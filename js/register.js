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
	if (check_email_exist(value))
	{
	document.getElementById("error_email").innerHTML = "E-mail address exist!";
	return false;
	}
	else 
	  {
  	document.getElementById("error_email").innerHTML = "";
  	return true;
  	}
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
function validate_confirm(field_password, field_confirm)
{

	if (field_password.value!=field_confirm.value)
	{
		document.getElementById("error_confirm").innerHTML = "Check the password!";
		return false;
		}
	else
		{
		document.getElementById("error_confirm").innerHTML = "";
		return true;
		}
}
////////////////////////////////////////////////////////////////////////
function validate_username(field)
{
with (field)
{

if (value==null||value=="") 
  {
  	document.getElementById("error_username").innerHTML = "Not a valid username!";
  	return false;
  	}
else {
	document.getElementById("error_username").innerHTML = "";
	return true
	}
}
}
////////////////////////////////////////////////////////////////////////
function validate_form(thisform)
{


with (thisform)
{
	var bool_valitate_email = validate_email(email);
	var bool_validate_password = validate_password(password);
	var bool_validate_confirm = validate_confirm(password,confirm);
	var bool_validate_username = validate_username(username);
	if (  bool_valitate_email==true && bool_validate_password  ==true && bool_validate_confirm ==true && bool_validate_username ==true)
	{return true;}
	else
	{return false;}
}
}
////////////////////////////////////////////////////////////////////////
var xmlHttp

function check_email_exist(str)
{

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
{return false;}
else {return true;}
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