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
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>My Read List</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Castoro:ital@0;1&family=DM+Serif+Display:ital@0;1&family=Varela+Round&display=swap" rel="stylesheet">
<link rel="icon" type="image/png" href="final-logo.png">

<link rel="stylesheet" href="index-styles.css">

<style>
    .book-card   { position:relative; }
    .del-btn     { position:absolute; top:6px; right:6px;
                    width:26px; height:26px; border:none;
                    background:#ff6666; border-radius:50%;
                    color:#fff; line-height:24px; cursor:pointer; }
    .del-btn:hover { background:#ff4b4b; }
</style>
</head>
<body>
<nav class="sidebar" style="width:20%">
    <div class="sidebar-links">
        <h6>Library Management System</h6>
        <a href="index.php"         class="sidebar-item1"><img class="home-icon" src="home.svg"     alt="Home"> Home</a>
        <a href="read-list.php"     class="sidebar-item2"><img class="bookmark-icon" src="bookmark.svg" alt="Bookmark"> Read List</a>
        <a href="reserve-page.php"  class="sidebar-item3"><img class="shelf-icon" src="shelf.svg"   alt="Shelf"> Reserved Books</a>
        <a href="borrowing-activity.php" class="sidebar-item4"><img class="borrow-icon" style="height:25px" src="borrow.svg" alt="Borrow"> Borrowing Activity</a>
    </div>
    <a href="#" class="sidebar-signout" style="margin-top:auto;margin-bottom:10px;">
        <img class="out-icon" style="height:25px" src="signout.svg" alt="Sign‑Out"> Sign Out
    </a>
</nav>

<main class="content">
    <section class="brown-curve" style="width: auto;">
        <h1 style="margin-left:-400px;">My Read List</h1>
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
            <button class="del-btn" title="Remove from Read List">&times;</button>
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

<script>
document.querySelectorAll('.del-btn').forEach(btn => {
    btn.addEventListener('click', e => {
        e.stopPropagation();
        const card = btn.closest('.book-card');
        const rlid = card.dataset.rlid;
        const bid  = card.dataset.bid;

        if (!rlid || !bid) {
            alert('Missing IDs – check data-rlid/data-bid.');
            return;
        }
        if (!confirm('Remove this book from your Read List?')) return;

        fetch('read-deletion.php', {
            method : 'POST',
            headers: { 'Content-Type':'application/x-www-form-urlencoded' },
            body   : new URLSearchParams({ read_id: rlid, book_id: bid })
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