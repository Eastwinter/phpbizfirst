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
				<td class="header">Addon Puchase Details</td>
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
				  <td width="7%">Date of Purchase</td>
				  <td width="14%">Advertiser</td>
				  <td width="25%">Addon Title</td>
				  <td width="20%">Price</td>
	  </tr>
                <?php
				
					$rs=mysql_query("select * from soe_addonmembers where paymentstatus='paid' and addonid in (select addonid from soe_addons) and memid in (select mem_id from soe_members) order by date desc") or die(mysql_error());
				while($row=mysql_fetch_array($rs))
				{
					extract($row);
					$rs1=mysql_query("select * from soe_members where mem_id=".$memid) or die(mysql_error());
					$row1=mysql_fetch_array($rs1);
					$em=$row1['email'];

					$rs1=mysql_query("select * from soe_addons where addonid=".$addonid) or die(mysql_error());
					$row1=mysql_fetch_array($rs1);
					$sm=$row1['name'];
					$pm2=$row1['price'];




				?>
					<tr class="tbl_text">
					  <td><?php echo date('m/d/Y',strtotime($date)); ?></td>
						<td><?php echo $em; ?></td>
						<td><?php echo $sm; ?></td>
						<td>$ <?php echo $pm2; ?></td>
	  </tr>
                <?php
				}
				?>
			</form>
		</table>
</div>
	<?php include("bottom.php"); ?>