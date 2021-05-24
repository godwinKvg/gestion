<?php

class sanitizer{


    /**
     * Neutralise la chaine de caractère passée comme paramètre
     */
    private function sanitize($var)
    {
        $r = isset($var) ? htmlspecialchars(trim($var)) : "";

        // TODO : on doit faire ...

        return $r;
    }


    /**
     * Neutralise la chaine de caractère envoyée par POST
     */

    public function sanitizePost($var)
    {
        $r = isset($_POST[$var]) ? sanitize($_POST[$var]) : "";

        return $r;
    }

    /**
     * Neutralise la chaine de caractère envoyée par GET
     */
    public function sanitizeGet($var)
    {
        $r = isset($_GET[$var]) ? sanitize($_GET[$var]) : "";

        return $r;
    }


}