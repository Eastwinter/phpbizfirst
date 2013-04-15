<?php include("header.php"); ?>
<style type="text/css">
<!--
.style1 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style>

<?php
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
	
$sql="insert into soe_membership set mem_id='".$_SESSION['memberid']."',sto_id=".$_GET['stoid'].",packageid='".$_POST['package']."',price_exc_vat='".floatval($price_exc_vat)."',vat='".floatval($vat)."',total='".floatval($total)."',subscription='".$_POST['subscription']."'";
mysql_query($sql) or die(mysql_error());
$memshipid=mysql_insert_id();
	
	?>
    <script>
	location.href='paypal.php?memshipid=<?php echo $memshipid; ?>';
	</script>
    <?php
}
?>
				
				

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
    <h2>Select Package for New Store</h2>
  </div>
    <div class="sbdatabase">
      <div class="edittable">
        <form class="form" id="account_payment" name="account_payment" method="post" action="">
			<input name="sto_id" value="10" id="sto_id" type="hidden">
			
			<div class="input_title"><label for="package">Listing packages</label></div>
			<div class="input">
            <?php
			$n=1;
				$rs=mysql_query("select * from soe_packages where packageid>1");
				while($row=mysql_fetch_array($rs))
				{
	if($_GET['diff']=="true")
		$row['price']=$row['addstorediffstate'];
	elseif($_GET['diff']=="false")
		$row['price']=$row['addstoresamestate'];
	else
		$row['price']=$row['price'];
		
		if($n==1)
		{
			$s='checked';
			$n++;
			$n1=$row['packageid'];
		}
		else
			$s='';
				?>
				<input name="package" value="<?php echo $row['packageid']; ?>" type="radio" onclick="javascript: fn1(this);" <?php echo $s; ?> ><?php echo ucfirst($row['name']); ?> (<?php echo $row['code']; ?>) Listing $<?php echo $row['price']; ?> USD per month<br>
                <?php
				}
				?>
				<label for="package" class="error"><br>&nbsp; Please choose a package.</label>				
			</div>
			<br class="clear">
            
            	<div class="input_title"><label for="package">Subscription</label></div>
		  <div class="input" id="subscr">
           <?php
		   if($n1==1)
		   {
		   ?>
		     <a class="style1" onclick="window.open('defaultpackage.php?pr=<?php echo $row['price'];?>','','status=no,menubar=no,toolbars=no,width=700,height=300,scrollbars=yes');">Click Here To View Subscription Details For Default Package</a>			
            <?php
			}
			else
			{
			?>
			<input name="subscription" value="monthly" type="radio" checked="checked">Monthly<br>
                <input name="subscription" value="sixmonthly" type="radio">6 Months<br>
				<input name="subscription" value="yearly" type="radio">Yearly<br>
            <?php
			}
			?>
			</div>
			<br class="clear">
			
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
  
 <script>
				function fn1(obj)
				{
					if(obj.value>1)
					{
						str='<input name="subscription" value="monthly" type="radio" checked="checked">Monthly<br> <input name="subscription" value="sixmonthly" type="radio">6 Months<br><input name="subscription" value="yearly" type="radio">Yearly<br>';
						document.getElementById('subscr').innerHTML=str;
					}
					else
					{
						str='<input name="subscription" type="hidden" value="monthly" /> <a <a class="style1" onclick="window.open(\'defaultpackage.php\',\'\',\'status=no,menubar=no,toolbars=no,width=700,height=300,scrollbars=yes\');">Click Here To View Subscription Details For Default Package</a>';
						document.getElementById('subscr').innerHTML=str;
					}
				}
				</script>
            
<?php include("footer.php"); ?>