<?php

namespace Servicofacil;

require_once("../vendor/autoload.php");

use Servicofacil\Banco;
use PDO;

trait TipoServicoDao
{
  public static function rowMapper($id, $nome)
  {

    return new TipoServico($id, $nome);
  }


  public static function buscarPeloId($id)
  {
    $pdo = Banco::obterConexao();
    $stmt = $pdo->prepare("SELECT * from tb_tipos_servico WHERE id = :id");
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $resultado = $stmt->fetch();
    return TipoServicoDao::rowMapper((int)$resultado["id"], $resultado["nome"]);
  }

  public static function buscarTipos()
  {
    $pdo = Banco::obterConexao();
    $stmt = $pdo->prepare("SELECT * from tb_tipos_servico");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_FUNC, "Servicofacil\\TipoServicoDao::rowMapper");
  }
}
