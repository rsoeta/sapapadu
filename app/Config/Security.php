<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Security extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * CSRF Protection Method
     * --------------------------------------------------------------------------
     *
     * Enables a CSRF cookie token for forms.
     */
    public bool $csrfProtection = false;

    /**
     * --------------------------------------------------------------------------
     * CSRF Token Name (for session-based protection)
     * --------------------------------------------------------------------------
     */
    public string $tokenName = 'csrf_token';

    /**
     * --------------------------------------------------------------------------
     * CSRF Header Name (for AJAX requests)
     * --------------------------------------------------------------------------
     */
    public string $headerName = 'X-CSRF-TOKEN';

    /**
     * --------------------------------------------------------------------------
     * CSRF Cookie Settings
     * --------------------------------------------------------------------------
     */
    public string $cookieName     = 'csrf_cookie';
    public string $cookiePrefix   = '';
    public string $cookieDomain   = '';
    public string $cookiePath     = '/';
    public bool   $cookieSecure   = false;
    public bool   $cookieHTTPOnly = false;
    public string $samesite       = 'Lax';

    /**
     * --------------------------------------------------------------------------
     * CSRF Exclude URIs
     * --------------------------------------------------------------------------
     */
    public array $excludeURIs = [];

    /**
     * --------------------------------------------------------------------------
     * CSRF Token Expiration
     * --------------------------------------------------------------------------
     */
    public int $expires = 7200;

    /**
     * --------------------------------------------------------------------------
     * Token Randomization
     * Options: none, sha1, md5
     * --------------------------------------------------------------------------
     */
    public string $tokenRandomize = 'none';

    /**
     * --------------------------------------------------------------------------
     * Token Segments
     * --------------------------------------------------------------------------
     */
    public array $tokenSegments = [
        0 => 'csrf_token',
        1 => 'csrf_hash',
    ];

    /**
     * --------------------------------------------------------------------------
     * Redirect on failure
     * --------------------------------------------------------------------------
     */
    public bool $redirect = false;
}
