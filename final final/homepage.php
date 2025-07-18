<?php
include "mysql.php";
$sql = "
select *,
year(date_published) as year,
round(avg(rating), 2) as book_rating
from books b
left join book_reviews br on b.book_id = br.book_id
group by b.book_id
limit 5
";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
  echo "
  <h1>
  {$row['book_title']}
  </h1>
  <img src={$row['book_cover']}>
  <h2>
  {$row['book_rating']}
  </h2>
  <h2>
  {$row['year']}
  </h2>
  ";
}
?>