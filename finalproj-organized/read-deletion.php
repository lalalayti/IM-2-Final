<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$mysqli = new mysqli('localhost','root','','library-management-system');
if ($mysqli->connect_errno) {
    http_response_code(500);
    exit(json_encode(['ok'=>false,'msg'=>'DB error']));
}
header('Content-Type: application/json');

$rlid = isset($_POST['read_id']) ? (int)$_POST['read_id'] : 0;
$bid  = isset($_POST['book_id']) ? (int)$_POST['book_id'] : 0;
if (!$rlid || !$bid) {
    http_response_code(400);
    exit(json_encode(['ok'=>false,'msg'=>'Missing parameters']));
}

// delete from read_list
$del = $mysqli->prepare('DELETE FROM read_list WHERE id = ?');
$del->bind_param('i', $rlid);
$del->execute();

// (optional) you may want to mark the book as “available” again, 
// but typically Read‑List doesn’t affect availability.
// Uncomment if you’re tracking something extra.
//
// $upd = $mysqli->prepare('UPDATE books SET availability = 1 WHERE book_id = ?');
// $upd->bind_param('i',$bid);
// $upd->execute();

echo json_encode(['ok'=>true]);