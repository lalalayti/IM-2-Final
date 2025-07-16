<?php
$user_id = 1;                           // replace with $_SESSION['user_id']

$mysqli = new mysqli('localhost', 'root', '', 'library-management-system');
if ($mysqli->connect_errno) {
    exit('Connect error: ' . $mysqli->connect_error);
}

$sql = 'SELECT bb.id AS borrow_id,
                b.book_id, b.title, b.authors, b.image_url,
                bb.borrowed_at, bb.due_at
        FROM borrowed_books bb
        JOIN books b ON bb.book_id = b.book_id
        WHERE bb.user_id = ? AND bb.returned_at IS NULL
        ORDER BY bb.due_at';

$stmt = $mysqli->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$loans = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Borrowing Activity</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Castoro:ital@0;1&family=DM+Serif+Display:ital@0;1&family=Varela+Round&display=swap" rel="stylesheet">
<link rel="icon" type="image/png" href="final-logo.png">
<link rel="stylesheet" href="index-styles.css">

<style>
    .book-card { position:relative; }
    .return-btn{ position:absolute; top:6px; right:6px;
                    background:#4bb543; border:none; border-radius:4px;
                    color:#fff; font-size:.75rem; padding:2px 6px; cursor:pointer; }
    .return-btn:hover{ background:#3ea238; }
    .dates { font-size:.8rem; margin-top:.3rem; }
</style>
</head>
<body>
    <nav class="sidebar" style="width:20%">
        <div class="sidebar-links">
            <h6>Library Management System</h6>
            <a href="index.php" class="sidebar-item1">
                <img class="home-icon" src="home.svg" alt="Home"> Home
            </a>
            <a href="read-list.php" class="sidebar-item2">
                <img class="bookmark-icon" src="bookmark.svg" alt="Bookmark"> Read List
            </a>
            <a href="reserve-page.php" class="sidebar-item3">
                <img class="shelf-icon" src="shelf.svg" alt="Shelf"> Reserved Books
            </a>
            <a href="borrowing-activity.php" class="sidebar-item4">
                <img class="borrow-icon" style="height: 25px;" src="borrow.svg" alt="Borrow"> Borrowing Activity
            </a>
        </div>
        <a href="#" class="sidebar-signout" style="margin-top: auto; margin-bottom:10px;">
            <img class="out-icon" style="height: 25px;" src="signout.svg" alt="Sign-Out"> Sign Out
        </a>
    </nav>

    <main class="content" style="width: auto;">
        <section class="brown-curve">
            <h1 style="margin:20px 25px">Borrowing Activity</h1>
        </section>

        <div class="recommend-bar">
            <h2 class="recommend-title">
                You currently have <?= $loans->num_rows ?> book<?= $loans->num_rows!==1?'s':'' ?> borrowed
            </h2>
            <a href="viewall.php" class="view-all-btn">Borrow More</a>
        </div>

        <div class="book-grid">
        <?php while ($row = $loans->fetch_assoc()): ?>
            <?php
                $bid  = (int)$row['book_id'];
                $bor  = (int)$row['borrow_id'];
                $img  = htmlspecialchars($row['image_url']);
                $title= htmlspecialchars($row['title']);
                $auth = htmlspecialchars($row['authors']);
                $borDate = date('M d Y', strtotime($row['borrowed_at']));
                $dueDate = date('M d Y', strtotime($row['due_at']));
            ?>
            <div class="book-card" data-borrowid="<?= $bor ?>" data-bookid="<?= $bid ?>">
                <button class="return-btn" title="Return this book">Return</button>
                <img src="<?= $img ?>" alt="<?= $title ?>">
                <h3><?= $title ?></h3>
                <p><?= $auth ?></p>
                <p class="dates">Borrowed: <?= $borDate ?><br>Due: <?= $dueDate ?></p>
            </div>
        <?php endwhile; ?>

        <?php if ($loans->num_rows === 0): ?>
            <p style="padding:2rem;font-style:italic">
                No active loans — grab something from View All!
            </p>
        <?php endif; ?>
        </div>
    </main>

<script>
document.querySelectorAll('.return-btn').forEach(btn=>{
    btn.addEventListener('click', e=>{
        e.stopPropagation();
        const card = btn.closest('.book-card');
        const borrowId = card.dataset.borrowid;
        const bookId   = card.dataset.bookid;

        if (!confirm('Return this book?')) return;

        fetch('return-book.php', {
            method:'POST',
            headers:{'Content-Type':'application/x-www-form-urlencoded'},
            body:new URLSearchParams({ borrow_id: borrowId, book_id: bookId })
        })
        .then(r=>r.json())
        .then(d=>{
            if (d.ok){
                card.remove();
            } else {
                alert(d.msg||'Could not return.');
            }
        })
        .catch(()=>alert('Server error'));
    });
});
</script>

<?php $stmt->close(); $mysqli->close(); ?>
</body>
</html>