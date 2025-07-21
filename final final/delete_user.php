<?php
include "mysql.php";

$user_id = $_POST['user_id'];

$sql = "
delete from reading_lists where
user_id = {$user_id}
";

$conn->query($sql);

$user_id = $_POST['user_id'];
$sql = "
delete from reservations where
user_id = {$user_id}
";

$conn->query($sql);

$user_id = $_POST['user_id'];
$sql = "
delete from users where
user_id = {$user_id}
";

$conn->query($sql);
?>