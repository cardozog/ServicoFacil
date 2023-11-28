<?php

namespace Servicofacil;

require_once("../vendor/autoload.php");

use Servicofacil\Banco;
use PDO;

trait PrestadorDao
{
  public static function rowMapper($id, $email, $dataUltimoServico, $validacaoEmail, $executandoServico)
  {

    return new Prestador($id, $email, $dataUltimoServico, $validacaoEmail, $executandoServico);
  }

  public static function buscarLogin($email, $senha)
  {
    $pdo = Banco::obterConexao();
    $stmt = $pdo->prepare("SELECT * from tb_prestadores WHERE email = :email and senha = :senha");
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->bindParam(":senha", $senha, PDO::PARAM_STR);
    $stmt->execute();
    $resultado = $stmt->fetch();
    if ($resultado) {
      return PrestadorDao::rowMapper((int)$resultado["id"], $resultado["email"], $resultado["ultimo_atendimento"], $resultado["validacao_email"], $resultado["executando_servico"]);
    } else {
      return null;
    }
  }

  public static function buscarPeloId($id)
  {
    $pdo = Banco::obterConexao();
    $stmt = $pdo->prepare("SELECT * from tb_prestadores WHERE id = :id");
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $resultado = $stmt->fetch();
    PrestadorDao::rowMapper($resultado["id"], $resultado["email"], $resultado["ultimo_atendimento"], $resultado["validacao_email"], $resultado["executando_servico"]);
  }

  public static function prestadorMaisAntigo()
  {
    $pdo = Banco::obterConexao();
    $stmt = $pdo->prepare("SELECT * from tb_prestadores 
            where ultimo_atendimento = (select min(ultimo_atendimento) from tb_prestadores)");
    $stmt->execute();
    $resultado = $stmt->fetch();
    return PrestadorDao::rowMapper($resultado["id"], $resultado["email"], $resultado["ultimo_atendimento"], $resultado["validacao_email"], $resultado["executando_servico"]);
  }

  public static function atualizarDataUltimoAtendimento($id)
  {
    date_default_timezone_set('America/Sao_Paulo');

    $pdo = Banco::obterConexao();
    $stmt = $pdo->prepare("UPDATE tb_prestadores SET ultimo_atendimento=:ultAtend where id=:id");
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->bindParam(":ultAtend", date("Y-m-d H:i:s"), PDO::PARAM_INT);
  }
  public static function atualizarDados($id, $dataUltimoServico, $validacao, $executandoServico)
  {
    $pdo = Banco::obterConexao();
    $stmt = $pdo->prepare("UPDATE tb_prestadores SET
        validacao_email=:validacaoEmail,
        ultimo_atendimento=:ultAtend,
        executando_servico=:execServico
        WHERE id =:id");
    $stmt->bindParam(":ultAtend", $dataUltimoServico, PDO::PARAM_STR);
    $stmt->bindParam(":validacaoEmail", $validacao, PDO::PARAM_INT);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->bindParam(":execServico", $executandoServico, PDO::PARAM_INT);
    return $stmt->execute();
  }

  public static function inserir($email, $senha)
  {
    date_default_timezone_set('America/Sao_Paulo');
    $dataLocal = date('Y/m/d H:i:s');
    $pdo = Banco::obterConexao();
    $stmt = $pdo->prepare("INSERT INTO tb_prestadores VALUES (0,:email,:senha, 0, :dataHora,0)");
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->bindParam(":senha", $senha, PDO::PARAM_STR);
    $stmt->bindParam(":dataHora", $dataLocal, PDO::PARAM_STR);
    return $stmt->execute();
  }
}
