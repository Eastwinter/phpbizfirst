<?php include("top.php");
$msg='';
if($_POST['hfld']==1)
{
	foreach($_POST['checkbox'] as $key=>$value) 
	{
		$s="update soe_storelocations set active='1' where loc_id=".$value;
	//	echo $s;
		mysql_query($s) or die(mysql_error());
	} 
}


if($_POST['hfld']==2)
{
	foreach($_POST['checkbox'] as $key=>$value) 
	{
		mysql_query("update soe_storelocations set active='0' where loc_id=".$value) or die(mysql_error());
	} 
}

if($_POST['hfld']==3)
{
	foreach($_POST['checkbox'] as $key=>$value) 
	{
		$rs=mysql_query('delete from soe_storelocations where loc_id='.$value) or die(mysql_error());
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

 <?php
		  $s="select * from soe_stores where sto_id=".$_GET['id'];
		  $rs=mysql_query($s) or die(mysql_error());
		  $row=mysql_fetch_array($rs);
		  $advid=$row['mem_id'];
		  
			
		  ?>
				<div class="body" id="mk_height">
		
		<table width="95%" border="0" cellpadding="0" cellspacing="0" align="center">		
			<tr>
				<td class="header">Store Locations - <?php echo $row['store_name']; ?></td>
		  </tr>
			
			<tr><td class="height">&nbsp;</td></tr>
		</table>		
		<?php
		 $n=0;
		  $s="select * from soe_storelocations where sto_id=".$_GET['id'];
		  $rs=mysql_query($s) or die(mysql_error());
		  if(mysql_num_rows($rs)>0)
		  {
		  ?>
		<table width="95%" border="0" cellpadding="0" cellspacing="1" align="center">
<form name="site_banners" method="post" action="">

				<input type="hidden" name="page" value="1" />
				
				<tr class="tableheader1">
				  <td width="4%"><input type="hidden" name="hfld" id="hfld" /></td>
				  <td width="11%">Address</td>
				  <td width="11%">City</td>
				  <td width="10%">State</td>
			      <td width="12%">Country</td>
			      <td width="12%">Action</td>
	  </tr>
                <?php
		 
		  while($row=mysql_fetch_array($rs))
		  {
		  		$n++;
		  		$rs1=mysql_query("select * from soe_geo_countries where con_id=".$row['con_id']);
				$row1=mysql_fetch_array($rs1);
				$cname=$row1['name'];

		  		$rs1=mysql_query("select * from soe_geo_states where sta_id=".$row['sta_id']);
				$row1=mysql_fetch_array($rs1);
				$stname=$row1['name'];

		  		$rs1=mysql_query("select * from soe_geo_cities where cty_id=".$row['cty_id']);
				$row1=mysql_fetch_array($rs1);
				$ctname=$row1['name'];

		  ?>
					<tr class="tbl_text">
						<td><input type="checkbox" name="checkbox[]" id="checkbox[]" value="<?php echo $row['loc_id']; ?>" /></td>
						<td><span class="msg" style="text-align:left; "><?php echo $row['address']; ?></span></td>
						<td><?php echo $ctname; ?></td>
						<td><?php echo $stname; ?></td>
						<td><?php echo $cname; ?></td>
						<td><a href="addlocationadv.php?id=<?php echo $row['loc_id']; ?>&stoid=<?php echo $_GET['id']; ?>">
                        <img src="images/edit.gif" alt="edit" border="0" title="click to edit" /></a></td>			
					</tr>
                <?php
				}
				?>
								
				<tr class="tblrow">
					<td colspan="8" align="left" valign="middle" class="tac_ptb"><div align="left"><a href="javascript: selactiv(3);"><img src="images/delete.gif" alt="edit" border="0" align="absmiddle" title="click to delete" /></a>
					 &nbsp;&nbsp;&nbsp;&nbsp; 
                     <?php
					 $arr=getpack($advid,$_GET['id']);
					if($n<($arr['location']-1))
					{
						?>
                     
                     <button type="button" onclick="javascript: location.href='addlocationadv.php?stoid=<?php echo $_GET['id']; ?>&advid=<?php echo $advid; ?>';" class="button">ADD NEW LOCATION</button>
                     <?php
					 }
					 ?>
					</div></td>
		        </tr>
			</form>
		</table>
        <?php
		}
		else
			echo '&nbsp;&nbsp;&nbsp;&nbsp;No Additional Locations Added<br />
<br />
<br />
 &nbsp;&nbsp;&nbsp;&nbsp; <button type="button" onclick="javascript: location.href=\'addlocationadv.php?stoid='.$_GET['id'].'&advid='.$advid.'\';" class="button">ADD NEW LOCATION</button>
';
		?>
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
	ans=confirm('Are you sure to delete?');
	if(ans==true)
	{
	document.site_banners.hfld.value=d;
	document.site_banners.submit();
	}
}
}
	</script>
	<?php include("bottom.php"); ?>