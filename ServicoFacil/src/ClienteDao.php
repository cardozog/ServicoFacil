<?php

namespace Servicofacil;

require_once("../vendor/autoload.php");

use Servicofacil\Banco;
use Servicofacil\Solicitacao;
use PDO;

trait ClienteDao
{
  public static function rowMapper($id, $email, $creditos, $validacaoEmail)
  {

    return new Cliente($id, $email, $creditos, $validacaoEmail);
  }

  public static function buscarPeloId($id)
  {
    $pdo = Banco::obterConexao();
    $stmt = $pdo->prepare("SELECT * from tb_clientes WHERE id = :id");
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $resultado = $stmt->fetch();
    return ClienteDao::rowMapper($resultado["id"], $resultado["email"], $resultado["creditos"], $resultado["validacao_email"]);
  }
  public static function inserir($email, $senha)
  {

    $pdo = Banco::obterConexao();
    $stmt = $pdo->prepare("INSERT INTO tb_clientes VALUES (0 ,:email,:senha, 0.0, 0)");
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->bindParam(":senha", $senha, PDO::PARAM_STR);
    return $stmt->execute();
  }
  public static function buscarLogin($email, $senha)
  {
    $pdo = Banco::obterConexao();
    $stmt = $pdo->prepare("SELECT * from tb_clientes WHERE email = :email and senha = :senha");
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->bindParam(":senha", $senha, PDO::PARAM_STR);
    $stmt->execute();
    $resultado = $stmt->fetch();
    if ($resultado) {
      return ClienteDao::rowMapper((int)$resultado["id"], $resultado["email"], (float)$resultado["creditos"], (int)$resultado["validacao_email"]);
    } else {
      return null;
    }
  }

  public static function atualizarDados($id, $creditos, $validacao)
  {
    $pdo = Banco::obterConexao();
    $stmt = $pdo->prepare("UPDATE tb_clientes SET
    creditos=:creditos,
    validacao_email=:validacaoEmail 
    WHERE id =:id");
    $stmt->bindParam(":creditos", $creditos, PDO::PARAM_STR);
    $stmt->bindParam(":validacaoEmail", $validacao, PDO::PARAM_INT);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    return $stmt->execute();
  }
  public static function buscarEmail($email)
  {
    $pdo = Banco::obterConexao();
    $stmt = $pdo->prepare("SELECT * from tb_clientes WHERE email = :email ");
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->execute();
    $resultado = $stmt->fetch();

    return ClienteDao::rowMapper((int)$resultado["id"], $resultado["email"], (float)$resultado["creditos"], (int)$resultado["validacao_email"]);
  }

  public static function buscarSolicitacoes($id)
  {
    $pdo = Banco::obterConexao();
    $stmt = $pdo->prepare("select * from tb_solicitacao where fk_id_cliente =:idCliente order by id desc");
    $stmt->bindParam(":idCliente", $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_FUNC, "Servicofacil\\SolicitacaoDao::rowMapper");
  }
}
