<?php include("top.php");
$msg='';
if($_GET['id']>0)
{
	
		mysql_query("delete from soe_addons where addonid=".$_GET['id']);
		$_GET['id']='';
	
}
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
				<td class="header">Advertiser Addons</td>
			</tr>
			
			<tr>
			  <td class="height">&nbsp;</td>
		  </tr>
			<tr><td class="height"><button type="button" onclick="javascript: location.href='addadvaddon.php';" class="button">Add New Addon</button>
			    </td>
			</tr>
			<tr>
			  <td class="height">&nbsp;</td>
		  </tr>
		</table>		
		
		<table width="95%" border="0" cellpadding="0" cellspacing="1" align="center">
<form name="site_banners" method="post" action="">

				<input type="hidden" name="page" value="1" />
				
				<tr class="tableheader1">
				  <td width="24%">Name</td>
				  <td width="19%">Cost</td>
				  <td width="16%">Action</td>
	  </tr>
                <?php
				
					$rs=mysql_query("select * from soe_addons") or die(mysql_error());
				while($row=mysql_fetch_array($rs))
				{
					extract($row);
					
				?>
					<tr class="tbl_text">
						<td><?php echo $name; ?></td>
						<td>$<?php echo $price; ?></td>
						<td><a href="editadvaddon.php?id=<?php echo $addonid; ?>;">
                        <img src="images/edit.gif" alt="edit" border="0" title="click to edit" /></a>&nbsp;
                        <a href="javascript: show(<?php echo $addonid; ?>);"><img src="images/delete.gif" alt="edit" border="0" title="click to delete" /></a></td>			
	  </tr>
                <?php
				}
				?>
			</form>
		</table>
</div>
<script>
function show(id)
{
	ans=confirm("Are you sure to delete?");
	if(ans==true)
		location.href="showadvaddons.php?id="+id;
}
</script>
	<?php include("bottom.php"); ?>