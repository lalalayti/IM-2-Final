<?php
include "mysql.php";
$sql = "select * from books";

if (!empty($_GET['key']) && !empty($_GET['val'])) {
    $sql = "select * from books where ${_GET['key']} like \"%${_GET['val']}%\"";
}

$result = $conn->query($sql);

$counter = 0;

echo "
<table>
  <tr>
    <th></th>
    <th>Cover</th>
    <th>Title</th>
    <th>Publish Date</th>
    <th>Author</th>
    <th>ISBN</th>
  </tr>
";

while ($row = $result->fetch_assoc()) {
  $counter++;
  echo "
    <tr>
    <td>
    {$counter}
    </td>
    <td>
    <img src={$row['book_cover_small']}>
    </td>
    <td>
    {$row['book_title']}
    </td>
    <td>
    {$row['date_published']}
    </td>
    <td>
    {$row['book_author']}
    </td>
    <td>
    {$row['isbn']}
    </td>
    </tr>
    ";
}

echo "</table>";
?>