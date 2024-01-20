<?php

$conn = new PDO('mysql:host=localhost;dbname=u562528100_cateringdb', 'u562528100_loreto', 'Loreto2024!');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $packageName = $_POST['package_name'];
    $amount = $_POST['amount'];

    // Insert into package table
    $sql = 'INSERT INTO package(package_name, price) VALUES (:Name, :Amount)';
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        'Name' => $packageName,
        'Amount' => $amount
    ]);

    // Get the last inserted package_id
    $lastPackageId = $conn->lastInsertId();

    foreach ($_POST['food_name'] as $key => $foodName) {  
        // Insert into tbl_food_list with the last inserted package_id
        $sqli = 'INSERT INTO tbl_food_list(foodname, package_id) VALUES (:food, :packageId)';
        $statment = $conn->prepare($sqli);
        $statment->execute([
            'food' => $foodName,
            'packageId' => $lastPackageId
        ]);
    }

    echo 'Items inserted successfully!';
    exit;
}
?>
