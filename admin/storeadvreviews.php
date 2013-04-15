<?php include("top.php");
$msg='';
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
				<td class="header">Shoes Reviews</td>
			</tr>
			
			<tr><td class="height">&nbsp;</td></tr>
		</table>		
		
		<table width="95%" border="0" cellpadding="0" cellspacing="1" align="center">
<form name="site_banners" method="post" action="">

				<input type="hidden" name="page" value="1" />
				
				<tr class="tableheader1">
				  <td width="4%"><input type="hidden" name="hfld" id="hfld" /></td>
					<td width="5%">ID</td>
					<td width="12%">Added On</td>
					<td width="10%">Added By</td>
					<td width="61%">Comments</td>
					<td width="8%">Status</td>
				</tr>
                <?php
				
					$rs=mysql_query("select * from soe_reviews where sto_id=".$_GET['id']." and fldtype='review' order by flddate desc") or die(mysql_error());
				while($row=mysql_fetch_array($rs))
				{
					extract($row);
					if($fldapprove=='1')
						$a='active';
					else
						$a='inactive';
						$rs1=mysql_query("select * from soe_members where mem_id=".$flduserid) or die(mysql_error());
						$row1=mysql_fetch_array($rs1);
						if($row1['member_type']=='mem')
							$nm='<a href="addmem.php?id='.$row1['mem_id'].'" >'.$row1['first_name']." ".$row1['last_name'].'</a>';
						if($row1['member_type']=='adv')
							$nm='<a href="addadv.php?id='.$row1['mem_id'].'" >'.$row1['first_name']." ".$row1['last_name'].'</a>';

				?>
					<tr class="tbl_text">
						<td><input type="checkbox" name="checkbox[]" id="checkbox[]" value="<?php echo $fldid; ?>" /></td>
						<td><?php echo $fldid; ?></td>
						<td><?php echo date('F d, Y',strtotime($flddate)); ?></td>
						<td><?php echo $nm; ?></td>
						<td><?php echo $fldcomments; ?></td>
						<td><?php echo $a; ?></td>
					</tr>
                <?php
				}
				?>
								
				<tr class="tblrow">
					<td colspan="8" align="left" valign="middle" class="tac_ptb"><a href="javascript: selactiv(3);"><img src="images/delete.gif" alt="edit" border="0" align="absmiddle" title="click to delete" />&nbsp;</a><a href="javascript: selactiv(1);"><img src="images/do-publish.png" alt="edit" border="0" align="absmiddle" title="click to active" /></a>&nbsp;<a href="javascript: selactiv(2);"><img src="images/do-unpublish.png" alt="edit" border="0" align="absmiddle" title="click to inactive" /></a></td>
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
	alert("Select a record");
else
{
	ans=confirm('Are you sure?');
	if(ans==true)
	{
	document.site_banners.hfld.value=d;
	document.site_banners.submit();
	}
}
}
	</script>
	<?php include("bottom.php"); ?>