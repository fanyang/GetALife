<?include("database.php");?>
<?php
if (!isset($_COOKIE['userid'])||!isset($_COOKIE['email'])||!isset($_GET['userid'])||!isset($_GET['my_userid'])||!isset($_GET['follow_type'])) 
{die("ERROR");}
if ($_COOKIE['userid'] != $_GET['my_userid'])
{die("ERROR");}
$userid = $_GET['userid'];
$my_userid = $_GET['my_userid'];
$follow_type = $_GET['follow_type'];

$con = mysql_connect($db_address,$db_username,$db_password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db($db_dbname, $con);

$result = mysql_query("SELECT * FROM persons WHERE userid='$userid'");
$row = mysql_fetch_array($result);
if ($row['active'] != '0') die("User does not exist!");

$followedby = $row['followedby'];
$followedby = $followedby.$my_userid;
$followedby = explode('&',$followedby);
$followedby = array_unique($followedby);
sort($followedby);

if ($follow_type == 0)
{
	$position = array_search($my_userid,$followedby);
	unset($followedby[$position]);
	$followedby = array_values($followedby);
	}
	
$followedby = implode('&',$followedby);
if ($followedby!="")
{
	$followedby = $followedby.'&';
	}
mysql_query("UPDATE persons SET followedby = '$followedby' WHERE userid = '$userid'");


$result = mysql_query("SELECT * FROM persons WHERE userid='$my_userid'");
$row = mysql_fetch_array($result);
if ($row['active'] != '0') die("User does not exist!");
$follow = $row['follow'];
$follow = $follow.$userid;
$follow = explode('&',$follow);
$follow = array_unique($follow);
sort($follow);
if ($follow_type == 0)
{
	$position = array_search($userid,$follow);
	unset($follow[$position]);
	$follow = array_values($follow);
	}
$follow = implode('&',$follow);	
if ($follow!="")
{
	$follow = $follow.'&';
	}

mysql_query("UPDATE persons SET follow = '$follow' WHERE userid = '$my_userid'");



mysql_close($con);


echo "true";
?>