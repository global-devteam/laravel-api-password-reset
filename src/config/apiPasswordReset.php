<?php

return [
    'route' => [
        'prefix'     => 'api/v1/auth/',
        'uri'        => 'password',
        'middleware' => 'api',
    ],
    'tokenSize'             => 60,
    'emailNotificationLink' => 'some/link/',
    'bcryptPassword'        => true,

];
