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

    <link rel="stylesheet" href="index-styles.css">

    <style>
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.55);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }
        .modal.active { display: flex; }

        .modal-content {
            background: #e5e5e5;
            padding: 2rem;
            max-width: 900px;
            width: 95%;
            border-radius: 10px;
            display: grid;
            grid-template-columns: 220px 1fr;
            grid-template-rows: auto 1fr auto;
            gap: 1.5rem;
            position: relative;
        }
        .modal-content h2 { margin: 0; font-family: "Archivo Black", sans-serif; }
        .modal-close {
            position: absolute;
            top: 12px;
            right: 14px;
            border: none;
            background: transparent;
            font-size: 1.6rem;
            cursor: pointer;
        }
        .modal-img {
            width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 4px;
            grid-row: 1 / span 3;
        }
        .availability {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.95rem;
            margin-bottom: 1rem;
        }
        .modal-buttons button {
            display: block;
            width: 100%;
            margin-bottom: 0.6rem;
            padding: 0.45rem 1rem;
            border: none;
            border-radius: 4px;
            background: #d7d7d7;
            cursor: pointer;
            transition: background 0.2s ease;
        }
        .modal-buttons button:hover { background: #c2c2c2; }
        .modal-desc, .modal-reviews { background: #f3f3f3; padding: 1rem; border-radius: 6px; }
        .modal-reviews { min-height: 120px; margin-top: 1rem; }
        @media (max-width: 600px) {
            .modal-content { grid-template-columns: 1fr; }
            .modal-img { grid-row: auto; }
        }
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
        <a href="index.PHP" class="sidebar-signout" style="margin-top: auto; margin-bottom:10px;"><img class="out-icon" style="height: 25px;" src="signin.svg" alt="Sign-In">Sign In</a>
    </nav>

    <main class="content">
        <section class="brown-curve">
            <div class="top"><h1 style="margin:10px; margin-left:-400px; margin-top:20px;">Discover</h1></div>
            <div style="display:flex;gap:0.5rem;align-items:center;margin-left:25px;">
                <input class="search-bar" style="margin-left: 25px;" type="text" placeholder="Search.." >
                <button class="search-btn" style="margin-top: 25px; margin-left: -7px;"><img class="search" src="search.svg" alt="Button"></button>
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

    <script>
        const modal      = document.getElementById('bookModal');
        const closeBtn   = modal.querySelector('.modal-close');
        const imgEl      = modal.querySelector('.modal-img');
        const titleEl    = modal.querySelector('#modalTitle');
        const authorsEl  = modal.querySelector('.modal-authors');
        const descEl     = modal.querySelector('.modal-desc');
        const availText  = modal.querySelector('.avail-text');
        const availInd   = modal.querySelector('.avail-indicator');
        const reserveBtn = document.getElementById('btnReserve');
        const readBtn  = document.getElementById('btnReadList');


        let   currentBookId = null;

        document.querySelectorAll('.open-modal').forEach(card => {
            card.addEventListener('click', () => {
                currentBookId = card.dataset.bookid;
                titleEl.textContent   = card.dataset.title;
                authorsEl.textContent = card.dataset.authors;
                descEl.textContent    = card.dataset.desc || 'No description available.';
                imgEl.src             = card.dataset.img;
                imgEl.alt             = card.dataset.title;

                const available = card.dataset.avail === '1';
                availText.textContent = available ? 'Available' : 'Currently Unavailable';
                availInd.textContent  = available ? '✔️' : '❌';
                reserveBtn.disabled   = !available;

                readBtn.disabled = false;
                readBtn.textContent = 'Add to Read List';

                modal.classList.add('active');
            });
        });

        closeBtn.addEventListener('click', () => modal.classList.remove('active'));
        modal.addEventListener('click', e => { if (e.target === modal) modal.classList.remove('active'); });
        document.addEventListener('keydown', e => { if (e.key === 'Escape') modal.classList.remove('active'); });

        reserveBtn.addEventListener('click', () => {
            if (!currentBookId) return;
            reserveBtn.disabled = true;

            fetch('reserve-book.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({ book_id: currentBookId })
            })
            .then(r => r.json())
            .then(data => {
                if (data.ok) {
                    availText.textContent = 'Currently Unavailable';
                    availInd.textContent  = '❌';

                    const card = document.querySelector(`.open-modal[data-bookid="${currentBookId}"]`);
                    if (card) card.dataset.avail = '0';

                    alert('Book reserved successfully.');
                } else {
                    alert(data.msg || 'Could not reserve.');
                    reserveBtn.disabled = false;
                }
            })
            .catch(() => {
                alert('Server error.');
                reserveBtn.disabled = false;
            });
        });

    readBtn.addEventListener('click', () => {
    window.location.href = 'signup.html';
    });


    </script>

<?php
$stmt->close();
$mysqli->close();
?>
</body>
</html>