<?php include("top.php");
?>

	
	<div class="body" id="mk_height">
<?php
if($msg!='')
{
?>	
<script type="text/javascript">
$().ready(function()
{
	//first slide down and blink the alert box
	$("#object").animate({ 
		top: "0px"
	  }, 2000 ).fadeOut(11111);
});
</script>

<div id="object" class="message_box">
			<span id="error"><?php echo $msg; ?></span>
	</div>		
 <?php
 }
 ?>
				
		
		<table width="95%" border="0" cellpadding="0" cellspacing="0" align="center">		
			<tr>
				<td class="header">Downgrad Package Requests</td>
			</tr>
			
			<tr>
			  <td class="height">&nbsp;</td>
		  </tr>
			
			<tr>
			  <td class="height">&nbsp;</td>
		  </tr>
		</table>		
		
	  <table width="95%" border="0" cellpadding="0" cellspacing="1" align="center">
<form name="site_banners" method="post" action="">

				<input type="hidden" name="page" value="1" />
				
				<tr class="tableheader1">
				  <td width="7%">Date of Request</td>
				  <td width="14%">Advertiser</td>
				  <td width="17%">Store</td>
				  <td width="25%">From Package</td>
				  <td width="20%">To Package</td>
				  <td width="17%">Action</td>
	  </tr>
                <?php
				
					$rs=mysql_query("select * from soe_downgrades where status='open' order by date desc") or die(mysql_error());
				while($row=mysql_fetch_array($rs))
				{
					extract($row);
					$rs1=mysql_query("select * from soe_members where mem_id=".$mem_id) or die(mysql_error().'---1');
					if(mysql_num_rows($rs1)<=0)
						continue;
					$row1=mysql_fetch_array($rs1);
					$em=$row1['email'];

					$rs1=mysql_query("select * from soe_stores where sto_id=".$sto_id) or die(mysql_error().'---2');
					if(mysql_num_rows($rs1)<=0)
						continue;

					$row1=mysql_fetch_array($rs1);
					$sm=$row1['store_name'];

					$rs1=mysql_query("select * from soe_membership where memshipid=".$memshipid) or die(mysql_error().'---3');
					if(mysql_num_rows($rs1)<=0)
						continue;

					$row1=mysql_fetch_array($rs1);
					$pack1=$row1['packageid'];

					$rs1=mysql_query("select * from soe_packages where packageid=".$pack1) or die(mysql_error().'---4');
					if(mysql_num_rows($rs1)<=0)
						continue;

					$row1=mysql_fetch_array($rs1);
					$pm1=$row1['name'];

					$rs1=mysql_query("select * from soe_packages where packageid=".$packageid) or die(mysql_error().'---5');
					if(mysql_num_rows($rs1)<=0)
						continue;

					$row1=mysql_fetch_array($rs1);
					$pm2=$row1['name'];


				?>
					<tr class="tbl_text">
					  <td><?php echo date('m/d/Y',strtotime($date)); ?></td>
						<td><?php echo $em; ?></td>
						<td><?php echo $sm; ?></td>
						<td><?php echo $pm1; ?></td>
						<td><?php echo $pm2; ?></td>
						<td><a href="downgradesadvdetails.php?memshipid=<?php echo $memshipid; ?>&package=<?php echo $packageid; ?>&diff=<?php echo $diff; ?>&id=<?php echo $downid; ?>">Details</a>&nbsp;</td>			
	  </tr>
                <?php
				}
				?>
			</form>
		</table>
</div>
	<?php include("bottom.php"); ?>