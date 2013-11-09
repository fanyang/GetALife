<?include("database.php");?>
<?php
if (isset($_COOKIE['email'])&&isset($_COOKIE['userid']))
Header("Location: home.php"); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />
<meta http-equiv="expires" content="0" />
<title>Get a Life</title>
<script type="text/javascript" src="js/operatetips.js"></script>
<script type="text/javascript" src="js/login.js"></script>
<script type="text/javascript">
var tipsid=0;
</script>
<link rel="stylesheet" type="text/css" href="css/style_index.css" />
</head>
<body onload = "get_a_tip()">
	<div class="container">
		<div class="header">
<div class = "logo">
<a href="index.php">Get a Life</a>
<!-- end .logo --></div>
<div class = "login">
	<form action="" onsubmit = "return check_login(this)" method="post">
<table>
	<tr>
<td>
Email: 
</td>
	<td>
<input type="text" name="email" maxlength="30" style = "width:220px;" onfocus = "clean_error('error_email')" />
</td>
<td>
	Password: 
</td>
<td>
<input type="password" name="password" maxlength="20" style = "width:220px;" onfocus = "clean_error('error_password')" />
</td>
<td>
<input type="submit" value = "Sign in" /><a href="register.php">Sign up</a>
</td>
</tr>
<tr>
	<td></td>
	<td>
<span id = "error_email" style = "color:red;"></span>
</td>
<td></td>
<td>
<span id = "error_password" style = "color:red;"></span>
</td>
<td>
	<a href="forgetpassword.php">Forget password</a>
</td>
</tr>
</table>
</form>
	<!-- end .login --></div>
	
	<!-- end .header --></div>

<div class="sidebar1">

<div style="width:340px; height:280px; margin:10px;border: medium double rgb(250,0,255);" >
<div id = "getatip" style="font-size:20px; text-align:center;"></div>
<div id = "getatip_user" style="text-align:center;"></div>
<div id = "getatip_description"></div>
</div>
<div style="width:360px; height:60px; text-align:center" >
<button type="button" style="width:120px; height:60px; font-size:20px;" onclick = "get_a_tip()">Get a Tip!</button>
</div>
<!-- end .sidebar1 --></div>
<div class="content">
<?php
$con = mysql_connect($db_address,$db_username,$db_password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db($db_dbname, $con);
$result = mysql_query("SELECT * FROM tips");
$num=mysql_num_rows($result);
?>
<h2>Total Tips(<?echo $num;?>)</h2>
<p>
<?php
while($row = mysql_fetch_array($result))
  {
  	echo "<a href = 'showtip.php?tipsid=". $row['tipsid']."'>".$row['tip']."</a>";
  echo " - " ;
  echo "<a href = 'home.php?userid=". $row['userid']."'>".$row['username']."</a>";
  echo "<br />";
  }
mysql_close($con);
?>
</p>
<!-- end .content --></div>
<? include("footer.php");?>
<!-- end .container --></div>
</body>
</html>