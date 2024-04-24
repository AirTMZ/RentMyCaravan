<?php
session_start();

$host = 'localhost';
$dbname = 'rentmycar';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
           if ($password === $user['PASSWORD']) {
echo "<script>
        localStorage.setItem('first_name', '" . $user['first_name'] . "');
        localStorage.setItem('last_name', '" . $user['last_name'] . "');
        localStorage.setItem('email', '" . $user['email'] . "');
        localStorage.setItem('postcode', '" . $user['postcode'] . "');
        localStorage.setItem('password', '" . $user['PASSWORD'] . "');
        localStorage.setItem('profile_url', '" . $user['profile_url'] . "'); // Add this line
        window.location.href = '../profile.html';
      </script>";

    exit;
}else {
                echo "The password you entered was not valid.";
            }
        } else {
            echo "No account found with that email.";
        }
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
