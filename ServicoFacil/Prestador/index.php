<?php

namespace Servicofacil;

require_once("../vendor/autoload.php");
session_start();
$prestador = $_SESSION["prestador"];
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Serviço fácil</title>
  <link rel="shortcut icon" href="../Utilitarios/favicon.ico" type="image/x-icon" />
  <link href="../Estilos/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
  <?php require_once("cabecalho_prestador.inc"); ?>
  <main class="info">
    <section class="info">
      <ul>
        <li>
          <h3>Novo serviço solicitado:</h3>
          <?php
          $solicitacoesNovas = Solicitacao::buscarNovasSolicitacoes($prestador->getId(), 0);
          if ($solicitacoesNovas) {
            foreach ($solicitacoesNovas as $solicitacaoNova) {
              $id = $solicitacaoNova->getId();
              $cliente = Cliente::buscarPeloId($solicitacaoNova->getIdCliente());
              $servico = Servico::buscarPeloId($solicitacaoNova->getIdServico());
              $tipo = TipoServico::buscarPeloId($servico->getTipo());

          ?>
              <div>
                <form action="iniciar_servico.php" method="post">
                  <p> Cliente: <a href=#><?= $cliente->getEmail(); ?></a></p>
                  <p>Tipo de Serviço: <?= $tipo->getNome() ?></p>
                  <P>Serviço: <?= $servico->getDescricao() ?></P>
                  <input type="hidden" name="idServico" value="<?= $id ?>">
                  <input type="submit" class="inputs" value="Iniciar Serviço">
                </form>
              </div>
        </li>
      <?php }
          } else { ?>
      <section class="info">
        <p>Ainda não existem novos serviços.</p>
      </section>
    <?php }

    ?>

    <li>
      <h3>Serviço em Execução:</h3>
      <?php
      $solicitacoesNovas = Solicitacao::buscarNovasSolicitacoes($prestador->getId(), 1);
      if ($solicitacoesNovas) {
        foreach ($solicitacoesNovas as $solicitacaoNova) {
          $id = $solicitacaoNova->getId();
          $cliente = Cliente::buscarPeloId($solicitacaoNova->getIdCliente());
          $servico = Servico::buscarPeloId($solicitacaoNova->getIdServico());
          $tipo = TipoServico::buscarPeloId($servico->getTipo());
      ?>
          <div>
            <form method="post">
              <p> Cliente: <a href=#><?= $cliente->getEmail(); ?></a></p>
              <br>
              <p>Tipo de Serviço: <?= $tipo->getNome() ?></p>

              <br>
              <P>Serviço: <?= $servico->getDescricao() ?></P>
              <input type="hidden" name="idServico" value="<?= $id ?>">
              <input type="submit" class="inputs" formaction="servico_pendente.php" value="Mudar para Pendente">
              <input type="submit" class="inputs" formaction="concluir_servico.php" value="Concluir Serviço">
            </form>
          </div>
        <?php }
      } else {
        ?>
        <div>
          <p>Não há serviços em andamento.</p><?php
                                            } ?>
    </li>

    <li>
      <h3>Serviços Pendentes:</h3>
      <table border="1" >
        <?php
        $solicitacoesNovas = Solicitacao::buscarNovasSolicitacoes($prestador->getId(), 2);
        if ($solicitacoesNovas) {
          foreach ($solicitacoesNovas as $solicitacaoNova) {
            $id = $solicitacaoNova->getId();
            $cliente = Cliente::buscarPeloId($solicitacaoNova->getIdCliente());
            $servico = Servico::buscarPeloId($solicitacaoNova->getIdServico());
            $tipo = TipoServico::buscarPeloId($servico->getTipo());
        ?>
            <tr>
              <td>Numero</td>
              <td>Data</td>
              <td>Serviço</td>
              <td>Cliente</td>
            </tr>
            <tr>
              <td><?= $id ?></td>
              <td><?= $solicitacaoNova->getDataSolicitacao() ?></td>
              <td><?= $tipo->getNome() ?> <br><?= $servico->getDescricao() ?></td>
              <td><a href="#"><?= $cliente->getEmail() ?></a></td>
            </tr>
          <?php ;
          }
        } else {
          ?><p>Não há serviços pendentes.</p>
        <?php } ?>
      </table>
    </li>
      </ul>
    </section>
  </main>

  <?php require_once("rodape_prestador.inc"); ?>
</body>

</html>