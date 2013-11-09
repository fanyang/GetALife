<?php include "database.php";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<title>Get a Life</title>
</head>

<body>
	<h1>Install</h1>
	<?php
	///////////////////////////create database/////////////////////////////////////////////
$con = mysql_connect($db_address,$db_username,$db_password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
$sql = "CREATE DATABASE ".$db_dbname;
if (mysql_query($sql,$con))
  {
  echo "Database created<br/>";
  }
else
  {
  echo "Error creating database: " . mysql_error();
  }

////////////////////////////////////////create table persons//////////////////////////////////////////////////
mysql_select_db($db_dbname, $con);
$sql = "CREATE TABLE persons 
(
  `userid` int(11) NOT NULL auto_increment,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `regtime` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `ipaddress` varchar(64),
  `active` varchar(128) NOT NULL,
  `follow` text,
  `followedby` text,
  `favorite` text,
  PRIMARY KEY  (`userid`)
)";

if (mysql_query($sql,$con))
  {
  echo "Table persons created<br/>";
  }
else
  {
  echo "Error creating table: " . mysql_error();
  }

////////////////////////////////////////create table tips//////////////////////////////////////////////////
mysql_select_db("getalife", $con);
$sql = "CREATE TABLE tips 
(
  `tipsid` int(11) NOT NULL auto_increment,
  `userid` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `addtime` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `ipaddress` varchar(64),
  `tip` varchar(255)  NOT NULL,
  `tipdescription` text,
  `favoriteby` text,
  PRIMARY KEY  (`tipsid`)
)";

if (mysql_query($sql,$con))
  {
  echo "Table tips created<br/>";
  }
else
  {
  echo "Error creating table: " . mysql_error();
  }

/////////////////////////////////////add admin account////////////////////////////////////////////////////////////
$ipaddress = $_SERVER["REMOTE_ADDR"];
$email = "admin@fyfy.tk";
$username = "admin";
$password = "admin123";
$password = crypt($password,$crypt_salt);
$sql="INSERT INTO persons (email,password, username, ipaddress, active, favorite)
VALUES
('$email','$password','$username', '$ipaddress', '0','1&')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
 else
 {
 echo "admin account added<br/>";
 }
  
/////////////////////////////////////add a tip////////////////////////////////////////////////////////////
$ipaddress = $_SERVER["REMOTE_ADDR"];
$sql="INSERT INTO tips (userid,username,ipaddress, tip, tipdescription, favoriteby)
VALUES
(1,'admin', '$ipaddress', 'This is a sample tip.','This is a tip description.', '1&')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
 else
 {
 echo "a tip added<br/>";
 }
  
  
mysql_close($con);
echo "All done<br/>";
echo "<a href = 'index.php'>Home</a>";

?>
</body>
</html>