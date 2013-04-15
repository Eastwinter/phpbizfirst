<?php include("header.php"); ?>
<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: x-small;
	color: #FF0000;
}
-->
</style>


				
				

	
					
					<?php include("left3.php"); ?>
			

  
  <div id="content_area_mid_inner1">
  <div>
    <h2>ADDON PURCHASE</h2>
  </div>
   
    <div class="moremarketing">
      
       <?php
$sql="select * from soe_addonmembers where id='".$_GET['addonid']."'";
$rs=mysql_query($sql) or die(mysql_error().$sql);
$row=mysql_fetch_array($rs);

$sql1="select * from soe_addons where addonid=".$row['addonid'];
$rs1=mysql_query($sql1) or die(mysql_error().$sql1);
$row1=mysql_fetch_array($rs1);



$_SESSION['addonid']=$_GET['addonid'];

?>

<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" name="payaddonmyfrm">
        <input type="hidden" name="cmd" value="_xclick">
        <input type="hidden" name="business" value="user1_1305209813_biz@gmail.com">
        <input type="hidden" name="item_name" value="ADDON Purchase - <?php echo $row1['name']; ?>">
        <input type="hidden" name="item_number" value="<?php echo $row['addonid']; ?>">
        <input type="hidden" name="no_shipping" value="1">
        <input type="hidden" name="return" value="http://www.innogenius.com/shoebreeze/thankyouaddon.php?addonid=<?php echo $_GET['addonid']; ?>">
        <input type="hidden" name="cancel_return" value="http://www.innogenius.com/shoebreeze/canceladdon.php?addonid=<?php echo $_GET['addonid']; ?>">
        <input type="hidden" name="amount" value="<?php echo $row1["price"]; ?>">
        <input type="hidden" name="no_note" value="1">
        
        
	</form>
        <p align="center"> <img src="throbber.gif" width="100" height="100" align="absmiddle" /> <br />
           <span class="style1">Do not press 'back' or close the window until the process is complete</span></p>
      <div class="clear"></div>
</div>
  
  </div>
  <div id="content_area_right"><?php echo showbanners("right"); ?></div>
  <div class="clear"></div>
  <!-- Content Area End -->
  <div class="hei"></div>
  
  <script type="text/javascript">


function f()
{

	 document.payaddonmyfrm.submit();	

	//location.href="approval_test.php";
}
setTimeout("f()", 2000);
</script>

<?php include("footer.php"); ?>