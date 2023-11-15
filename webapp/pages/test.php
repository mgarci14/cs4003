<!DOCTYPE html>
<html lang="en">

<?php
    // Setting up the Inventory DAO for use
    require_once __DIR__ . '/../../php/control/InventoryDAO.php';
    $invDAO = new InventoryDAO();

    // Form submission for creating an item
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['createItem'])) {        
        $name = $_POST["name"];
        $description = $_POST["description"];
        $price = $_POST["price"];
        $qty = $_POST["qty"];

        $item = new Inventory(null, $name, $description, $price, $qty);
        $invDAO->create($item);

        header("Location: test.php");
    }
    // Form submission for deleting an item
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['deleteItem'])) {
        $itemID = $_POST["itemID"];
        $invDAO->delete($itemID);

        header("Location: test.php");
    }
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory List</title>
    <style>
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
    </style>
</head>
<body>
    <h2>Inventory</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            <?php
                // Looping through the array of Inventory objects and display each row in the table
                $invList = $invDAO->findAll();
                foreach ($invList as $item) {
                    echo "<tr>";
                    
                    echo "<td>" . $item->getInvId() . "</td>";
                    echo "<td>" . $item->getName() . "</td>";
                    echo "<td>" . $item->getDescription() . "</td>";
                    echo "<td>" . $item->getPrice() . "</td>";
                    echo "<td>" . $item->getQty() . "</td>";

                    echo "</tr>";
                }

            ?>
        </tbody>
    </table>
    <form method="post" action="<?php echo ($_SERVER["PHP_SELF"]); ?>">
        <h2>Create Item</h2>
        <label for="name">Name:</label>
        <input type="text" name="name" required><br>
        <label for="description">Description:</label>
        <textarea name="description" required></textarea><br>
        <label for="price">Price:</label>
        <input type="number" name="price" required><br>
        <label for="qty">Quantity:</label>
        <input type="number" name="qty" required><br>
        <input type="submit" name="createItem" value="Create Item">
    </form>
    <form method="post" action="<?php echo ($_SERVER["PHP_SELF"]); ?>">
        <h2>Delete Item</h2>
        <label for="itemID">Item ID:</label>
        <input type="number" name="itemID" required><br>
        <input type="submit" name="deleteItem" value="Delete Item">
    </form>
</body>
</html>
