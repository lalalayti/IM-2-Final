<?php
include "mysql.php";

$sql = "
select * from books where
book_id = \"{$_GET['book_id']}\"
";
$row = $conn->query($sql)->fetch_assoc();
?>

<h1>"<?$row['book_title']?>"</h1>
<img src="<?$row['book_cover']?>">
<h2>"<?$row['book_rating']?>"</h2>
<h2>"<?$row['year']?>"</h2>