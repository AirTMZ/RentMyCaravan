<?php
// Database credentials
$host = 'localhost';
$dbname = 'rentmycar';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $sql = "INSERT INTO caravans (numberPlate, make, model, bodyType, fuelType, mileage, location, productionYear, doorNum, media) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            $_POST['numberPlate'],
            $_POST['make'],
            $_POST['model'],
            $_POST['bodyType'],
            $_POST['fuelType'],
            $_POST['mileage'],
            $_POST['location'],
            $_POST['productionYear'],
            $_POST['doorNum'],
            $_POST['media']
        ]);
        echo "New caravan added successfully.";
    }
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
