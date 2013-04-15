<?php include("top.php");
$msg='';
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
				$rs=mysql_query("select * from soe_members where mem_id=".$_GET['id']) or die(mysql_error());
				$row=mysql_fetch_array($rs);
		?>
		<table width="95%" border="0" cellpadding="0" cellspacing="0" align="center">		
			<tr>
				<td class="header">Membership Details of <?php echo $row['first_name'].' '.$row['last_name']; ?></td>
		  </tr>
			
			<tr><td class="height">&nbsp;</td></tr>
		</table>		
		
		<table width="95%" border="0" cellpadding="0" cellspacing="1" align="center">
<form name="site_banners" method="post" action="">

				<input type="hidden" name="page" value="1" />
				
				<tr class="tableheader1">
				  <td width="17%">Store</td>
				  <td width="24%">Package</td>
				  <td width="9%">Price Excl. VAT</td>
	              <td width="4%">VAT</td>
	              <td width="6%">Total</td>
	              <td width="9%">Payment Status</td>
	              <td width="11%">Paid On</td>
	              <td width="9%">Expiry On</td>
	              <td width="11%">Subscription</td>
	              <td width="11%">&nbsp;</td>
	  </tr>
                <?php
				
					$rs=mysql_query("select * from soe_membership where mem_id=".$_GET['id']." and payment='paid' order by paydate") or die(mysql_error());
				while($row=mysql_fetch_array($rs))
				{
					extract($row);
						$rs1=mysql_query("select * from soe_stores where sto_id=".$sto_id) or die(mysql_error());
						$row1=mysql_fetch_array($rs1);
						$storename=$row1['store_name'];
						$diff=$row1['diff'];
						
						if($loc_id>0)
							$storename.=' (New Location )';
						

						$rs1=mysql_query("select * from soe_packages where packageid=".$packageid) or die(mysql_error());
						$row1=mysql_fetch_array($rs1);
						$packagename=$row1['name'];
					
				?>
					<tr class="tbl_text">
						<td><?php echo $storename; ?></td>
						<td><?php echo $packagename; ?></td>
						<td>$<?php echo $price_exc_vat; ?></td>
	                    <td>$<?php echo $vat; ?></td>
	                    <td>$<?php echo $total; ?></td>
	                    <td><?php echo $payment; ?></td>
	                    <td><?php echo date('F d, Y',$paydate); ?></td>
	                    <td><?php echo date('F d, Y',$expire); ?></td>
	                    <td><?php echo $subscription; ?></td>
	                    <td><a href="advpackages2.php?memshipid=<?php echo $row['memshipid']; ?>&amp;stoid=<?php echo $row['sto_id']; ?>&diff=<?php echo $diff; ?>&memberid=<?php echo $_GET['id']; ?>">Switch Package</a></td>
	  </tr>
                <?php
				}
				?>
			</form>
		</table>
</div>
	<?php include("bottom.php"); ?>