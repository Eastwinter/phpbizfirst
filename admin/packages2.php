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
	if($prsrow['subscription']=='monthly')
		$price_exc_vat=  $prsrow['price_exc_vat'];

	if($prsrow['subscription']=='sixmonthly')
		$price_exc_vat = round($prsrow['price_exc_vat']/6);
		
	if($prsrow['subscription']=='yearly')
		$price_exc_vat =round($prsrow['price_exc_vat']/12);
		
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
mysql_query("insert into temp_membership select * from soe_membership where memshipid=".$_GET['memshipid']);	
$sql="update soe_membership set mem_id='".$_GET['memberid']."',sto_id=".$_GET['stoid'].",packageid='".$_POST['package']."',price_exc_vat='".floatval($price_exc_vat)."',vat='".floatval($vat)."',total='".floatval($total)."',subscription='".$_POST['subscription']."' where memshipid=".$_GET['memshipid'];
mysql_query($sql) or die(mysql_error());
$memshipid=$_GET['memshipid'];
	
	?>
    <script>
	location.href='showadvmshipdetails.php?id=<?php echo $_GET['memberid']; ?>';
	</script>
    <?php
}
?>


	
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
				$rs=mysql_query("select * from soe_members where mem_id=".$_GET['memberid']) or die(mysql_error());
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
			
			<div class="input_title"><label for="package">Listing packages</label></div>
			<div class="input">
            <?php
			
			$prs=mysql_query("select * from soe_membership where memshipid=".$_GET['memshipid']);
			$prsrow=mysql_fetch_array($prs);

			
				$rs=mysql_query("select * from soe_packages");
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
            	<div class="input_title"><label for="package"></label>
           	</div>
		        <div class="input_title">&nbsp;</div>
			<div class="input"><input name="submt" type="button" value="SUBMIT" /></div>
			<br class="clear">
            
			
		</form>
		</div>
</div>
	<?php include("bottom.php"); ?>