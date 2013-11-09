<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
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
 	<div class="content" style = "width: 940px; height:300px; margin:10px; text-align:center;">
 		<h1>Forget Password</h1>
	<form name="input" action="sendpasswordemail.php" onsubmit="return check_email(this)" method="post">
Email: <input type="text" name="email" size="40" maxlength="30" onfocus = "clean_error('error_email')"/><input type="submit" value="Submit" />
<p id = "error_email" style = "color:red;"></p>

</form>
	
    <!-- end .content --></div>
<? include("footer.php");?>
  <!-- end .container --></div>
</body>
</html>