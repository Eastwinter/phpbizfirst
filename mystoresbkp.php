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
.style4 {font-size: medium}
-->
</style>


<script>
$(document).ready(function(){
  $("#mypaypalbutton").click(function () { // ATTACH CLICK EVENT TO MYBUTTON
  
	obj=document.getElementById("storechoice");  
  	a=obj.options.selectedIndex;
	b=obj.options[a].value;

if(b=="paypal" && document.paypalidstore.Email.value=='')
  	alert("Please enter paypal email id");
else if(b=="url" && document.paypalidstore.url.value=='')
  	alert("Please enter url of your website");
else if(b=="paypal" && checkemail1(document.paypalidstore.Email.value))
{
    $.post("paypalidstore1.php",        // PERFORM AJAX POST
      $("#paypalidstore").serialize(),      // WITH SERIALIZED DATA OF MYFORM
      function(data){                // DATA NEXT SENT TO COLORBOX
        $.fn.colorbox({
          html:   data,
          open:   true,
          iframe: false,            // NO FRAME, JUST DIV CONTAINER?
          width:  "50%",
        });
      },
      "html");
	  	  document.paypalidstore.reset();
	location.href="mystores.php";
}
else if(b=="paypal" && !checkemail1(document.paypalidstore.Email.value))
{
	alert("Invalid Email");
}
else if(b=="url" && !isUrl(document.paypalidstore.url.value))
{
	alert("Invalid URL ");
}

  });
}); 
</script>



<div style='display:none'>
          <div id='inline_example23' style='padding:10px; background:#fff;'>
            <h3>Enter Store Details</h3>
            <form method="post" name="paypalidstore" id="paypalidstore">
            <input type="hidden" name="storeid" value="" id="storeid" />
            <input type="hidden" name="onlinestore" value="" id="onlinestore" />
            <div id="loginform" style="text-align:left">
             
              <p><strong>Select Your Choice:</strong> 
              <select name="storechoice" onchange="javascript: chng(this);" id="storechoice">
              	<option value="paypal">Paypal</option>
              	<option value="url">My Website</option>
              </select>
              <p id="emid"><strong>Enter Paypal ID:</strong> <input type="text" style=" width:180px; " name="Email" id="Email"/></p>
              <p id="urlid" style="display:none"><strong>Enter URL:</strong> <input type="text" style=" width:180px; " name="url" id="url"/><br />( eg: http://www.google.com )</p>              
               
             
                
                <p>
                <div id="popupsubmit">
                  <div class="submitbtn">
                    <a id="mypaypalbutton"><img src="images/blue_submit_button.jpg" alt="" border="0"></a>
                  </div>
                 
                </div>
               
              <br />
              <br />
            </div>
            </form>
          </div>
         </div>
         
  
  <div id="content_area_mid_inner2">
    <div class="border1">
    <div>
     <a name="stores"></a>
    <h2>My Stores</h2>
   
  </div>
    <table align="center" border="1" cellpadding="5" cellspacing="1" width="98%">
      <tr>
        <td width="21%"><span style="font-weight: bold">Name</span></td>
        <td width="28%"><strong>Package</strong></td>
        <td width="20%"><strong>Valid</strong></td>
        <td width="8%" align="center" valign="middle">&nbsp;</td>
        <td width="6%" align="center" valign="middle"><span style="font-weight: bold">Edit</span></td>
        <td width="5%" align="center" valign="middle"><span style="font-weight: bold">Published</span></td>
        <td width="12%" align="center" valign="middle"><span style="font-weight: bold">Online Store ?<span class="style2"><br />
        (Click on the icon to change)</span></span></td>
        <td width="12%" align="center" valign="middle"><span style="font-weight: bold">Paypal-ID/URL</span></td>
        <td width="12%" align="center" valign="middle">&nbsp;</td>
      </tr>
      <?php
		  $s="select * from soe_stores where mem_id=".$_SESSION['memberid'];
		 // echo $s;
		  $rs=mysql_query($s) or die(mysql_error());
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
        <td bgcolor="#FFFFFF"><?php echo $hrsrow['code']." - ".$hrsrow['name']; ?> </td>
        <td bgcolor="#FFFFFF"><?php echo date('m/d/Y',$hrsrow1['paydate']); ?> TO <?php echo date('m/d/Y',$hrsrow1['expire']); ?></td>
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
        <a onclick="javascript: chngstore(<?php echo $row['onlinestore']; ?>,<?php echo $row['sto_id']; ?>,'<?php echo $row['paypalid']; ?>','<?php echo $row['paypalurl']; ?>');" class='example77'><?php echo $str1; ?></a>
        <?php
		}
		else
		{
		?>
        <a onclick="javascript: chngstore1(<?php echo $row['onlinestore']; ?>,<?php echo $row['sto_id']; ?>,'<?php echo $row['paypalid']; ?>');" href="#" ><?php echo $str1; ?></a>
        <?php
		}
		?>        </td>
        <td align="center" valign="middle" bgcolor="#FFFFFF"><?php echo $row['paypalid']; ?></td>
        <td align="center" valign="middle" bgcolor="#FFFFFF"><a href="orderhistory.php?stoid=<?php echo $row['sto_id']; ?>" class="style4 style3"><strong>Order History</strong></a></td>
      </tr>
      <?php
		  }
		  ?>
    </table>
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
	if(p=='paypal')
	{
		document.getElementById("storechoice").options.selectedIndex=0;
		document.paypalidstore.Email.value=payid;
	}
	
	if(p=='url')
	{
		document.getElementById("storechoice").options.selectedIndex=1;
		document.getElementById("url").value=payid;
	}
	chng(document.getElementById("storechoice"));
	

  }


function chng(obj)
{
	a=obj.options.selectedIndex;
	b=obj.options[a].value;
	if(b=='paypal')
	{
		document.getElementById('emid').style.display="block";
		document.getElementById('urlid').style.display="none";		
	}

	if(b=='url')
	{
		document.getElementById('emid').style.display="none";
		document.getElementById('urlid').style.display="block";		
	}

}
 
function chngstore1(st,stoid,payid)
  {
  	if(st==0)
		st1=1;
	else
		st1=0;
  	document.getElementById("storeid").value=stoid;
	document.getElementById("onlinestore").value=st1;
	document.paypalidstore.Email.value=payid;
	location.href="mystores.php?stoid="+stoid+"&st="+st;
	//alert(payid);
  }
  </script>
  
<?php include("footer.php"); ?>