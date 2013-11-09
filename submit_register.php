<?include("database.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Get a Life</title>
<?php
if (!isset($_POST['email']) || !isset($_POST['password']) || !isset($_POST['username'])) die("error!");
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

$email = $_POST['email'];
$password = crypt($_POST['password'],"getalife");
$username = $_POST['username'];
$email = strtolower($email);



$con = mysql_connect($db_address,$db_username,$db_password);
mysql_select_db($db_dbname, $con);
$result = mysql_query("SELECT * FROM persons WHERE email = '$email'");



	
$pw = create_password(8);
$ipaddress = $_SERVER["REMOTE_ADDR"];
$sql="INSERT INTO persons (email,password, username, ipaddress, active)
VALUES
('$email','$password','$username', '$ipaddress', '$pw')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
 ?>
 <p>Your account added</p>
 <?php
 $crypt_code = crypt($email,$pw);
$result = mysql_query("SELECT * FROM persons WHERE (email = '$email' AND active = '$pw')");
$row = mysql_fetch_array($result);
$id = $row['userid'];


$to = $email;
$subject = "Validation Mail";
$crypt_code = urlencode($crypt_code);
$url = $url."valid.php?id=".$id."&code=".$crypt_code;
$message = "<a href= $url>$url</a>";
$from = "admin@fyfy.tk";
$headers = 'MIME-Version: 1.0' . "\r\n";     
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";     
$headers .= 'From: ' . $from . "\r\n";
ini_set('max_execution_time', '0');
mail($to,$subject,$message,$headers);
?>
<p>Validation  Mail Sent.</p>
    <!-- end .content --></div>
<? include("footer.php");?>
  <!-- end .container --></div>
</body>
</html>

<?php
function create_password($pw_length = 8)
{
    $randpwd = '';
    for ($i = 0; $i < $pw_length; $i++)
    {
        $randpwd .= chr(mt_rand(97, 122));
    }
    return $randpwd;
}
?>