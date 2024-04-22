<?php
session_start(); // Start the session

// Database configuration
$host = 'localhost';
$dbname = 'rentmycar';
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password

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
           if ($password === $user['PASSWORD']) {
    // Output JavaScript to the browser to set local storage
    echo "<script>
            localStorage.setItem('first_name', '" . $user['first_name'] . "');
            localStorage.setItem('last_name', '" . $user['last_name'] . "');
            localStorage.setItem('email', '" . $user['email'] . "');
            localStorage.setItem('postcode', '" . $user['postcode'] . "');
            localStorage.setItem('password', '" . $user['PASSWORD'] . "');
                        localStorage.setItem('telephone', '" . $user['telephone'] . "');
            window.location.href = '../profile.html';
          </script>";
    exit; // It's important to call exit after headers
}else {
                // Display an error message if password is not valid
                echo "The password you entered was not valid.";
            }
        } else {
            // Display an error message if email doesn't exist
            echo "No account found with that email.";
        }
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
