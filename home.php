<?php
header("Pragma:no-cache");
?>
<?php include("database.php");?>
	<?php
if (!isset($_GET['userid']))
{
	if (isset($_COOKIE['email'])&&isset($_COOKIE['userid']))
	{
		
		$url = 'home.php?userid='.$_COOKIE['userid'];
		echo "<script type=\"text/javascript\">";
		echo " location='".$url."'";
		echo "</script>"; 

		}
	else
	{
				$url = "index.php";
		echo "<script type=\"text/javascript\">";
		echo " location='".$url."'";
		echo "</script>"; 
		}
		
}
$userid = $_GET['userid'];
$con = mysql_connect($db_address,$db_username,$db_password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($db_dbname, $con);

$result = mysql_query("SELECT * FROM persons WHERE userid='$userid'");
mysql_close($con);
$row = mysql_fetch_array($result);
if ($row['active'] != '0')
{
					$url = "index.php";
		echo "<script type=\"text/javascript\">";
		echo " location='".$url."'";
		echo "</script>"; 
	}
$username = $row['username'];
if (isset($_COOKIE['email'])&&isset($_COOKIE['userid']))
{
	$my_email = $_COOKIE['email'];
	$my_userid = $_COOKIE['userid'];
	$my_username = $_COOKIE['username'];
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
<script type="text/javascript" src="js/follow.js"></script>
<script type="text/javascript" src="js/operatetips.js"></script>
<!-- TinyMCE -->
<script type="text/javascript" src="js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "simple"
	});
</script>
<!-- /TinyMCE -->
<script type="text/javascript">
var tipsid=0;
</script>
<link rel="stylesheet" type="text/css" href="css/style_index.css" />
</head>
<body>
		<div class="container">
					<div class="header">
<div class = "logo">
<a href="index.php">Get a Life</a>
 <!-- end .logo --></div>
 <div class = "logout">
<?php
	if (isset($my_username)) {
		echo "Welcome: ";
		echo "<a href = 'home.php'>".$my_username."</a><br />";
		echo "<a href = 'logout.php'>Logout</a><br />";
		}
	?>
	<!-- end .logout --></div>
	<!-- end .header --></div>
	<?php
if (isset($_COOKIE['email'])&&isset($_COOKIE['userid'])&&$userid==$my_userid)
{
	echo '<div class="sidebar2">';
	}
else
{
	echo '<div class="sidebar1">';
	}
?>

<div id = "user_info" style="weight:340px;height:340px; margin:10px;">
		<div id = "follow_button" style = "text-align:center;">
	<h1><?echo $username;?></h1>
	<?php
	if (isset($my_username))
	{
		if ($userid != $my_userid)
		{
			$con = mysql_connect("localhost","root","root");
			if (!$con)
			{die('Could not connect: ' . mysql_error());}
			mysql_select_db("getalife", $con);
			$result = mysql_query("SELECT * FROM persons WHERE userid='$my_userid'");
			$row = mysql_fetch_array($result);
			$follow = $row['follow'];
			$follow = explode('&',$follow);
			if (in_array($userid,$follow))
			{echo "<button type='button' style='width:120px; height:60px; font-size:20px;' onclick = \"follow(".$userid.",".$my_userid.",0)\">Unfollow</button>";}
			else
			{echo "<button type='button' style='width:120px; height:60px; font-size:20px;' onclick = \"follow(".$userid.",".$my_userid.",1)\">Follow</button>";}
			}
		}
	?>
<!-- end .follow_button --></div>
<div id = "follow">
<?php
$con = mysql_connect($db_address,$db_username,$db_password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($db_dbname, $con);
$result = mysql_query("SELECT * FROM persons WHERE userid='$userid'");
$row = mysql_fetch_array($result);
if ($row['active'] != '0') die("User does not exist!");

$follow = explode('&',$row['follow']);
$count_follow = count($follow)-1;
$followedby = explode('&',$row['followedby']);
$count_followedby = count($followedby)-1;
?>

<h2>Follow(<a href = "allfollow.php?userid=<?echo $userid;?>&amp;followtype=1"><? echo $count_follow;?></a>)</h2>
<?php
if ($count_follow>2) {$count_follow=2;}
for ($i = 0;$i<$count_follow; $i++)
{
	$result = mysql_query("SELECT * FROM persons WHERE userid='$follow[$i]'");
	$row = mysql_fetch_array($result);
	echo "<a href = 'home.php?userid=$follow[$i]'>";
	echo $row['username']."</a> ";
}
?>

<h2>Followedby(<a href = "allfollow.php?userid=<?echo $userid;?>&amp;followtype=2"><? echo $count_followedby;?></a>)</h2>
<?
if ($count_followedby>2) {$count_followedby=2;}
for ($i = 0;$i<$count_followedby; $i++)
{
	$result = mysql_query("SELECT * FROM persons WHERE userid='$followedby[$i]'");
	$row = mysql_fetch_array($result);
	echo "<a href = 'home.php?userid=$followedby[$i]'>";
	echo $row['username']."</a> ";
}
mysql_close($con);
?>
</div>

<!--end of div user_info--></div>

<?php
if (isset($_COOKIE['email'])&&isset($_COOKIE['userid'])&&$userid==$my_userid):
?>

		<div id = "operate_tips" style="width:340px; height:280px; margin:10px;border: medium double rgb(250,0,255);" >
<div id = "getatip" style="font-size:20px; text-align:center;"></div>
<div id = "getatip_user" style="text-align:center;"></div>
<div id = "getatip_description"></div>
<script type="text/javascript">get_a_tip()</script>
</div>
<div style="width:360px; height:60px; text-align:center" >
<button type="button" style="width:120px; height:60px; font-size:20px;" onclick = "get_a_tip()">Get a Tip!</button>
<button type='button' style="width:120px; height:60px; font-size:20px;" onclick = "operate_favorite_tip(<? echo $my_userid;?>,1,0)">Favorite!</button>
</div>
<?php
endif;
?>

<!-- end .sidebar2 --></div>

<div class="content">
		<?php
if (isset($_COOKIE['email'])&&isset($_COOKIE['userid'])&&$userid==$my_userid):
?>
<div id = "submit_tips" style="margin:10px;">

<form action = "submit_tip.php" onsubmit="return check_title(this)" method="post">
<p>Tip Title: <input type="text" name="tip" size="40" maxlength="30" onfocus = "clean_error('error_tip_title')" /><span id = "error_tip_title" style="color:red;"></span></p>
	<textarea id="elm1" name="tipdescription" rows="15" cols="80" style="width: 100%">
	</textarea>
<input type="submit" value = "Insert a tip"/>
</form>
<br />
</div>
<?php
endif
?>

<div id = "tips_list" style = "margin:10px;">
<?php
$con = mysql_connect($db_address,$db_username,$db_password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($db_dbname, $con);
$result = mysql_query("SELECT * FROM tips WHERE userid='$userid'");
$num_of_tips = mysql_num_rows($result);
?>

<h2>Post Tips(<?echo $num_of_tips;?>)</h2>
<?php
while ($row = mysql_fetch_array($result))
{
	echo "<a href = 'showtip.php?tipsid=". $row['tipsid']."'>".$row['tip']."</a>";
	echo "<br />";
}
?>
<?php
$result = mysql_query("SELECT * FROM persons WHERE userid='$userid'");
$row = mysql_fetch_array($result);
if ($row['active'] != '0') die("User does not exist!");
$favorite= explode('&',$row['favorite']);
$count_favorite= count($favorite)-1;
?>

<h2>Favorite Tips(<?echo $count_favorite;?>)</h2>
<?php
for ($i = 0;$i<$count_favorite; $i++)
{
	$result = mysql_query("SELECT * FROM tips WHERE tipsid='$favorite[$i]'");
	$row = mysql_fetch_array($result);
	echo "<a href = 'showtip.php?tipsid=". $row['tipsid']."'>".$row['tip']."</a>";
  echo " - " ;
  echo "<a href = 'home.php?userid=". $row['userid']."'>".$row['username']."</a>";
  if ($userid == $my_userid)
  {
  echo "<button type='button' onclick = \"operate_favorite_tip(".$my_userid.",0,".$favorite

[$i].")\">Delete</button>";
  }
  echo "<br />";
}
mysql_close($con);
?>

</div>
<!-- end .content --></div>

<? include("footer.php");?>
<!-- end .container --></div>
</body>
</html>