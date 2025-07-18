<?php
session_start();

$conn = new mysqli('localhost', 'root', '', 'library management');

if ($conn === false) {
    die("ERROR:" . $conn->connect_error);
}
?>