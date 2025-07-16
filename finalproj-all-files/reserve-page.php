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

<link rel="stylesheet" href="index-styles.css">

<style>
    .book-card { position:relative; }
    .del-btn   { position:absolute; top:6px; right:6px;
                    background:#ff6666; border:none; border-radius:50%;
                    width:26px; height:26px; color:#fff; cursor:pointer; line-height:24px; }
    .del-btn:hover{ background:#ff4b4b; }
</style>
</head>
<body>
    <nav class="sidebar" style="width:20%">
        <div class="sidebar-links">
            <h6>Library Management System</h6>
            <a href="index.php" class="sidebar-item1"><img class="home-icon" src="home.svg" alt="Home"> Home</a>
            <a href="read-list.php" class="sidebar-item2"><img class="bookmark-icon" src="bookmark.svg" alt="Bookmark"> Read List</a>
            <a href="reserve-page.php" class="sidebar-item3"><img class="shelf-icon" src="shelf.svg" alt="Shelf"> Reserved Books</a>
            <a href="borrowing-activity.php" class="sidebar-item4"><img class="borrow-icon" style="height: 25px;" src="borrow.svg" alt="Borrow"> Borrowing Activity</a>
        </div>
        <a href="#" class="sidebar-signout" style="margin-top: auto; margin-bottom:10px;"><img class="out-icon" style="height: 25px;" src="signout.svg" alt="Sign-Out"> Sign Out</a>
    </nav>

    <main class="content">
        <section class="brown-curve">
            <h1 style="margin-left: -400px;">My Reserved Books</h1>
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

<script>
document.querySelectorAll('.del-btn').forEach(btn => {
    btn.addEventListener('click', e => {
        e.stopPropagation();
        const card = btn.closest('.book-card');

        const rid = card.dataset.rid;
        const bid = card.dataset.bid;

        if (!rid || !bid) {
            alert('Missing IDs on card – check data-rid / data-bid.');
            return;
        }

        if (!confirm('Cancel this reservation?')) return;

        fetch('book-deletion.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({ reservation_id: rid, book_id: bid })
        })
        .then(r => r.json())
        .then(d => {
            if (d.ok) {
                card.remove();
            } else {
                alert(d.msg || 'Could not delete.');
            }
        })
        .catch(() => alert('Server error.'));
    });
});

</script>

<?php $stmt->close(); $mysqli->close(); ?>
</body>
</html>