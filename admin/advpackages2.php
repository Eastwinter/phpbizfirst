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
$rs=mysql_query("select * from soe_membership where memshipid=".$_GET['memshipid']);	
$row=mysql_fetch_array($rs);
$subs=$row['subscription'];

if($row['subscription']=='monthly')
	$edt=strtotime(date("Y-m-d")." +1 month");

if($row['subscription']=='sixmonthly')
	$edt=strtotime(date("Y-m-d")." +6 months");

if($row['subscription']=='yearly')
	$edt=strtotime(date("Y-m-d")." +1 year");
	
$sql="update soe_membership set mem_id='".$_GET['memberid']."',sto_id=".$_GET['stoid'].",packageid='".$_POST['package']."',price_exc_vat='".floatval($price_exc_vat)."',vat='".floatval($vat)."',total='".floatval($total)."',subscription='".$subs."' where memshipid=".$_GET['memshipid'];
mysql_query($sql) or die(mysql_error());
$memshipid=$_GET['memshipid'];
	
	?>
    <script>
	location.href='showadvmshipdetails.php?id=<?php echo $_GET['memberid']; ?>';
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
            
            
		  <div class="orange" style="padding-left:20px;">
             <h3> Packages To Downgrade </h3>
             <?php
			
				$prs=mysql_query("select * from soe_membership where memshipid=".$_GET['memshipid']);
			$prsrow=mysql_fetch_array($prs);
				
					if($prsrow['subscription']=='monthly')
						$price_exc_vat=  $prsrow['price_exc_vat'];

					if($prsrow['subscription']=='sixmonthly')
						$price_exc_vat = round($prsrow['price_exc_vat']/6);
						
					if($prsrow['subscription']=='yearly')
						$price_exc_vat =round($prsrow['price_exc_vat']/12);

			
				if($_GET['diff']=="true")
					$rs=mysql_query("select * from soe_packages where packageid>1 and addstorediffstate < ".$price_exc_vat);
				elseif($_GET['diff']=="false")
					$rs=mysql_query("select * from soe_packages where packageid>1 and addstoresamestate < ".$price_exc_vat);
				else
					$rs=mysql_query("select * from soe_packages where packageid>1 and price < ".$price_exc_vat);
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
			  <span class="style1">
				<input name="package" value="<?php echo $row['packageid']; ?>" type="radio" <?php echo $c; ?> />
<?php echo ucfirst($row['name']); ?> (<?php echo $row['code']; ?>) Listing $<?php echo $row['price']; ?> USD per month</span><br>
                <?php
				}
				?>
            <h3> Packages To Upgrade </h3>
            <?php
			
			
			
				if($_GET['diff']=="true")
					$rs=mysql_query("select * from soe_packages where addstorediffstate > ".$price_exc_vat);
				elseif($_GET['diff']=="false")
					$rs=mysql_query("select * from soe_packages where addstoresamestate > ".$price_exc_vat);
				else
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
			  <span class="style1">
				<input name="package" value="<?php echo $row['packageid']; ?>" type="radio" <?php echo $c; ?> />
<?php echo ucfirst($row['name']); ?> (<?php echo $row['code']; ?>) Listing $<?php echo $row['price']; ?> USD per month</span><br>
                <?php
				}
				?>
				<label for="package" class="error"><br>&nbsp; Please choose a package.</label>				
		  </div>
          
<br class="clear"><br />
<br />
<span class="left_menu1">NOTE: The Subscription Will Remain : <?php echo strtoupper($prsrow['subscription']); ?></span>     
            <input name="subscription" type="hidden" value="<?php echo $prsrow['subscription']; ?>" />
            	<div class="input_title"><label for="package"></label>
           	</div>
		        <div class="input_title">&nbsp;</div>
			<div class="input"><input name="submt" type="submit" value="SUBMIT" /></div>
			<br class="clear">
		</form>
		</div>
</div>
	<?php include("bottom.php"); ?>