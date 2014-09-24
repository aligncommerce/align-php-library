<?php

//Namespace
namespace aligncommerce\lib\Align\HttpClient;
use aligncommerce\lib\Align\HttpClient\Curl as Curl;
use aligncommerce\lib\Align\Session\Session as Session;
use aligncommerce\lib\Align\Config\Apiconfig as Config;
use aligncommerce\lib\Align\HttpClient\AccessToken as Oauth;

/**
 * Service definition for ApiRequest.
 */
class ApiRequest
{
    public $curl;
    public $session;
    protected static $accessToken;
    public $apiUrl; 

    public function __construct()
    { 
        $this->curl         = new Curl;
        $this->session      = new Session;
        session_write_close();
        session_set_save_handler($this->session , true);
        session_start();
        
        $accessToken      = $this->session->read('access_token');
        $is_expired_token = $this->isTokenExpired();
    
        if( $is_expired_token == false )
        {
            self::$accessToken = $accessToken;
        }
        else
        {
            session_write_close();
            $oauth = new Oauth;
            $oauth->getAuthorizationCode();
            self::$accessToken = $this->session->read('access_token');
        }  
    }

    /**
     * Get list of data
     * 
     * @param string $url (buyer,invoice,products)
     * @return json response
     */
    public function all($url)
    {
        $data     = array('access_token' => self::$accessToken);
        $apiUrl   = Config::$apiUrl . $url;
        $response = $this->curl->get($apiUrl, $data);
        return $response;
    }

    /**
     * Get single data
     * 
     * @param string $url {buyer/invoice/products}/retrieve/{id}
     * @return json response
     */
    public function get($url)
    {
        $data     = array('access_token' => self::$accessToken);
        $apiUrl   = Config::$apiUrl . $url;
        $response = $this->curl->get($apiUrl, $data);
        return $response;
    }

    /**
     * For creating data
     * 
     * @param string $url {buyer/invoice/products}/create/
     * @param array $data data info
     * @return json response
     */
    public function post($url,$data=array())
    {
        $data['access_token'] = self::$accessToken;
        $apiUrl               = Config::$apiUrl . $url;
        $response             = $this->curl->post($apiUrl, $data);
        return $response;
    }

    /**
     * For updating data
     * 
     * @param string $url {buyer/invoice/products}/update/
     * @param array $data data info
     * @return json response
     */
    public function put($url, $data=array())
    {
        $data['access_token'] = self::$accessToken;
        $apiUrl               = Config::$apiUrl . $url;
        $response             = $this->curl->put($apiUrl, $data);
        return $response;
    }

    /**
     * Checks token expiration
     * 
     * @return boolean
     */
    public function isTokenExpired()
    {
        $token_exp_date = $this->session->read('expires');

    if (strtotime($token_exp_date) < strtotime(date("Y-m-d H:i:s"))){
        $this->session->destroy('access_token');
        $this->session->destroy('expires');
        return true;
    }
    return false;
  }

}
