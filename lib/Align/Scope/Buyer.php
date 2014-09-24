<?php

//Namespaces
use aligncommerce\lib\Align\HttpClient\ApiRequest as Request;
use aligncommerce\lib\Align\Config\Apiconfig as Config;

/**
 * Service definition for Buyer.
 */

class Buyer extends Request
{
	public $request;

	/**
	 * Returns buyer's single info if id != null or list of buyers if id = null
	 *
	 * @param string $id buyer id
	 * @return json buyer's info/list
	 */
	public static function retrieve($id=null)
	{
		$request = new Request();
 
		if( !is_null($id) )
		{
			$response = $request->get('buyer/' . $id);
		}
		else
		{
			$response = $request->all('buyer'); 
		}

	    return $response;
	}

	/**
	 * Creates buyer info
	 *
	 * @param array $data buyer info
	 * @return json response
	 */
	public static function create($data)
	{
		$request  = new Request();
		$response = $request->post('buyer/',$data);
		return $response;
	}

	/**
	 * Update buyer info
	 *
	 * @param string $id buyer id
	 * @param array $data buyer info
	 * @return json response
	 */
	public static function update($id,$data)
	{
		$request  = new Request();
		$response = $request->put('buyer/'.$id,$data);
		return $response;
	}

}
