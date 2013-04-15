<?php include("top.php");
$msg='';
if($_POST['hfld']==1)
{
	foreach($_POST['checkbox'] as $key=>$value) 
	{
		$s="update soe_members set banned='1' where mem_id=".$value;
//		echo $s;
		mysql_query($s) or die(mysql_error());
		
		$s="update soe_members set banned='1' where assignedto=".$value;
//		echo $s;
		mysql_query($s) or die(mysql_error());
	} 
}


if($_POST['hfld']==2)
{
	foreach($_POST['checkbox'] as $key=>$value) 
	{
		mysql_query("update soe_members set banned='0' where mem_id=".$value) or die(mysql_error());
		$s="update soe_members set banned='0' where assignedto=".$value;
//		echo $s;
		mysql_query($s) or die(mysql_error());
	} 
}

if($_POST['hfld']==4)
{
	foreach($_POST['checkbox'] as $key=>$value) 
	{
		mysql_query("update soe_members set freeze='1' where mem_id=".$value) or die(mysql_error());
		$s="update soe_members set banned='1' where assignedto=".$value;
//		echo $s;
		mysql_query($s) or die(mysql_error());
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
<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: x-small;
	font-weight: bold;
}
-->
</style>


	
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
				<td class="header"><?php
				if($_GET['t']=='v')
					echo 'Verified Advertisers';
				else
					echo 'Unverified Advertisers';
				?></td>
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
				  <td width="5%"><input type="hidden" name="hfld" id="hfld" /></td>
				  <td width="18%">Name</td>
				  <td width="27%">Email</td>
				  <td width="12%">Status</td>
				  <td width="14%">Freeze/Unfreeze</td>
				  <td width="14%">Joined On</td>
				  <td width="14%">Membership</td>
				  <td width="10%">Action</td>
	  </tr>
                <?php
					$rs=mysql_query("select * from soe_members where verified='1' and member_type='adv'") or die(mysql_error());
			//	else
				//	$rs=mysql_query("select * from soe_members where verified='0' and member_type='adv'") or die(mysql_error());
				while($row=mysql_fetch_array($rs))
				{
					extract($row);
					if($banned==1 and $first_name!='' and $last_name!='')
						$a='banned';
					elseif($banned==1 and $first_name=='' and $last_name=='')
						$a='inactive';
					else
						$a='active';
						
					if($freeze==1)
						$b='<a href="freezeadv.php?id='.$mem_id.'&v=0">Unfreeze</a>';
					else
						$b='<a href="freezeadv.php?id='.$mem_id.'&v=1">Freeze</a>';
				?>
					<tr class="tbl_text">
						<td><input type="checkbox" name="checkbox[]" id="checkbox[]" value="<?php echo $mem_id; ?>" /></td>
						<td><?php echo $first_name." ".$last_name; ?></td>
						<td><?php echo $email; ?></td>
						<td><?php echo $a; ?></td>
						<td class="style1"><?php echo $b; ?></td>
						<td><?php echo date('F d, Y',$joined); ?></td>
						<td>
                        <?php
						if($_GET['t']=='v')
						{
						?>
                        <a href="showadvmshipdetails.php?id=<?php echo $mem_id; ?>">Details</a>
                        <?php
						}
						?>                        </td>
						<td><a href="addadv.php?id=<?php echo $mem_id; ?>&t=<?php echo $_GET['t']; ?>">
                        <img src="images/edit.gif" alt="edit" title="click to edit" /></a>&nbsp;&nbsp;
                        <a href="storesadv1.php?advid=<?php echo $mem_id; ?>">
                                             
                        <img src="images/add.gif" width="22" height="22" title="Click to add store" /></a>                        </td>			
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
				  <td width="5%"><input type="hidden" name="hfld" id="hfld" /></td>
				  
				  <td width="27%">Email</td>
				  <td width="12%">Status</td>
				  <td width="14%">Joined On</td>
				 
				  <td width="10%">&nbsp;</td>
				  <td width="10%">code</td>
	  </tr>
                <?php
		$rs=mysql_query("select * from soe_verification where email not in (select email from soe_members) and member_type='adv'") or die(mysql_error());
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
						
						<td>&nbsp;</td>
						<td><?php echo $code; ?>                        </td>			
	  </tr>
                <?php
				}
				}
				?>
								
				<tr class="tblrow">
					<td colspan="10" align="center" valign="middle" class="tac_ptb"><a href="javascript: selactiv(3,'delete');"><img src="images/delete.gif" alt="edit" border="0" align="absmiddle" title="click to delete" /></a>
                    
                    <?php 
					if($_GET['t']=='v')
					{
					?>
                    <a href="javascript: selactiv(1,'BAN');"><img src="images/do-unpublish.png" alt="edit" border="0" align="absmiddle" title="click to BAN" /></a>&nbsp;<a href="javascript: selactiv(2,'ACTIVATE');"><img src="images/do-publish.png" alt="edit" border="0" align="absmiddle" title="click to Active" /></a>&nbsp;
                    <?php
					}
					?>                    </td>
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