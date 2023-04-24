<?php
$servername = "localhost";
$username = "arowix_mbc";
$password = 'nd2uzkO!$ZA8';
$dbname = "arowix_mbc";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$userid=$_GET['id'];
$sql = "UPDATE usergroups SET status='1' WHERE user_id=$userid";

if ($conn->query($sql) === TRUE) {
//   header("Location: http://arowix.com/mbc/public/groups");
} else {
  echo "Error updating record: " . $conn->error;
}

$conn->close();
?>