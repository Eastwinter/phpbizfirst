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
    <h2>Additional Location Payment</h2>
  </div>
   
    <div class="moremarketing">
      
        <?php
$sql="select * from soe_membership where memshipid='".$_GET['memshipid']."'";
$rs=mysql_query($sql) or die(mysql_error());
$row=mysql_fetch_array($rs);

$sql1="select * from soe_stores where sto_id=".$row['sto_id']."";
$rs11=mysql_query($sql1) or die(mysql_error());
$row11=mysql_fetch_array($rs11);
$desc=" Store: ".$row11['store_name'];

$sql1="select * from soe_storelocations where sto_id=".$row['sto_id']." and loc_id=".$row['loc_id'];
$rs11=mysql_query($sql1) or die(mysql_error());
$row11=mysql_fetch_array($rs11);
$desc=" Additional Store Location at : ".$row11['address'];
$_SESSION['memshipid']=$_GET['memshipid'];

?>


		<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" name="payaddonmyfrm">
        <input type="hidden" name="cmd" value="_xclick-subscriptions">
        <input type="hidden" name="business" value="user1_1305209813_biz@gmail.com">
        <input type="hidden" name="item_name" value="Additional Location">
        <input type="hidden" name="item_number" value="<?php echo $row['memshipid']; ?>">
        <input type="hidden" name="no_shipping" value="1">
        <input type="hidden" name="return" value="http://www.innogenius.com/shoebreeze/thankyouloc.php?memshipid=<?php echo $_GET['memshipid']; ?>">
        <input type="hidden" name="cancel_return" value="http://www.innogenius.com/shoebreeze/cancelloc.php?memshipid=<?php echo $_GET['memshipid']; ?>">
         <input type="hidden" name="rm" value="2">
        <?php
		if($row1['name']=='Default')
		{
		?>
            <input type="hidden" name="a1" value="0">
            <input type="hidden" name="p1" value="1">
            <input type="hidden" name="t1" value="M">
            
            <input type="hidden" name="a2" value="<?php echo $row['price_exc_vat']; ?>" />
            <input type="hidden" name="p2" value="2">
            <input type="hidden" name="t2" value="M">
       <?php
		}
	//	print_r($row);
	//	die();
	if($row['subscription']=='monthly')
	{
		$p3 = 1;
		$t3 = 'M';
	}

	if($row['subscription']=='sixmonthly')
	{
		$p3 = 6;
		$t3 = 'M';
	}
		
	if($row['subscription']=='yearly')
	{
		$p3 = 1;
		$t3 = 'Y';
	}

		?>  
        
        
            <input type="hidden" name="a3" value="<?php echo $row['price_exc_vat']; ?>">
            <input type="hidden" name="p3" value="<?php echo $p3 ;?>">
            <input type="hidden" name="t3" value="<?php echo $t3; ?>">
            
       	    
            <input type="hidden" name="src" value="1">
            <input type="hidden" name="no_note" value="1">
            <input type="hidden" name="memshipid" value="<?php echo $_GET['memshipid']; ?>" >
        
        
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