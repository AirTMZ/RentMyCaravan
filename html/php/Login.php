<?php
session_start(); // Start the session

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

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Prepare SQL statement
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            // Verify password
            if (password_verify($password, $user['PASSWORD'])) {
                // Password is correct, so start a new session
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $user['username']; // or user_id, depending on your system

                // Redirect user to welcome page
                header("location: welcome.html"); // Replace with the path to your welcome page
            } else {
                // Display an error message if password is not valid
                echo "The password you entered was not valid.";
            }
        } else {
            // Display an error message if username doesn't exist
            echo "No account found with that email.";
        }
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
