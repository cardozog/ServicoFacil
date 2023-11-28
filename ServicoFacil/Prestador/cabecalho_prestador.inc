<?php
$prestador = $_SESSION["prestador"];
?>

<header>
  <h3 class="titulo">Serviço Fácil - Reparo doméstico com segurança e rapidez!</h3>
  <p class =" navegacao-nome"> <?php echo "Prestador: ".$prestador->getEmail();?></p>
  <ul class="navegacao">


    <li><a href="index.php">Início</a></li>
    <li><a href="../Utilitarios/encerrar_sessao.php">Sair</a></li>
  </ul>
</header>