<?php

namespace Servicofacil;

require_once("../vendor/autoload.php");

abstract class Usuario
{

    private $id, $email, $validacaoEmail;

    public function __construct($id, $email, $validacaoEmail)
    {
        $this->id = $id;
        $this->email = $email;
        $this->validacaoEmail = $validacaoEmail;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getValidacaoEmail()
    {
        return $this->validacaoEmail;
    }

    public function validarEmail()
    {
        $this->validacaoEmail = 1;
    }
}
