<?php include("top.php");
$msg='';
if($_POST['hfld']==1)
{
	foreach($_POST['checkbox'] as $key=>$value) 
	{
		$s="update soe_shoe set active='1' where soe_id=".$value;
	//	echo $s;
		mysql_query($s) or die(mysql_error());
	} 
}


if($_POST['hfld']==2)
{
	foreach($_POST['checkbox'] as $key=>$value) 
	{
		mysql_query("update soe_shoe set active='0' where soe_id=".$value) or die(mysql_error());
	} 
}

if($_POST['hfld']==3)
{
	foreach($_POST['checkbox'] as $key=>$value) 
	{
		$rs=mysql_query('delete from soe_shoe where soe_id='.$value) or die(mysql_error());
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
				<td class="header">Shoes Added By Advertisers</td>
			</tr>
			
			<tr><td class="height">&nbsp;</td></tr>
		</table>		
		
		<table width="95%" border="0" cellpadding="0" cellspacing="1" align="center">
<form name="site_banners" method="post" action="">

				<input type="hidden" name="page" value="1" />
				
				<tr class="tableheader1">
				  <td width="10%"><input type="hidden" name="hfld" id="hfld" /></td>
					<td width="2%">ID</td>
					<td width="23%">Name</td>
					<td width="7%">Price</td>
					<td width="20%">Added By</td>
					<td width="12%">Added On</td>
					<td width="11%">Status</td>
				    <td width="11%">&nbsp;</td>
				    <td width="11%">&nbsp;</td>
			      <td width="4%">Action</td>
	  </tr>
                <?php
				
		$sql="select * from soe_shoe where mem_id in (select mem_id from soe_members where member_type='adv')";
		$rs=mysql_query($sql) or die(mysql_error());	
		$totrec=mysql_num_rows($rs);
		$totpages=ceil($totrec/10);
		if($_GET['curpage']=='')
			$curpage=1;
		else
			$curpage=$_GET['curpage'];
		$start=($curpage-1)*10;	
		$sql=$sql." limit ".$start.",10";
		//echo $sql;
		$rs=mysql_query($sql) or die(mysql_error());
				while($row=mysql_fetch_array($rs))
				{
					extract($row);
					if($active=='1')
						$a='active';
					else
						$a='inactive';
						$rs1=mysql_query("select * from soe_members where mem_id=".$mem_id) or die(mysql_error());
						$row1=mysql_fetch_array($rs1);
						if($row1['member_type']!='adv')
							continue;
						$nm='<a href="addadv.php?id='.$row1['mem_id'].'" >'.$row1['first_name']." ".$row1['last_name'].'</a>';
				?>
					<tr class="tbl_text">
						<td><input type="checkbox" name="checkbox[]" id="checkbox[]" value="<?php echo $soe_id; ?>" /></td>
						<td><?php echo $soe_id; ?></td>
						<td><?php echo $name; ?></td>
						<td><?php echo $price; ?></td>
						<td><?php echo $nm; ?></td>
						<td><?php echo date('F d, Y',$added); ?></td>
						<td><?php echo $a; ?></td>
						<td><a href="shoecolors.php?soeid=<?php echo $soe_id; ?>">SHOE COLORS</a></td>
						<td><a href="shoesadvreviews.php?id=<?php echo $soe_id; ?>">Reviews</a></td>
						<td><a href="addshoeadm.php?id=<?php echo $soe_id; ?>">
                        <img src="images/edit.gif" alt="edit" border="0" title="click to edit" /></a></td>			
					</tr>
                <?php
				}
				?>
								
				<tr class="tblrow">
					<td colspan="12" align="left" valign="middle" class="tac_ptb"><a href="javascript: selactiv(3);"><img src="images/delete.gif" alt="edit" border="0" align="absmiddle" title="click to delete" />&nbsp;</a><a href="javascript: selactiv(1);"><img src="images/do-publish.png" alt="edit" border="0" align="absmiddle" title="click to active" /></a>&nbsp;<a href="javascript: selactiv(2);"><img src="images/do-unpublish.png" alt="edit" border="0" align="absmiddle" title="click to inactive" /></a></td>
		        </tr>
				<tr class="tblrow">
				  <td colspan="12" align="left" valign="middle" class="tac_ptb"><?php
			 if($totpages>1)
			 {
			 ?>
             <div class="feedbuttons">
                  <p class="buttons">
                  
                   <?php 
		  if($curpage>1)
		  	$l='shoesadv.php?curpage='.($curpage-1);
		   else
		  	$l='shoesadv.php?curpage='.($curpage);
		  ?> 
                  <a href="<?php echo $l; ?>"> Previous </a> &nbsp;&nbsp;
                  
              <?php 
		  if($curpage<$totpages)
		  	$l='shoesadv.php?curpage='.($curpage+1);
		   else
		  	$l='shoesadv.php?curpage='.($curpage);
		  ?>      
                  <a href="<?php echo $l; ?>"> Next </a>&nbsp;</p>
                  </div>
                <?php
				}
				?></td>
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