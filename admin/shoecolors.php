<?php include("top.php");
$msg='';
if($_POST['hfld']==3)
{
	foreach($_POST['checkbox'] as $key=>$value) 
	{
		$rs=mysql_query('delete from soe_shoecolors where id='.$value) or die(mysql_error());
	} 
}


?>

	
	
		<script type="text/javascript">
$().ready(function()
{
	$("#object").animate({ 
		top: "0px"
	  }, 2000 ).fadeOut(11111);
});
</script>
				<div class="body1" id="mk_height">
		
		<table width="95%" border="0" cellpadding="0" cellspacing="0" align="center">		
			<tr>
				<td class="header">Shoecolors</td>
			</tr>
			
			<tr><td class="height">&nbsp;</td></tr>
		</table>		
		
		<table width="95%" border="0" cellpadding="0" cellspacing="1" align="center">
<form name="site_banners" method="post" action="">

				<input type="hidden" name="page" value="1" />
				
				<tr class="tableheader1">
				  <td width="10%"><input type="hidden" name="hfld" id="hfld" /></td>
				  <td width="17%">Color</td>
				  <td width="6%">Action</td>
	  </tr>
                <?php
				
		$sql="select * from soe_shoecolors where soe_id=".$_GET['soeid'];
		$rs=mysql_query($sql) or die(mysql_error());	
		$totrec=mysql_num_rows($rs);
		$totpages=ceil($totrec/10);
		if($_GET['curpage']=='')
			$curpage=1;
		else
			$curpage=$_GET['curpage'];
		$start=($curpage-1)*10;	
		$sql=$sql." limit ".$start.",10";
		
		$rs=mysql_query($sql) or die(mysql_error());	

				while($row=mysql_fetch_array($rs))
				{
					extract($row);
					
						
						
				?>
					<tr class="tbl_text">
						<td><input type="checkbox" name="checkbox[]" id="checkbox[]" value="<?php echo $id; ?>" /></td>
						<td><?php echo $color; ?></td>
						<td><a href="addshoecolors.php?soeid=<?php echo $soe_id; ?>&id=<?php echo $id; ?>">
                        <img src="images/edit.gif" alt="edit" border="0" title="click to edit" /></a></td>			
	  </tr>
                <?php
				}
				?>
								
				<tr class="tblrow">
					<td colspan="5" align="left" valign="middle" class="tac_ptb">
                    <a href="javascript: selactiv(3,'delete');"><img src="images/delete.gif" alt="edit" border="0" align="absmiddle" title="click to delete" /></a>
<button type="button" onclick="javascript: location.href='addshoecolors.php?soeid=<?php echo $_GET['soeid']; ?>';" class="button">Add New Shoe Color</button>&nbsp;&nbsp;&nbsp;&nbsp;  <button type="button" onclick="javascript: location.href='shoesadm.php';" class="button">CANCEL</button></td>
		        </tr>
				<tr class="tblrow">
				  <td colspan="5" align="left" valign="middle" class="tac_ptb"> <?php
			 if($totpages>1)
			 {
			 ?>
             <div class="feedbuttons">
                  <p class="buttons">
                  
                   <?php 
		  if($curpage>1)
		  	$l='shoescolors.php?curpage='.($curpage-1);
		   else
		  	$l='shoescolors.php?curpage='.($curpage);
		  ?> 
                  <a href="<?php echo $l; ?>"> Previous </a> &nbsp;&nbsp;
                  
              <?php 
		  if($curpage<$totpages)
		  	$l='shoescolors.php?curpage='.($curpage+1);
		   else
		  	$l='shoescolors.php?curpage='.($curpage);
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