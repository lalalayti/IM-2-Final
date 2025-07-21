<?php
include "mysql.php";

$sql = "
select * from users
";

$result = $conn->query($sql);

$counter = 0;

echo "
<table>
  <tr>
    <th></th>
    <th>FN</th>
    <th>MN</th>
    <th>LN</th>
    <th>Email</th>
    <th>Type</th>
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
    {$row['first_name']}
    </td>
    <td>
    {$row['middle_name']}
    </td>
    <td>
    {$row['last_name']}
    </td>
    <td>
    {$row['email']}
    </td>
    <td>
      <select>
      <option selected>
      {$row['account_type']}
      </option>
      <option>
      regular
      </option>
      <option>
      administrator
      </option>
      </select>
    </td>
    <td>
      <form action='delete_user.php' method='post'>
      <input name='user_id' value={$row['user_id']} hidden>
      <input type='submit' value='delete'>
      </form>
    </td>
    </tr>
    ";
}

echo "</table>";
?>