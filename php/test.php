<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory List</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h2>Inventory</h2>

    <?php
        // Setting up the Inventory DAO for use
        require_once __DIR__ . '/control/InventoryDAO.php';
        $invDAO = new InventoryDAO();
        $invList = $invDAO->findAll();
    ?>

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

</body>
</html>
