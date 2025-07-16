<?php
/* mark the loan as returned and set book availability = 1 */

ini_set('display_errors', 1);
error_reporting(E_ALL);

$mysqli = new mysqli('localhost', 'root', '', 'library-management-system');
if ($mysqli->connect_errno) {
    http_response_code(500);
    exit(json_encode(['ok'=>false,'msg'=>'DB error']));
}

header('Content-Type: application/json');

$bor_id = isset($_POST['borrow_id']) ? (int)$_POST['borrow_id'] : 0;
$book_id= isset($_POST['book_id'])   ? (int)$_POST['book_id']   : 0;
if (!$bor_id || !$book_id) {
    http_response_code(400);
    exit(json_encode(['ok'=>false,'msg'=>'Missing parameters']));
}

/* 1. set returned_at */
$upd1 = $mysqli->prepare('UPDATE borrowed_books SET returned_at = NOW() WHERE id = ?');
$upd1->bind_param('i',$bor_id);
if (!$upd1->execute())
    exit(json_encode(['ok'=>false,'msg'=>$upd1->error]));

/* 2. flip availability */
$upd2 = $mysqli->prepare('UPDATE books SET availability = 1 WHERE book_id = ?');
$upd2->bind_param('i',$book_id);
if (!$upd2->execute())
    exit(json_encode(['ok'=>false,'msg'=>$upd2->error]));

echo json_encode(['ok'=>true]);