<?php
$mysqli = new mysqli('localhost', 'root', '', 'library-management-system');
if ($mysqli->connect_errno) {
    exit('Connect error: ' . $mysqli->connect_error);
}

$sql  = 'SELECT title, authors, image_url FROM books ORDER BY title LIMIT 9';
$stmt = $mysqli->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Library Management System</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Castoro:ital@0;1&family=DM+Serif+Display:ital@0;1&family=Varela+Round&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="final-logo.png" />

    <link rel="stylesheet" href="index-styles.css">
</head>
<body>
    <nav class="sidebar" style="width:20%">
        <div class="sidebar-links">
        <h6>Library Management System</h6>
            <a href="index.PHP" class="sidebar-item1">
                <img class="home-icon" src="home.svg" alt="Home">
                Home
            </a>

            <a href="#" class="sidebar-item2">
                <img class="bookmark-icon" src="bookmark.svg" alt="Bookmark">
                Read List
            </a>

            <a href="#" class="sidebar-item3">
                <img class="shelf-icon" src="shelf.svg" alt="Shelf">
                Reserved Books
            </a>
            <a href="#" class="sidebar-item4">
                <img class="borrow-icon" style="height: 25px;" src="borrow.svg" alt="Borrow">
                Borrowing Activity
            </a>
        </div>

        <a href="#" class="sidebar-signout" style="margin-top: auto; margin-bottom:10px;">
            <img class="out-icon" style="height: 25px;" src="signout.svg" alt="Sign-Out">
            Sign Out
        </a>
    </nav>

    <main class="content">

        <section class="brown-curve">
            <div class="top">
                <h1 style="font-weight: 40px; margin-top:20px;">Discover</h1>
            </div>
            

            <input class="search-bar" style="margin-left: 25px;" type="text" placeholder="Search..">
            <button class="search-btn"><img class="search" src="search.svg" alt="Button"></button>
        </section>

        <div class="recommend-bar">
            <h2 class="recommend-title">Book Recommendations</h2>

            <a href="viewall.php" class="view-all-btn">View All</a>
        </div>

        <div class="book-grid">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="book-card">
                <img src="<?= htmlspecialchars($row['image_url']) ?>"
                        alt="<?= htmlspecialchars($row['title']) ?>">
                <h3><?= htmlspecialchars($row['title']) ?></h3>
                <p><?= htmlspecialchars($row['authors']) ?></p>
            </div>
        <?php endwhile; ?>
        </div>

<?php
    $stmt->close();
    $mysqli->close();
    ?>
</body>
</html>
