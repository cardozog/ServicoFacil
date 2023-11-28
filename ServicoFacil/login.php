<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>Serviço Fácil - Entrar</title>
  <meta charset="utf-8" />
  <link rel="shortcut icon" href="../Utilitarios/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="Estilos/style.css" type="text/css" />
</head>

<body>
  <?php require_once("cabecalho.inc"); ?>

  <main class="secao-principal">
    <section class="container-entrar">
      <span class="subtitulo">Login</span>

      <form method="post" action="Utilitarios/abrir_sessao.php">
        <ul>
          <p class="<?=
                    isset($_SESSION["estiloMsg"]) ?  $_SESSION["estiloMsg"] :   "";
                    ?>">
            <?php
            if (isset($_SESSION["flash"])) {
              echo $_SESSION["flash"];
              unset($_SESSION["flash"]);
            }
            ?>
          </p>
          <li>
            <label for="email">E-mail</label><br>
            <input type="email" name="email" id="email" class="inputs" required />
          </li>

          <li>
            <label for="senha">Senha</label><br>
            <input type="password" name="senha" id="senha" class="inputs" />
          </li>
          <li>
            <input type="submit" value="Entrar" class="inputs" />
          </li>
          <li>
            <a href="cadastro.php" class="link-cadastro">Cadastre-se!</a>
          </li>
          <li>
            <a href="Prestador/login_prestador.php" class="link-cadastro">Já é um prestador? Clique aqui para entrar!</a>
          </li>

        </ul>
      </form>
    </section>
  </main>

  <?php require_once("rodape.inc"); ?>
</body>

</html>