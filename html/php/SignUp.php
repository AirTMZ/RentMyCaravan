<?php
// Start the session
session_start();

// Database configuration
$host = 'localhost';
$dbname = 'rentmycar';
$dbUsername = 'root'; // Replace with your database username
$dbPassword = '';  // Replace with your database password

// Create a new PDO instance
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $dbUsername, $dbPassword);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Insert new user into the database
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Set default values for unspecified fields
        $defaultTitle = 'Mr';
        $defaultGender = 'Male';
        $defaultAddress = 'N/A';
        $defaultTelephone = '0000000000';

        // Assign POST data to variables
        $username = $_POST['email']; // Using email as username for simplicity
        $password = $_POST['password']; // This should be hashed with password_hash()
        $title = isset($_POST['title']) ? $_POST['title'] : $defaultTitle;
        $first_name = $_POST['firstName'];
        $last_name = $_POST['lastName'];
        $gender = isset($_POST['gender']) ? $_POST['gender'] : $defaultGender;
        $address1 = isset($_POST['address1']) ? $_POST['address1'] : $defaultAddress;
        $postcode = $_POST['postCode'];
        $email = $_POST['email'];
        $telephone = isset($_POST['telephone']) ? $_POST['telephone'] : $defaultTelephone;

        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO users (username, PASSWORD, title, first_name, last_name, gender, adress1, postcode, email, telephone) VALUES (:username, :password, :title, :first_name, :last_name, :gender, :adress1, :postcode, :email, :telephone)");

        // Bind parameters to variables
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':adress1', $address1);
        $stmt->bindParam(':postcode', $postcode);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telephone', $telephone);

        // Execute the statement
        $stmt->execute();

        // Redirect to the profile page after successful registration
        header('Location: ../profile.html');
        exit;
    }
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Close the connection
$conn = null;
?>
