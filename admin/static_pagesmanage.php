<?php include("top.php");

if($_POST['hfld']==1)
{
	foreach($_POST['checkbox'] as $key=>$value) 
	{
		$s="update soe_static_pages set status='1' where pag_id=".$value;
//		echo $s;
		mysql_query($s) or die(mysql_error());
	} 
}


if($_POST['hfld']==2)
{
	foreach($_POST['checkbox'] as $key=>$value) 
	{
		mysql_query("update soe_static_pages set status='0' where pag_id=".$value) or die(mysql_error());
	} 
}

if($_POST['hfld']==3)
{
	foreach($_POST['checkbox'] as $key=>$value) 
	{
		$rs=mysql_query('delete from soe_static_pages where pag_id='.$value) or die(mysql_error());
	} 
}

if($_POST['hfld']==0)
{
	$rs=mysql_query("select * from soe_static_pages");
	while($row=mysql_fetch_array($rs))
	{
		extract($row);
		$nm='order'.$pag_id;
		$v=$_POST[$nm];
		mysql_query("update soe_static_pages set odering=".$v." where pag_id=".$pag_id);
	}
}

?>
				<div class="body" id="mk_height">
		
		<table width="95%" border="0" cellpadding="0" cellspacing="0" align="center">		
			<tr>
				<td class="header">Static Pages</td>
			</tr>
			
			<tr><td class="height">&nbsp;</td></tr>
		</table>		
		
		<table width="95%" border="0" cellpadding="0" cellspacing="1" align="center">
<form name="site_banners" method="post" action="">

				<input type="hidden" name="page" value="1" />
				
				<tr class="tableheader1">
				  <td width="22%"><input type="hidden" name="hfld" id="hfld" /></td>
					<td width="8%">Page ID</td>
					<td width="14%">Title</td>
				  <td width="26%">Show URL</td>
				  <td width="14%">Status</td>
				  <td width="5%">Order</td>
				  <td width="11%">Action</td>
				</tr>
                <?php
				$rs=mysql_query("select * from soe_static_pages");
				while($row=mysql_fetch_array($rs))
				{
					extract($row);
					if($status==1)
						$a='active';
					else
						$a='inactive';
				
				?>
					<tr class="tbl_text">
						<td><input type="checkbox" name="checkbox[]" id="checkbox[]" value="<?php echo $pag_id; ?>" /></td>
						<td><?php echo $pag_id; ?></td>
						<td><?php echo $page_title; ?></td>
						<td><?php echo $page_url; ?></td>
						<td><?php echo $a; ?></td>
					  <td><input name="order<?php echo $pag_id; ?>" type="text" id="order<?php echo $pag_id; ?>" size="10" maxlength="5" value="<?php echo $odering; ?>" /></td>
						<td><a href="addstatic_pagesmanage.php?id=<?php echo $pag_id; ?>">
                        <img src="images/edit.gif" alt="edit" title="click to edit" /></a></td>			
					</tr>
                <?php
				}
				?>
								
				<tr class="tblrow">
				  <td align="center" valign="middle" class="tac_ptb"><a href="javascript: selactiv(3,'delete');"><img src="images/delete.gif" alt="edit" border="0" align="absmiddle" title="click to delete" /></a>&nbsp;<a href="javascript: selactiv(1,'activate');"><img src="images/do-publish.png" alt="edit" border="0" align="absmiddle" title="click to active" /></a>&nbsp;<a href="javascript: selactiv(2,'deactivate');"><img src="images/do-unpublish.png" alt="edit" border="0" align="absmiddle" title="click to inactive" /></a></td>
				  <td colspan="8" class="tac_ptb">
                  <button type="button" onclick="javascript: selactiv1();" class="button">Change Order</button>&nbsp;&nbsp;&nbsp;<button type="button" onclick="javascript: location.href='addstatic_pagesmanage.php';" class="button">Create New Page</button></td>
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
	ans=confirm('Are you sure to '+msg + "?");
	if(ans==true)
	{
	document.site_banners.hfld.value=d;
	document.site_banners.submit();
	}
}
}

function selactiv1()
{
	document.site_banners.hfld.value=0;
	document.site_banners.submit();
}
	</script>
    	<?php include("bottom.php"); ?>