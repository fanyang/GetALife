<?php include("database.php");?>
<?php
if (!isset($_COOKIE['email'])||!isset($_COOKIE['userid'])||!isset($_GET['password']))
{die("error");}
else
{
	$email = $_COOKIE['email'];
	$userid = $_COOKIE['userid'];
	$password = crypt($_GET['password'],$crypt_salt);
}
?>
<?php
$con = mysql_connect($db_address,$db_username,$db_password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($db_dbname, $con);

mysql_query("UPDATE persons SET password = '$password'
WHERE userid = '$userid' AND email = '$email'");

mysql_close($con);
?>
<?php
echo "true";
?>