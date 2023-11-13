<?php

class Connection {
  
  public static function createConnection() {
    
    // Credentials
    $dbInfo = "pgsql:host=localhost;dbname=postgres";
    $dbUser = "postgres";
    $dbPass = "pass";

    // Connecting
    try {
      $pdo = new PDO($dbInfo, $dbUser, $dbPass);
      return $pdo;
    } catch (PDOException $e) {
      echo "Database connection failed: " . $e->getMessage();
      die();
    }

  }
  
}

?>
