<? include("database.php");?>
<?php
if (!isset($_GET['tipsid'])||!isset($_GET['tiptype'])) {die("Error!");}
else
{
	$tipsid = $_GET['tipsid'];
	$tiptype = $_GET['tiptype'];
}

$con = mysql_connect($db_address,$db_username,$db_password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($db_dbname, $con);
if ($tiptype == "get_tipsid")
{
	$result = mysql_query("SELECT * FROM tips");
	$num=mysql_num_rows($result);
	do
	{$randnum=rand(1,$num);}
	while ($randnum == $tipsid && $num!=1);
	echo $randnum;
}
else
{
	$result = mysql_query("SELECT * FROM tips WHERE tipsid='$tipsid'");
	$row = mysql_fetch_array($result);
	switch($tiptype)
	{
		case "get_userid":
		echo $row['userid'];
		break;
		case "get_username":
		echo $row['username'];
		break;
		case "get_tip":
		echo $row['tip'];
		break;
		case "get_tipdescription":
		echo $row['tipdescription'];
		break;
		default:
		echo "error";
	}
}
?>