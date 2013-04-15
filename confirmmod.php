<?php include("header.php"); ?>

<?php
		$prs=mysql_query("select * from soe_membership where memshipid=".$_GET['memshipid']);
		$prsrow=mysql_fetch_array($prs);
	
		$prevsubs=$prsrow['subscription'];
		$prevprice=$prsrow['price_exc_vat'];
						
if($_SERVER['REQUEST_METHOD']=="POST")
{
	$sql="update soe_stores set packageid='".$_POST['package']."' where sto_id=".$_GET['stoid']."";
	mysql_query($sql) or die(mysql_error());
	
	$rs=mysql_query("select * from soe_settings where field='price_vat'");
	$row=mysql_fetch_array($rs);
	$price_vat=$row[2];
	
	$rs=mysql_query("select * from soe_packages where packageid=".$_POST['package']) or die(mysql_error());
	$row=mysql_fetch_array($rs);
	if($_GET['diff']=="true")
		$row['price']=$row['addstorediffstate'];
	elseif($_GET['diff']=="false")
		$row['price']=$row['addstoresamestate'];
	else
		$row['price']=$row['price'];
		
	$price=$row['price'];
	
	$package=$_POST['package'];
	if($_POST['subscription']=='monthly')
		$price_exc_vat = $price;

	if($_POST['subscription']=='sixmonthly')
		$price_exc_vat = $price*6;
		
	if($_POST['subscription']=='yearly')
		$price_exc_vat = $price*12;
	
					if(empty($price_vat))
					{
						$vat = 0;
						$total = $price_exc_vat;
					}
					else
					{
						$vat = (($price_exc_vat*$price_vat)/100);
						$total = $price_exc_vat+$vat;
					}
mysql_query("delete from temp_membership where memshipid=".$_GET['memshipid']) or die(mysql_error());						
mysql_query("insert into temp_membership select * from soe_membership where memshipid=".$_GET['memshipid']) or die(mysql_error());	
$sql="update soe_membership set mem_id='".$_SESSION['memberid']."',sto_id=".$_GET['stoid'].",packageid='".$_POST['package']."',price_exc_vat='".floatval($price_exc_vat)."',vat='".floatval($vat)."',total='".floatval($total)."',subscription='".$_POST['subscription']."',payment='notpaid' where memshipid=".$_GET['memshipid'];
mysql_query($sql) or die(mysql_error());
$memshipid=$_GET['memshipid'];
	
	?>
    <script>
	location.href='confirmmod.php?memshipid=<?php echo $memshipid; ?>';
	</script>
    <?php
}
?>
    <style type="text/css">
<!--
.style2 {
	color: #FF0000;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: x-small;
	font-weight: bold;
}
-->
    </style>
    
				
				<div class="container">	

<script type="text/javascript">
$().ready(function()
{
	$("#object").animate({ 
		top: "0px"
	  }, 2000 ).fadeOut(11111);
});
</script>

<div style="top: 0px; display: none;" id="object" class="message_box">
	<span class="msg">Your account registration has done successfully.</span>	</div>
	
					
					<?php include("left3.php"); ?>
					

<script type="text/javascript">
$(document).ready(function() {
	$("#account_payment").validate({
		rules: {
			package: "required"
		},
		messages: {
			package: "<br/>"
		}
	});	
});
</script>
  
  <div id="content_area_mid_inner2">
  <div>
    <h2>Confirm Package Switch</h2>
  </div>
    <div class="sbdatabase">
      <div class="edittable">
        <form class="form" id="account_payment" name="account_payment" method="post" action="">
			<input name="sto_id" value="10" id="sto_id" type="hidden">
			
			<div class="input_title"><label for="package">Listing packages</label></div>
			<div class="input">
            <?php
			
			$prs=mysql_query("select * from soe_membership where memshipid=".$_GET['memshipid']);
			$prsrow=mysql_fetch_array($prs);
				
					if($prsrow['subscription']=='monthly')
						$price_exc_vat=  $prsrow['price_exc_vat'];

					if($prsrow['subscription']=='sixmonthly')
						$price_exc_vat = round($prsrow['price_exc_vat']/6);
						
					if($prsrow['subscription']=='yearly')
						$price_exc_vat =round($prsrow['price_exc_vat']/12);

				
			
				$rs=mysql_query("select * from soe_packages where price > ".$price_exc_vat);
				while($row=mysql_fetch_array($rs))
				{
						if($_GET['diff']=="true")
							$row['price']=$row['addstorediffstate'];
						elseif($_GET['diff']=="false")
							$row['price']=$row['addstoresamestate'];
						else
							$row['price']=$row['price'];

					
					if($prsrow['packageid']==$row['packageid'])
						$c='checked';
					else
						$c='';
				?>
				<input name="package" value="<?php echo $row['packageid']; ?>" type="radio" <?php echo $c; ?> /><?php echo ucfirst($row['name']); ?> (<?php echo $row['code']; ?>) Listing $<?php echo $row['price']; ?> USD per month<br>
                <?php
				}
				?>
				<label for="package" class="error"><br>&nbsp; Please choose a package.</label>				
			</div>
			<br class="clear">
            <input name="subscription" type="hidden" value="<?php echo $prsrow['subscription']; ?>" />
            <span class="style2">NOTE: Your Subscription Will Remain : <?php echo strtoupper($prsrow['subscription']); ?>           	</span>
            <div class="input_title"><label for="package"></label>
           	</div>
		        <div class="input_title">&nbsp;</div>
			<div class="input"><input type="image" src="http://images.paypal.com/images/x-click-but01.gif" border="0" name="submit" alt="Make payments with PayPal - it’s fast, free and secure!" /></div>
			<br class="clear">
            
			
		</form>
      </div>
    </div>
  </div>
  <div class="clear"></div>
  <!-- Content Area End -->
  <div class="hei"></div>
  

            
<?php include("footer.php"); ?>