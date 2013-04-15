<?php include("top.php");
$msg='';
if($_POST['hfld']==1)
{
	foreach($_POST['checkbox'] as $key=>$value) 
	{
		$s="update soe_banners set status='1' where bnr_id=".$value;
//		echo $s;
		mysql_query($s) or die(mysql_error());
	} 
}


if($_POST['hfld']==2)
{
	foreach($_POST['checkbox'] as $key=>$value) 
	{
		mysql_query("update soe_banners set status='0' where bnr_id=".$value) or die(mysql_error());
	} 
}

if($_POST['hfld']==3)
{
	foreach($_POST['checkbox'] as $key=>$value) 
	{
		$rs=mysql_query('delete from soe_banners where bnr_id='.$value) or die(mysql_error());
	} 
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
		
		<table width="95%" border="0" cellpadding="0" cellspacing="0" align="center">		
			<tr>
				<td class="header">Banners</td>
			</tr>
			
			<tr><td class="height">&nbsp;</td></tr>
		</table>		
		
		<table width="95%" border="0" cellpadding="0" cellspacing="1" align="center">
<form name="site_banners" method="post" action="">

				<input type="hidden" name="page" value="1" />
				
				<tr class="tableheader1">
				  <td width="18%"><input type="hidden" name="hfld" id="hfld" /></td>
					<td width="8%">Title</td>
					<td width="26%">Position</td>
					<td width="20%">Type</td>
					<td width="14%">Status</td>
					<td width="14%">Clicks</td>
					<td width="14%">Action</td>
				</tr>
                <?php
				$rs=mysql_query("select * from soe_banners");
				while($row=mysql_fetch_array($rs))
				{
					extract($row);
					if($status==1)
						$a='active';
					else
						$a='inactive';
				?>
					<tr class="tbl_text">
						<td><input type="checkbox" name="checkbox[]" id="checkbox[]" value="<?php echo $bnr_id; ?>" /></td>
						<td><?php echo $title; ?></td>
						<td><?php echo $position; ?></td>
						<td><?php echo $type; ?></td>
						<td><?php echo $a; ?></td>
						<td><?php echo $clicks; ?></td>
						<td><a href="addbannermanage.php?id=<?php echo $bnr_id; ?>">
                        <img src="images/edit.gif" alt="edit" title="click to edit" /></a></td>			
					</tr>
                <?php
				}
				?>
								
				<tr class="tblrow">
					<td align="center" valign="middle" class="tac_ptb"><a href="javascript: selactiv(3,'delete');"><img src="images/delete.gif" alt="edit" border="0" align="absmiddle" title="click to delete" /></a>&nbsp;<a href="javascript: selactiv(1,'activate');"><img src="images/do-publish.png" alt="edit" border="0" align="absmiddle" title="click to active" /></a>&nbsp;<a href="javascript: selactiv(2,'deactivate');"><img src="images/do-unpublish.png" alt="edit" border="0" align="absmiddle" title="click to inactive" /></a></td>

			      <td colspan="8" class="tac_ptb"><button type="button" onclick="javascript: location.href='addbannermanage.php';" class="button">Add New Banner</button></td>
			    </tr>
			</form>
		</table>
</div>

	<script>
function selactiv(d,msg)
{
	var chks = document.getElementsByName('checkbox[]');
	var x = 0;
	var n = 0;
	for(i=0;i<chks.length;i++)
	{
		if(chks[i].checked)
		{
			x=chks[i].value;
			n++;
		}
	}

if(n==0)
	alert("Select a record to "+msg);
else
{
	ans=confirm('Are you sure to '+msg+" ? ");
	if(ans==true)
	{
	document.site_banners.hfld.value=d;
	document.site_banners.submit();
	}
}
}
	</script>
	<?php include("bottom.php"); ?>