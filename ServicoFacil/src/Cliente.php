<?php

namespace Servicofacil;

require_once("../vendor/autoload.php");

use Servicofacil\ClienteDao;

class Cliente extends Usuario
{
  use ClienteDao;

  private $credito;
  function __construct($id, $email, $credito, $validacaoEmail)
  {
    parent::__construct($id, $email, $validacaoEmail);
    $this->credito = $credito;
  }

  public function getCreditos()
  {
    return $this->credito;
  }

  public function concederCreditos($valor)
  {
    $this->credito += $valor;
    ClienteDao::atualizarDados($this->getId(), $this->getCreditos(), $this->getValidacaoEmail());
  }
  public function utilizarCreditos($valor)
  {
    $this->credito -= $valor;
    ClienteDao::atualizarDados($this->getId(), $this->getCreditos(), $this->getValidacaoEmail());
  }
}
