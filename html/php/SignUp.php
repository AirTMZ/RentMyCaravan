<?php
session_start();

$host = 'localhost';
$dbname = 'rentmycar';
$dbUsername = 'root';
$dbPassword = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $dbUsername, $dbPassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $defaultTitle = 'Mr';
        $defaultGender = 'Male';
        $defaultAddress = 'N/A';
        $defaultTelephone = '0000000000';
        $defaultProfileUrl = 'resources/tim/defaultProfile.png'; // Default profile URL

        $username = $_POST['email'];
        $password = $_POST['password']; // Remember to hash the password before storing
        $title = isset($_POST['title']) ? $_POST['title'] : $defaultTitle;
        $first_name = $_POST['firstName'];
        $last_name = $_POST['lastName'];
        $gender = isset($_POST['gender']) ? $_POST['gender'] : $defaultGender;
        $address1 = isset($_POST['address1']) ? $_POST['address1'] : $defaultAddress;
        $postcode = $_POST['postCode'];
        $email = $_POST['email'];
        $telephone = isset($_POST['telephone']) ? $_POST['telephone'] : $defaultTelephone;

        $stmt = $conn->prepare("INSERT INTO users (username, PASSWORD, title, first_name, last_name, gender, adress1, postcode, email, telephone, profile_url) VALUES (:username, :password, :title, :first_name, :last_name, :gender, :adress1, :postcode, :email, :telephone, :profile_url)");

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
        $stmt->bindParam(':profile_url', $defaultProfileUrl);

        $stmt->execute();

        header('Location: ../Login.html');
        exit;
    }
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$conn = null;
?>
