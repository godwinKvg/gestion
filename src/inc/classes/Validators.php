<?php

require_once 'Sanitizer';

class Validators
{

    /**
     * Permet d'avoir les erreurs de validation d'un formulaire sous forme d'une liste à puces
     */
    public function getValidationError($ValidationErros, $key)
    {
        $errors = '';
        if (isset($ValidationErros[$key])) {

            $errors = $this->arrayToUL($ValidationErros[$key], 'text-danger');
        }

        return $errors;
    }

    /**
     * Permet d'afficher les erreurs
     */
    public function printValidationError($ValidationErros, $key)
    {
        echo $this->getValidationError($ValidationErros, $key);
    }

    /**
     * Neutralise la chaine de caractère envoyée par POST
     */
    public function sanitazePost($var)
    {
        $r = isset($_POST[$var]) ? Sanitizer::sanitize($_POST[$var]) : "";

        return $r;
    }

    /**
     * Construit une liste à puce avec les données d'un tableau
     */
    function arrayToUL($array, $class)
    {
        $ul = '<ul>';
        foreach ($array as $li) {
            $ul .= '<li class="' . $class . '">' . $li . '</li>';
        }
        $ul .= '</ul>';

        return $ul;
    }
}
