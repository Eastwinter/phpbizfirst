<?php include("header.php"); 
if($_GET['action']=='del')
{
	mysql_query("delete from soe_stores where sto_id=".$_GET['id']);
	mysql_query("delete from soe_storelocations where sto_id=".$_GET['id']);
}

if($_GET['stoid']>0)
{
	if($_GET['st']==1)
		$st1=0;
	else
		$st1=1;
		$a="update soe_stores set onlinestore=".intval($st1)." where sto_id=".intval($_GET['stoid']);
		//die($a);
	mysql_query($a) or die(mysql_error());
	?>
    <script>
	location.href="mystores.php#stores";
	</script>
    <?php
}
delstores($_SESSION['memberid']);
?>
<?php include("left3.php"); ?>
<style type="text/css">
<!--
.style1 {font-style: italic}
.style2 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-style: italic;
	font-size: x-small;
}
.style3 {font-family: Verdana, Arial, Helvetica, sans-serif}
.style4 {font-size: small}
-->
</style>




    <!--
  jQuery library
-->
<script type="text/javascript" src="lib/jquery-1.4.2.min.js"></script>
<!--
  jCarousel library
-->
<script type="text/javascript" src="lib/jquery.jcarousel.min.js"></script>
<!--
  jCarousel skin stylesheets
-->
<link rel="stylesheet" type="text/css" href="skins/tango/skin1.css" />
<link rel="stylesheet" type="text/css" href="skins/ie7/skin.css" />

<script type="text/javascript">
 var $j = jQuery.noConflict();
$j(document).ready(function() {
	$j('.mycarousel').jcarousel();
});

</script>
  
  <div id="content_area_mid_inner2">
    <div class="border1">
    <div>
     <a name="stores"></a>
    <h2>My Stores</h2>
   
  </div>
   <form method="post" name="paypalidstore" id="paypalidstore" action="paypalidstore1.php">
   <input type="hidden" name="storeid" value="" id="storeid" />
            <input type="hidden" name="onlinestore" value="" id="onlinestore" />
  
    <table align="center" border="1" cellpadding="5" cellspacing="1" width="700">
      <tr>
        <td width="21%"><span style="font-weight: bold">Name</span></td>
        <td width="28%"><strong>Package/Valid</strong></td>
        <td width="8%" align="center" valign="middle">&nbsp;</td>
        <td width="6%" align="center" valign="middle"><span style="font-weight: bold">Edit</span></td>
        <td width="5%" align="center" valign="middle"><span style="font-weight: bold">Published</span></td>
        <td width="12%" align="center" valign="middle"><span style="font-weight: bold">Online Store ?<span class="style2"><br />
        (Click on the icon to change)</span></span></td>
        <td width="12%" align="center" valign="middle"><span style="font-weight: bold">Paypal-ID/URL</span></td>
        <td width="12%" align="center" valign="middle">&nbsp;</td>
      </tr>
      <?php
		  $sql="select * from soe_stores where mem_id=".$_SESSION['memberid'];
		 
		 $rs=mysql_query($sql) or die(mysql_error());	
		$totrec=mysql_num_rows($rs);
		$totpages=ceil($totrec/20);
		if($_GET['curpage']=='')
			$curpage=1;
		else
			$curpage=$_GET['curpage'];
		$start=($curpage-1)*20;	
		$sql=$sql." limit ".$start.",20";
		$rs=mysql_query($sql) or die(mysql_error());
		 
		 
		  $rs=mysql_query($sql) or die(mysql_error());
		  while($row=mysql_fetch_array($rs))
		  {
		  
			if($row['active']==1)
			{
				$str='<img src="images/published.png" width="20" height="20" />';
			}			
			else
			{
			    $str='<img src="images/unpublished.png" width="20" height="20" />';
			}
			
			if($row['onlinestore']==1)
			{
				$str1='<img src="images/published.png" width="20" height="20" id="onstimg'.$row['sto_id'].'" />';
			}			
			else
			{
			    $str1='<img src="images/unpublished.png" width="20" height="20" id="onstimg'.$row['sto_id'].'"/>';
			}
			
			$hrs=mysql_query("select * from soe_packages where packageid=".$row['packageid']);
			$hrsrow=mysql_fetch_array($hrs);

			$hrs1=mysql_query("select * from soe_membership where sto_id=".$row['sto_id']);
			$hrsrow1=mysql_fetch_array($hrs1);
			if($hrsrow1['payment']=='notpaid')
				continue;
		  ?>
      <tr>
        <td bgcolor="#FFFFFF"><span class="msg" style="text-align:left; "><?php echo stripslashes($row['store_name']); ?></span> </td>
        <td bgcolor="#FFFFFF"><?php echo $hrsrow['code']." - ".$hrsrow['name']; ?> <hr />
        <?php echo date('m/d/Y',$hrsrow1['paydate']); ?> TO <?php echo date('m/d/Y',$hrsrow1['expire']); ?></td>
        <td align="center" valign="middle" bgcolor="#FFFFFF"><?php
		  if($row['active']==1)
		  {
		  ?>
            <a href="locations.php?id=<?php echo $row['sto_id']; ?>" class="style1">Locations</a>
            <?php
		  }
		  ?>        </td>
        <td align="center" valign="middle" bgcolor="#FFFFFF"><a href="editbusiness.php?id=<?php echo $row['sto_id']; ?>"><img src="images/edit.png" width="32" height="32" border="0" /></a></td>
        <td align="center" valign="middle" bgcolor="#FFFFFF"><?php echo $str; ?></td>
        <td align="center" valign="middle" bgcolor="#FFFFFF">
        <?php
		if($row['onlinestore']==0)
		{
		?>
        <a onclick="javascript: chngstore(<?php echo $row['onlinestore']; ?>,<?php echo $row['sto_id']; ?>,'<?php echo $row['paypalid']; ?>','<?php echo $row['paypalurl']; ?>');"><?php echo $str1; ?></a>
        <?php
		}
		else
		{
		?>
        <a onclick="javascript: chngstore1(<?php echo $row['onlinestore']; ?>,<?php echo $row['sto_id']; ?>,'<?php echo $row['paypalid']; ?>');" href="#" ><?php echo $str1; ?></a>
        <?php
		}
		?>        </td>
        <td align="center" valign="middle" bgcolor="#FFFFFF"><?php echo wordwrap($row['paypalid'],10,'<br />'); ?></td>
        <td align="center" valign="middle" bgcolor="#FFFFFF"><a href="orderhistory.php?stoid=<?php echo $row['sto_id']; ?>" class="style4 style3"><strong>Order History</strong></a></td>
      </tr>
      <tr>
        <td colspan="8" align="left" valign="middle" bgcolor="#FFFFFF">
        
        
        <div id='ines<?php echo $row['sto_id']; ?>' style='padding:10px; background:#fff; display:none '>
            <h3>Enter Store Details</h3>
           
           
            <div id="loginform" style="text-align:left">
              <p><strong>Select Your Choice:</strong> 
              <select name="storechoice<?php echo $row['sto_id']; ?>" onchange="javascript: chng(this,<?php echo $row['sto_id']; ?>);" id="storechoice<?php echo $row['sto_id']; ?>">
              	<option value="paypal">Paypal</option>
              	<option value="url">My Website</option>
              </select>
              <p id="emid<?php echo $row['sto_id']; ?>"><strong>Enter Paypal ID:</strong> <input name="Email<?php echo $row['sto_id']; ?>" type="text" id="Email<?php echo $row['sto_id']; ?>" style=" width:180px; " maxlength="40"/>
              </p>
              <p id="urlid<?php echo $row['sto_id']; ?>" style="display:none"><strong>Enter URL:</strong> <input type="text" style=" width:180px; " name="url<?php echo $row['sto_id']; ?>" id="url<?php echo $row['sto_id']; ?>"/><br />( eg: http://www.google.com )</p>              
               
                <p>
                <div id="popupsubmit">
                  <div class="submitbtn">
                    <a onclick="javascript: chngstore2(<?php echo $row['sto_id']; ?>);"><img src="images/blue_submit_button.jpg" alt="" border="0"></a>                  </div>
                </div>
               </p>
              <br />
              <br />
            </div>
          </div>        </td>
      </tr>
      
      <?php
		  }
		  ?>
          
          <?php
		if($totpages>1)
		{
		?>
          
          
          <tr>
        <td colspan="8" align="left" valign="middle" bgcolor="#FFFFFF">
        
        
        <div id="numbring">
        <ul id="carousel" class="mycarousel jcarousel-skin-tango">
         <?php
		  
		  for($i=1;$i<=$totpages;$i++)
		  {
		  ?>
   <li class="numbers"><a  href="mystores.php?curpage=<?php echo $i; ?>" class="gray_link"><?php echo $i; ?></a></li>
         <?php
		  }
		  ?>
          </ul>
        <div class="clear"></div>
      </div>     </td>
      </tr>
           <?php
	  }
	  ?>
    </table>
    
    </form>
    </div>
  </div>
  
  <div class="clear"></div>
  <!-- Content Area End -->
  <div class="hei"></div>
  
  <script>
  function chngstore(st,stoid,payid,p)
  {
  	if(st==0)
		st1=1;
	else
		st1=0;
  	document.getElementById("storeid").value=stoid;
	document.getElementById("onlinestore").value=st1;
	nm1="storechoice"+stoid;
	em1="Email"+stoid;
	ur1="url"+stoid;
	if(p=='paypal')
	{
		document.getElementById(nm1).options.selectedIndex=0;
		document.getElementById(em1).value=payid;
	}
	
	if(p=='url')
	{
		document.getElementById(nm1).options.selectedIndex=1;
		document.getElementById(ur1).value=payid;
	}
	
	nms="ines"+stoid;

	if(document.getElementById(nms).style.display=="none")
		document.getElementById(nms).style.display="block";
	else
		document.getElementById(nms).style.display="none";
		
	chng(document.getElementById("storechoice"+stoid),stoid);
	

  }


function chng(obj,stoid)
{
	a=obj.options.selectedIndex;
	b=obj.options[a].value;
	nm1="emid"+stoid;
	nm2="urlid"+stoid;
	//alert(stoid);
	if(b=='paypal')
	{
		document.getElementById(nm1).style.display="block";
		document.getElementById(nm2).style.display="none";		
	}

	if(b=='url')
	{
		document.getElementById(nm1).style.display="none";
		document.getElementById(nm2).style.display="block";		
	}

}
 
function chngstore1(st,stoid,payid)
  {
  	if(st==0)
		st1=1;
	else
		st1=0;
		nme="Email"+stoid;
		nmu="url"+stoid;
  	document.getElementById("storeid").value=stoid;
	document.getElementById("onlinestore").value=st1;
	if(document.getElementById(nme))
	document.getElementById(nme).value='';
	if(document.getElementById(nmu))
	document.getElementById(nmu).value='';	
	document.paypalidstore.submit();
  }


function chngstore2(stoid)
{
  	//document.getElementById("storeid").value=stoid;
	
		obj=document.getElementById("storechoice"+stoid);  
  	a=obj.options.selectedIndex;
	b=obj.options[a].value;

nme="Email"+stoid;
		nmu="url"+stoid;
		
if(b=="paypal" && document.getElementById(nme).value=='')
  	alert("Please enter paypal email id");
else if(b=="url" && document.getElementById(nmu).value=='')
  	alert("Please enter url of your website");
else if(b=="paypal" && checkemail1(document.getElementById(nme).value))
{
    document.paypalidstore.submit();
}
else if(b=="paypal" && !checkemail1(document.getElementById(nme).value))
{
	alert("Invalid Email");
}
else if(b=="url" && !isUrl(document.getElementById(nmu).value))
{
	alert("Invalid URL ");
}
else
{
	document.paypalidstore.submit();
}
	
}

  </script>
  
<?php include("footer.php"); ?>