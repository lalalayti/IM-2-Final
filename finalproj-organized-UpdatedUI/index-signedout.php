<?php
$mysqli = new mysqli('localhost', 'root', '', 'library-management-system');
if ($mysqli->connect_errno) {
    exit('Connect error: ' . $mysqli->connect_error);
}

$sql = 'SELECT book_id, title, authors, synopsis, image_url, availability FROM books ORDER BY book_id LIMIT 9';
$stmt = $mysqli->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Library System</title>
  <link href="https://fonts.googleapis.com/css2?family=Lexend&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/book-preview.css">
  <link rel="stylesheet" href="css/index-styles.css">
  <link rel="icon" href="final-logo.png">
</head>
<body>
  <nav class="sidebar">
    <h6>Library Management System</h6>
    <a href="index.php"><img src="img/home.svg" alt="Home" class="icon"> Home</a>
    <a href="read-list.php"><img src="img/bookmark.svg" alt="Bookmark" class="icon"> Read List</a>
    <a href="reserve-page.php"><img src="img/shelf.svg" alt="Shelf" class="icon"> Reserved Books</a>
    <a href="borrowing-activity.php"><img src="img/borrow.svg" alt="Borrow" class="icon"> Borrowing Activity</a>
    <a href="admin.php"><img src="img/dashboard.png" alt="Dashboard" class="icon"> Dashboard</a>
    <a href="login.php" style="margin-top:auto"><img src="img/signin.svg" alt="Sign Out" class="icon"> Sign Out</a>
  </nav>

  <main class="content">
    <header>
      <h1>Discover Books</h1>
      <div class="search-bar">
        <input type="text" placeholder="Search...">
        <button><img src="img/search.svg" alt="Search" style="height:18px;"></button>
      </div>
    </header>

    <div class="recommend-bar">
      <h2 class="recommend-title">Book Recommendations</h2>
      <a href="viewall.php" class="view-all-btn">View All</a>
    </div>

    <div class="book-grid">
      <?php while ($row = $result->fetch_assoc()): ?>
        <?php
          $id = (int) $row['book_id'];
          $title = htmlspecialchars($row['title']);
          $auth = htmlspecialchars($row['authors']);
          $desc = htmlspecialchars($row['synopsis']);
          $img = htmlspecialchars($row['image_url']);
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
        <div class="availability">
          <span class="avail-indicator">✔️</span>
          <span class="avail-text"></span>
        </div>
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

  <script src="js/index.js"></script>
</body>
</html>

<?php
$stmt->close();
$mysqli->close();
?>
