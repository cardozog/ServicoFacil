<?php

namespace Servicofacil;

require_once("../vendor/autoload.php");
session_start();

use Servicofacil\Cliente;
use Servicofacil\Prestador;

$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
$senha = htmlspecialchars($_POST["senha"]);
$prestador = filter_input(INPUT_POST, "prestador", FILTER_SANITIZE_EMAIL);

if (!isset($prestador)) {
    $cliente = Cliente::buscarLogin($email, $senha);
    if ($cliente) {
        $_SESSION["cliente"] = $cliente;
        if ($cliente->getValidacaoEmail() == 1) {
            header("Location: ../Cliente/index.php");
        } else {
            header("location: tela_validacao.php");
        }
    } else {
        $_SESSION["estiloMsg"] = "msg-erro";
        $_SESSION["flash"] = "Usuário ou senha incorretos!";
        header("location:../login.php");
    }
} else {
    $prestador = Prestador::buscarLogin($email, $senha);
    if ($prestador) {
        $_SESSION["prestador"] = $prestador;
        if ($prestador->getValidacaoEmail() == 1) {
            header("Location: ../Prestador/index.php");
        } else {
            header("location: tela_validacao.php");
        }
    } else {
        $_SESSION["estiloMsg"] = "msg-erro";
        $_SESSION["flash"] = "Usuário ou senha incorretos!";
        header("location:../Prestador/login_prestador.php");
    }
}
