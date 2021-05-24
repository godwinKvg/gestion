<?php 

class Validators{
    
    /**
     * Permet d'avoir les erreurs de validation d'un formulaire sous forme d'une liste à puces
     */
    public function getValidationError($ValidationErros, $key)
    {
        $errors = '';
        if (isset($ValidationErros[$key])) {

            $errors = arrayToUL($ValidationErros[$key], 'text-danger');
        }

        return $errors;
    }

    /**
     * Permet d'afficher les erreurs
     */
    public function printValidationError($ValidationErros, $key)
    {
        echo getValidationError($ValidationErros, $key);
    }

    /**
     * Neutralise la chaine de caractère envoyée par POST
     */
    public function sanitazePost($var)
    {
        $r = isset($_POST[$var]) ? sanitaze($_POST[$var]) : "";

        return $r;
    }
}