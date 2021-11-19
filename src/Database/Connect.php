<?php

namespace ASPTest\Database;

use PDO;
use PDOException;
use Symfony\Component\Dotenv\Dotenv;

class Connect
{
  static public function conn()
  {
      $dotenv = new Dotenv();
      $dotenv->load($_SERVER['DOCUMENT_ROOT'].'.env');


      $host = $_ENV['DB_HOST'];
      $port = $_ENV['DB_PORT'];
      $db   = $_ENV['DB_DATABASE'];
      $user   = $_ENV['DB_USERNAME'];
      $pass   = $_ENV['DB_PASSWORD'];

    try {
      $pdo = new PDO(
        "mysql:host={$host};port={$port};dbname={$db}",
        $user,
        $pass,
        array(PDO::ATTR_PERSISTENT => true)
      );
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $pdo;
    } catch (PDOException $e) {
      printf("Error:\n");
      printf("{$e->getMessage()}\n");
      printf("Please, check the database connection and try again.");
    }
  }
}
