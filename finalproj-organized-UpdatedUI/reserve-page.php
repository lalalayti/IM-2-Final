<?php
$user_id = 1;

$mysqli = new mysqli('localhost', 'root', '', 'library-management-system');
if ($mysqli->connect_errno) {
    exit('Connect error: ' . $mysqli->connect_error);
}

$sql = 'SELECT rb.id   AS reservation_id,
                b.book_id, b.title, b.authors, b.image_url
        FROM reserved_books rb
        JOIN books b ON rb.book_id = b.book_id
        WHERE rb.user_id = ?
        ORDER BY rb.reserved_at DESC';

$stmt = $mysqli->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$reserved = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>My Reserved Books</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Castoro:ital@0;1&family=DM+Serif+Display:ital@0;1&family=Varela+Round&display=swap" rel="stylesheet">
<link rel="icon" type="image/png" href="final-logo.png">

<link rel="stylesheet" href="css/index-styles.css">
<link rel="stylesheet" href="css/read-list.css">
</head>

<body>
<nav class="sidebar" style="width:20%">
    <div class="sidebar-links">
        <h6>Library Management System</h6>
        <a href="index.php" class="sidebar-item"><img class="icon" src="img/home.svg" alt="Home"> <span>Home</span></a>
        <a href="read-list.php" class="sidebar-item"><img class="icon" src="img/bookmark.svg" alt="Bookmark"> <span>Read List</span></a>
        <a href="reserve-page.php" class="sidebar-item"><img class="icon" src="img/shelf.svg" alt="Shelf"> <span>Reserved Books</span></a>
        <a href="borrowing-activity.php" class="sidebar-item"><img class="icon" src="img/borrow.svg" alt="Borrow"> <span>Borrowing Activity</span></a>
        <a href="admin.php" class="sidebar-item"><img class="icon" src="img/dashboard.png" alt="Dashboard"> <span>Dashboard</span></a>
    </div>
    <a href="index-signedout.php" class="sidebar-item" style="margin-top: auto; margin-bottom: 10px;">
        <img class="icon" src="img/signout.svg" alt="Sign-Out"> <span>Sign Out</span>
    </a>
</nav>

<main class="content">
    <section class="brown-curve">
        <div class="brown-curve-content">
            <h1>My Reserved Books</h1>
        </div>
    </section>

    <div class="recommend-bar">
        <h2 class="recommend-title">
            You have <?= $reserved->num_rows ?> reserved book<?= $reserved->num_rows!==1?'s':'' ?>
        </h2>
        <a href="viewall.php" class="view-all-btn">Add More</a>
    </div>

    <div class="book-grid">
    <?php while ($row = $reserved->fetch_assoc()): ?>
        <?php
            $rid   = (int)$row['reservation_id'];
            $bid   = (int)$row['book_id'];
            $title = htmlspecialchars($row['title']);
            $auth  = htmlspecialchars($row['authors']);
            $img   = htmlspecialchars($row['image_url']);
        ?>
        <div class="book-card" data-rid="<?= $rid ?>" data-bid="<?= $bid ?>">
            <button class="del-btn" title="Delete reservation">&times;</button>
            <img src="<?= $img ?>" alt="<?= $title ?>">
            <h3><?= $title ?></h3>
            <p><?= $auth ?></p>
        </div>
    <?php endwhile; ?>

    <?php if ($reserved->num_rows === 0): ?>
        <p style="padding:2rem;font-style:italic">
            No reservations yet — head to View All to add some!
        </p>
    <?php endif; ?>
    </div>
</main>

<script src="js/reserve-page.js"></script>

<?php $stmt->close(); $mysqli->close(); ?>
</body>
</html>
