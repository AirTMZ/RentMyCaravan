<?php
session_start();

$servername = 'localhost';
$dbname = 'rentmycar';
$username = 'root';
$password = '';

try {

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Updating user settings
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // $id = $_SESSION['user_id']; 
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $phone_number = $_POST['telephone'];
        $address = $_POST['address'];
        $password = $_POST['PASSWORD']; 

        $sql = "UPDATE users SET 
                first_name='$first_name', 
                last_name='$last_name', 
                email='$email', 
                telephone='$phone_number', 
                address='$address', 
                password='$password' 
                WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            echo "User settings updated successfully";
        } else {
            throw new Exception("Error updating settings: " . $conn->error);
        }
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
