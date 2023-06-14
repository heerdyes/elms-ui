<!DOCTYPE html>
<html>
<head><title>users</title></head>
<body>
<?php
$dbcfg      = parse_ini_file('cfg.ini');
$servername = $dbcfg['srv'];
$database   = $dbcfg['db'];
$username   = $dbcfg['unm'];
$password   = $dbcfg['pwd'];

mysqli_report    (MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$cn = new mysqli ($servername, $username, $password, $database);
if ($cn->connect_error)
{
  die('connection failed: ' . $cn->connect_error);
}

// generate tabular data
$qry = 'select regno, fname, lname, created_ts, updated_ts from users';
$rs  = $cn->query($qry);
if (!$rs) { die('result empty!'); }

echo <<<END
<table>
  <thead>
    <tr>
      <th>regno</th>
      <th>fname</th>
      <th>lname</th>
    </tr>
  </thead>
<tbody>
END;
while ($row = $rs->fetch_assoc())
{
  echo <<<END
  <tr>
    <td>{$row['regno']}</td>
    <td>{$row['fname']}</td>
    <td>{$row['lname']}</td>
  </tr>
END;
}
echo '</tbody></table>';

mysqli_close($cn);
?>
</body>
</html>
