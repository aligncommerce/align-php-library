Align Commerce PHP Library
==========================

Requirements :

PHP 5.4 and later.

Registration :

	Register account at https://aligncommerce.com/dashboard/

Installation

Obtain the latest version :

	git clone https://github.com/aligncommerce/align-php-library.git

To use the Library, add the following to your PHP Script:
	
	require_once("/path/lib/Align.php");

Configuration :

	Configure your credential on lib/Align/Apiconfig.php
	
	authBasicUsername = Username that you used in our registration.
	
	authBasicPassword = Password that you used in our registration.	
	
	clientId  = Provided in https://aligncommerce.com/dashboard/keys.
	
	secretKey = Provided in https://aligncommerce.com/dashboard/keys.

Basic usage:

	require_once("lib/Align.php");
	echo Invoice::retrieve();
