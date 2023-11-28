<?php

namespace Servicofacil;

use Servicofacil\Solicitacao;

require_once("../vendor/autoload.php");
session_start();
$prestador = $_SESSION["prestador"];
$idSolicitacao = filter_input(INPUT_POST, "idServico", FILTER_SANITIZE_NUMBER_INT);

if (Solicitacao::concluirSolicitacao($idSolicitacao)) {
    $prestador->setExecutandoServico();
    $_SESSION["prestador"] = $prestador;
    header("location:index.php");
}
