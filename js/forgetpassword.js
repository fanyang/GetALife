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
  else
  {
  	return true;
  	}
}
}
///////////////////////////////////////////////////////////////////////
function check_email(thisform)
{
	if (!validate_email(thisform.email))
	{
		return false;
	}
	else
		if (check_email_exist(thisform.email))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
///////////////////////////////////////////////////////////////////////
function check_password(thisform)
{
	
	if (thisform.password.value == "")
	{
		document.getElementById("error_password").innerHTML = "Must enter a password!";
		return false;
	}


	if (thisform.confirm_password.value == "")
	{
		document.getElementById("error_confirm_password").innerHTML = "Must enter a password!";
		return false;
	}
	
	if (thisform.password.value!=thisform.confirm_password.value)
	{
		document.getElementById("error_confirm_password").innerHTML = "Check password!";
		return false;
	}
	else
	{
		str = thisform.password.value;
		xmlHttp=GetXmlHttpObject();
		if (xmlHttp==null)
		{
			alert ("Browser does not support HTTP Request")
			return false;
		}
		var url="submit_new_password.php"
		url = url+"?password="+str;
		url=url+"&sid="+Math.random()
		xmlHttp.open("GET",url,false)
		xmlHttp.send(null)
		if (xmlHttp.responseText == "true")
		{
			return true;
		}
		else
		{
			document.getElementById("error_confirm_password").innerHTML = xmlHttp.responseText;
			return false;
		}
	}

}
///////////////////////////////////////////////////////////////////////
var xmlHttp

function check_email_exist(email)
{
str = email.value;
xmlHttp=GetXmlHttpObject()
if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return false;
  } 
var url="check_account.php"
url=url+"?q="+str
url=url+"&sid="+Math.random()

xmlHttp.open("GET",url,false)
xmlHttp.send(null)
if (xmlHttp.responseText == "false") 
{
	document.getElementById("error_email").innerHTML = "Email does not exist!";
	return false;
}
else {return true;}
} 


///////////////////////////////////////////////////////////////////////
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