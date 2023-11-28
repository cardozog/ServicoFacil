<?php

namespace Servicofacil;

require_once("../vendor/autoload.php");
session_start();
if (!isset($_SESSION["cliente"])) {
  header("Location: ../login.php");
}

$cliente = $_SESSION["cliente"];

$pedidos = $cliente->buscarSolicitacoes($cliente->getId());

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
    <section class="container-entrar" style="text-align:center;width:fit-content;">
      <span class="subtitulo">Lista de solicitações</span>
      <table class="tabela-inicio">
        <thead>
          <tr>
            <td>
              <b>
                <p>Número OS</p>
              </b>
            </td>
            <td>
              <b>
                <p>Data</p>
              </b>
            </td>
            <td>
              <b>
                <p>Serviço</p>
              </b>
            </td>
            <td>
              <b>
                <p>Status</p>
              </b>
            </td>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($pedidos) {
            foreach ($pedidos as $pedido) {
              $servico = Servico::buscarPeloId($pedido->getIdServico());
              $tipo = TipoServico::buscarPeloId($servico->getTipo()); ?>

              <tr>
                <td>
                  <p><?= $pedido->getId() ?></p>
                </td>
                <td>
                  <p><?= $pedido->getDataSolicitacao() ?></p>
                </td>
                <td>
                  <p><?= $tipo->getNome() ?></p>
                  <p><?= $servico->getDescricao() ?></p>
                </td>
                <td>
                  <?php
                  $statusSolicitacao = $pedido->getStatusSolicitacao();
                  switch ($statusSolicitacao) {
                    case 0:
                      $statusAtual = "Aguardando início";
                      break;
                    case 1:
                      $statusAtual = "Em execução";
                      break;
                    case 2:
                      $statusAtual = "Pendente";
                      break;
                    case 3:
                      $statusAtual = "Concluído";
                      break;
                    case 4:
                      $statusAtual = "Concluído e Avaliado";
                      break;
                  }
                  ?>


                  <p> <?= $statusAtual ?></p>
                  <?php if ($pedido->getStatusSolicitacao() < 3) { ?>
                    <a href="cancelar_solicitacao.php/?id=<?= $pedido->getId() ?>">Cancelar</a>
                  <?php } ?>
                  <?php if ($statusSolicitacao == 3) {
                  ?>
                    <a href="avaliar_prestador.php/?id=<?php echo $pedido->getId() ?>">Avaliar</a>
                  <?php } ?>
                </td>
              </tr>
            <?php }
          } else { ?>
            <h3>Você não possui solicitações no momento.</h3>
          <?php } ?>
        </tbody>
      </table>
    </section>
  </main>


  <?php require_once("rodape_cliente.inc"); ?>
</body>

</html>