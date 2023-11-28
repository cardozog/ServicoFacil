<?php

namespace Servicofacil;

require_once("../vendor/autoload.php");

use Servicofacil\SolicitacaoDao;

class Solicitacao
{
    use SolicitacaoDao;
    private $id,  $idPrestador, $idCliente, $idServico, $dataSolicitacao, $valorFinal, $statusSolicitacao;

    public function __construct($id, $idPrestador, $idCliente, $idServico, $dataSolicitacao, $valorFinal, $statusSolicitacao)
    {
        $this->id = $id;
        $this->idPrestador = $idPrestador;
        $this->idCliente = $idCliente;
        $this->idServico = $idServico;
        $this->dataSolicitacao = $dataSolicitacao;
        $this->valorFinal = $valorFinal;
        $this->statusSolicitacao = $statusSolicitacao;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getIdPrestador()
    {
        return $this->idPrestador;
    }
    public function getIdCliente()
    {
        return $this->idCliente;
    }
    public function getIdServico()
    {
        return $this->idServico;
    }
    public function getDataSolicitacao()
    {
        return $this->dataSolicitacao;
    }

    public function getValorFinal()
    {
        return $this->valorFinal;
    }
    public function getStatusSolicitacao()
    {
        return $this->statusSolicitacao;
    }

    public function alterarStatus($status)
    {
        $this->statusSolicitacao = $status;
    }
}
