<?php include("top.php");

if($_POST['hfld']==3)
{
	foreach($_POST['checkbox'] as $key=>$value) 
	{
		$rs=mysql_query('delete from soe_newsletter_users where id='.$value) or die(mysql_error());
	} 
}


?>
				<div class="body" id="mk_height">
		
		<table width="95%" border="0" cellpadding="0" cellspacing="0" align="center">		
			<tr>
				<td class="header">Newsletter Mailing List</td>
			</tr>
			
			<tr><td class="height">&nbsp;</td></tr>
		</table>		
		
		<table width="95%" border="0" cellpadding="0" cellspacing="1" align="center">
<form name="site_banners" method="post" action="">

				<input type="hidden" name="page" value="1" />
				
				<tr class="tableheader1">
				  <td width="4%"><input type="hidden" name="hfld" id="hfld" /></td>
					<td width="23%">Zipcode</td>
					<td width="17%">Gender</td>
				  <td width="29%">Email</td>
				  <td width="14%">Date</td>
			    </tr>
                <?php
				$rs=mysql_query("select * from soe_newsletter_users");
				while($row=mysql_fetch_array($rs))
				{
					extract($row);
					
				?>
					<tr class="tbl_text">
						<td><input type="checkbox" name="checkbox[]" id="checkbox[]" value="<?php echo $id; ?>" /></td>
						<td><?php echo $zipcode; ?></td>
						<td><?php echo $gender; ?></td>
						<td><?php echo $email; ?></td>
					    <td><?php echo date('F d, Y',strtotime($date)); ?></td>
		            </tr>
                <?php
				}
				?>
								
				<tr class="tblrow">
				  <td align="center" valign="middle" class="tac_ptb"><a href="javascript: selactiv(3);"><img src="images/delete.gif" alt="edit" border="0" align="absmiddle" title="click to delete" /></a>&nbsp;</td>
				  <td colspan="6" class="tac_ptb"></td>
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
	alert("Select a record to delete.");
else
{
	ans=confirm('Are you sure to delete?');
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