<?php

namespace Servicofacil;

require_once("../vendor/autoload.php");

use Servicofacil\ServicoDao;

class Servico
{
    use ServicoDao;

    private $id, $tipo, $descricao, $valor;
    public function __construct($id, $tipo, $descricao, $valor)
    {
        $this->id = $id;
        $this->tipo = $tipo;
        $this->descricao = $descricao;
        $this->valor = $valor;
    }
    public function getId()
    {
        return $this->id;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function getValor()
    {
        return $this->valor;
    }
}
