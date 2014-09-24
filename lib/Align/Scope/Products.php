<?php

//Namespaces
use aligncommerce\lib\Align\HttpClient\ApiRequest as Request;
use aligncommerce\lib\Align\Config\Apiconfig as Config;

/**
 * Service definition for Products.
 */
class Products extends Request
{
    public $request;

    /**
     * Returns product info if id != null or list if id = null
     *
     * @param string $id product id
     * @return product info/list
     */
    public static function retrieve($id=null)
    {
        $request = new Request();

        if( !is_null($id) )
        {
            $response = $request->get('products/' . $id);
        }
        else
        {
            $response = $request->all('products'); 
        }

        return $response;
    }

    /**
     * Creates product info
     *
     * @param array $data product info
     * @return json response
     */
    public static function create($data)
    {
        $request  = new Request();
        $response = $request->post('products/',$data);
        return $response;
    }

    /**
     * Update product info
     *
     * @param string $id product id
     * @param array $id product info
     * @return json response
     */
    public static function update($id,$data)
    {
        $request = new Request();
        $response = $request->put('products/'.$id,$data);
        return $response;
    }

}
