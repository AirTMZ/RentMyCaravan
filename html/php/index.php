<?php
$servername = "127.0.0.1";
$username = "your_username";
$password = "your_password";
$dbname = "rentmycar";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM vehicle_details";
$result = $conn->query($sql);

$vehicles = array();
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $vehicles[] = $row;
  }
  echo json_encode($vehicles);
} else {
  echo "0 results";
}
$conn->close();
?>
