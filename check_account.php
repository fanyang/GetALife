<? include("database.php");?>
<?php
if (!isset($_GET["q"])) die("error!");
$email=$_GET["q"];
$email = strtolower($email);

$con = mysql_connect($db_address,$db_username,$db_password);
mysql_select_db($db_dbname, $con);
$result = mysql_query("SELECT * FROM persons WHERE email = '$email'");
$num=mysql_num_rows($result); 
if ($num == 1) 
{
	$row = mysql_fetch_array($result);
	if ($row['active'] == '0')
	{echo "true";}
	else
	{echo "false";}
}
else
{echo"false";}
?>