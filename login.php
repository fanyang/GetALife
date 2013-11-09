<?php include("database.php");?>
<?php
if (!isset($_GET['email']) || !isset($_GET['password'])) die("ERROR!");
$email = $_GET['email'];
$password = crypt($_GET['password'],$crypt_salt);

$con = mysql_connect($db_address,$db_username,$db_password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($db_dbname, $con);

$result = mysql_query("SELECT * FROM persons WHERE email = '$email'");
$num=mysql_num_rows($result); 
$row = mysql_fetch_array($result);
$message = '';
if ($num == 0) $message =  "Email does not exist!";
else if ($row['active'] != '0') $message =  "Email has not been actived!";
else if ($row['password'] != $password) $message =  "Wrong password!";
else
{ 
	setcookie("userid", $row['userid'], time()+3600);
	setcookie("email", "$email", time()+3600);
	setcookie("username", $row['username'], time()+3600);
	$message = "true";
}
echo $message;
?>