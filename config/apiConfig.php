<?php
return          [
    // #1 getUserProfile
    'getUserProfile' => [
        'baseUri'   => 'PLATFORM-ADDRESS',
        'subUri' => 'nzh/doServiceCall',
        'method'    => 'GET'
    ],

    // #2 editProfile
    'editProfile' => [
        'baseUri'   => 'PLATFORM-ADDRESS',
        'subUri' => 'nzh/doServiceCall',
        'method'    => 'POST'
    ],

    // #3 editProfileWithConfirmation
    'editProfileWithConfirmation' => [
        'baseUri'   => 'PLATFORM-ADDRESS',
        'subUri' => 'nzh/doServiceCall',
        'method'    => 'POST'
    ],

    // #4 confirmEditProfile
    'confirmEditProfile' => [
        'baseUri'   => 'PLATFORM-ADDRESS',
        'subUri' => 'nzh/doServiceCalle',
        'method'    => 'POST'
    ],

    // #5 listAddress
    'getListAddress' => [
        'baseUri'   => 'PLATFORM-ADDRESS',
        'subUri' => 'nzh/doServiceCall',
        'method'    => 'GET'
    ],

];
