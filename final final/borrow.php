<?php
include "mysql.php";

$sql = "
select * from reservations r 
left join books b 
on r.book_id = b.book_id 
where 
r.user_id = {$_SESSION['user_id']}
and
now() >= reservation_start
and
now() <= reservation_end
";

if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $item_id = $row['item_id'];
        $date = $row['date_reserved'];
        echo "
          <h1>
          {$row['book_title']}
          </h1>
          <img src={$row['book_cover']}>
          <h2>
          
          <a href='return_book.php?item_id={$item_id}&date_reserved={$date}'>return book</a>
          
          <form action='return_book.php'>
          <input name='item_id' value={$item_id} hidden>
          <input name= 'date_reserved' value={$date} hidden>
          <input type='submit' value='return book'>
          </form>
          ";
    }    
}

?>