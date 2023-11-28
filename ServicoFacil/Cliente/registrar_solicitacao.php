<?php

namespace Servicofacil;

require_once("../vendor/autoload.php");
session_start();
date_default_timezone_set('America/Sao_Paulo');



$cliente = $_SESSION["cliente"];
$cliente->utilizarCreditos($cliente->getCreditos());
$prestadorAntigo = Prestador::prestadorMaisAntigo();
$idServico = htmlspecialchars($_POST["servico"]);
$valorACobrar = htmlspecialchars($_POST["valorACobrar"]);

$hoje = date('Y-m-d H:i:s');


Solicitacao::inserir($prestadorAntigo->getId(), $cliente->getId(), $idServico, $hoje, $valorACobrar, 0);
$_SESSION["cliente"] = $cliente;
header("Location: index.php");
