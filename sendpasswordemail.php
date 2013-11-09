<?php include("database.php"); ?>
<?php
if (!isset($_POST['email']))
{die("error");}
else
{$email = $_POST['email'];}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
 	 <div class="content" style = "width: 940px; height:300px; margin:10px; text-align:center;">
<p>Your email is <?php echo $email;?></p>
<?php
$con = mysql_connect($db_address,$db_username,$db_password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($db_dbname, $con);
$result = mysql_query("SELECT * FROM persons WHERE email = '$email'");
$num=mysql_num_rows($result); 
if ($num == 1) 
{
	$row = mysql_fetch_array($result);
	if ($row['active'] == '0')
	{
		$userid =  $row['userid'];
		$password = $row['password'];
	}
	else
	{die("error");}
}
else
{die("error");}
mysql_close($con);
?>

<?php

$to = $email;
$subject = "Fotget password";
$password = urlencode($password);
$url = $url."resetpassword.php?userid=".$userid."&password=".$password;
$message = "<a href= $url>$url</a>";
$from = "admin@fyfy.tk";
$headers = 'MIME-Version: 1.0' . "\r\n";     
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";     
$headers .= 'From: ' . $from . "\r\n";
ini_set('max_execution_time', '0');
mail($to,$subject,$message,$headers);
?>


<p>Email sent!</p>

    <!-- end .content --></div>
<? include("footer.php");?>
  <!-- end .container --></div>
</body>
</html>