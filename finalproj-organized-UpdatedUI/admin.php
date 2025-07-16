<?php
$mysqli = new mysqli('localhost', 'root', '', 'library-management-system');
if ($mysqli->connect_errno) {
    exit('Connect error: ' . $mysqli->connect_error);
}

$totalBooks = $mysqli->query("SELECT COUNT(*) AS total FROM books")->fetch_assoc()['total'];
$reservedBooks = $mysqli->query("SELECT COUNT(*) AS reserved FROM reserved_books")->fetch_assoc()['reserved'];
$borrowedBooks = $mysqli->query("SELECT COUNT(*) AS borrowed FROM borrowed_books")->fetch_assoc()['borrowed'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Library Dashboard</title>
  <link rel="stylesheet" href="css/index-styles.css">
  <link rel="stylesheet" href="css/book-preview.css">
  <link rel="stylesheet" href="css/admin.css">
  <link rel="icon" href="final-logo.png">
  <link href="https://fonts.googleapis.com/css2?family=Lexend&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <nav class="sidebar">
    <h6>Library Management System</h6>
    <a href="index.php"><img src="img/home.svg" alt="Home" class="icon"> Home</a>
    <a href="read-list.php"><img src="img/bookmark.svg" alt="Bookmark" class="icon"> Read List</a>
    <a href="reserve-page.php"><img src="img/shelf.svg" alt="Shelf" class="icon"> Reserved Books</a>
    <a href="borrowing-activity.php"><img src="img/borrow.svg" alt="Borrow" class="icon"> Borrowing Activity</a>
    <a href="admin.php"><img src="img/dashboard.png" alt="Dashboard" class="icon"> Dashboard</a>
    <a href="index-signedout.php" style="margin-top:auto"><img src="img/signout.svg" alt="Sign Out" class="icon"> Sign Out</a>
  </nav>

  <main class="content">
    <header>
      <h1>Dashboard</h1>
    </header>

    <section>
      <h2>List of Users</h2>
      <table class="admin-table">
        <thead>
          <tr>
            <th>User ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Account Type</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $usersResult = $mysqli->query("SELECT user_id, first_name, middle_name, last_name, email, account_type FROM users");
          while ($user = $usersResult->fetch_assoc()) {
              $fullName = "{$user['first_name']} {$user['middle_name']} {$user['last_name']}";
              echo "<tr>
                      <td>{$user['user_id']}</td>
                      <td>{$fullName}</td>
                      <td>{$user['email']}</td>
                      <td>{$user['account_type']}</td>
                      <td><button class='flag-btn' onclick='flagUser({$user['user_id']})'>Flag</button></td>
                    </tr>";
          }
          ?>
        </tbody>
      </table>
    </section>
          <br>
    <section>
      <h2>Library Book Statistics</h2>
      <canvas id="bookStatsChart" width="300" height="83"></canvas>
    </section>
  </main>

  <script>
    const totalBooks = <?php echo $totalBooks; ?>;
    const reservedBooks = <?php echo $reservedBooks; ?>;
    const borrowedBooks = <?php echo $borrowedBooks; ?>;
  </script>
  <script src="js/charts.js"></script>
  <?php $mysqli->close(); ?>
</body>
</html>
