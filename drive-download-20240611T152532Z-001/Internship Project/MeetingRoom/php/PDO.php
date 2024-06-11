<?php

$username = "root";
$password = "root";
$port =3306;
try {
  $conn = new PDO("mysql:port=$port;host=127.0.0.1;dbname=MeetingRoom", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>
