<?php
include "mysql.php";

if (!empty($_POST['email']) && !empty($_POST['password'])) {
$sql = "
insert into users (
first_name, 
middle_name, 
last_name, 
email, 
password
) values (
{$_POST['first_name']},
{$_POST['middle_name']},
{$_POST['last_name']},
{$_POST['email']},
{$_POST['password']}
)
";

$conn->query($sql);

header("Location:login.html");
exit();
}
?>