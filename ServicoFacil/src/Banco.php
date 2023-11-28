<?php
namespace Servicofacil;
require_once("../vendor/autoload.php");
use PDO;

abstract class Banco
{
    public static function obterConexao()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=servico_facil;charset=utf8mb4', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
}
