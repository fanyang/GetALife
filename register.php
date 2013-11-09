<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />
<meta http-equiv="expires" content="0" />
<title>Get a Life</title>
<script type="text/javascript" src="js/register.js"></script>
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
<form action="submit_register.php" onsubmit="return validate_form(this)" method="post">
	<table>
		<tr>
			<td style = "text-align:right;">
Email: <input type="text" name="email" maxlength="30" style = "width:200px;" onfocus = "clean_error('error_email')"/><br />
Password: <input type="password" name="password" maxlength="20" style = "width:200px;" onfocus = "clean_error('error_password')"/><br />
Confirm: <input type="password" name="confirm" maxlength="20" style = "width:200px;" onfocus = "clean_error('error_confirm')"/><br />
Name: <input type="text" name="username" maxlength="20" style = "width:200px;" onfocus = "clean_error('error_username')"/><br />
<input type="submit" value="Submit and Agree"/>
</td>
<td style = "text-align:left;">
	<span id = "error_email" style = "color:red;"></span><br />
	<span id = "error_password" style = "color:red;"></span><br />
	<span id = "error_confirm" style = "color:red;"></span><br />
	<span id = "error_username" style = "color:red;"></span><br />
	&nbsp;
</td>
</tr>
</table>
</form>

    <!-- end .content --></div>
<? include("footer.php");?>
  <!-- end .container --></div>
</body>
</html>