<?php
$user_id = 1;
$mysqli  = new mysqli('localhost','root','','library-management-system');
if ($mysqli->connect_errno) {
    exit('Connect error: ' . $mysqli->connect_error);
}

$sql = 'SELECT rl.id   AS read_id,
                b.book_id, b.title, b.authors, b.image_url
        FROM   read_list rl
        JOIN   books b ON rl.book_id = b.book_id
        WHERE  rl.user_id = ?
        ORDER  BY rl.added_at DESC';

$stmt = $mysqli->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$read = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Read List</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Castoro:ital@0;1&family=DM+Serif+Display:ital@0;1&family=Varela+Round&display=swap" rel="stylesheet">
<link rel="icon" type="image/png" href="final-logo.png">

<link rel="stylesheet" href="css/index-styles.css">
<link rel="stylesheet" href="css/read-list.css">
</head>
<body>
<nav class="sidebar">
    
    <h6>Library Management System</h6>
    <a href="index.php" class="sidebar-item"><img src="img/home.svg" class="icon" alt="Home"><span>Home</span></a>
    <a href="read-list.php" class="sidebar-item"><img src="img/bookmark.svg" class="icon" alt="Bookmark"><span>Read List</span></a>
    <a href="reserve-page.php" class="sidebar-item"><img src="img/shelf.svg" class="icon" alt="Shelf"><span>Reserved Books</span></a>
    <a href="borrowing-activity.php" class="sidebar-item"><img src="img/borrow.svg" class="icon" alt="Borrow"><span>Borrowing Activity</span></a>
    <a href="admin.php" class="sidebar-item"><img src="img/dashboard.png" class="icon" alt="Dashboard"><span>Dashboard</span></a>
    
    <a href="index-signedout.php" class="sidebar-item" style="margin-top:auto">
    <img src="img/signout.svg" class="icon" alt="Sign-Out"><span>Sign Out</span>
    </a>
</nav>

<main class="content">
    <section>
  <div>
    <h1>My Read List</h1>
  </div>
</section>

    <div class="recommend-bar">
        <h2 class="recommend-title">
            You have <?= $read->num_rows ?> book<?= $read->num_rows!==1 ? 's' : '' ?> in your list
        </h2>
        <a href="viewall.php" class="view-all-btn">Add More</a>
    </div>

    <div class="book-grid">
    <?php while ($row = $read->fetch_assoc()): ?>
        <?php
            $rlid  = (int)$row['read_id'];
            $bid   = (int)$row['book_id'];
            $title = htmlspecialchars($row['title']);
            $auth  = htmlspecialchars($row['authors']);
            $img   = htmlspecialchars($row['image_url']);
        ?>
        <div class="book-card" data-rlid="<?= $rlid ?>" data-bid="<?= $bid ?>">
            <button class="del-btn" title="Remove from Read List">&times;</button>
            <img src="<?= $img ?>" alt="<?= $title ?>">
            <h3><?= $title ?></h3>
            <p><?= $auth ?></p>
        </div>
    <?php endwhile; ?>

    <?php if ($read->num_rows === 0): ?>
        <p style="padding:2rem;font-style:italic">
            Nothing here yet — head to View All to start adding!
        </p>
    <?php endif; ?>
    </div>
</main>

<script src="js/read-list.js"></script>

<?php $stmt->close(); $mysqli->close(); ?>
</body>
</html>
