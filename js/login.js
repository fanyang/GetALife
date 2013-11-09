function clean_error(field)
{
	document.getElementById(field).innerHTML = "";
}
////////////////////////////////////////////////////////////////////////
function validate_email(field)
{
with (field)
{
apos=value.indexOf("@")
dotpos=value.lastIndexOf(".")
if (apos<1||dotpos-apos<2) 
  {
  	document.getElementById("error_email").innerHTML = "Not a valid e-mail address!";
  	return false;
  	}
else {
	return true;
	}
}
}
////////////////////////////////////////////////////////////////////////
function validate_password(field)
{
with (field)
{
if (value==null||value=="")
  {
  	document.getElementById("error_password").innerHTML = "Not a valid password!";
  	return false;
  	}
else {
	document.getElementById("error_password").innerHTML = "";
	return true
	}
}
}
////////////////////////////////////////////////////////////////////////
function check_login(thisform)
{

	
with (thisform)
{
	
  var bool_valitate_email = validate_email(email);
	var bool_validate_password = validate_password(password);

  if (bool_valitate_email && bool_validate_password )
  {
  	

  	if (check_account(email.value,password.value))

  	{
  	window.location.href="home.php";
  	}
  }
  return false;
}
}
////////////////////////////////////////////////////////////////////////
var xmlHttp

function check_account(email_value,password_value)
{
	

xmlHttp=GetXmlHttpObject()
if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return false;
  }
  

var url="login.php"
var postmessage = "email="+email_value+"&password="+password_value;
url = url +"?"+postmessage;
url=url+"&sid="+Math.random()


xmlHttp.open("GET",url,false)
xmlHttp.send(null)
if (xmlHttp.responseText == "true")
{return true;}
else
	{
		if (xmlHttp.responseText == "Wrong password!")
		{document.getElementById("error_password").innerHTML = xmlHttp.responseText;}
		else
			{document.getElementById("error_email").innerHTML = xmlHttp.responseText;}
				
		
		
		
		
		return false;
		}
} 



function GetXmlHttpObject()
{
var xmlHttp=null;
try
 {
 // Firefox, Opera 8.0+, Safari
 xmlHttp=new XMLHttpRequest();
 }
catch (e)
 {
 // Internet Explorer
 try
  {
  xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
  }
 catch (e)
  {
  xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
 }
return xmlHttp;
}