<?php
require_once __DIR__ . '/Connection.php';
require_once __DIR__ . '/DataAccess.php';
require_once __DIR__ . '/../model/Inventory.php';

class InventoryDAO implements DataAccess {
	private $pdo;

	public function __construct() {

		$this->pdo = Connection::createConnection();

		if (!$this->pdo) {
			echo "Unable to connect...";
			exit;
		}
	}

    public function findById($inv_id) {
		
        try {

			$query = "SELECT * FROM inventory WHERE inv_id = :inv_id";
			$stmt = $this->pdo->prepare($query);
			$stmt->bindParam(':inv_id', $inv_id, PDO::PARAM_STR);
			$stmt->execute();

			$inventoryItems = array();
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$inventory = new Inventory($row['inv_id'], $row['name'], $row['description'], $row['price'], $row['qty']);
				$inventoryItems[] = $inventory;
			}

			$pdo = null;
			return $inventoryItems;
            
		} catch (PDOException $e) {
			echo "Database error: " . $e->getMessage();
		}

    }
    
    public function findAll() {

		try {

			$query = "SELECT * FROM inventory";
			$stmt = $this->pdo->prepare($query);
			$stmt->execute();

			$invItems = array();
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$inventory = new Inventory($row['inv_id'], $row['name'], $row['description'], $row['price'], $row['qty']);
				$invItems[] = $inventory;
			}

			$pdo = null;
			return $invItems;

		} catch (PDOException $e) {
			echo "Database error: " . $e->getMessage();
		}

    }
    
	public function create($entity) {

		try {
			$query = "INSERT INTO inventory (name, description, price, qty) VALUES (:name, :description, :price, :qty)";
			$stmt = $this->pdo->prepare($query);
	
			$stmt->bindValue(':name', $entity->getName());
			$stmt->bindValue(':description', $entity->getDescription());
			$stmt->bindValue(':price', $entity->getPrice());
			$stmt->bindValue(':qty', $entity->getQty());
	
			$stmt->execute();
	
			$pdo = null;
		} catch (PDOException $e) {
			echo "Database error: " . $e->getMessage();
		}
	}
	
	public function update($entity) {

    }
    
	public function delete($id) {
		try {
			$query = "DELETE FROM inventory WHERE inv_id = :id";
			$stmt = $this->pdo->prepare($query);
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->execute();
	
			$pdo = null;
		} catch (PDOException $e) {
			echo "Database error: " . $e->getMessage();
		}
	}
	
}

?>
