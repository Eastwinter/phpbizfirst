<?php include("top.php");
if($_SERVER['REQUEST_METHOD']=="POST")
{
	mysql_query("update soe_downgrades set status='".$_POST['select']."' where downid=".$_GET['id']) or die(mysql_error());
}
?>

	
	<div class="body" id="mk_height">
				
		
		<table width="95%" border="0" cellpadding="0" cellspacing="0" align="center">		
			<tr>
				<td class="header">Downgrad Package Request Details</td>
			</tr>
			
			<tr>
			  <td class="height">&nbsp;</td>
		  </tr>
			
			<tr>
			  <td class="height">&nbsp;</td>
		  </tr>
		</table>		
		
	  <?php
		
		$prs=mysql_query("select * from soe_membership where memshipid=".$_GET['memshipid']);
		$prsrow=mysql_fetch_array($prs);
	
		$prevsubs=$prsrow['subscription'];
		$rs=mysql_query("select * from soe_packages where packageid=".$prsrow['packageid']) or die(mysql_error());
		$row=mysql_fetch_array($rs);
		$packname1=$row['name'];
		
		
			$rs=mysql_query("select * from soe_packages where packageid=".$_GET['package']) or die(mysql_error());
	$row=mysql_fetch_array($rs);
	$packname2=$row['name'];
	if($_GET['diff']=="true")
		$row['price']=$row['addstorediffstate'];
	elseif($_GET['diff']=="false")
		$row['price']=$row['addstoresamestate'];
	else
		$row['price']=$row['price'];
		
	$price=$row['price'];
	
	$package=$_GET['package'];
	if($prevsubs=='monthly')
		$price_exc_vat = $price;

	if($prevsubs=='sixmonthly')
		$price_exc_vat = $price*6;
		
	if($prevsubs=='yearly')
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
		
		$rsb=mysql_query("select * from soe_downgrades where downid=".$_GET['id']) or die(mysql_error());
		$rowb=mysql_fetch_array($rsb);
		
		$prevprice=$prsrow['price_exc_vat'];
		
		$passeddays=dateDiff(date('Y-m-d',$prsrow['paydate']),$rowb['date']);
		$leftdays=dateDiff($rowb['date'],date('Y-m-d',$prsrow['expire']));	
		$totdays=$passeddays+$leftdays;
		
		$prevpriceperday=round($prevprice/$totdays,2);
		$currpriceperday=round($total/$totdays,2);
		
		$usedamount=$passeddays*$prevpriceperday;
		$remamount=$prevprice-$usedamount;
		
		$curramount=($leftdays*$currpriceperday)-$remamount;
	

?>
<style type="text/css">
<!--
.style4 {font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; font-size: x-small; }
.style6 {font-size: small}
.style10 {font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; font-size: x-small; color: #FF0000; }
.style11 {color: #FF0000}
.style15 {font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; font-size: small; color: #0000FF; }
-->
</style>
<br />
<br />

<table width="90%" border="0" align="center" cellpadding="2" cellspacing="2" bgcolor="#CCCCCC">
  <tr>
    <td bgcolor="#CCCCCC" class="style15"> 
      <form id="form1" name="form1" method="post" action="">
        STATUS:&nbsp;&nbsp;&nbsp;&nbsp;
        <select name="select" id="select" onchange="javascript: document.form1.submit();">
          <option value="open" selected="selected">open</option>
          <option value="closed" <?php if($rowb['status']=='closed') { ?> selected="selected" <?php } ?> >closed</option>
        </select>
      </form>      </td>
    <td bgcolor="#CCCCCC" class="style15">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC" class="style15">Pro-rata Calculation</td>
    <td bgcolor="#CCCCCC" class="style15">Validity From : <span class="style10"><?php echo date('m/d/Y',$prsrow['paydate']); ?></span> To <span class="style10"><?php echo date('m/d/Y',$prsrow['expire']); ?></span> </td>
  </tr>
  <tr>
    <td width="46%" bgcolor="#FFFFFF"><span class="style4">Package</span></td>
    <td width="54%" bgcolor="#FFFFFF"><span class="style10"><?php echo $packname1; ?></span></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><span class="style4">Package Amount</span></td>
    <td bgcolor="#FFFFFF"><span class="style10"><?php echo $prevprice; ?></span></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><span class="style4">Total Days Subscribed</span></td>
    <td bgcolor="#FFFFFF"><span class="style10"><?php echo $totdays; ?></span></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><span class="style4">Days Used</span></td>
    <td bgcolor="#FFFFFF"><span class="style10"><?php echo $passeddays; ?></span></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><span class="style4">Days Left</span></td>
    <td bgcolor="#FFFFFF"><span class="style10"><?php echo $leftdays; ?></span></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><span class="style4">Amount Per Day</span></td>
    <td bgcolor="#FFFFFF"><span class="style10">$ <?php echo $prevpriceperday; ?></span></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><span class="style4">Used Amount</span></td>
    <td bgcolor="#FFFFFF"><span class="style10">$ <?php echo $usedamount; ?></span></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><span class="style4">Remaining Amount</span></td>
    <td bgcolor="#FFFFFF"><span class="style10">$ <?php echo $remamount; ?></span></td>
  </tr>
  <tr>
    <td height="30" bgcolor="#FFFFFF"><span class="style6"></span></td>
    <td bgcolor="#FFFFFF"><span class="style11"></span></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><span class="style4">Package</span></td>
    <td bgcolor="#FFFFFF"><span class="style10"><?php echo $packname2; ?></span></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><span class="style4">Package Amount</span></td>
    <td bgcolor="#FFFFFF"><span class="style10"><?php echo $total; ?></span></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><span class="style4">Total Days Subscribed</span></td>
    <td bgcolor="#FFFFFF"><span class="style10"><?php echo $totdays; ?></span></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><span class="style4">Days Deducted</span></td>
    <td bgcolor="#FFFFFF"><span class="style10"><?php echo $passeddays; ?></span></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><span class="style4">Days to Be Billed</span></td>
    <td bgcolor="#FFFFFF"><span class="style10"><?php echo $leftdays; ?></span></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><span class="style4">Amount Per Day</span></td>
    <td bgcolor="#FFFFFF"><span class="style10">$ <?php echo $currpriceperday; ?></span></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><span class="style15">Amount To Refund</span></td>
    <td bgcolor="#CCCCCC"><span class="style15">$ <?php echo ($curramount*-1); ?></span></td>
  </tr>
</table>

</div>
	<?php include("bottom.php"); ?>