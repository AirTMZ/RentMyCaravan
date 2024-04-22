<?php
// Database configuration
$host = '127.0.0.1:3308';
$dbname = 'rentmycar';
$username = 'root'; // Replace with your database username
$password = 'webdesign'; // Replace with your database password

// Create a new PDO instance
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Insert new user into the database
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO users (username, PASSWORD, title, first_name, last_name, gender, adress1, postcode, email, telephone) VALUES (:username, :password, :title, :first_name, :last_name, :gender, :adress1, :postcode, :email, :telephone)");

        // Bind parameters
        $stmt->bindParam(':username', $_POST['email']); // Using email as username for simplicity
        $stmt->bindParam(':password', password_hash($_POST['password'], PASSWORD_DEFAULT)); // Hash the password
        $stmt->bindParam(':title', $title, PDO::PARAM_NULL); // Set to NULL if not provided
        $stmt->bindParam(':first_name', $_POST['firstName']);
        $stmt->bindParam(':last_name', $_POST['lastName']);
        $stmt->bindParam(':gender', $gender, PDO::PARAM_NULL); // Set to NULL if not provided
        $stmt->bindParam(':adress1', $adress1, PDO::PARAM_NULL); // Set to NULL if not provided
        $stmt->bindParam(':postcode', $_POST['postCode']);
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->bindParam(':telephone', $telephone, PDO::PARAM_NULL); // Set to NULL if not provided

        // Execute the statement
        $stmt->execute();

        // Redirect to the sign-in page after successful registration
        header('Location: Login.html');
        exit;
    }
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$conn = null;
?>
