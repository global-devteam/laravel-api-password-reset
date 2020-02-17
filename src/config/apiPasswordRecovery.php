<?php

return [
    'routes' => [
        'api' => [
            'prefix' => 'api/v1/auth/',
            'uri' => 'password',
            'middleware' => 'api'
        ],
        'web' => [
            'prefix' => 'recover/',
            'uri' => 'password',
            'middleware' => 'web'
        ]

    ],
    'tokenSize' => 60,
    'emailNotificationLink' => 'some/link/',
    'bcryptPassword' => true,
    'formPath' => 'views/vendor/form/apiPasswordRecovery'

];
