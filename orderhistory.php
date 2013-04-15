<?php include("header.php"); 
if($_GET['action']=='del')
{
	mysql_query("delete from cart where ocn like '".$_GET['ocn']."'");
}

?>
<?php include("left3.php"); ?>
<style type="text/css">
<!--
.style5 {color: #009ade}
.style7 {color: #009ade; font-weight: bold; }
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
else if(b=="paypal" && checkemail(document.paypalidstore.Email.value))
{
    $.post("paypalidstore.php",        // PERFORM AJAX POST
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
else if(b=="paypal" && !checkemail(document.paypalidstore.Email.value))
{
	alert("Invalid Email");
}
else if(b=="url" && isUrl(document.paypalidstore.url.value))
{
    $.post("paypalidstore.php",        // PERFORM AJAX POST
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
            <form action="paypalidstore.php" method="post" name="paypalidstore" id="paypalidstore">
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
    <h2>Order History</h2>
   
  </div>
    <div class="orderform">
        <?php
		$maintot=0;
			$rs=mysql_query("select * from cart where stoid='".intval($_GET['stoid'])."' group by ocn order by date desc");
			if(mysql_num_rows($rs)>0)
			{
		?>
        <table  width="90%" border="1" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="marginTop"  style=" text-align:center;" >
          <tr bgcolor="#fff" style="color:#009ade; background-color:#e4e4e4;">
            <th width="5%" >Order Number</th>
            <th width="5%" height="50" >Date</th>
            <th width="13%" >Total Amount</th>
            <th width="5%" >Status</th>
            <th width="5%" >&nbsp;</th>
            <th width="5%" >&nbsp;</th>
          </tr>
          <?php
			
			while($row=mysql_fetch_array($rs))
			{
				extract($row);
				$rs1=mysql_query("select * from soe_members where mem_id=".$row['memid']);
				$row1=mysql_fetch_array($rs1);
				
				$maintot+=$row['total'];
				$rsmt=mysql_query("select sum(price*qty) from cart where ocn like '".$ocn."' and stoid='".intval($_GET['stoid'])."' group by ocn order by date desc");
				$rsmtrow=mysql_fetch_array($rsmt);
				$tot=$rsmtrow[0];
				
			?>
          <tr bgcolor="#fff">
            <td bgcolor="#ffffff"><?php echo $ocn; ?></td>
            <td height="40" bgcolor="#ffffff"><?php echo date('F d, Y',strtotime($date)); ?></td>
            <td bgcolor="#ffffff"><?php echo $tot; ?></td>
            <td bgcolor="#ffffff"><?php echo $paid; ?>            </td>
            <td bgcolor="#ffffff"><a style="cursor:pointer" onclick="javascript: showhd(<?php echo $id; ?>);"><strong>DETAILS</strong></a></td>
            <td bgcolor="#ffffff"><a href="javascript: show('<?php echo $row['ocn']; ?>');"><img src="images/delete.png" alt="" border="0" /></a></td>
          </tr>
          <tr bgcolor="#fff" id="mytr" >
            <td colspan="6" bgcolor="#ffffff">
            
            
            
            <div id="row<?php echo $id; ?>" style="display:none">
              <table style="text-align:center; color:#000000; margin:20px;"  align="center" bgcolor="#ffffff"   border="1px solid gray" cellpadding="0" cellspacing="0">
                  <tr style="color:#009ade; background-color:#e4e4e4;">
                    <th width="137" height="50" >&nbsp;</th>
                    <th width="176" >Item Code</th>
                    <th width="102" >Quantity</th>
                    <th width="95" >Price</th>
                    <th width="128" >Amount</th>
                  </tr>
                  <?php
					$maintot1=0;
			$rs11=mysql_query("select * from cart where ocn like '".$ocn."' and stoid='".intval($_GET['stoid'])."'") or die(mysql_error());

			while($row11=mysql_fetch_array($rs11))
			{
				
				$rs1=mysql_query("select * from soe_shoe where active='1' and soe_id=".$row11['itemid']);
				$row1=mysql_fetch_array($rs1);
				
				$img='<img src="uploads/shoe_photo/thumb98_'.getcol($row11['itemid'],'',$row11['colid']).'" alt="" border="0"  />' ;
				
				
				
				
			?>
                  <tr>
                    <td height="40"><?php echo $img; ?></td>
                    <td><?php echo $row1['name']; ?></td>
                    <td><?php echo $row11['qty']; ?></td>
                    <td><?php echo $row11['price']; ?></td>
                    
                    <td><?php echo $row11['qty']*$row11['price']; ?></td>
                  </tr>
                  
                  <?php
			}
			
			
			$rsmem=mysql_query("select * from soe_members where mem_id=".$memid);
			$rowmem=mysql_fetch_array($rsmem);
			
			
			?>
            
            <tr>
                    <td colspan="5" align="center" valign="middle">
                    
                    <table width="80%"   border="1px solid gray"  align="center" cellpadding="4" cellspacing="0" bgcolor="#ffffff" style="text-align:center; color:#000000; margin:20px;">
                      <tr>
                        <th colspan="2"><span class="style5">Customer Details</span></th>
                      </tr>
                      <tr>
                        <td><span class="style7"> Name</span></td>
                        <td><?php echo $rowmem['first_name']." ".$rowmem['last_name']; ?></td>
                      </tr>
                      <tr>
                        <td><span class="style7">Email</span></td>
                        <td><?php echo $rowmem['email']; ?></td>
                      </tr>
                    </table></td>
                </tr>
              </table>
                <p>&nbsp;</p>
            </div></td>
          </tr>
          <?php
				   }
				   ?>
        </table>
<?php
		  }
		  else
		  {
		  ?>
            <div align="center"><span style="font-variant:small-caps; font-size:18px; font-family:Verdana, Arial, Helvetica, sans-serif"><strong>No Orders Yet!</strong></span><br></div>
<br>
<br>
<br>
<br>

            <?php
		  }
		  ?>
         
        </div>
    </div>
  </div>
  
  <div class="clear"></div>
  <!-- Content Area End -->
  <div class="hei"></div>
  
 <script>
				function showhd(i)
				{
					nm="row"+i;
		obj=document.getElementById(nm);
		
		if(obj.style.display=='none')
			obj.style.display='inline';
		else
			obj.style.display='none';
				}
				
				
				</script>
                
                
                 <script>
		function show(ocn)
		{
			ans=confirm("Are you sure to delete?");
			if(ans==true)
				location.href="orderhistory.php?action=del&ocn="+ocn;
		}
		</script>  
  
<?php include("footer.php"); ?>