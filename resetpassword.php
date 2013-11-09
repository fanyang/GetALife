<?php
if (!isset($_GET['userid'])||!isset($_GET['password']))
{die("error!");}
$userid = $_GET['userid'];
$password = $_GET['password'];
?>
<?php include("database.php"); ?>
<?php
$con = mysql_connect($db_address,$db_username,$db_password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($db_dbname, $con);
$result = mysql_query("SELECT * FROM persons WHERE userid = '$userid'");
$num=mysql_num_rows($result); 
if ($num == 1) 
{
	$row = mysql_fetch_array($result);
	if ($row['active'] == '0'&& $password == $row['password'])
	{
		$email = $row['email'];
		setcookie("userid", $row['userid'], time()+3600);
		setcookie("email", "$email", time()+3600);
		setcookie("username", $row['username'], time()+3600);
	}
	else
	{die("error");}
}
else
{die("error");}
mysql_close($con);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />
<meta http-equiv="expires" content="0" />
<script type="text/javascript" src="js/forgetpassword.js"></script>
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




<h2 style = "text-align:center;">
	Your email is: 
<?php
echo $email;
?>
</h2>

<form action="home.php" onsubmit="return check_password(this)" method="post">
	<table>
		<tr>
			<td>New password:</td>
			<td><input type="password" name="password" style = "width:200px;" maxlength="20" onfocus = "clean_error('error_password')" /></td>
			<td> <span id = "error_password" style = "color:red;"></span></td>
		</tr>
		<tr>
			<td>Confirm password:</td>
			<td><input type="password" name="confirm_password" style = "width:200px;"  maxlength="20" onfocus = "clean_error('error_confirm_password')" /></td>
			<td><span id = "error_confirm_password" style = "color:red;"></span><br/></td>
		</tr>
		<tr>
			<td><input type="submit" value="Submit"/></td>
			<td></td>
			<td></td>			
		</tr>

 

</table>
</form>

    <!-- end .content --></div>
<? include("footer.php");?>
  <!-- end .container --></div>
</body>
</html>