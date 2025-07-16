<?php

$mysqli = new mysqli('localhost', 'root', '', 'library-management-system');
if ($mysqli->connect_errno) {
    http_response_code(500);
    exit(json_encode(['ok' => false, 'msg' => 'DB error']));
}

header('Content-Type: application/json');

$book_id = isset($_POST['book_id']) ? (int)$_POST['book_id'] : 0;
if ($book_id === 0) {
    http_response_code(400);
    exit(json_encode(['ok' => false, 'msg' => 'Invalid book_id']));
}

/* 1  Is the book still available? */
$check = $mysqli->prepare('SELECT availability FROM books WHERE book_id = ?');
$check->bind_param('i', $book_id);
$check->execute();
$avail = $check->get_result()->fetch_assoc()['availability'] ?? null;

if ($avail === null)           exit(json_encode(['ok'=>false,'msg'=>'Book not found']));
if ((int)$avail === 0)         exit(json_encode(['ok'=>false,'msg'=>'Already unavailable']));

/* 2  Flip availability */
$upd = $mysqli->prepare('UPDATE books SET availability = 0 WHERE book_id = ?');
$upd->bind_param('i', $book_id);
$upd->execute();

/* 3  Insert reservation */
$user_id = 1;   // replace with $_SESSION['user_id'] when login is added
$ins = $mysqli->prepare('INSERT INTO reserved_books (book_id, user_id, reserved_at)
                            VALUES (?, ?, NOW())');
$ins->bind_param('ii', $book_id, $user_id);
$ins->execute();

echo json_encode(['ok' => true]);
