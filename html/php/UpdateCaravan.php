<?php
// Database credentials
$host = 'localhost';
$dbname = 'rentmycar';
$username = 'root';
$password = '';

try {
    // Create a new PDO connection object
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set PDO to throw exceptions on errors
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the form was submitted using POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // SQL query to update caravan details in the database
        $sql = "UPDATE caravans SET make=?, model=?, bodyType=?, fuelType=?, mileage=?, location=?, productionYear=?, doorNum=?, media=? WHERE numberPlate=?";
        
        // Prepare the SQL statement for execution
        $stmt = $conn->prepare($sql);

        // Execute the prepared statement with the provided form values
        $stmt->execute([
            $_POST['make'],        // New make of the caravan
            $_POST['model'],       // New model of the caravan
            $_POST['bodyType'],    // New body type of the caravan
            $_POST['fuelType'],    // New fuel type of the caravan
            $_POST['mileage'],     // New mileage of the caravan
            $_POST['location'],    // New location of the caravan
            $_POST['productionYear'], // New production year of the caravan
            $_POST['doorNum'],     // New number of doors on the caravan
            $_POST['media'],       // New media or other information
            $_POST['numberPlate']  // Number plate to identify which caravan to update
        ]);

        // Notify the user that the caravan has been updated successfully
        echo "Caravan updated successfully.";
    }
} catch (PDOException $e) {
    // If there is an error in the database connection or execution, terminate the script and display the error
    die("Connection failed: " . $e->getMessage());
}
?>
