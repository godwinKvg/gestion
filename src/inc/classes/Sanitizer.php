<?php

class Sanitizer
{


    /**
     * Neutralise la chaine de caractère passée comme paramètre
     */
    public static function sanitize($var)
    {
        $r = isset($var) ? htmlspecialchars(trim($var)) : "";

        // TODO : on doit faire ...

        return $r;
    }


    /**
     * Neutralise la chaine de caractère envoyée par POST
     */

    public static function sanitizePost($var)
    {
        $r = isset($_POST[$var]) ? self::sanitize($_POST[$var]) : "";
        return $r;
    }

    /**
     * Neutralise la chaine de caractère envoyée par GET
     * 
     * Retourne une chaîne de caractères contenant la valeur de $_GET[$var]
     *
     * @param mixed $var
     * @return string
     */
    public static function sanitizeGet($var)
    {
        $r = isset($_GET[$var]) ? self::sanitize($_GET[$var]) : "";

        return $r;
    }
}
