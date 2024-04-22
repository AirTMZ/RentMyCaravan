<?php
session_start();

$host = 'localhost';
$dbname = 'rentmycar';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM vehicle_details ORDER BY vehicle_id DESC LIMIT 4");
    $stmt->execute();
    $caravans = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($caravans);

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
