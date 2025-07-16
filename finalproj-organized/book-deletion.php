<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

$mysqli = new mysqli('localhost', 'root', '', 'library-management-system');
if ($mysqli->connect_errno) {
    http_response_code(500);
    exit(json_encode(['ok'=>false,'msg'=>'DB error']));
}

header('Content-Type: application/json');

$rid = isset($_POST['reservation_id']) ? (int)$_POST['reservation_id'] : 0;
$bid = isset($_POST['book_id'])        ? (int)$_POST['book_id']        : 0;
if (!$rid || !$bid) {
    http_response_code(400);
    exit(json_encode(['ok'=>false,'msg'=>'Missing parameters']));
}

$del = $mysqli->prepare('DELETE FROM reserved_books WHERE id = ?');
$del->bind_param('i',$rid);
$del->execute();

$upd = $mysqli->prepare('UPDATE books SET availability = 1 WHERE book_id = ?');
$upd->bind_param('i',$bid);
$upd->execute();

echo json_encode(['ok'=>true]);