<?php include("top.php");
$msg='';
if($_POST['hfld']==1)
{
	foreach($_POST['checkbox'] as $key=>$value) 
	{
		$s="update soe_stores set active='1' where sto_id=".$value;
	//	echo $s;
		mysql_query($s) or die(mysql_error());
	} 
}


if($_POST['hfld']==2)
{
	foreach($_POST['checkbox'] as $key=>$value) 
	{
		mysql_query("update soe_stores set active='0' where sto_id=".$value) or die(mysql_error());
	} 
}

if($_POST['hfld']==3)
{
	foreach($_POST['checkbox'] as $key=>$value) 
	{
		$rs=mysql_query('delete from soe_stores where sto_id='.$value) or die(mysql_error());
		mysql_query("update soe_shoe set sto_id=0 and mem_id=1 where sto_id=".$value) or die(mysql_error());
		$rs=mysql_query('delete from soe_storelocations where sto_id='.$value) or die(mysql_error());
		$rs=mysql_query('delete from soe_membership where sto_id='.$value) or die(mysql_error());
		
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
				<td class="header">Stores</td>
		  </tr>
			
			<tr><td class="height">&nbsp;</td></tr>
		</table>		
		
		<table width="95%" border="0" cellpadding="0" cellspacing="1" align="center">
<form name="site_banners" method="post" action="">

				<input type="hidden" name="page" value="1" />
				
				<tr class="tableheader1">
				  <td width="4%"><input type="hidden" name="hfld" id="hfld" /></td>
				  <td width="5%">ID</td>
				  <td width="14%">Business Name</td>
				  <td width="17%">Store Name</td>
				  <td width="16%">Advertiser</td>
				  <td width="11%">Added On</td>
				  <td width="11%">Package</td>
				  <td width="10%">Status</td>
			      <td width="12%">&nbsp;</td>
			      <td width="12%">Action</td>
	  </tr>
                <?php
				
					$rs=mysql_query("select * from soe_stores where sto_id in (select sto_id from soe_membership where payment='paid') ORDER BY sto_id desc") or die(mysql_error());
				while($row=mysql_fetch_array($rs))
				{
					extract($row);
					if($active=='1')
						$a='active';
					else
						$a='inactive';
						$rs1=mysql_query("select * from soe_members where mem_id=".$mem_id) or die(mysql_error());
						$row1=mysql_fetch_array($rs1);
						if($row1['member_type']!='adv' and $row1['member_type']!='adm')
							continue;
						$nm='<a href="addadv.php?id='.$row1['mem_id'].'" >'.$row1['first_name']." ".$row1['last_name'].'</a>';

						$rs2=mysql_query("select * from soe_packages where packageid in (select packageid from soe_membership where sto_id=".$sto_id." order by memshipid)") or die(mysql_error());
						$row2=mysql_fetch_array($rs2);
						
						$rs3=mysql_query("select * from soe_membership where sto_id=".$sto_id);
						$row3=mysql_fetch_array($rs3);
				?>
					<tr class="tbl_text">
						<td rowspan="2"><input type="checkbox" name="checkbox[]" id="checkbox[]" value="<?php echo $sto_id; ?>" /></td>
						<td rowspan="2"><?php echo $sto_id; ?></td>
						<td rowspan="2"><?php echo stripslashes($business_name); ?></td>
						<td rowspan="2"><?php echo stripslashes($store_name); ?></td>
						<td rowspan="2"><?php echo $nm; ?></td>
						<td rowspan="2"><?php echo date('F d, Y',$row3['paydate']); ?></td>
						<td rowspan="2"><?php echo $row2['name']; ?></td>
						<td rowspan="2"><?php echo $a; ?></td>
						<td height="30" align="center" valign="middle"><a href="locationsadv.php?id=<?php echo $row['sto_id']; ?>" class="style1">Locations</a><br /></td>
						<td rowspan="2"><a href="editstoreadv.php?id=<?php echo $sto_id; ?>&advid=<?php echo $row1['mem_id']; ?>">
                        <img src="images/edit.gif" alt="edit" title="click to edit" /></a></td>			
					</tr>
					<tr class="tbl_text">
					  <td height="30" align="center" valign="middle"><a href="orderhistoryadv.php?stoid=<?php echo $row['sto_id']; ?>" class="style1">Order History</a></td>
	  </tr>
                <?php
				}
				?>
								
				<tr class="tblrow">
					<td colspan="12" align="left" valign="middle" class="tac_ptb"><a href="javascript: selactiv(3,'delete');"><img src="images/delete.gif" border="0" align="absmiddle" title="click to delete" /></a>&nbsp;<a href="javascript: selactiv(1,'activate');"><img src="images/do-publish.png" alt="edit" border="0" align="absmiddle" title="click to active" /></a>&nbsp;<a href="javascript: selactiv(2,'deactivate');"><img src="images/do-unpublish.png" alt="edit" border="0" align="absmiddle" title="click to inactive" />
					  
					</a></td>
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
	ans=confirm('Are you sure to '+msg+" ?");
	if(ans==true)
	{
	document.site_banners.hfld.value=d;
	document.site_banners.submit();
	}
}
}
	</script>
	<?php include("bottom.php"); ?>