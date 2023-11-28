<?php
//LEMBRETE: NÃO PRECISA FAZER INNER JOIN, FAÇO PRIMEIRO O SELECT DO TIPO DE SERVIÇO, DEPOIS TENDO O ID DO TIPO, LISTO TODOS OS SERVIÇOS COM AQUELA FK
namespace Servicofacil;

require_once("../vendor/autoload.php");
session_start();

use Servicofacil\TipoServico;
use Servicofacil\Servico;

$tiposServico = TipoServico::buscarTipos();
if (isset($_POST["tiposServico"])) {
    $opcaoSelecionada = htmlspecialchars($_POST["tiposServico"]);
} else {
    $opcaoSelecionada = "";
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Serviço Fácil </title>
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="../Utilitarios/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="../Estilos/style.css" type="text/css" />
</head>

<body>
    <?php require_once("cabecalho_cliente.inc"); ?>

    <main class="secao-principal">
        <section class="container-entrar">
            <span class="subtitulo">Solicitar Serviço</span>
            <form action="solicitar_servicos.php" method="POST">
                <ul>
                    <li>
                        <label for="tiposServico">Tipos de serviço</label>
                        <select name="tiposServico" id="tiposServico" class="inputs">
                            <?php

                            foreach ($tiposServico as $tipo) :
                                if ($opcaoSelecionada == $tipo->getId()) {
                                    $selecionado = "selected";
                                } else {
                                    $selecionado = "";
                                }
                            ?>
                                <option value="<?= $tipo->getId() ?>" <?= $selecionado ?>><?= $tipo->getNome()  ?></option>
                            <?php endforeach; ?>
                        </select>
                    </li>
                    <li>
                        <input type="submit" value="Selecionar" class="inputs">
                    </li>

            </form>
            <li>
                <form action="confirmar_solicitacao.php" method="post">
            <li>
                <label for="tiposServico">Serviços disponíveis</label>
                <select name="tiposServico" id="tiposServico" class="inputs">

                    <?php
                    $servicos = Servico::buscarServicosPorTipo($opcaoSelecionada);
                    if ($servicos) {
                        foreach ($servicos as $servico) {
                    ?>
                            <option value="<?= $servico->getId() ?>"><?= $servico->getDescricao() ?></option>
                    <?php }
                    } ?>
                </select>
            </li>
            <li>
                <br>
                <input type="hidden" name="idTipo" value="<?= $opcaoSelecionada ?>">
                <?php if ($opcaoSelecionada) { ?>
                    <input type="submit" value="SOLICITAR SERVIÇO" class="inputs">
                <?php } ?>
            </li>
            </ul>
            </form>
        </section>
    </main>

    <?php require_once("rodape_cliente.inc"); ?>
</body>

</html>