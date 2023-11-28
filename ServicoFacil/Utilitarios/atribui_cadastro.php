<?php

namespace Servicofacil;

require_once("../vendor/autoload.php");
session_start();

use Exception;
use Servicofacil\Cliente;

$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
$senha = htmlspecialchars($_POST["senha"]);
$prestador = filter_input(INPUT_POST, "prestador", FILTER_SANITIZE_NUMBER_INT);
if (!isset($prestador)) {
    //cadastro clientes
    try {
        Cliente::inserir($email, $senha);
        $_SESSION["estiloMsg"] = "sucesso";
        $_SESSION["flash"] = "Cadastro efetuado com sucesso! Efetue login com os dados informados e confirme seu e-mail.";
        header("location: ../login.php");
    } catch (Exception $e) {
        $_SESSION["estiloMsg"] = "msg-erro";
        $_SESSION["flash"] = "Não foi possível efetuar o cadastro, e-mail já existente em nosso banco.";
        header("Location: ../cadastro.php");
    }
} else {
    try {
        Prestador::inserir($email, $senha);
        $_SESSION["estiloMsg"] = "sucesso";
        $_SESSION["flash"] = "Cadastro efetuado com sucesso! Efetue login com os dados informados e confirme seu e-mail.";
        header("location: ../Prestador/login_prestador.php");
    } catch (Exception $e) {
        $_SESSION["estiloMsg"] = "msg-erro";
        $_SESSION["flash"] = "Não foi possível efetuar o cadastro.";
        header("Location: ../cadastro.php");
    }
}
