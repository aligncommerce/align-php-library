<?php

//Namespaces
namespace aligncommerce\lib\Align\HttpClient;
use aligncommerce\lib\Align\HttpClient\Curl as Curl;
use aligncommerce\lib\Align\Config\Apiconfig as config;
use aligncommerce\lib\Align\Session\Session as Session;

/**
 * Service definition for AccessToken.
 * This AccessToken Class handles the request to generate token needed in accessing the API
 */

class AccessToken extends Curl {
  
    protected static $_instance;
    protected $grant_type = 'client_credentials';
    protected $accessToken;
    protected $machineId;
    protected $expiresAt;
    protected $scope  = array('products','buyer','invoice');
    public    $curl;
    protected $session;

    public function __construct()
    { 
        $this->curl    = new Curl;
        $this->session = new Session;
        session_write_close();
        session_set_save_handler($this->session, true);
        session_start();
    }

    /**
     * Handles request for new token if the current token is expired
     *
     * @return string token
     */
    public function getAuthorizationCode()
    {
        $oauth_param = array(
            'grant_type'    => $this->grant_type, 
            'client_id'     => config::$clientId,
            'client_secret' => config::$secretKey,
            'scope'         => implode(',', $this->scope));

        $url        = config::$apiUrl . 'oauth/access_token';
        $response   = $this->curl->request('post', $url, $oauth_param);

        if( $response )
        {
            $res = json_decode($response);
            if( isset($res->access_token) )
            {
                $this->setExpiresAtFromTimeStamp($res->expires);
                $this->session->write('access_token',$res->access_token);
                $this->session->write('expires', $this->expiresAt);

                $read = $this->session->read('access_token');
                session_write_close();
            }
            elseif( isset($res->error) )
            {
                die($response);
            }
        }
    }

    /**
     * Sets expiration date of the access token based on the current timestamp
     * 
     * @param datetime $timestamp current datetime
     * @access protected
     */
    protected function setExpiresAtFromTimeStamp($timeStamp)
    {
        $dt              = new \DateTime();
        $expire          = $dt->setTimestamp($timeStamp);
        $this->expiresAt = $expire->format('Y-m-d H:i:s');
    }

}