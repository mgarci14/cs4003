<?php

class Connection {

  public $dbHost = "localhost";
  public $dbPort = "5432";
  public $dbname = "SEDB";
  public $dbUser = "username";
  public $dbPass = "password";
  
	public static function createConnection() {
    
		try {
			
			$pdo = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
			return $pdo;
			
		} catch (PDOException $e) {
			echo "Database connection failed: " . $e->getMessage();
			die();
		}
		
	}
  
}

?>
