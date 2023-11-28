<?php
session_start();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>Serviço Fácil - Cadastre-se</title>
  <meta charset="utf-8" />
  <link rel="shortcut icon" href="../Utilitarios/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="/Estilos/style.css" type="text/css" />
</head>

<body>
  <?php require_once("cabecalho.inc"); ?>

  <main class="secao-principal">
    <section class="container-entrar">
      <span class="subtitulo">Cadastro</span>
      <?php if (isset($_SESSION["flash"])) : ?>
        <p style="color:red"><?= $_SESSION["flash"] ?></p>
      <?php endif;
      unset($_SESSION["flash"]); ?>
      <form method="post" action="../Utilitarios/atribui_cadastro.php">
        <ul>
          <li>
            <label for="email">E-mail</label><br>
            <input type="email" name="email" id="email" class="inputs" required />
          </li>

          <li>
            <label for="senha">Senha</label><br>
            <input type="password" name="senha" id="senhaCadastro" class="inputs" required />
          </li>
          <li>
            <label for="senha">Confirme a senha</label><br>
            <input type="password" name="senha" id="senhaCadastroConf" class="inputs" required />
          </li>

          <li>
            <label for="prestador">
              <input type="checkbox" name="prestador" id="prestador" value="1">
              Desejo ser prestador de serviços
              <p style="font-size: 15px;">(Deixe em branco caso seja cliente.)</p>
            </label>

          </li>
          <li>
            <input type="submit" value="Cadastrar" class="inputs" />
          </li>

        </ul>
      </form>
    </section>
  </main>

  <?php require_once("rodape.inc"); ?>
  <script type="text/javascript" src="js/script.js"></script>
</body>

</html>