<?php 

//PHP version 5.4 or higher.
if (version_compare(PHP_VERSION, '5.4.0', '<')) {
  throw new Exception('The Align Commerce Library requires PHP version 5.4 or higher.');
}

// Align Commerce needs this extension to run properply.
if ( !function_exists('curl_init') ) 
{
	throw new Exception('Please install CURL PHP extension.');
}
if ( !function_exists('json_decode') ) 
{
	throw new Exception('Please install JSON PHP extension.');
}

//API Configurations
require(dirname(__FILE__) . '/Align/Config/Apiconfig.php');

require(dirname(__FILE__) . '/Align/HttpClient/ApiRequest.php');

//Curl client and request
require(dirname(__FILE__) . '/Align/HttpClient/Curl.php');

//Oauth
require(dirname(__FILE__) . '/Align/HttpClient/AccessToken.php');

//Session
require(dirname(__FILE__) . '/Align/Session/Session.php');

//Scope
require(dirname(__FILE__) . '/Align/Scope/Products.php');
require(dirname(__FILE__) . '/Align/Scope/Invoice.php');
require(dirname(__FILE__) . '/Align/Scope/Buyer.php');