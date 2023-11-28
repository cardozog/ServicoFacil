<?php
session_start();

$idApagar = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
$idApagar -= 1;
unset($_SESSION["pedidosCliente"][$idApagar]);

header("Location: /Cliente/index.php");
