<?php include("top.php");
$msg='';
if($_POST['hfld']==1)
{
	foreach($_POST['checkbox'] as $key=>$value) 
	{
		$s="update soe_members set banned='1' where mem_id=".$value;
//		echo $s;
		mysql_query($s) or die(mysql_error());
	} 
}


if($_POST['hfld']==2)
{
	foreach($_POST['checkbox'] as $key=>$value) 
	{
		mysql_query("update soe_members set banned='0' where mem_id=".$value) or die(mysql_error());
	} 
}

if($_POST['hfld']==3)
{

	if(isset($_POST['checkbox']))
	{
	foreach($_POST['checkbox'] as $key=>$value) 
	{
		$rs=mysql_query('select * from soe_members where mem_id='.$value) or die(mysql_error().'---1');
		$row=mysql_fetch_array($rs);
		$email=$row['email'];
		$rs=mysql_query("delete from soe_verification where email='".$email."'") or die(mysql_error().'---2');
	
		$rs=mysql_query('delete from soe_members where mem_id='.$value) or die(mysql_error().'---3');
		$rs=mysql_query('delete from soe_stores where mem_id='.$value) or die(mysql_error().'---4');
		$rs=mysql_query('update soe_shoe set mem_id=1 where mem_id='.$value) or die(mysql_error().'---5');
		$rs=mysql_query('update soe_members set assignedto=0 where assignedto='.$value) or die(mysql_error().'---6');
		
	}
	} 
	if(isset($_POST['checkbox1']))
	{
	foreach($_POST['checkbox1'] as $key=>$value) 
	{
		$rs=mysql_query("delete from soe_verification where email='".$value."'") or die(mysql_error().'---2');
	
		
	} 
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
				<td class="header">
                 <?php
				if($_GET['t']=='v')
					echo 'Verified Members';
				else
					echo 'Unverified Members';
				?>
                </td>
			</tr>
			
			<tr><td class="height">&nbsp;</td></tr>
		</table>		
		
		<table width="95%" border="0" cellpadding="0" cellspacing="1" align="center">
<form name="site_banners" method="post" action="">

				<input type="hidden" name="page" value="1" />
				
				
                <?php
				if($_GET['t']=='v')
				{
				?>
                <tr class="tableheader1">
				  <td width="18%"><input type="hidden" name="hfld" id="hfld" /></td>
					<td width="8%">ID</td>
					<td width="26%">Name</td>
					<td width="20%">Email</td>
					<td width="14%">Status</td>
					<td width="14%">Joined On</td>
					<td width="14%">Action</td>
				</tr>
                <?php
					$rs=mysql_query("select * from soe_members where verified='1' and member_type='mem'") or die(mysql_error());
				//else
					//$rs=mysql_query("select * from soe_verification where email not in (select email from soe_members) and member_type='mem'") or die(mysql_error());
				while($row=mysql_fetch_array($rs))
				{
					extract($row);
					
					if($banned==1 and $first_name!='' and $last_name!='')
						$a='banned';
					elseif($banned==1 and $first_name=='' and $last_name=='')
						$a='inactive';
					else
						$a='active';
				?>
					<tr class="tbl_text">
						<td><input type="checkbox" name="checkbox[]" id="checkbox[]" value="<?php echo $mem_id; ?>" /></td>
						<td><?php echo $mem_id; ?></td>
						<td><?php echo $first_name." ".$last_name; ?></td>
						<td><?php echo $email; ?></td>
						<td><?php echo $a; ?></td>
						<td><?php echo date('F d, Y',$joined); ?></td>
						<td><a href="addmem.php?id=<?php echo $mem_id; ?>&t=<?php echo $_GET['t']; ?>">
                        <img src="images/edit.gif" alt="edit" border="0" title="click to edit" /></a></td>			
					</tr>
                <?php
				}
				}
				?>
                
                 <?php
				if($_GET['t']=='u')
				{
				?>
                <tr class="tableheader1">
				  <td width="18%"><input type="hidden" name="hfld" id="hfld" /></td>
					
					<td width="20%">Email</td>
					<td width="14%">Status</td>
					<td width="14%">Joined On</td>
					<td width="14%">Code</td>
				</tr>
                <?php
					
					$rs=mysql_query("select * from soe_verification where email not in (select email from soe_members) and member_type='mem'") or die(mysql_error());
				while($row=mysql_fetch_array($rs))
				{
					extract($row);
					
					if($banned==1 and $first_name!='' and $last_name!='')
						$a='banned';
					elseif($banned==1 and $first_name=='' and $last_name=='')
						$a='inactive';
					else
						$a='active';
				?>
					<tr class="tbl_text">
						<td><input type="checkbox" name="checkbox1[]" id="checkbox1[]" value="<?php echo $email; ?>" /></td>
					
						<td><?php echo $email; ?></td>
						<td><?php echo $a; ?></td>
						<td><?php echo date('F d, Y',$added); ?></td>
						<td><?php echo $code; ?></td>			
					</tr>
                <?php
				}
				}
				?>
								
				<tr class="tblrow">
					<td colspan="9" align="center" valign="middle" class="tac_ptb"><a href="javascript: selactiv(3,'delete');"><img src="images/delete.gif" alt="edit" border="0" align="absmiddle" title="click to delete" /></a>&nbsp;&nbsp;
                    
                    <?php 
					if($_GET['t']=='v')
					{
					?>
                    <a href="javascript: selactiv(1,'BAN');"><img src="images/do-unpublish.png" alt="edit" border="0" align="absmiddle" title="click to BAN" /></a>&nbsp;<a href="javascript: selactiv(2,'ACTIVATE');"><img src="images/do-publish.png" alt="edit" border="0" align="absmiddle" title="click to Active" /></a>
                    <?php
					}
					?>
                    
                    </td>
		        </tr>
			</form>
		</table>
</div>

	<script>
function selactiv(d,msg)
{
<?php
if($_GET['t']=='v')
{
?>
	var chks = document.getElementsByName('checkbox[]');
<?php
}
else
{
?>
	var chks = document.getElementsByName('checkbox1[]');
<?php
}
?>
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
	ans=confirm('Are you sure to '+msg+ " ? ");
	if(ans==true)
	{
	document.site_banners.hfld.value=d;
	document.site_banners.submit();
	}
}
}
	</script>
	<?php include("bottom.php"); ?>