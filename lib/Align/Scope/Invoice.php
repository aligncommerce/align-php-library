<?php

//Namespaces
use aligncommerce\lib\Align\HttpClient\ApiRequest as Request;
use aligncommerce\lib\Align\Config\Apiconfig as Config;

/**
 * Service definition for Invoice.
 */
class Invoice extends Request
{
    public $request;

    /**
     * Returns invoice info if id != null or list of ivoices if id = null
     *
     * @param string $id invoice id
     * @return json invoice info/list
     */
    public static function retrieve($id=null)
    {
        $request = new Request();

        if( !is_null($id) )
        {
            $response = $request->get('invoice/' . $id);
        }
        else
        {
            $response = $request->all('invoice'); 
        }

        return $response;
    }

    /**
     * Creates invoice info
     *
     * @param array $data invoice info
     * @return json response
     */
    public static function create($data)
    {
        $request  = new Request();
        $response = $request->post('invoice/',$data);
        return $response;
    }

    /**
     * Update invoice info
     *
     * @param string $id invoice id
     * @param array $id invoice info
     * @return json response
     */
    public static function update($id,$data)
    {
        $request  = new Request();
        $response = $request->put('invoice/'.$id,$data);
        return $response;
    }

}
