<?php
include "mysql.php";

$date = $_GET['date_reserved'];

$sql = "
delete from reservations where
item_id = {$_GET['item_id']}
and
date_reserved = '$date'
";

$conn->query($sql);

?>