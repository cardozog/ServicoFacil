<?php

namespace Servicofacil;

require_once("../vendor/autoload.php");

use Servicofacil\PrestadorDao;

class Prestador extends Usuario
{
    use PrestadorDao;
    private $dataUltimoServico, $executandoServico;
    public function __construct($id, $email, $dataUltimoServico, $validacaoEmail, $executandoServico)
    {
        parent::__construct($id, $email, $validacaoEmail);
        $this->dataUltimoServico = $dataUltimoServico;
        $this->executandoServico = $executandoServico;
    }

    public function getDataUltimoServico()
    {
        return $this->dataUltimoServico;
    }
    public function setDataUltimoServico()
    {
        date_default_timezone_set('America/Sao_Paulo');
        $this->dataUltimoServico = date("Y-m-d H:i:s");
        PrestadorDao::atualizarDataUltimoAtendimento($this->getId());
    }

    public function getExecutandoServico()
    {
        return $this->executandoServico;
    }

    public function setExecutandoServico()
    {
        if ($this->executandoServico == 1) {
            $this->executandoServico = 0;
        } else {
            $this->executandoServico = 1;
            $this->setDataUltimoServico();
        }
        Prestador::atualizarDados($this->getId(), $this->getDataUltimoServico(), $this->getValidacaoEmail(), $this->getExecutandoServico());
    }
}
