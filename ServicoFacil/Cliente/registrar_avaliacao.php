<?php

namespace Servicofacil;

require_once("../vendor/autoload.php");
session_start();
$cliente = $_SESSION["cliente"];
$idSolicitacao = filter_input(INPUT_POST, "idSolicitacao", FILTER_SANITIZE_NUMBER_INT);
Solicitacao::avaliarSolicitacao($idSolicitacao);
$cliente->concederCreditos(10.00);
$_SESSION["cliente"] = $cliente;
header("location: index.php");
