<?php
namespace aligncommerce\lib\Align\Config;

/**
 * Credentials object used for OAuth 2.0 and Align Commerce API.
 */

abstract class Apiconfig
{
    public static $authBasicUsername  = ''; 
    public static $authBasicPassword  = '';
    public static $clientId           = '';
    public static $secretKey          = '';
    public static $apiUrl             = '';  

    public static function getBasicAuthUsername()
    {
        return self::$authBasicUsername;
    }

    public static function getBasicAuthPassword()
    {
    return self::$authBasicPassword;
    }

    public static function getClientId()
    {
        return self::$clientId;
    }

}
