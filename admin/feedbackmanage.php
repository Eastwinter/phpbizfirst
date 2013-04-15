<?php include("top.php");
$msg='';
mysql_query("delete from soe_reviews where fldshoeid not in (select soe_id from soe_shoe)");
if($_POST['hfld']==1)
{
	foreach($_POST['checkbox'] as $key=>$value) 
	{
		$s="update soe_reviews set fldapprove='1' where fldid=".$value;
	//	echo $s;
		mysql_query($s) or die(mysql_error());
	} 
}


if($_POST['hfld']==2)
{
	foreach($_POST['checkbox'] as $key=>$value) 
	{
		mysql_query("update soe_reviews set fldapprove='0' where fldid=".$value) or die(mysql_error());
	} 
}

if($_POST['hfld']==3)
{
	foreach($_POST['checkbox'] as $key=>$value) 
	{
		$rs=mysql_query('delete from soe_reviews where fldid='.$value) or die(mysql_error());
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
				<td class="header">Feedback For Shoes in SB Database</td>
		  </tr>
			
			<tr><td class="height">&nbsp;</td></tr>
		</table>		
		
		<table width="95%" border="0" cellpadding="0" cellspacing="1" align="center">
<form name="site_banners" method="post" action="">

				<input type="hidden" name="page" value="1" />
				
				<tr class="tableheader1">
				  <td width="3%"><input type="hidden" name="hfld" id="hfld" /></td>
					<td width="4%">ID</td>
					<td width="9%">Shoe Name</td>
					<td width="9%">Added On</td>
					<td width="8%">Added By</td>
					<td width="38%">Comments</td>
				</tr>
                <?php
				
	$rs=mysql_query("select * from soe_reviews where fldtype='feedback' order by flddate desc") or die(mysql_error());
				while($row=mysql_fetch_array($rs))
				{
					extract($row);
					
					$rs1=mysql_query("select * from soe_shoe where soe_id=".$fldshoeid);
					$row1=mysql_fetch_array($rs1);
				?>
					<tr class="tbl_text">
						<td><input type="checkbox" name="checkbox[]" id="checkbox[]" value="<?php echo $fldid; ?>" /></td>
						<td><?php echo $fldid; ?></td>
						<td><a href="../detail-id-<?php echo $fldshoeid; ?>.htm" target="_blank"><?php echo $row1['name']; ?></a></td>
						<td><?php echo date('F d, Y',strtotime($flddate)); ?></td>
						<td><?php echo $name; ?></td>
						<td><?php echo $fldcomments; ?></td>
					</tr>
                <?php
				}
				?>
								
				<tr class="tblrow">
					<td colspan="8" align="left" valign="middle" class="tac_ptb"><a href="javascript: selactiv(3);"><img src="images/delete.gif" alt="edit" border="0" align="absmiddle" title="click to delete" /></a>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		        </tr>
			</form>
		</table>
</div>

	<script>
function selactiv(d)
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
	alert("Select a record to delete");
else
{
	ans=confirm('Are you sure to delete ?');
	if(ans==true)
	{
	document.site_banners.hfld.value=d;
	document.site_banners.submit();
	}
}
}
	</script>
	<?php include("bottom.php"); ?>