<?php
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 27.05.2014
 * Time: 21:26
 */

return array(

    'template'  => 'default',
    'out'       => 'content',

    'views'     => [
        'registration' => 'Larauth::larauth/registration',
        'activation' => 'Larauth::larauth/activation',
        'request_code' => 'Larauth::larauth/request_code',
        'mail_activation' => 'Larauth::larauth/mail_activation',
        'mail_registration' => 'Larauth::larauth/mail_registration',
        'logon' => 'Larauth::larauth/logon',
        'forgot' =>  'Larauth::larauth/forgot',
        'mail_forgotpassword' => 'Larauth::larauth/mail_forgotpassword',
        'new_password' => 'Larauth::larauth/new_password',
    ],

    'registration' => array(
        'captcha_protect' => true,
        'generate_password' => false,
        'require_activation' => true,
        'min_password' => 6,
    ),

);