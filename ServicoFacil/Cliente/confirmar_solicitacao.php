<?php

namespace Servicofacil;

require_once("../vendor/autoload.php");
session_start();

use Servicofacil\Cliente;
use Servicofacil\TipoServico;
use Servicofacil\Servico;
use NumberFormatter;

if (!isset($_SESSION["cliente"])) {
    header("Location: ../login.php");
}
$idTipo = filter_input(INPUT_POST, "idTipo", FILTER_SANITIZE_NUMBER_INT);
$idServico = filter_input(INPUT_POST, "tiposServico", FILTER_SANITIZE_NUMBER_INT);

$tipo = TipoServico::buscarPeloId($idTipo);

$servico = Servico::buscarPeloId($idServico);

$cliente = $_SESSION["cliente"];


$fmt = new NumberFormatter('pt_BR', NumberFormatter::CURRENCY);

$valorACobrar = $servico->getValor() - $cliente->getCreditos();
$prestadorAntigo = Prestador::prestadorMaisAntigo();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Serviço Fácil</title>
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="../Utilitarios/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="../Estilos/style.css" type="text/css" />
</head>

<body>
    <?php require_once("cabecalho_cliente.inc"); ?>

    <main class="secao-principal">
        <section class="container-entrar">
            <span class="subtitulo">Confirme sua solicitação</span>
            <form action="registrar_solicitacao.php" method="post">
                <ul>
                    <li>
                        <span class="subtitulo">Tipo de serviço:</span><span> <?= $tipo->getNome() ?></span>
                    </li>
                    <li>
                        <span class="subtitulo">Serviço:</span><span> <?= $servico->getDescricao() ?></span>
                    </li>
                    <li>
                        <span class="subtitulo">Prestador: </span><span> <?= $prestadorAntigo->getEmail() ?></span>
                    </li>
                    <li>
                        <span class="subtitulo">Valor:</span><span> <?= $fmt->formatCurrency($servico->getValor(), 'BRL') ?></span>
                    </li>
                    <li>
                        <span class="subtitulo">Seu crédito</span><span> <?= $fmt->formatCurrency($cliente->getCreditos(), 'BRL') ?></span>
                    </li>
                    <li>
                        <span class="subtitulo">Valor a ser cobrado:</span><span> <?= $fmt->formatCurrency($valorACobrar, 'BRL') ?></span>
                    </li>
                    <li>
                        <input type="hidden" name="servico" value="<?= $servico->getId() ?>">
                        <input type="hidden" name="valorACobrar" value="<?= $valorACobrar ?>">

                        <input type="submit" onclick="sucesso()" value="Confirmar" class="inputs">

                    </li>
                </ul>
            </form>
        </section>
    </main>


    <script type="text/javascript" src="../js/script.js"></script>
    <?php require_once("rodape_cliente.inc"); ?>
</body>

</html>