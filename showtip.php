<? include("database.php");?>
<?php
if (!isset($_GET['tipsid'])) {header('Location: home.php');}
else {$tipsid = $_GET['tipsid'];}

$con = mysql_connect($db_address,$db_username,$db_password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($db_dbname, $con);
$result = mysql_query("SELECT * FROM tips WHERE tipsid='$tipsid'");
mysql_close($con);
$num=mysql_num_rows($result); 
if ($num == 0) {header('Location: home.php');}
$row = mysql_fetch_array($result);
$userid = $row['userid'];
$username = $row['username'];
$tip = $row['tip'];
$tipdescription = $row['tipdescription'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<title>Get a Life</title>
<link rel="stylesheet" type="text/css" href="css/style_index.css" />
</head>
<body>
				<div class="container">
					<div class="header">
<div class = "logo">
<a href="index.php">Get a Life</a>
 <!-- end .logo --></div>
 <!-- end .header --></div>
 <div class="content" style = "width: 940px; height:300px; margin:10px;">
	<h1 style = "text-align:center;"><? echo $tip;?></h1>
	<h2 style = "text-align:center;"><a href = "home.php?userid=<?echo $userid;?>"><? echo $username;?></a></h2>
	<p><? echo $tipdescription;?></p>

    <!-- end .content --></div>
<? include("footer.php");?>
  <!-- end .container --></div>
</body>
</html>