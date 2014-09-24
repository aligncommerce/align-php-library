= Align Commerce PHP Library

Register account at https://aligncommerce.com/dashboard/.

== Requirements

PHP 5.4 and later.

== Installation

Obtain the latest version :

	git clone https://github.com/aligncommerce/align-php-library.git

To use the Library, add the following to your PHP Script:
	
	require_once("/path/lib/Align.php");

== Configuration

	Configure your credential on lib/Align/Apiconfig.php
	authBasicUsername = Username that you used in our registration.
	authBasicPassword = Password that you used in our registration.	
	clientId  = Provided in https://aligncommerce.com/dashboard/keys.
	secretKey = Provided in https://aligncommerce.com/dashboard/keys.

Basic usage:
	require_once("lib/Align.php");
	echo Invoice::create(array(
					'checkout_type' => 'btc',
					'order_id' => 'test1',
						'products' => array(
										array(
											'product_name' => 'choco',
											'product_price' => 12,
											'quantity' => 1,
											'product_shipping' => 0),
											array(
											'product_name' => 'choco2',
											'product_price' => 9,
											'quantity'=> 1,
											'product_shipping' => 0)
										),
						'buyer_info' => array(
										'first_name' => 'Align',
										'last_name' => 'Commerce',
										'email' => 'align@mail.com',
										'address_1' => 'Test Address',
										'address_2' => 'Test Address2')
										)
					);

