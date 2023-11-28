<?php

namespace Servicofacil;

require_once("../vendor/autoload.php");

session_start();

if (isset($_SESSION["prestador"])) {
    date_default_timezone_set('America/Sao_Paulo');
    $dataLocal = date('Y/m/d H:i:s');
    $prestador = $_SESSION["prestador"];
    $prestador->validarEmail();
    $prestador->atualizarDados($prestador->getId(), $dataLocal, 1, 0);
    $_SESSION["prestador"] = $prestador;
    header("Location: ../Prestador/index.php");
    exit();
} else if (isset($_SESSION["cliente"])) {
    $cliente = $_SESSION["cliente"];
    $cliente->validarEmail();
    $cliente->atualizarDados($cliente->getId(), $cliente->getCreditos(), $cliente->getValidacaoEmail());
    $_SESSION["cliente"] = $cliente;
    header("Location: ../Cliente/index.php");
}
