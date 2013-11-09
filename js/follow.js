function follow(userid, my_userid, follow_type)
{
	if (follow_type == 0)
	{
		if (submit_follow(userid, my_userid, follow_type))
		{
		document.getElementById("follow_button").innerHTML = "<button type='button' onclick = \"follow("+userid+","+my_userid+",1)\">Follow</button>";

		}
	}
	if (follow_type == 1)
	{
		if (submit_follow(userid, my_userid, follow_type))
		{
		document.getElementById("follow_button").innerHTML = "<button type='button' onclick = \"follow("+userid+","+my_userid+",0)\">Unfollow</button>";

		}
	}
	
	}
	
	////////////////////////////////////////////////////////////////////////
var xmlHttp

function submit_follow(userid, my_userid, follow_type)
{
	

xmlHttp=GetXmlHttpObject()
if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return false;
  }
  

var url="follow.php"
var postmessage = "userid="+userid+"&my_userid="+my_userid+"&follow_type="+follow_type;
url = url +"?"+postmessage;
url=url+"&sid="+Math.random()


xmlHttp.open("GET",url,false)
xmlHttp.send(null)
if (xmlHttp.responseText != "true")
{
	alert(xmlHttp.responseText);
	return false;
	}
else
	{
		
		window.location.reload(); 
		return true;
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