<?php

$mysqli = new mysqli('localhost', 'root', '', 'library-management-system');
if ($mysqli->connect_errno) {
    exit('Connect error: ' . $mysqli->connect_error);
}

$limit  = 12;
$page   = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
$search = isset($_GET['q'])    ? trim($_GET['q'])        : '';
$offset = ($page - 1) * $limit;

$whereSql   = '';
$bindTypes  = '';
$bindValues = [];
if ($search !== '') {
    $whereSql   = 'WHERE title LIKE ? OR authors LIKE ?';
    $bindTypes  .= 'ss';
    $likeValue   = "%{$search}%";
    $bindValues[] = $likeValue;
    $bindValues[] = $likeValue;
}

$countSql = "SELECT COUNT(*) AS total FROM books $whereSql";
$countStmt = $mysqli->prepare($countSql);
if ($bindTypes !== '') {
    $countStmt->bind_param($bindTypes, ...$bindValues);
}
$countStmt->execute();
$totalRows = $countStmt->get_result()->fetch_assoc()['total'] ?? 0;
$totalPages = $totalRows > 0 ? (int) ceil($totalRows / $limit) : 1;
$countStmt->close();

$dataSql = "SELECT book_id, title, authors, synopsis,
                    image_url, availability
            FROM books $whereSql
            ORDER BY book_id
            LIMIT ? OFFSET ?";
$dataStmt = $mysqli->prepare($dataSql);

$bindTypesData  = $bindTypes . 'ii';
$bindValuesData = [...$bindValues, $limit, $offset];
$dataStmt->bind_param($bindTypesData, ...$bindValuesData);
$dataStmt->execute();
$result = $dataStmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>All Books • Library Management System</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Castoro:ital@0;1&family=DM+Serif+Display:ital@0;1&family=Varela+Round&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="final-logo.png" />

    <link rel="stylesheet" href="css/index-styles.css">
    <link rel="stylesheet" href="css/book-preview.css">
    <link rel="stylesheet" href="css/viewall.css">
</head>
<body>
   <nav class="sidebar">
    
        <h6>Library Management System</h6>

        <a href="index.php" class="sidebar-item1">
            <img src="img/home.svg" class="sidebar-icon" alt="Home"> Home
        </a>
        <a href="read-list.php" class="sidebar-item2">
            <img src="img/bookmark.svg" class="sidebar-icon" alt="Bookmark"> Read List
        </a>
        <a href="reserve-page.php" class="sidebar-item3">
            <img src="img/shelf.svg" class="sidebar-icon" alt="Shelf"> Reserved Books
        </a>
        <a href="borrowing-activity.php" class="sidebar-item4">
            <img src="img/borrow.svg" class="sidebar-icon" alt="Borrow"> Borrowing Activity
        </a>
    

    <a href="index-signedout.php" class="sidebar-signout">
        <img src="img/signout.svg"  class="sidebar-icon" alt="Sign-Out"> Sign Out
    </a>
</nav>

    <main class="content">
        <section class="brown-curve">
            <div class="top" style="display: flex; justify-content: space-between; align-items: center;">
                <h1 style="margin: 20px 30px; font-family: 'DM Serif Display', serif;">All Books</h1>
                <form method="get" class="search-wrapper">
    <input class="search-bar" type="text" name="q" placeholder="Search by title or author" value="<?= htmlspecialchars($search) ?>">
    <button class="search-btn" type="submit">
        <img class="search-icon" src="img/search.svg" alt="Search">
    </button>
</form>
            </div>
        </section>

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

        <?php if ($totalPages > 1): ?>
            <div class="pagination">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?<?= $search !== '' ? 'q=' . urlencode($search) . '&' : '' ?>page=<?= $i ?>" class="<?= $i === $page ? 'active' : '' ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>
            </div>
        <?php endif; ?>
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

<script src="js/index.js"> </script>

<?php
$dataStmt->close();
$mysqli->close();
?>
</body>
</html>
