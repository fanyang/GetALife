<?php 
setcookie("userid", "", time()-3600);
setcookie("email", "", time()-3600);
setcookie("username", "", time()-3600);
Header("Location: index.php");
?>
