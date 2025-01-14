<?php
$servername = "localhost";
$username = "root";
$password = "";
$database_name = "projectweek";

$connect = new mysqli($servername, $username, $password, $database_name);


if ($connect->connect_error) {
  die("Connection failed: " . $connect->connect_error);
}
echo "Connected successfully";
?>