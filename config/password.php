<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Password Broker
    |--------------------------------------------------------------------------
    |
    | This option controls the default password broker that will be used when
    | performing password resets and other password related operations.
    |
    */

    'defaults' => [
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Brokers
    |--------------------------------------------------------------------------
    |
    | Here you may define multiple password reset configurations if you have more
    | than one user table or model in the application and you want to have
    | separate password reset settings based on the specific user types.
    |
    | The expire time is the number of minutes that each reset token will be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less time to be guessed. You may change this as needed.
    |
    | The throttle setting is the number of seconds a user must wait before
    | generating more password reset tokens. This prevents the user from
    | quickly generating a very large amount of password reset tokens.
    |
    */
    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Here you may define the amount of seconds before a password confirmation
    | times out and the user is prompted to re-enter their password via the
    | confirmation screen. By default, the timeout lasts for three hours.
    |
    */
    'password_timeout' => 10800,

    /*
    |--------------------------------------------------------------------------
    | Password Hashing Strategy
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default password hashing strategy that should
    | be used when hashing passwords for the application. The bcrypt algorithm
    | is the default hashing algorithm for Laravel and is a great choice.
    |
    */
    'hashing' => [
        'driver' => 'bcrypt',
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Validation Rules
    |--------------------------------------------------------------------------
    |
    | Here you may define the validation rules which will be used to validate
    | passwords as they are set by the user. You may modify these rules
    | as needed to better match your application's requirements.
    |
    */
    'validation' => [
        'rules' => [
            'required',
            'string',
            'min:8',
            'confirmed',
        ],
        'messages' => [
            'required' => 'Le champ mot de passe est requis.',
            'string' => 'Le mot de passe doit être une chaîne de caractères.',
            'min' => 'Le mot de passe doit contenir au moins :min caractères.',
            'confirmed' => 'La confirmation du mot de passe ne correspond pas.',
        ],
    ],
];
