<?php

class LarauthController extends \BaseController
{

    public function __construct()
    {
        \Debugbar::disable();
    }

    /**
     * Display authorization form
     */
    public function getLogon()
    {
        return View::make(Config::get('Larauth::views.logon'))
            ->with('errors', Session::get('errors'));
    }


    public function postLogon()
    {
        $valid = Validator::make(
            Input::all(),
            array(
                'email' => 'required|email',
                'password' => 'required'
            )
        );

        if ($valid->fails()) {
            return Redirect::route('larauth.logon')
                ->with('errors', $valid->errors())
                ->with(Input::all());
        }

        try
        {
            $user = Sentry::authenticate([
                'email' => Input::get('email'),
                'password' => Input::get('password'),
            ], Input::get('remember'));

            return Redirect::to('/');
        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            echo 'Login field is required.';
        }
        catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
        {
            echo 'Password field is required.';
        }
        catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
        {
            echo 'Wrong password, try again.';
        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            echo 'User was not found.';
        }
        catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
        {
            echo 'User is not activated.';
        }

        // The following is only required if the throttling is enabled
        catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
        {
            echo 'User is suspended.';
        }
        catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
        {
            echo 'User is banned.';
        }
    }


    /**
     * Registration form
     */
    public function getRegistration()
    {
        return View::make(Config::get('Larauth::views.registration'))
            ->with('errors', Session::get('errors'));
    }

    public function postRegistration()
    {
        $rules['email'] = 'required|email|unique:users,email';

        if (Config::get('Larauth::registration.captcha_protect'))
            $rules['recaptcha_response_field'] = 'required|recaptcha';

        if (!Config::get('Larauth::registration.generate_password'))
            $rules['password'] = 'required|min:' . Config::get('Larauth::registration.min_password') . '|confirmed';

        $messages = [
            'email.unique' => Lang::get('Larauth::larauth.email_already_registered', ['email' => Input::get('email')]),
            'password.required' => Lang::get('Larauth::larauth.password_required'),
            'password.min' => Lang::get('Larauth::larauth.password_min', ['min' => Config::get('Larauth::registration.min_password')]),
            'password.confirmed' => Lang::get('Larauth::larauth.password_confirmed'),
        ];

        $valid = Validator::make(
            Input::all(),
            $rules,
            $messages
        );

        if (!$valid->passes())
            return Redirect::route('larauth.registration')
                ->with('errors', $valid->errors())
                ->with(Input::all());

        if (Config::get('Larauth::registration.generate_password'))
            $password = str_random(8);
        else
            $password = Input::get('password');

        if (Config::get('Larauth::registration.require_activation')) {
            // если активация обязательна
            // формируем и высылаем письмо с инструкцией по активации
            $user = Sentry::register(array(
                'email' => Input::get('email'),
                'password' => $password,
            ));

            $activationCode = $user->getActivationCode();

            $data = array_merge(
                ['code' => $activationCode, 'password' => $password],
                Input::all()
            );

            //Запоминаем пароль в хеше на сутки
            Cache::put(md5(Input::get('email')), $password, 60*24);

            Mail::send(
                Config::get('Larauth::views.mail_activation'),
                $data,
                function ($message) use ($data) {
                    $message
                        ->to($data['email'])
                        ->subject(trans('Larauth::larauth.activation'));
                }
            );

            return Redirect::route('larauth.activation');

        } else {
            // иначе создаем пользователя и высылаем уведомление о регистрации
            $user = Sentry::createUser(array(
                'email' => Input::get('email'),
                'password' => $password,
                'activated' => true
            ));

            $data = [
                'email' => Input::get('email'),
                'password' => $password
            ];

            // Высылаем письмо с сообщением об успешной регистрации
            Mail::send(
                Config::get('Larauth::views.mail_registration'),
                $data,
                function ($message) use ($data) {
                    $message
                        ->to($data['email'])
                        ->subject(trans('Larauth::larauth.registration_success'));
                }
            );
        }

        if ($valid->errors()->count()) {
            return Redirect::route('larauth.registration')
                ->with('errors', $valid->errors())
                ->with(Input::all());
        }
    }

    /**
     * Actiovation account
     */
    public function getActivation($code = null)
    {
        if (Session::get('activated')) {
            return View::make(Config::get('Larauth::views.activation'));
        }

        if (Input::get('code')) {
            $code = Input::get('code');
        }

        if ($code) {
            try {
                $user = Sentry::findUserByActivationCode($code);

                $user->attemptActivation($code);

                $data = [
                    'email' => $user->email,
                    'password' => Cache::pull(md5($user->email))
                ];

                // Высылаем письмо с сообщением об успешной регистрации
                Mail::send(
                    Config::get('Larauth::views.mail_registration'),
                    $data,
                    function ($message) use ($data) {
                        $message
                            ->to($data['email'])
                            ->subject(trans('Larauth::larauth.registration_success'));
                    }
                );

                return Redirect::route('larauth.activation')
                    ->with('activated', TRUE);
            } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
                return Redirect::route('larauth.activation')
                    ->with('error', trans('Larauth::larauth.wrong_activation_code'));
            }
        }

        return View::make(
            Config::get('Larauth::views.activation'),
            [
                'error' => Session::get('error'),
                'code' => $code
            ]
        );
    }


    /**
     * Response view form for request activation code
     * @param none
     * @return view
     */
    public function getRequestCode()
    {
        return View::make(Config::get('Larauth::views.request_code'))
            ->with('error', Session::get('error'));
    }

    /**
     * Request activation code
     * @param $email string
     * @method post
     * @return redirect
     */
    public function postRequestCode()
    {
        $rules = [
            'email' => 'required|email|exists:users,email,activated,0'
        ];

        $messages = [
            'email.required' => trans('Larauth::larauth.email_required'),
            'exists' => trans('Larauth::larauth.user_acivated_or_not_registered'),
        ];

        $valid = Validator::make(
            Input::all(),
            $rules,
            $messages
        );

        if ($valid->fails()) {
            return Redirect::route('larauth.requestcode')->with('errors', $valid->errors());
        }

        $user = Sentry::findUserByCredentials(['email' => Input::get('email')]);


        $data = array_merge(
            ['code' => $user->activation_code, 'password' => Session::get('pasword')],
            Input::all()
        );

        Mail::send(
            Config::get('Larauth::views.mail_activation'),
            $data,
            function ($message) use ($data) {
                $message->to($data['email']);
            }
        );

        return Redirect::route('larauth.activation');
    }


    /**
     * Form for forgot or change password
     * @return view
     */
    public function getForgotPassword()
    {
        return View::make(Config::get('Larauth::views.forgot'))
            ->with('errors', Session::get('errors'))
            ->with('processed', Session::get('processed'));
    }

    /**
     * Request forgot password
     * @param $email string
     * @return redirect
     */
    public function postForgotPassword()
    {
        $valid = Validator::make(
            Input::all(),
            array(
                'email' => 'required|email|exists:users'
            ),
            array(
                'exists' => \Patchwork\Utf8::ucfirst(trans('Larauth::larauth.account_with_email_not_exist')),
            )
        );
        if (!$valid->passes()) {
            return Redirect::route('larauth.forgot_password')
                ->with('errors', $valid->errors())
                ->with(Input::all());
        }

        $user = Sentry::findUserByCredentials(['email'=>Input::get('email')]);

        $key = $user->getResetPasswordCode();

        $data = ['key' => $key, 'email'=>Input::get('email')];

        Mail::send(
            Config::get('Larauth::views.mail_forgotpassword'),
            $data,
            function($message) use ($data){
                $message
                    ->to($data['email'])
                    ->subject(trans('Larauth::larauth.password_recovery'));
            }
        );

        return Redirect::route('larauth.forgot_password')->with('processed', true);
    }

    /**
     * For for make new password
     */
    public function getNewPassword($email, $key)
    {
        $view = View::make(Config::get('Larauth::views.new_password'));

        if(Session::get('processed'))
        {
            return $view
                ->with([
                    'errors'    => false,
                    'email'     => $email,
                    'key'       => $key
                ]);
        }

        if(Session::get('errors'))
            return $view
                ->with([
                    'errors'    => Session::get('errors'),
                    'email'     => $email,
                    'key'       => $key
                ]);

        $valid = Validator::make(
            [
                'email' => $email,
            ],
            [
                'email' => 'required|email|exists:users',
            ]
        );

        if($valid->fails())
            return Redirect::route('larauth.forgot_password');

        $user = Sentry::findUserByCredentials(['email'=>$email]);

        if(!$user->checkResetPasswordCode($key))
            return Redirect::route('larauth.forgot_password');

        return $view
            ->with([
                'errors'    => $valid->errors(),
                'email'     => $email,
                'key'       => $key
            ]);
    }

    /**
     * Change new password
     */
    public function postNewPassword($email, $key)
    {
        $valid = Validator::make(
            [
                'email' => $email,
                'key' => $key,
            ],
            [
                'email' => 'required|email|exists:users',
                'key' => 'required|exists:users,reset_password_code',
            ]
        );

        if($valid->fails())
        {
            return Redirect::route('larauth.new_password', ['email'=>$email, 'key'=>$key])->with('errors', $valid->errors());
        }

        $valid = Validator::make(
            [
                'password' => Input::get('password'),
                'password_confirmation' => Input::get('password_confirmation'),
            ],
            [
                'password' => 'required|confirmed|min:'.Config::get('Larauth::registration.min_password'),
            ],
            [
                'key.required' => trans('Larauth::larauth,process_key_required'),
                /*
                'key.exists'=> trans('Larauth::larauth.process_key_incorrect',
                    ['repeat_recovery_password'=>link_to_route('larauth.forgot_password', trans('Larauth::larauth.repeat_recovery_password'))]
                ),
                */
                'password.required' => trans('Larauth::larauth.password_required'),
                'password.confirmed' => trans('Larauth::larauth.password_confirmed'),
                'password.min' => trans('Larauth::larauth.password_min', ['min'=>Config::get('Larauth::registration.min_password')])
            ]
        );

        if($valid->fails())
        {
            return Redirect::route('larauth.new_password', ['email'=>$email, 'key'=>$key])->with('errors', $valid->errors());
        }

        $user = Sentry::findUserByCredentials(['email'=>$email]);

        if($user->attemptResetPassword($key, Input::get('password')))
        {
            return Redirect::route('larauth.new_password')->with('processed', true);
        }
    }

    /**
     * Logout
     * @param $token string
     */
    public function getLogout()
    {

    }
}
