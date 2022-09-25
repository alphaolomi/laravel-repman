<?php

/**
 * Repman Configuration
 */
return [

    /**
     * API Base Url
     * If your using the default Repman API, you can leave this as is.
     */
    'url' => env('REPMAN_URL', 'https://app.repman.io/api'),

    /**
     * API Token
     * While logged in, obtain your token from https://app.repman.io/user/token
     */
    'token' => env('REPMAN_TOKEN'),
];
