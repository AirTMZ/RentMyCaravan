<?php
session_start();

$servername = 'localhost';
$dbname = 'rentmycar';
$username = 'root';
$password = '';

$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT vehicle_make, vehicle_model, vehicle_bodytype, fuel_type, mileage, num_doors FROM vehicle_details"; 

$result = $conn->query($sql);

// Fetching Data
if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
        echo "vehicle_make: " . $row["vehicle_make"]. " - vehicle_model: " . $row["vehicle_model"]." - vehicle_bodytype: " . $row["vehicle_bodytype"]." - fuel_type: " . $row["fuel_type"]." - mileage: " . $row["mileage"]." - num_doors: " . $row["num_doors"] "<br>";
    }
} else {
    echo "0 results";
}
?>