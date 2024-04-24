<?php
// Define database credentials and connection parameters
$host = 'localhost';
$dbname = 'rentmycar';
$username = 'root';
$password = '';

try {
    // Attempt to connect to the database using PDO
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception to handle any potential errors in a more manageable way
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the server request method is POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare an SQL statement to insert new data into the caravans table
        $sql = "INSERT INTO caravans (numberPlate, make, model, bodyType, fuelType, mileage, location, productionYear, doorNum, media) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql); // Prepare the SQL statement for execution
        
        // Execute the prepared statement with values from POST request
        $stmt->execute([
            $_POST['numberPlate'], // Number plate of the caravan
            $_POST['make'],        // Make of the caravan
            $_POST['model'],       // Model of the caravan
            $_POST['bodyType'],    // Body type of the caravan
            $_POST['fuelType'],    // Fuel type of the caravan
            $_POST['mileage'],     // Mileage of the caravan
            $_POST['location'],    // Location of the caravan
            $_POST['productionYear'], // Production year of the caravan
            $_POST['doorNum'],     // Number of doors on the caravan
            $_POST['media']        // Media or additional info related to the caravan
        ]);
        
        // Notify user of successful addition
        echo "New caravan added successfully.";
    }
} catch (PDOException $e) {
    // If there is a PDO exception, terminate the script and display an error message
    die("Connection failed: " . $e->getMessage());
}
?>
