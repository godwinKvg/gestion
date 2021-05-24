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
        $params = [];

        if (isset($_GET['p'])) {
            $params = explode('/', $_GET['p']);
        }


        if (!empty($params[0])) {

            $file =  (isset($params[0])) ? array_shift($params) : 'contact';

            $file = $PAGE_PATH . $file . '.php';

            if (file_exists($file)) {
                require_once $file;
            } else {
                http_response_code(404);
                echo "La page recherchée n'existe pas";
            }
        } else {
            require_once $PAGE_PATH . 'contact.php';
        }
    }
}
