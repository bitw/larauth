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
        'registration' => 'larauth::larauth/registration',
        'activation' => 'larauth::larauth/activation',
        'request_code' => 'larauth::larauth/request_code',
        'mail_activation' => 'larauth::larauth/mail_activation',
        'mail_registration' => 'larauth::larauth/mail_registration',
        'logon' => 'larauth::larauth/logon',
        'forgot' =>  'larauth::larauth/forgot',
        'mail_forgotpassword' => 'larauth::larauth/mail_forgotpassword',
        'new_password' => 'larauth::larauth/new_password',
    ],

    'registration' => array(
        'captcha_protect' => true,
        'generate_password' => false,
        'require_activation' => true,
        'min_password' => 6,
    ),

);