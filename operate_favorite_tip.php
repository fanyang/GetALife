<? include("database.php");?>
<?php
if (!isset($_COOKIE['userid'])||!isset($_COOKIE['email'])||!isset($_GET['tipsid'])||!isset($_GET['userid'])||!isset($_GET['operate_type'])) 
{die("ERROR");}

$tipsid = $_GET['tipsid'];
$userid = $_GET['userid'];
$operate_type = $_GET['operate_type'];

$con = mysql_connect($db_address,$db_username,$db_password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db($db_dbname, $con);
$result = mysql_query("SELECT * FROM persons WHERE userid='$userid'");
$row = mysql_fetch_array($result);
if ($row['active'] != '0') die("User does not exist!");

$favorite = $row['favorite'];
$origin_favorite = $row['favorite'];
$favorite = $favorite.$tipsid;
$favorite = explode('&',$favorite);
$favorite = array_unique($favorite);
sort($favorite);

if ($operate_type == 0)
{
	$position = array_search($tipsid,$favorite);
	unset($favorite[$position]);
	$favorite = array_values($favorite);
	}

$favorite = implode('&',$favorite);
if ($favorite!="")
{
	$favorite = $favorite.'&';
	}
mysql_query("UPDATE persons SET favorite = '$favorite' WHERE userid = '$userid'");


$result = mysql_query("SELECT * FROM tips WHERE tipsid='$tipsid'");
$row = mysql_fetch_array($result);

$favoriteby = $row['favoriteby'];
$favoriteby = $favoriteby.$userid;
$favoriteby = explode('&',$favoriteby);
$favoriteby = array_unique($favoriteby);
sort($favoriteby);
if ($operate_type == 0)
{
	$position = array_search($userid,$favoriteby);
	unset($favoriteby[$position]);
	$favoriteby = array_values($favoriteby);
	}
$favoriteby = implode('&',$favoriteby);	
if ($favoriteby!="")
{
	$favoriteby = $favoriteby.'&';
	}

mysql_query("UPDATE tips SET favoriteby = '$favoriteby' WHERE tipsid = '$tipsid'");


mysql_close($con);

if ($origin_favorite!=$favorite)
{
echo "true";
}
else
{
	echo "Exist!";
	}
?>