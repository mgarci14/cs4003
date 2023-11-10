<?php
require_once 'config.php';

class Connection {

  public $host;
  public $port;
  public $dbname;
  public $user;
  public $pass;
  
	public static function createConnection() {
    
    try {
      
      $pdo = new PDO("pgsql:host={$this->host};port={$this->port};dbname={$this->dbname}", $this->user, $this->pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
      return $pdo;
      
		} catch (PDOException $e) {
			echo "Database connection failed: " . $e->getMessage();
			die();
	  }
    
	}
  
}

?>
