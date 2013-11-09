<? include("database.php");?>
<?
if (!isset($_GET['userid']) || !isset($_GET['followtype']))
{die("error");}
if (!isset($_GET['page']))
{$page = 1;}
else
{
	$page = $_GET['page'];
}
$onepage = 2;
$userid = $_GET['userid'];
$followtype = $_GET['followtype'];
$con = mysql_connect($db_address,$db_username,$db_password);
mysql_select_db($db_dbname, $con);
$result = mysql_query("SELECT * FROM persons WHERE userid = '$userid'");
$num=mysql_num_rows($result); 
if ($num == 1) 
{
	$row = mysql_fetch_array($result);
	if ($row['active'] == '0')
	{
		$username = $row['username'];
		$follow = explode('&',$row['follow']);
		$count_follow = count($follow)-1;
		$followedby = explode('&',$row['followedby']);
		$count_followedby = count($followedby)-1;
	}
	else
	{die("error");}
}
else
{
	die("error");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />
<meta http-equiv="expires" content="0" />
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
<h1 style = "text-align:center;">
	<? echo $username;?>
</h1>
<h2>
<?
if ($followtype == 1) echo "Follow(".$count_follow.")";
else {echo "Followedby(".$count_followedby.")";}
?>
</h2>

<?php
$userstart = 0;
$userend = 0;
$userstart = ($page-1)*$onepage;
if ($userstart<0) {$userstart = 0;}
if ($followtype==1)
{
	if ($userstart>=$count_follow) {$userstart = 0;}
	$userend = $userstart+$onepage-1;
	if ($userend>=$count_follow) {$userend = $count_follow;}
	
for ($i = $userstart;$i<=$userend; $i++)
{
	$result = mysql_query("SELECT * FROM persons WHERE userid='$follow[$i]'");
	$row = mysql_fetch_array($result);
	echo "<a href = 'home.php?userid=$follow[$i]'>";
	echo $row['username']."</a> ";
}
}
else
{
	if ($userstart>=$count_followedby) $userstart = 0;
	$userend = $userstart+$onepage-1;
	if ($userend>=$count_followedby) $userend = $count_followedby;
for ($i = $userstart;$i<=$userend; $i++)
{
	$result = mysql_query("SELECT * FROM persons WHERE userid='$followedby[$i]'");
	$row = mysql_fetch_array($result);
	echo "<a href = 'home.php?userid=$followedby[$i]'>";
	echo $row['username']."</a> ";
}
}
?>
<p>
<?php
$url = "allfollow.php?userid=".$userid."&amp;followtype=".$followtype."&amp;page=";
if ($followtype==1)
{
	$pagenum = ceil($count_follow/$onepage);
	for ($i=0; $i<$pagenum; $i++)
	{
		$tempurl=$url.($i+1);
		if ($i+1!=$page)
		{
		echo "<a href = \"".$tempurl."\">".($i+1)."</a> ";
		}
		else
		{
			echo "<b><a href = \"".$tempurl."\">".($i+1)."</a></b> ";
		}
	}

}
else
{
	$pagenum = ceil($count_followedby/$onepage);
	for ($i=0; $i<$pagenum; $i++)
	{
		$tempurl=$url.($i+1);
		if ($i+1!=$page)
		{
		echo "<a href = \"".$tempurl."\">".($i+1)."</a> ";
		}
		else
		{
			echo "<b><a href = \"".$tempurl."\">".($i+1)."</a></b> ";
		}
	}
}
?>
</p>

<p><a href = "home.php?userid=<? echo $userid;?>">Back</a></p>
    <!-- end .content --></div>
<? include("footer.php");?>
  <!-- end .container --></div>
</body>
</html>