<?php include("top.php"); ?>

	
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
				<td class="header">Reminder Section</td>
		  </tr>
			
			<tr><td class="height">&nbsp;</td></tr>
		</table>		
		
		<table width="95%" border="0" cellpadding="0" cellspacing="1" align="center">
<form name="site_banners" method="post" action="">

				<input type="hidden" name="page" value="1" />
				
				<tr class="tableheader1">
				  <td width="4%">Store-ID</td>
				  <td width="7%">Memship ID</td>
				  <td width="21%">Store Name</td>
				  <td width="13%">Advertiser</td>
				  <td width="9%">Added On</td>
				  <td width="9%">Expiry Date</td>
				  <td width="9%">Package</td>
				  <td width="10%">Days Left</td>
				  <td width="15%">Action</td>
	  </tr>
                <?php
					 $cond='';
					$ds =strtotime(date("Y-m-d") . " +1 month");
			  		$cond=" ( expire<='".$ds."'";

					$ds =strtotime(date("Y-m-d") . " +2 weeks");
					$cond.=" or expire<='".$ds."'";

					$ds =strtotime(date("Y-m-d") . " +1 week");
			  		$cond.=" or expire<='".$ds."'";

					$ds =strtotime(date("Y-m-d") . " +1 day");
			  		$cond.=" or expire<='".$ds."')";

				$s="select * from soe_membership where payment='paid' and packageid=1 and ".$cond." ORDER BY memshipid desc";
				//echo($s);
				$rs=mysql_query($s) or die(mysql_error());
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
						
						$rs3=mysql_query("select * from soe_stores where sto_id=".$sto_id);
						$row3=mysql_fetch_array($rs3);
						
						$dt=date('Y-m-d',$expire);
						$days=dateDiff($dt,date('Y-m-d'));
				?>
					<tr class="tbl_text">
						<td><?php echo $sto_id; ?></td>
						<td><?php echo $memshipid; ?></td>
						<td><?php echo $row3['store_name']; ?></td>
						<td><?php echo $nm; ?></td>
						<td><?php echo date('F d, Y',$paydate); ?></td>
						<td><?php echo date('F d, Y',$expire); ?></td>
						<td><?php echo $row2['name']; ?></td>
						<td><?php echo $days; ?> Days</td>
						<td><button type="button" onclick="javascript: location.href='sendreminder.php?advid=<?php echo $row1['mem_id']; ?>&memshipid=<?php echo $memshipid; ?>&days=<?php echo $days; ?>';" class="button">Send Reminders</button></td>			
					</tr>
                <?php
				}
				?>
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