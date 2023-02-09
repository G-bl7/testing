<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if(isset($_POST['Requested']))
    $servername = 'localhost';
    $username = "root";
    $password = 'P%40ssw0rd';
    $dbname = 'glpibd';

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = $_POST['Requested'];

    if ($conn->query($sql) === TRUE) {
      echo "successfully";
    } else {
      echo  $conn->error;
    }
    $conn->close();
}
?>
