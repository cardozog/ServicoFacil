<?php

namespace Servicofacil;

require_once("../vendor/autoload.php");

use Servicofacil\TipoServicoDao;

class TipoServico
{
    use TipoServicoDao;

    private $id, $nome;
    public function __construct($id, $nome)
    {
        $this->id = $id;
        $this->nome = $nome;
    }
    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }
}
