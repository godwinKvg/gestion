<?php

class Application
{
    /**
     * Routeur principal
     *
     * @return void
     */
    public static function process()
    {
        $PAGE_PATH = 'src/inc/pages/';
        $param = '';

        if (isset($_GET['p'])) {
            $param = $_GET['p'];
        }

        if (!empty($param)) {

            $file = $param;


            $file = $PAGE_PATH . $file . '.php';

            if (file_exists($file)) {
                require_once $file;
            } else {
                http_response_code(404);
                require_once 'error.php';
            }
        } else {
            require_once $PAGE_PATH . 'contact.php';
        }
    }
}
