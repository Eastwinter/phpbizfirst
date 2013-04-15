<?php include("top.php");
$msg='';
?>

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
	
$sql="insert into soe_membership set mem_id='".$_GET['advid']."',sto_id=".$_GET['stoid'].",packageid='".$_POST['package']."',price_exc_vat='".floatval($price_exc_vat)."',vat='".floatval($vat)."',total='".floatval($total)."',subscription='".$_POST['subscription']."'";
mysql_query($sql) or die(mysql_error());
$memshipid=mysql_insert_id();
//die($memshipid);
$_GET['memshipid']=$memshipid;
$sql="select * from soe_membership where memshipid='".$_GET['memshipid']."'";
$rs=mysql_query($sql) or die(mysql_error());
$row=mysql_fetch_array($rs);
	if($row['subscription']=='monthly')
		$sql="update soe_membership set payment='paid',paydate='".strtotime(date("Y-m-d"))."',expire='".strtotime(date("Y-m-d")." +1 month")."' where memshipid=".$_GET['memshipid'];

	if($row['subscription']=='sixmonthly')
		$sql="update soe_membership set payment='paid',paydate='".strtotime(date("Y-m-d"))."',expire='".strtotime(date("Y-m-d")." +6 months")."' where memshipid=".$_GET['memshipid'];

	if($row['subscription']=='yearly')
		$sql="update soe_membership set payment='paid',paydate='".strtotime(date("Y-m-d"))."',expire='".strtotime(date("Y-m-d")." +1 year")."' where memshipid=".$_GET['memshipid'];		
mysql_query($sql) or die(mysql_error()."----".$sql);



$rs1=mysql_query("select * from soe_members where mem_id=".$row['mem_id']) or die(mysql_error()."----1");		
$row1=mysql_fetch_array($rs1);

$rs2=mysql_query("select * from soe_packages where packageid=".$row['packageid']) or die(mysql_error()."----2");		
$row2=mysql_fetch_array($rs2);
mysql_query("delete from temp_membership where memshipid=".$_GET['memshipid']) or die(mysql_error());	
mysql_query("update soe_stores set active='1' where sto_id=".$_GET['stoid']) or die(mysql_error());
	
	?>
    <script>
	location.href='storesadv1.php?advid=<?php echo $_GET['advid']; ?>';
	</script>
    <?php
}
?>

<link rel="stylesheet" href="admin.css" type="text/css" />
    <style type="text/css">
<!--
.style1 {
	font-size: medium;
	font-weight: bold;
}
-->
    </style>
    <div class="body" id="mk_height">
		<script type="text/javascript">
$().ready(function()
{
	$("#object").animate({ 
		top: "0px"
	  }, 2000 ).fadeOut(11111);
});
</script>
				<div class="body" id="mk_height">
                <?php
				$rs=mysql_query("select * from soe_members where mem_id=".$_GET['advid']) or die(mysql_error());
				$row=mysql_fetch_array($rs);
		?>
		<table width="95%" border="0" cellpadding="0" cellspacing="0" align="center">		
			<tr>
				<td class="header">Change Package For <?php echo $row['first_name'].' '.$row['last_name']; ?></td>
		  </tr>
			
			<tr><td class="height">&nbsp;</td></tr>
		</table>		
		
		<div align="left"><br />
		
		<form class="form" id="account_payment" name="account_payment" method="post" action="">
			<input name="sto_id" value="10" id="sto_id" type="hidden">
			<div class="orange" style="padding-left:20px;">
            <?php
			
			$rs=mysql_query("select * from soe_packages where packageid>1");
				while($row=mysql_fetch_array($rs))
				{
	if($_GET['diff']=="true")
		$row['price']=$row['addstorediffstate'];
	elseif($_GET['diff']=="false")
		$row['price']=$row['addstoresamestate'];
	else
		$row['price']=$row['price'];
				?>
				<span class="style1">
				<input name="package" value="<?php echo $row['packageid']; ?>" type="radio" <?php echo $c; ?> />
<?php echo ucfirst($row['name']); ?> (<?php echo $row['code']; ?>) Listing $<?php echo $row['price']; ?> USD per month</span><br>
                <?php
				}
				?>
				<label for="package" class="error"><br>&nbsp; Please choose a package.</label>				
		  </div>
<br class="clear">
            <div class="input_title"><label for="package">Subscription</label></div>
		
           
			<input name="subscription" value="monthly" type="radio" checked="checked">Monthly<br>
                <input name="subscription" value="sixmonthly" type="radio">6 Months<br>
				<input name="subscription" value="yearly" type="radio">Yearly<br>
			
            	<div class="input_title"><label for="package"></label>
           	</div>
		        <div class="input_title">&nbsp;</div>
			<div class="input"><input name="submt" type="submit" value="SUBMIT" /></div>
			<br class="clear">
            
			
		</form>
		</div>
</div>
	<?php include("bottom.php"); ?>