<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

$mysqli = new mysqli('localhost','root','','library-management-system');
if ($mysqli->connect_errno) {
    http_response_code(500);
    exit(json_encode(['ok'=>false,'msg'=>'DB error']));
}

$user_id = 1;                              // eventually: $_SESSION['user_id']
$book_id = isset($_POST['book_id']) ? (int)$_POST['book_id'] : 0;
if (!$book_id) {
    http_response_code(400);
    exit(json_encode(['ok'=>false,'msg'=>'Missing book_id']));
}

/* insert only if it isn’t already there */
$stmt = $mysqli->prepare(
    'INSERT IGNORE INTO read_list (user_id, book_id) VALUES (?, ?)'
);
$stmt->bind_param('ii', $user_id, $book_id);
$stmt->execute();

if ($stmt->affected_rows === 0) {
    exit(json_encode(['ok'=>false,'msg'=>'Book already in your Read List']));
}
echo json_encode(['ok'=>true]);