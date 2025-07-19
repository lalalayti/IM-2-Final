<?php
$gets = array(
    'user_id',
    'book_id',
    'item_id',
    'email',
    'password'
    );
foreach ($gets as $get) {
    if (!empty($_GET[$get])) echo "GET {$get}: {$_GET[$get]}<br>";  
    if (!empty($_POST[$get])) echo "POST {$get}: {$_POST[$get]}<br>";  
    if (!empty($_SESSION[$get])) echo "SESSION {$get}: {$_SESSION[$get]}<br>";        
}

if (!empty($_GET['date_reserved']))
    echo date("Y-m-d", strtotime($_GET['date_reserved'] . "+ 7 days"));
?>

<form>
    <?php
    foreach ($gets as $get) {
    echo "{$get} <input name={$get}><br>";    
    }
    ?>
    <input type="date" name="date_reserved">
    <input type="submit">
</form>