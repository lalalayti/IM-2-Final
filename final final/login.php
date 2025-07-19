<?php
include "mysql.php";

if (empty($_POST['email']) || empty($_POST['password'])) {
    header("Location:{$_SERVER['HTTP_REFERER']}");
    exit();
}
$sql = "
select * from users where 
email = \"{$_POST['email']}\"
and
password = \"{$_POST['password']}\"
";

$result = $conn->query($sql);
$row = $result->fetch_assoc();

$_SESSION['user_id'] = $row['user_id'];
header("Location:index.php");
exit();
?>