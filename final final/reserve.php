<?php
include "mysql.php";

if (empty($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}
if (empty($_GET['book_id']) || empty($_GET['reservation_start'])) {
    if (empty($_SERVER['HTTP_REFERER'])) {
        header("Location:homepage.php");
    } else {
        header("Location:{$_SERVER['HTTP_REFERER']}");
    }
    exit();
}

$item_query = "
select * from inventory where 
book_id = \"{$_GET['book_id']}\"
and
item_status = \"available\"
";

$item_check = $conn->query($item_query)->fetch_assoc();
if ($item_check !== false) {
    $item_id = $item_check['item_id'];
    $start = $_GET['reservation_start'];
    $end = date("Y-m-d", strtotime($_GET['reservation_start'] . "+ 7 days"));
    $sql = "
    insert into reservations (
    item_id, 
    book_id, 
    user_id, 
    date_reserved, 
    reservation_start,
    reservation_end
    )
    values (
    {$item_id},
    {$_GET['book_id']},
    {$_SESSION['user_id']},
    now(),
    '$start',
    '$end' 
    )
    ";

    $conn->query($sql);
}
if (empty($_SERVER['HTTP_REFERER'])) {
        header("Location:homepage.php");
} else {
    header("Location:{$_SERVER['HTTP_REFERER']}");
}
exit();
?>