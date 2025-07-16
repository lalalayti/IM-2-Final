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
    <title>Library Management System</title>

   
    <link rel="stylesheet" href="css/index-styles.css">
    <link rel="stylesheet" href="css/book-preview.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="icon" type="image/png" href="final-logo.png" />

    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <nav class="sidebar" style="width:20%">
        <div class="sidebar-links">
            <h6>Library Management System</h6>
            <a href="index.php" class="sidebar-item1"><img class="home-icon" src="img/home.svg" alt="Home"> Home</a>
            <a href="read-list.php" class="sidebar-item2"><img class="bookmark-icon" src="img/bookmark.svg" alt="Bookmark"> Read List</a>
            <a href="reserve-page.php" class="sidebar-item3"><img class="shelf-icon" src="img/shelf.svg" alt="Shelf"> Reserved Books</a>
            <a href="borrowing-activity.php" class="sidebar-item4"><img class="borrow-icon" style="height: 25px;" src="img/borrow.svg" alt="Borrow"> Borrowing Activity</a>
            <a href="admin.php" class="sidebar-item4"><img class="borrow-icon" style="height: 25px;" src="img/dashboard.png" alt="Dash"> Dashboard</a>
        </div>
        <a href="index-signedout.php" class="sidebar-signout" style="margin-top: auto; margin-bottom:10px;"><img class="out-icon" style="height: 25px;" src="img/signout.svg" alt="Sign-Out"> Sign Out</a>
    </nav>

    <main class="content">
        <section class="brown-curve">
            <div class="top"><h1 style="margin:10px; margin-left:-400px; margin-top:20px;">Dashboard</h1></div>
        </section>

        <section style="padding: 20px 60px;">
            <h2><b>List of Users</b></h2>
            <table border="1" cellpadding="8" cellspacing="0" style="margin-top: 10px; width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background-color: #ddd;">
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


        <section style="padding: 30px 60px;">
            <h2><b>Library Book Statistics</b></h2>
            <canvas id="bookStatsChart" width="400" height="300"></canvas>
        </section>

       
       
    </main>

   
    <script>
        const totalBooks = <?php echo $totalBooks; ?>;
        const reservedBooks = <?php echo $reservedBooks; ?>;
        const borrowedBooks = <?php echo $borrowedBooks; ?>;
    </script>
    <script src="js/charts.js"></script>

<?php

$mysqli->close();
?>
</body>
</html>
