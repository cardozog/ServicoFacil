<?php

namespace Servicofacil;

require_once("../vendor/autoload.php");
session_start();

if (!isset($_SESSION["cliente"])) {
  header("Location: ../login.php");
}
$idSolicitacao = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
if (isset($idSolicitacao)) {
  $solicitacaoAtual = Solicitacao::buscarPeloId((int)$idSolicitacao);
}



?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width" />
  <title>Serviço Fácil</title>


  <link rel="shortcut icon" href="../Utilitarios/favicon.ico" type="image/x-icon" />
  <link href="../../Estilos/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
  <?php require_once("cabecalho_cliente.inc"); ?>
  <main class="info">
    <section class="container-entrar">
      <span class="subtitulo">Avalie Seu Prestador</span>
      <div>
        <?php
        if ($solicitacaoAtual) {

          $servico = Servico::buscarPeloId($solicitacaoAtual->getIdServico());
          $tipoServico = TipoServico::buscarPeloId($servico->getTipo());
        }

        ?>
        <p>Tipo de Serviço:<?= $tipoServico->getNome() ?></p>
        <p>Serviço: <?= $servico->getDescricao() ?></p>
        <p>Data: <?= $solicitacaoAtual->getDataSolicitacao() ?></p>
        <p>Prestador: <?= $solicitacaoAtual->getIdPrestador() ?></p>

        <form method="post"> Nota :
          <INPUT TYPE="radio" NAME="opc" value="1"> 1
          <INPUT TYPE="radio" NAME="opc" value="2"> 2
          <INPUT TYPE="radio" NAME="opc" value="3"> 3
          <INPUT TYPE="radio" NAME="opc" value="4"> 4
          <INPUT TYPE="radio" NAME="opc" value="5"> 5

          <p>Comentário (opcional)</p>
          <textarea name="opcional" rows="4" cols="50"></textarea>
          <input type="hidden" name="idSolicitacao" value="<?= $idSolicitacao ?>">

          <input type="submit" formaction="../registrar_avaliacao.php" value="Registrar Avaliação" class="inputs">
        </form>
        </p>
      </div>
    </section>
  </main>
  <?php require_once("rodape_cliente.inc"); ?>
</body>

</html>