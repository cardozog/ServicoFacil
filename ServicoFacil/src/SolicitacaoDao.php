<?php

namespace Servicofacil;

require_once("../vendor/autoload.php");

use Servicofacil\Banco;

use PDO;

trait SolicitacaoDao
{
  public static function rowMapper($id, $idPrestador, $idCliente, $idServico, $dataSolicitacao, $valorFinal, $statusSolicitacao)
  {
    return new Solicitacao($id, $idPrestador, $idCliente, $idServico, $dataSolicitacao, $valorFinal, $statusSolicitacao);
  }


  public static function inserir($idPrestador, $idCliente, $idServico, $dataSolicitacao, $valorFinal, $statusSolicitacao)
  {

    $pdo = Banco::obterConexao();
    $stmt = $pdo->prepare("insert into tb_solicitacao values(0,:idpres,:idcli,:idserv,:data,:valor,:status)");
    $stmt->bindParam(":idpres", $idPrestador, PDO::PARAM_INT);
    $stmt->bindParam(":idcli", $idCliente, PDO::PARAM_INT);
    $stmt->bindParam(":idserv", $idServico, PDO::PARAM_INT);
    $stmt->bindParam(":data", $dataSolicitacao, PDO::PARAM_STR);
    $stmt->bindParam(":valor", $valorFinal, PDO::PARAM_STR);
    $stmt->bindParam(":status", $statusSolicitacao, PDO::PARAM_INT);

    return $stmt->execute();
  }

  public static function buscarPeloId($id)
  {
    $pdo = Banco::obterConexao();
    $stmt = $pdo->prepare("SELECT * from tb_solicitacao where id=:id");
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $resultado = $stmt->fetch();
    return Solicitacao::rowMapper($resultado["id"], $resultado["fk_id_prestador"], $resultado["fk_id_cliente"], $resultado["fk_id_servico"], $resultado["data_solicitacao"], $resultado["valor_final"], $resultado["status_solicitacao"]);
  }

  public static function buscarNovasSolicitacoes($idPrestador, $status)
  {
    $pdo = Banco::obterConexao();
    $stmt = $pdo->prepare("
        select * from tb_solicitacao where status_solicitacao=:status and fk_id_prestador =:idPrestador
        ");
    $stmt->bindParam(":status", $status, PDO::PARAM_INT);
    $stmt->bindParam(":idPrestador", $idPrestador, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_FUNC, "Servicofacil\\SolicitacaoDao::rowMapper");
  }

  public static function iniciarSolicitacao($id)
  {
    $pdo = Banco::obterConexao();
    $stmt = $pdo->prepare("UPDATE tb_solicitacao SET status_solicitacao = 1 where id =:id");
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    return $stmt->execute();
  }
  public static function concluirSolicitacao($id)
  {
    $pdo = Banco::obterConexao();
    $stmt = $pdo->prepare("UPDATE tb_solicitacao SET status_solicitacao = 3 where id =:id");
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    return $stmt->execute();
  }
  public static function avaliarSolicitacao($id)
  {
    $pdo = Banco::obterConexao();
    $stmt = $pdo->prepare("UPDATE tb_solicitacao SET status_solicitacao = 4 where id =:id");
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    return $stmt->execute();
  }
}
