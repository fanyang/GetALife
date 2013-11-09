<? include("database.php");?>
<?php
if (!isset($_POST['tip'])||!isset($_COOKIE['userid'])||!isset($_COOKIE['username'])) {header('Location: home.php');}
else {
	$tip = $_POST['tip'];
	$username = $_COOKIE['username'];
	$userid = $_COOKIE['userid'];
	}
$ipaddress = $_SERVER["REMOTE_ADDR"];
if (!isset($_POST['tipdescription'])) {$tipdescription = "";}
else {$tipdescription = str_replace('\"','"',$_POST['tipdescription']);}

$con = mysql_connect($db_address,$db_username,$db_password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db($db_dbname, $con);
$sql="INSERT INTO tips (userid,username,ipaddress,tip,tipdescription)
VALUES ('$userid','$username','$ipaddress','$tip','$tipdescription')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
mysql_close($con);
header('Location: home.php');
?>