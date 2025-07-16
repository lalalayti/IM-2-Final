<?php

$mysqli = new mysqli('localhost', 'root', '', 'library-management-system');
if ($mysqli->connect_errno) {
    exit('Connect error: ' . $mysqli->connect_error);
}

$sql = 'SELECT book_id, title, authors, synopsis, image_url, availability
        FROM books ORDER BY book_id LIMIT 9';
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

    <link rel="stylesheet" href="css/index-styles.css">
    <link rel="stylesheet" href="css/book-preview.css">

    
</head>
<body>
    <nav class="sidebar" style="width:20%">
        <div class="sidebar-links">
            <h6>Library Management System</h6>
            <a href="index.php" class="sidebar-item1"><img class="home-icon" src="img/home.svg" alt="Home"> Home</a>
            <a href="read-list.php" class="sidebar-item2"><img class="bookmark-icon" src="img/bookmark.svg" alt="Bookmark"> Read List</a>
            <a href="reserve-page.php" class="sidebar-item3"><img class="shelf-icon" src="img/shelf.svg" alt="Shelf"> Reserved Books</a>
            <a href="borrowing-activity.php" class="sidebar-item4"><img class="borrow-icon" style="height: 25px;" src="img/borrow.svg" alt="Borrow"> Borrowing Activity</a>
            <a href="admin.php" class="sidebar-item4"><img class="borrow-icon" style="height: 25px;" src="img/dashboard.png" alt="Dashboard"> Dashboard</a>
        </div>
        <a href="index-signedout.php" class="sidebar-signout" style="margin-top: auto; margin-bottom:10px;"><img class="out-icon" style="height: 25px;" src="img/signout.svg" alt="Sign-Out"> Sign Out</a>
    </nav>

    <main class="content">
        <section class="brown-curve">
            <div class="top"><h1 style="margin:10px; margin-left:-400px; margin-top:20px;">Discover</h1></div>
            <div style="display:flex;gap:0.5rem;align-items:center;margin-left:25px;">
                <input class="search-bar" style="margin-left: 25px;" type="text" placeholder="Search.." >
                <button class="search-btn" style="margin-top: 25px; margin-left: -7px;"><img class="search" src="img/search.svg" alt="Button"></button>
            </div>
        </section>

        <div class="recommend-bar">
            <h2 class="recommend-title">Book Recommendations</h2>
            <a href="viewall.php" class="view-all-btn">View All</a>
        </div>

        <div class="book-grid">
        <?php while ($row = $result->fetch_assoc()): ?>
            <?php
                $id    = (int) $row['book_id'];
                $title = htmlspecialchars($row['title']);
                $auth  = htmlspecialchars($row['authors']);
                $desc  = htmlspecialchars($row['synopsis']);
                $img   = htmlspecialchars($row['image_url']);
                $avail = (int) $row['availability'];
        ?>
            <div class="book-card open-modal"
                    data-bookid="<?= $id ?>"
                    data-title="<?= $title ?>"
                    data-authors="<?= $auth ?>"
                    data-desc="<?= $desc ?>"
                    data-img="<?= $img ?>"
                    data-avail="<?= $avail ?>">
                <img src="<?= $img ?>" alt="<?= $title ?>">
                <h3><?= $title ?></h3>
                <p><?= $auth ?></p>
            </div>
        <?php endwhile; ?>
        </div>
    </main>
    <div class="modal" id="bookModal" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
        <div class="modal-content">
            <button class="modal-close" aria-label="Close modal">&times;</button>
            <img src="" alt="Book cover" class="modal-img">
            <div>
                <h2 id="modalTitle"></h2>
                <p class="modal-authors" style="margin-top:0.25rem;font-style:italic;"></p>
                <div class="availability"><span class="avail-indicator">✔️</span> <span class="avail-text"></span></div>
                <div class="modal-buttons">
                    <button id="btnReserve">Reserve Book</button>
                    <button>Borrow Book</button>
                    <button id="btnReadList">Add to Read List</button>
                </div>
            </div>
            <div class="modal-desc"></div>
            <div class="modal-reviews">Book Reviews (coming soon)</div>
            <button style="grid-column:2; justify-self:end; margin-top:0.5rem; padding:0.35rem 1rem; border:none; background:#d7d7d7; border-radius:4px; cursor:pointer;">Add Review</button>
        </div>
    </div>

    <script src= "js/index.js"></script>

<?php
$stmt->close();
$mysqli->close();
?>
</body>
</html>