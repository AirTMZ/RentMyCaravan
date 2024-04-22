<?php
// Database configuration
$host = 'localhost';
$dbname = 'rentmycar';
$username = 'root'; // Replace with your database username
$password = '';  // Replace with your database password

// Create a new PDO instance
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Insert new user into the database
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Set default values for unspecified fields
        $defaultTitle = 'Mr';
        $defaultGender = 'Male';
        $defaultAddress = 'N/A';
        $defaultTelephone = '0000000000';

        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO users (username, PASSWORD, title, first_name, last_name, gender, adress1, postcode, email, telephone) VALUES (:username, :password, :title, :first_name, :last_name, :gender, :adress1, :postcode, :email, :telephone)");

        // Bind parameters
        $stmt->bindParam(':username', $_POST['email']); // Using email as username for simplicity
        $stmt->bindParam(':password', $_POST['password']);
        $stmt->bindParam(':title', $defaultTitle); // Bind the default value
        $stmt->bindParam(':first_name', $_POST['firstName']);
        $stmt->bindParam(':last_name', $_POST['lastName']);
        $stmt->bindParam(':gender', $defaultGender); // Bind the default value
        $stmt->bindParam(':adress1', $defaultAddress); // Bind the default value
        $stmt->bindParam(':postcode', $_POST['postCode']);
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->bindParam(':telephone', $defaultTelephone); // Bind the default value

        // Execute the statement
        $stmt->execute();

        // Redirect to the profile page after successful registration
        header('Location: ../profile.html');
        exit;
    }
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$conn = null;
?>
