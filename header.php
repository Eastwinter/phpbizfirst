<?php
include("connect.php");
require_once('admin/phpthumb/phpthumb.class.php');
include_once "class.phpmailer.php";

$loginreq=array('memshoes.php','memwishlist.php','addshoes.php','sharepicture.php','sharepicture1.php','sharepicturereview.php','sharepicturereview1.php','memprofile.php','memshoes.php','addshoes.php','addshoecolor.php','shoecolors.php','memsavedsearches.php');

$loginreqad=array('advprofile.php','mystores.php','addstore.php','addstore1.php','locations','advshoes.php','addshoes1.php','addshoecolor1.php','shoecolors1.php','moremarketing.php','advpurchaselot.php','advstatistics.php','addlocation.php','paypal.php','paypalmod.php','packages.php','packages1.php','packages2.php','storereviews.php','advfeedback.php','paypal_loc.php','sbdatabase.php','advsavedsearches.php','advaccountinfo.php','advaccountinfo1.php');

$currentFile = $_SERVER["SCRIPT_NAME"];
$parts = explode('/', $currentFile);
$currentFile = $parts[count($parts) - 1];
if(in_array($currentFile,$loginreq))
{
	if($_SESSION['memberlogged']!='yes')
	{
		header("location: memberlogin.php?msg=login");
		die();
	}
}

if(in_array($currentFile,$loginreqad))
{
	if($_SESSION['memberlogged']!='yes')
	{
		header("location: advlogin.php?msg=login");
		die();
	}
}


if($_SESSION['memtype']=='staff')
{
	$rs=mysql_query("select * from soe_members where mem_id=".$_SESSION['staffid']);
	$row=mysql_fetch_array($rs);
	$priv=$row['privileges'];
	if($priv!='')
	   if(strpos($priv,",") > 0)
			$arrpriv=explode(",",$priv);
		else
			$arrpriv[0]=$priv;
}


if($_SESSION['memtype']=='adv' and $_SESSION['reggoingon']!=1 and strpos($_SERVER['PHP_SELF'],'packages11.php')<=0 and strpos($_SERVER['PHP_SELF'],'paypalch.php')<=0 and in_array($currentFile,$loginreqad))
{
	$packs=getpack($_SESSION['memberid']);
	$days=dateDiff(date('Y-m-d',$packs['expire']),date('Y-m-d'));
	if($packs['packageid']==1 and $days<=0)
	{
		$_SESSION['delmemshipid']=$packs['memshipid'];
	?>
		<script>
            location.href="packages11.php?memshipid=<?php echo $packs['memshipid']; ?>&stoid=<?php echo $packs['sto_id']; ?>&diff=<?php echo $packs['diff']; ?>";
        </script>
        <?php
            die();

    }
}

function redy()
{

if($_SESSION['memtype']=='staff')
{
	$rs=mysql_query("select * from soe_members where mem_id=".$_SESSION['staffid']);
	$row=mysql_fetch_array($rs);
	$priv=$row['privileges'];
	if($priv!='')
	{
	
	
		   if(strpos($priv,",") > 0)
			$arrpriv=explode(",",$priv);
		else
			$arrpriv[0]=$priv;


		if(in_array('Statistics',$arrpriv))
		return "advstatistics.php";

	if(in_array('More Marketing',$arrpriv))
		return "moremarketing.php";

	if(in_array('Edit Profile',$arrpriv))
		return "advprofile.php";

	if(in_array('My Stores',$arrpriv))
		return "mystores.php";

	if(in_array('Edit Inventory',$arrpriv))
		return "advshoes.php";

	if(in_array('SB Database',$arrpriv))
		return "sbdatabase.php";

	if(in_array('Purchase Lot',$arrpriv))
		return "advpurchaselot.php";

	if(in_array('Feedback',$arrpriv))
		return "advfeedback.php";

		
			
	}
	else
	  return '';		
			
}
return '';
}
?>
       <?php
   $url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
   
  if(strpos($_SERVER['PHP_SELF'],'addshoes')>0)
  {
  	if($_GET['id']>0)
	{
		$rs=mysql_query("select * from soe_shoe where soe_id=".$_GET['id']);
		$row=mysql_fetch_array($rs);
		extract($row);
	}
  }
   ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Shoebreeze.com</title>
<link href="css/css.css" rel="stylesheet" type="text/css">
<link href="css/font.css" rel="stylesheet" type="text/css">
<link media="screen" rel="stylesheet" href="css/colorbox.css"  type="text/css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script src="colorbox/jquery.colorbox.js"></script>
<script src="js/jquery.form.js" type="text/javascript"></script>
<script src="js/jquery.validate.js" type="text/javascript"></script>

<script>

		$(document).ready(function(){
			//Examples of how to assign the ColorBox event to elements
			$(".example5").colorbox();
			$(".example7").colorbox({width:"70%", inline:true, href:"#inline_example2"});
			$(".example8").colorbox({width:"55%", inline:true, href:"#inline_example1"});
			$(".example9").colorbox({width:"70%", inline:true, href:"#inline_example3"});
			$(".example10").colorbox({width:"40%", inline:true, href:"#inline_example4"});
			$(".example11").colorbox({width:"50%", inline:true, href:"#inline_example22"});
			$(".example99").colorbox({width:"70%",  href:"readreview.php"});
			$(".example77").colorbox({width:"50%", inline:true, href:"#inline_example23"});
			$(".example777").colorbox({width:"38%", inline:true, href:"#inline_example233"});
			$(".example88").colorbox({width:"55%", inline:true, href:"#inline_example88"});
			
		

});
</script>
<script type="text/javascript">

function isUrl(s) {
	var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
	return regexp.test(s);
}

function checkemail(str){
//var str=document.newsfrm.Email.value;
var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
if (filter.test(str))
testresults=true
else{
alert("Please input a valid email address!")
testresults=false
}
return (testresults)
}

function checkemail1(str){
//var str=document.newsfrm.Email.value;
var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
if (filter.test(str))
testresults=true
else{
//alert("Please input a valid email address!")
testresults=false
}
return (testresults)
}


$(document).ready(function(){
  $("#mybutton").click(function () { // ATTACH CLICK EVENT TO MYBUTTON
if(document.newsfrm.Email.value=='' || document.newsfrm.ZipCode.value=='')
  	alert("All fields required");
else if(checkemail(document.newsfrm.Email.value))
{
    $.post("newsletter.php",        // PERFORM AJAX POST
      $("#newsfrm").serialize(),      // WITH SERIALIZED DATA OF MYFORM
      function(data){                // DATA NEXT SENT TO COLORBOX
        $.fn.colorbox({
          html:   data,
          open:   true,
          iframe: false,            // NO FRAME, JUST DIV CONTAINER?
          width:  "50%",
        });
      },
      "html");
	  	  document.newsfrm.reset();
}
  });
}); 




</script> 
 <script type="text/javascript">



String.prototype.trim = function() {
	return this.replace(/^\s+|\s+$/g,"");
}
String.prototype.ltrim = function() {
	return this.replace(/^\s+/,"");
}
String.prototype.rtrim = function() {
	return this.replace(/\s+$/,"");
}

$(document).ready(function(){

  var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i

  $("#reviewsubmit").click(function () { // ATTACH CLICK EVENT TO MYBUTTON
  var em=document.reviewfrm.email.value;
  if(document.reviewfrm.email.value=='' || document.reviewfrm.yourname.value=='' || document.reviewfrm.description.value=='')
  	alert("Please enter all fields.");
else if(!filter.test(em))
	alert("Enter a valid email address");
else
{
    $.post("review.php",        // PERFORM AJAX POST
      $("#reviewfrm").serialize(),      // WITH SERIALIZED DATA OF MYFORM
      function(data){                // DATA NEXT SENT TO COLORBOX
        $.fn.colorbox({
          html:   data,
          open:   true,
          iframe: false,            // NO FRAME, JUST DIV CONTAINER?
          width:  "50%",
        });
      },
      "html");
	  document.reviewfrm.reset();
	 }
  });


  $("#feedbacksubmit").click(function () { // ATTACH CLICK EVENT TO MYBUTTON
  if(document.fdbackfrm.name.value=='' || document.fdbackfrm.comments.value=='')
  	alert("Name and comments required");
else
{
    $.post("feedback.php",        // PERFORM AJAX POST
      $("#fdbackfrm").serialize(),      // WITH SERIALIZED DATA OF MYFORM
      function(data){                // DATA NEXT SENT TO COLORBOX
        $.fn.colorbox({
          html:   data,
          open:   true,
          iframe: false,            // NO FRAME, JUST DIV CONTAINER?
          width:  "50%",
        });
      },
      "html");
	  	  document.fdbackfrm.reset();
}
  });
  
  

  $("#tell").click(function () { // ATTACH CLICK EVENT TO MYBUTTON
  em=document.tellfrm.email.value;
  em1=document.tellfrm.friend_email1.value;
  em2=document.tellfrm.friend_email2.value;  
  em3=document.tellfrm.friend_email3.value;  
  
    if(document.tellfrm.name.value=='' || em=='' || document.tellfrm.message.value=='' || em1=='')
  		alert("Please enter yourname, youremail, one friend's email and message.");
	else if(em==em1  || em==em2 || em==em3 || em1==em2 || (em1==em3 && em3!='') || (em2==em3 && em2!='' && em3!=''))
  		alert("Please enter different emails.");
	else if(em!='' && !filter.test(em))
		alert("Invalid Your email");
	else if(em1!='' && !filter.test(em1))
		alert("Invalid Friend 1 Email");
	else if(em2!='' && !filter.test(em2))
		alert("Invalid Friend 2 Email");
	else if(em3!='' && !filter.test(em3))
		alert("Invalid Friend 3 Email");		
else
{

    $.post("tell_a_friend.php?id=<?php echo $_GET['id']; ?>",        // PERFORM AJAX POST
      $("#tellfrm").serialize(),      // WITH SERIALIZED DATA OF MYFORM
      function(data){                // DATA NEXT SENT TO COLORBOX
        $.fn.colorbox({
          html:   data,
          open:   true,
          iframe: false,            // NO FRAME, JUST DIV CONTAINER?
          width:  "50%",
        });
      },
      "html");
	  	  document.tellfrm.reset();
 
}
 });
}); 
</script> 

<SCRIPT TYPE="text/javascript">
<!--
//Disable right click script
//visit http://www.rainbow.arch.scriptmania.com/scripts/
var message="Sorry, right-click has been disabled";
///////////////////////////////////
function clickIE() {if (document.all) {(message);return false;}}
function clickNS(e) {if
(document.layers||(document.getElementById&&!document.all)) {
if (e.which==2||e.which==3) {(message);return false;}}}
if (document.layers)
{document.captureEvents(Event.MOUSEDOWN);document.onmousedown=clickNS;}
else{document.onmouseup=clickNS;document.oncontextmenu=clickIE;}
document.oncontextmenu=new Function("return false")
// -->
</SCRIPT> 


<script src="js/main.js" type="text/javascript"></script>

<style>
#preview{
	position:absolute;
	border:1px solid #ccc;
	background:#333;
	padding:1px;
	display:none;
	color:#ccc;
	}

.zoomPreload{
	display:none !important;
}	
</style>

<script type="text/javascript" src="autocomplete/jquery.autocomplete.js"></script>
<link rel="stylesheet" media="screen" href="autocomplete/jquery.autocomplete.css">

<script type="text/javascript">

function findCity(li)
{
	if( li == null ) 
		return alert("No match!");
	if( !!li.extra ) 
		var sValue = li.extra[0];
	else 
		var sValue = li.selectValue;	
	$("#cty_id").val(sValue);
}
function selectCity(li)
{
	findCity(li);
}
function formatItem(row)
{
	return row[0];
}

$(document).ready(function() {
    $("select#con_id").change(function () {		
		$('#sta_id').children().remove().end().append("<option value=\"\">...Loading...</option>");
		var con_id = $("#con_id").val();		
		$.get("populatestate.php?con_id="+con_id,
		function(xml){
			$('#sta_id').children().remove().end().append("<option value=\"\">Please Select</option>");
			$("states",xml).each(function(id) {
			states = $("states",xml).get(id);	
				x='<?php echo $sta_id; ?>';
				if($("sta_id",states).text()==x)
					c='selected';
				else
					c='';
				result = '<option value="'+$("sta_id",states).text()+'" ' + c + '>'+$("name",states).text()+'</option>'
//				states = $("states",xml).get(id);				
	//			result = '<option value="'+$("sta_id",states).text()+'">'+$("name",states).text()+'</option>'
				$("#sta_id").append(result);
			});
		});
	});	

$("#city").autocomplete("populatecity.php",
		{
			delay:10,
			minChars:2,
			matchSubset:1,
			matchContains:1,
			onItemSelect:selectCity,
			onFindValue:findCity,
			formatItem:formatItem,
			extraParams:{con_id:function() { return $("#con_id").val(); },sta_id:function() { return $("#sta_id").val(); }}
		}
	);
	
	
	    $("select#shc_id").change(function () {		
		$('#siz_id').children().remove().end().append("<option value=\"\">...Loading...</option>");
		$('#shw_id').children().remove().end().append("<option value=\"\">...Loading...</option>");
		var shc_id = $("#shc_id").val();		
		$.get("populatesize.php?shc_id="+shc_id,
		function(xml){
			$('#siz_id').children().remove().end().append("<option value=\"\">Please Select</option>");
			$("size",xml).each(function(id) {
				size = $("size",xml).get(id);				
				result = '<option value="'+$("siz_id",size).text()+'">'+$("name",size).text()+'</option>'
				$("#siz_id").append(result);
			});
		});
		
		
		$.get("populatewidth.php?shc_id="+shc_id,
		function(xml){
			$('#shw_id').children().remove().end().append("<option value=\"\">Please Select</option>");
			$("width",xml).each(function(id) {
				width = $("width",xml).get(id);				
				result = '<option value="'+$("shw_id",width).text()+'">'+$("name",width).text()+'</option>'
				$("#shw_id").append(result);
			});
		});
		
	});	


	});
</script>

 <script type="text/javascript">
    var RecaptchaOptions = { theme : 'white' };
 </script>








<script language="javascript">
function checkvalue(value)
{
<?php
	$rs=mysql_query("select * from soe_shoe_category where active=1 and parent_id=0");
	while($row=mysql_fetch_array($rs))
	{
?>
document.getElementById('<?php echo $row['name']; ?>').style.display = 'none';
document.getElementById(value).style.display = '';
<?php
}
?>
}
</script>
<style>
<!--

a{cursor:pointer}
-->
</style>
<script type="text/javascript" src="ntc.js"></script>
</head>

<body>
<!-- This contains the hidden content for inline calls -->
        <div style='display:none'>
          <div id='inline_example1' style='padding:10px; background:#fff;'>
            <h3>Newsletter</h3>
            <form action="newsletter.php" method="post" name="newsfrm" id="newsfrm">
            <div id="loginform">
              <div class="log1">
                <p> Email<br />
                  <input type="text" style=" width:180px; " name="Email" id="Email"/>
                </p>
                <p> Zip code<br />
                  <input type="text"  style=" width:180px; " name="ZipCode" id="ZipCode" />
                </p>
              </div>
              <div class="log1">
                <p>Gender<br />
                  <select name="gender" style="width:180px;">
                    
                    <option value="Male" selected="selected">Male</option>
                    <option value="Female">Female</option>
                  </select>
                </p>
                <p>
                <div id="popupsubmit">
                  <div class="submitbtn">
                    <a id="mybutton"><img src="images/blue_submit_button.jpg" alt="" border="0"></a>
                  </div>
                  <div class="submitbtn">
                    <a onClick="javascript: document.newsfrm.reset();"><img src="images/clear_buton.jpg" alt="" border="0"></a>
                  </div>
                </div>
                <p> 
              </div>
              <br />
              <br />
            </div>
            </form>
          </div>
         </div>
  <!-- Logo Top Portion Start -->
<div id="container_main">
	
		<!-- Logo Top Portion Start -->
	<div id="logo_portion">
		<div id="logo_portion_left">&nbsp;</div>
		
		<div id="logo_portion_mid">
			<div style="height:105px;"></div>
			
		</div>
		
		<div id="logo_portion_right">
			<div><img src="images/follow_us.jpg" alt=""></div>
			<div><img src="images/facebook_ico.jpg" alt=""><img src="images/tw_ico.jpg" alt=""><img src="images/rss_ico.jpg" alt=""></div>
		</div>
		<div class="clear"></div>
		<div id="new_nav">
			<div id="link_bg_left">
			<ul>
				<li class="current_link"><a href="index.php" class="white_link">Home</a></li>
				<li class="current_link"><a href="searchresults.php?ja=1" class="white_link">Just Added</a></li>
				<li class="current_link"><a href="searchresults.php?ja=2" class="white_link">Most Popular</a></li>
				<li class="current_link" ><a href="#" id="white_link" class='example8'>Newsletter</a></li>
                <?php
		  if($_SESSION['memberlogged']!='yes')
		  {
		  ?>
				<li class="current_link"><a href="footwearsuggestions.php" class="white_link">Footwear Suggestions</a></li><li><a href="advancesearch.php" class="white_link">Advance Search</a></li>
          <?php
		  }
		  else
		  {
		  ?>
          
           <?php
		if($_SESSION['memberlogged']=='yes' and $_SESSION['memtype']=='mem')
		{
		?>
    		<li class="current_link"><a href="advancesearch.php" class="white_link">Advance Search</a></li><li ><a href="memberprofile.php" class="white_link" style="color: rgb(105, 201, 241); margin-left:50px;">My Account</a> </li>
        <?php
		}
		elseif($_SESSION['memberlogged']=='yes' and $_SESSION['memtype']=='adv')
		{
		?>
    		<li class="current_link"><a href="advancesearch.php" class="white_link">Advance Search</a></li><li ><a href="advstatistics.php" class="white_link" style="color: rgb(105, 201, 241); margin-left:50px;">My Account</a></li> 
        <?php
		}
		elseif($_SESSION['memberlogged']=='yes' and $_SESSION['memtype']=='staff')
		{
		   $a=redy();
		?>
        
    		<li class="current_link"><a href="advancesearch.php" class="white_link">Advance Search</a></li><li ><a href="<?php echo $a; ?>" class="white_link" style="color: rgb(105, 201, 241); margin-left:50px;">My Account</a></li>
        <?php
		}
		?> 
          
          
          
          <?php
		  }
		  ?>
				
			</ul>
		</div>
		<div id="logo_portion_right">
			<div id="link_bg_right_link">
            
             <?php
		if($_SESSION['memberlogged']=='yes' and $_SESSION['memtype']=='mem')
		{
		?>
    		<a href="logout1.php" class="white_link">Log out</a> 
        <?php
		}
		elseif($_SESSION['memberlogged']=='yes' and $_SESSION['memtype']=='adv')
		{
		?>
    		<a href="logout1.php" class="white_link">Log out</a> 
        <?php
		}
		elseif($_SESSION['memberlogged']=='yes' and $_SESSION['memtype']=='staff')
		{
		   $a=redy();
		?>
        
    		<a href="logout1.php" class="white_link">Log out</a> 
        <?php
		}
		else
		{
		?>
         <a href="memberlogin.php" class="white_link">Member Log in</a>&nbsp; 
        <?php
		}
        ?> 
            
           
            
            
            
            </div>
		</div>
		<div class="clear"></div>
		</div>
	</div>
	<!-- Logo Top Portion End -->
		
	<!-- Header area Start -->
	
     <?php 
	 if(strpos($_SERVER['PHP_SELF'],'detail.php')<=0 and strpos($_SERVER['PHP_SELF'],'cart.php')<=0)
	 {
		 if(strpos($_SERVER['PHP_SELF'],'search')>0 or strpos($_SERVER['PHP_SELF'],'adv')>0 or strpos($_SERVER['PHP_SELF'],'mem')>0  or strpos($_SERVER['PHP_SELF'],'editbusiness')>0 or strpos($_SERVER['PHP_SELF'],'store')>0 or strpos($_SERVER['PHP_SELF'],'location')>0 or strpos($_SERVER['PHP_SELF'],'addshoes')>0 or strpos($_SERVER['PHP_SELF'],'marketing')>0 or strpos($_SERVER['PHP_SELF'],'color')>0 or strpos($_SERVER['PHP_SELF'],'sharepicture')>0  or strpos($_SERVER['PHP_SELF'],'sbdatabase')>0 or strpos($_SERVER['PHP_SELF'],'pack')>0 or strpos($_SERVER['PHP_SELF'],'footwearsuggestion')>0 or strpos($_SERVER['PHP_SELF'],'paypaladdon.php')>0 or strpos($_SERVER['PHP_SELF'],'paypal_loc.php')>0)
			echo '<div><img src="images/sr_header.jpg" alt=""></div>';
		  else
		  {
				echo '<div id="header_left"></div><div id="header_right">';
				  include("headersrchfrm.php"); 
				echo '</div>';
		  }
	  }
		  insertstats('visit');
	  
		 ?>
         
	
	<div class="clear"></div>
   
	<!-- Header area End -->