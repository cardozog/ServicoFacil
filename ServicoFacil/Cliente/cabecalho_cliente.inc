<?php


$cliente = $_SESSION["cliente"];
$fmt = new NumberFormatter('pt_BR', NumberFormatter::CURRENCY);
?>

<header>
  
   <div class="titulo navegacao-nome ">
      <img src="../../Utilitarios/icone.png"> 
        <h3 class="titulo"><b>Serviço Fácil - Reparo doméstico com segurança e rapidez!</b></h3>
    </div>
  <p class ="navegacao-nome"> <?php echo "Cliente: ".$cliente->getEmail()."  ";?> <b> | </b> <?php echo " Créditos: ".$fmt->formatCurrency($cliente->getCreditos(),'BRL');?> </p>
  <ul class="navegacao">
    <li><a href="index.php">Início</a></li>
    <li><a href="solicitar_servicos.php">Solicitar serviço</a></li>
    <li><a href="../Utilitarios/encerrar_sessao.php">Sair</a></li>
  </ul>
</header>