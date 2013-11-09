////////////////////////////////////////////////////////////////////////
function clean_error(field)
{
	document.getElementById(field).innerHTML = "";
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
var xmlHTTP
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
/////////////////////////////////////////////////////////////////////////////////////////

function get_a_tip ()
{
	xmlHttp=GetXmlHttpObject();
	if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return false;
  }
  var url="getatip.php?tipsid="+tipsid+"&tiptype=get_tipsid&sid="+Math.random();
  xmlHttp.open("GET",url,false)
  xmlHttp.send(null)
  tipsid = xmlHttp.responseText;
  url="getatip.php?tipsid="+tipsid+"&tiptype=get_tip&sid="+Math.random();
  xmlHttp.open("GET",url,false)
  xmlHttp.send(null)
  tip = xmlHttp.responseText;
  url="getatip.php?tipsid="+tipsid+"&tiptype=get_tipdescription&sid="+Math.random();
  xmlHttp.open("GET",url,false)
  xmlHttp.send(null)
  tipdescription = xmlHttp.responseText;  
  url="getatip.php?tipsid="+tipsid+"&tiptype=get_userid&sid="+Math.random();
  xmlHttp.open("GET",url,false)
  xmlHttp.send(null)
  userid = xmlHttp.responseText;  
  url="getatip.php?tipsid="+tipsid+"&tiptype=get_username&sid="+Math.random();
  xmlHttp.open("GET",url,false)
  xmlHttp.send(null)
  username = xmlHttp.responseText;  
  document.getElementById("getatip").innerHTML = "<a href = \"showtip.php?tipsid="+tipsid+"\">"+tip+"</a>";
  document.getElementById("getatip_description").innerHTML = tipdescription;
  document.getElementById("getatip_user").innerHTML = "<a href = \"home.php?userid="+userid+"\">"+username+"</a>";
} 
////////////////////////////////////////////////////////////////////////////////////////
function check_title(thisform)
{
	var str=thisform.tip.value ;
	if (str== null||str == "") 
	{
		document.getElementById("error_tip_title").innerHTML = "Must enter a title!";
		return false;
		}
	else
	{
		return true;
	}
}

////////////////////////////////////////////////////////////////////////////////////////
function operate_favorite_tip(userid, operate_type, del_tipsid)
{
	var temp_tipsid;
	if (operate_type == 0) {temp_tipsid = del_tipsid;}
	else {temp_tipsid = tipsid}
	xmlHttp=GetXmlHttpObject()
	if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return false;
  }
  

var url="operate_favorite_tip.php"
var postmessage = "tipsid="+temp_tipsid+"&userid="+userid+"&operate_type="+operate_type;
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