<?php
$dbcfg      = parse_ini_file('cfg.ini');
$servername = $dbcfg['srv'];
$database   = $dbcfg['db'];
$username   = $dbcfg['unm'];
$password   = $dbcfg['pwd'];
$ufname     = $_POST['fname'];
$ulname     = $_POST['lname'];
$uregno     = $_POST['regno'];
$upwd       = $_POST['pwd'];

mysqli_report    (MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$cn = new mysqli ($servername, $username, $password, $database);
if ($cn->connect_error)
{
  die("connection failed: " . $cn->connect_error);
}

// db logic
$stmt = $cn->prepare ('insert into users (regno, fname, lname) values (?, ?, ?)');
$stmt->bind_param ("sss", $uregno, $ufname, $ulname);
$stmt->execute    ();
$lastid = $cn->insert_id;
$s2     = $cn->prepare ('insert into passwd (uid, pwdhash) values (?, ?)');
$s2->bind_param ("is", $lastid, $upwd);
$s2->execute    ();

mysqli_close($cn);

header('Location: users.php');
?>
