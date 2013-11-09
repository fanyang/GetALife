<?include("database.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<title>Get a Life</title>
<?php
if (!isset($_GET['id']) || !isset($_GET['code'])) die("error!");
?>
<link rel="stylesheet" type="text/css" href="css/style_index.css" />
</head>

<body>
					<div class="container">
					<div class="header">
<div class = "logo">
<a href="index.php">Get a Life</a>
 <!-- end .logo --></div>
 <!-- end .header --></div>
 <div class="content" style = "width: 940px; height:300px; margin:10px; text-align:center;">
<?php
$id = $_GET['id'];
$active = $_GET['code'];



$con = mysql_connect($db_address,$db_username,$db_password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($db_dbname, $con);

$result = mysql_query("SELECT * FROM persons WHERE userid='$id'");
$num = mysql_num_rows($result); 
if ($num == 0) echo "Account does not exist!<br/>";
else
{
	$row = mysql_fetch_array($result);
	$email = $row['email'];
	$pw = $row['active'];
	if ($pw == '0') echo "Account has already been actived!<br/>";
	else
	{
		$crypt_code = crypt($email,$pw);
		if ($crypt_code != $active) echo "Wrong activation code!<br/>";
		else
		{
			mysql_query("UPDATE persons SET active = '0' WHERE userid = '$id' AND email = '$email' and active = '$pw'");
			mysql_query("DELETE FROM persons WHERE email = '$email' and active != '0'");
			echo "Active successfully!";
		}
	}
}
?>

    <!-- end .content --></div>
<? include("footer.php");?>
  <!-- end .container --></div>
</body>
</html>