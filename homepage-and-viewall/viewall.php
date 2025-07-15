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

$dataSql = "SELECT title, authors, image_url FROM books $whereSql ORDER BY title LIMIT ? OFFSET ?";
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

    <link rel="stylesheet" href="index-styles.css">

    <style>
        .pagination {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin: 32px 0;
            flex-wrap: wrap;
        }
        .pagination a {
            padding: 0.35rem 0.85rem;
            border: 1px solid var(--primary, #745636);
            color: #745636;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.9rem;
            transition: background 0.2s ease;
        }
        .pagination a.active,
        .pagination a:hover {
            background: var(--primary, #745636);
            color: #fff;
        }

    </style>
</head>
<body>
    <nav class="sidebar" style="width:20%">
        <div class="sidebar-links">
            <h6>Library Management System</h6>
            <a href="index.php" class="sidebar-item1">
                <img class="home-icon" src="home.svg" alt="Home"> Home
            </a>
            <a href="#" class="sidebar-item2">
                <img class="bookmark-icon" src="bookmark.svg" alt="Bookmark"> Read List
            </a>
            <a href="#" class="sidebar-item3">
                <img class="shelf-icon" src="shelf.svg" alt="Shelf"> Reserved Books
            </a>
            <a href="#" class="sidebar-item4">
                <img class="borrow-icon" style="height: 25px;" src="borrow.svg" alt="Borrow"> Borrowing Activity
            </a>
        </div>
        <a href="#" class="sidebar-signout" style="margin-top: auto; margin-bottom:10px;">
            <img class="out-icon" style="height: 25px;" src="signout.svg" alt="Sign-Out"> Sign Out
        </a>
    </nav>

    <main class="content">
        <section class="brown-curve">
            <div class="top">
                <h1 style="margin:10px; margin-left:-250px; margin-top:20px;">All Books</h1>
            </div>
            <form method="get" class="search-wrapper" style="display:flex; align-items:center; gap:8px; margin-left:25px;">
                <input class="search-bar" type="text" style="margin-left: 25px;" name="q" placeholder="Search by title or author" value="<?= htmlspecialchars($search) ?>">
                <button class="search-btn" type="submit" style="margin-top: 25px; margin-left: 160px;"><img class="search" src="search.svg" alt="Search"></button>
            </form>
        </section>

        <div class="book-grid">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="book-card">
                    <img src="<?= htmlspecialchars($row['image_url']) ?>" alt="<?= htmlspecialchars($row['title']) ?>">
                    <h3><?= htmlspecialchars($row['title']) ?></h3>
                    <p><?= htmlspecialchars($row['authors']) ?></p>
                </div>
            <?php endwhile; ?>

            <?php if ($result->num_rows === 0): ?>
                <p style="padding: 0 2rem; font-style: italic;">No books found.</p>
            <?php endif; ?>
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

<?php
$dataStmt->close();
$mysqli->close();
?>
</body>
</html>
