<?php


require_once 'Sanitizer.php';
class Message
{

    /**
     * cette fonction construit un message
     * on se basant sur les messages donnés dans messages.php
     *   
     */
    public static function getValidationMessage($errorName, $associ)
    {
        global $messages;
        // On sélectionne le message
        $msg = $messages[$errorName];

        // On remplace tous paramètres par leurs valeurs
        foreach ($associ as $key => $val) {

            $msg = str_replace('{' . $key . '}', $val, $msg);
        }

        return $msg;
    }

    /**
     * Permet d'entourer un text par une balise avec classe CSS
     */
    public static function insertTextInTag($tag, $text, $class = '')
    {
        return '<' . $tag . ' class="' . $class . '">' . $text . '</' . $tag . '>';
    }


    /**
     * Construit un message d'erreur
     */
    public static function errorMsg($text, $type = 2)
    {
        if ($type == 1) {
            return '<p class="text-danger">' . $text . '</p>';
        }
        return '<div class="alert alert-danger col-md-6 mb-1 mt-1" role="alert">' . $text . '</div>';
    }

    /**
     * Construit un message de succès
     */
    public static function okMsg($text, $type = 2)
    {
        if ($type == 1) {
            return '<p class="text-success">' . $text . '</p>';
        }

        return '<div class="alert alert-success col-md-6 mb-1 mt-1" role="alert">' . $text . '</div>';
    }


    /**
     * Construit un message d'avertissement
     */
    public static function warnMsg($text, $type = 2)
    {
        if ($type == 1) {
            return '<p class="text-warning">' . $text . '</p>';
        }
        return '<div class="alert alert-warning col-md-6 mb-1 mt-1" role="alert">' . $text . '</div>';
    }

    public static function showGetMsg()
    {
        if ((int)Sanitizer::sanitizeGet('status') === -1) {
            echo self::errorMsg(Sanitizer::sanitizeGet('msg'));
        } else if ((int)Sanitizer::sanitizeGet('status') === 1) {
            echo self::okMsg(Sanitizer::sanitizeGet('msg'));
        }
    }
}
