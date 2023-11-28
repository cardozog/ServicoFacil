<?php

namespace Servicofacil;

require_once("../vendor/autoload.php");

use Servicofacil\Banco;
use PDO;

trait ServicoDao
{
  public static function rowMapper($id, $tipo, $descricao, $valor)
  {

    return new Servico($id, $tipo, $descricao, $valor);
  }


  public static function buscarPeloId($id)
  {
    $pdo = Banco::obterConexao();
    $stmt = $pdo->prepare("SELECT * from tb_servicos WHERE id = :id");
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $resultado = $stmt->fetch();
    return ServicoDao::rowMapper($resultado["id"], $resultado["fk_id_tipo"], $resultado["descricao"], $resultado["valor"]);
  }

  public static function buscarServicosPorTipo($id)
  {
    $pdo = Banco::obterConexao();
    $stmt = $pdo->prepare("SELECT * from tb_servicos where fk_id_tipo =:id");
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_FUNC, "Servicofacil\\ServicoDao::rowMapper");
  }
}
