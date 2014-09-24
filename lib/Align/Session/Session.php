<?php

//Namespace
namespace aligncommerce\lib\Align\Session;

/**
 * Service definition for Session.
 */
class Session implements \SessionHandlerInterface
{
    private $savePath;

    public function open($savePath, $sessionName)
    {
        $this->savePath = $savePath;
        if ( !is_dir($this->savePath) ) 
        {
            mkdir($this->savePath, 0777);
        }

        return true;
    }

    /**
     * Close the current session.
     */
    public function close()
    {
        return true;
    }

    /**
     * Read session data
     *
     * @param string $id 
     */
    public function read($id)
    {
        return (string)@file_get_contents("$this->savePath/sess_$id");
    }

    /**
     * Write session data
     *
     * @param string $id key name
     * @param array $data data/info
     */
    public function write($id, $data)
    {
        return file_put_contents("$this->savePath/sess_$id", $data) === false ? false : true;
    }

    /**
     * @Destroy's the session 
     *
     * @param string $id key name
     */
    public function destroy($id)
    {
        $file = "$this->savePath/sess_$id";
        if (file_exists($file)) {
            unlink($file);
        }

        return true;
    }

    public function gc($maxlifetime)
    {
        foreach (glob("$this->savePath/sess_*") as $file) {
            if (filemtime($file) + $maxlifetime < time() && file_exists($file)) {
                unlink($file);
            }
        }

        return true;
    }
}