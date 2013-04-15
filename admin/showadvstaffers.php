<?php include("top.php");
$msg='';

function correctprivileges($id)
{
	$rs=mysql_query("select * from soe_members where mem_id=".$id);
	$row=mysql_fetch_array($rs);
	$priv=$row['privileges'];
	if($priv!='')
	{
		if(substr($priv,0,1)==',')
			$priv=substr($priv,1);
		if(strpos($priv,",")>0)
			$arr=explode(",", $priv);
		else
			$arr[0]=$priv;
		
		$arr1=array();
		for($i=0,$j=0;$i<count($arr);$i++)
		{
			if($arr[$i]!='')
			{
				$arr1[$j++]=$arr[$i];
			}
		}
		$s=implode(",",$arr1);
		return $s;
	}
}

if($_GET['s']==1)
{
	$e=explode("-",$_GET['v']);
	$s="update soe_members set privileges=concat(privileges,',".$e[1]."') where mem_id=".$e[0];
	mysql_query($s) or die(mysql_error().'<br />'.$s);
	$n=correctprivileges($e[0]);
	//echo "<br />****".$n;
	$s="update soe_members set privileges='".$n."' where mem_id=".$e[0];
	mysql_query($s) or die(mysql_error().'<br />'.$s);
}

if($_GET['s']==2)
{
	$e=explode("-",$_GET['v']);
	$s="update soe_members set privileges=replace(privileges,'".$e[1]."','') where mem_id=".$e[0];
	mysql_query($s) or die(mysql_error().'<br />'.$s);
	$n=correctprivileges($e[0]);
	$s="update soe_members set privileges='".$n."' where mem_id=".$e[0];
	mysql_query($s) or die(mysql_error().'<br />'.$s);	
}


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
	foreach($_POST['checkbox'] as $key=>$value) 
	{
		$rs=mysql_query('select * from soe_members where mem_id='.$value) or die(mysql_error());
		$row=mysql_fetch_array($rs);
		$email=$row['email'];
		$rs=mysql_query("delete from soe_verification where email='".$email."'") or die(mysql_error());
	
		$rs=mysql_query('delete from soe_members where mem_id='.$value) or die(mysql_error());
		$rs=mysql_query('delete from soe_stores where mem_id='.$value) or die(mysql_error());
		$rs=mysql_query('update soe_shoe set mem_id=1 where mem_id='.$value) or die(mysql_error());
		
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
				<td class="header"><?php
				
					echo 'I.C. Staffers';
				?></td>
			</tr>
			
			<tr>
			  <td class="height">&nbsp;</td>
			</tr>
		</table>		
		
		<table width="95%" border="0" cellpadding="0" cellspacing="1" align="center">
<form name="site_banners" method="post" action="">

				<input type="hidden" name="page" value="1" />
				
				
           
                <tr class="tableheader1">
				  <td width="4%"><input type="hidden" name="hfld" id="hfld" /></td>
				  <td width="14%">Name</td>
				  <td width="22%">Email</td>
				  <td width="10%">Status</td>
				  <td width="12%">Created On</td>
				  <td width="34%">Privileges</td>
				  <td width="4%">Action</td>
	  </tr>
                <?php
					$rs=mysql_query("select * from soe_members where member_type='staff' order by mem_id desc") or die(mysql_error());
				while($row=mysql_fetch_array($rs))
				{
					extract($row);
					if($banned==1 and $first_name!='' and $last_name!='')
						$a='banned';
					elseif($banned==1 and $first_name=='' and $last_name=='')
						$a='inactive';
					else
						$a='active';
					if($privileges!='')
					{
					
					if(substr($privileges,0,1)==',')
						$privileges=substr($privileges,1);
			
					if(strpos($privileges,",")>0)
						$arr=explode(",", $privileges);
					else
						$arr[0]=$privileges;
					}
					else
						$arr[0]='&nbsp;';
					
					//print_r($arr);
					if(in_array('More Marketing',$arr))
						$chk1='checked';
					else
						$chk1='';

					if(in_array('Edit Profile',$arr))
						$chk2='checked';
					else
						$chk2='';

					if(in_array('My Stores',$arr))
						$chk3='checked';
					else
						$chk3='';

					if(in_array('Edit Inventory',$arr))
						$chk4='checked';
					else
						$chk4='';

					if(in_array('Purchase Lot',$arr))
						$chk5='checked';
					else
						$chk5='';

					if(in_array('SB Database',$arr))
						$chk6='checked';
					else
						$chk6='';

					if(in_array('Feedback',$arr))
						$chk7='checked';
					else
						$chk7='';

					if(in_array('Statistics',$arr))
						$chk8='checked';
					else
						$chk8='';
												
				?>
					<tr class="tbl_text">
						<td><input type="checkbox" name="checkbox[]" id="checkbox[]" value="<?php echo $mem_id; ?>" /></td>
						<td><?php echo $first_name." ".$last_name; ?></td>
						<td><?php echo $email; ?></td>
						<td><?php echo $a; ?></td>
						<td><?php echo date('F d, Y',$joined); ?></td>
						<td align="left" valign="middle"><p align="left">
<input type="checkbox" name="checkbox1" id="checkbox1" value="<?php echo $mem_id; ?>-More Marketing" onclick="javascript: setprivilege(this);" <?php echo $chk1 ;?> />
More Marketing<br />
<input type="checkbox" name="checkbox2" id="checkbox2" value="<?php echo $mem_id; ?>-Edit Profile" onclick="javascript: setprivilege(this);" <?php echo $chk2 ;?>  />
Edit Profile<br />
<input type="checkbox" name="checkbox3" id="checkbox3" value="<?php echo $mem_id; ?>-My Stores" onclick="javascript: setprivilege(this);"  <?php echo $chk3 ;?> />
My Stores<br />
<input type="checkbox" name="checkbox4" id="checkbox4" value="<?php echo $mem_id; ?>-Edit Inventory" onclick="javascript: setprivilege(this);" <?php echo $chk4 ;?>  />
Edit Inventory<br />
<input type="checkbox" name="checkbox5" id="checkbox5" value="<?php echo $mem_id; ?>-SB Database" onclick="javascript: setprivilege(this);"  <?php echo $chk6 ;?> />
SB Database<br />
<input type="checkbox" name="checkbox6" id="checkbox6" value="<?php echo $mem_id; ?>-Purchase Lot" onclick="javascript: setprivilege(this);"  <?php echo $chk5 ;?> />
Purchase Lot<br />
<input type="checkbox" name="checkbox7" id="checkbox7" value="<?php echo $mem_id; ?>-Feedback" onclick="javascript: setprivilege(this);"  <?php echo $chk7 ;?> />
Feedback<br />
<input type="checkbox" name="checkbox8" id="checkbox8" value="<?php echo $mem_id; ?>-Statistics" onclick="javascript: setprivilege(this);"  <?php echo $chk8 ;?> /> 
Statistics
<br />
					        </p>					  </td>
						<td><a href="addadvstaff.php?id=<?php echo $mem_id; ?>&t=<?php echo $_GET['t']; ?>">
                        <img src="images/edit.gif" alt="edit" border="0" title="click to edit" /></a>&nbsp;&nbsp;                        </td>			
	  </tr>
                <?php
				}
				
				?>
                
                
                
								
				<tr class="tblrow">
					<td colspan="9" align="center" valign="middle" class="tac_ptb"><a href="javascript: selactiv(3,'delete');"><img src="images/delete.gif" alt="edit" border="0" align="absmiddle" title="click to delete" /></a>&nbsp;&nbsp;<a href="javascript: selactiv(1,'BAN');"><img src="images/do-unpublish.png" alt="edit" border="0" align="absmiddle" title="click to BAN" /></a>&nbsp;&nbsp;<a href="javascript: selactiv(2,'activate');"><img src="images/do-publish.png" alt="edit" border="0" align="absmiddle" title="click to Activate" /></a>&nbsp;&nbsp;
					  <button type="button" onclick="javascript: location.href='addadvstaff.php';" class="button">Add New Staffer</button>
					</td>
		        </tr>
			</form>
		</table>
</div>

	<script>
	
function setprivilege(obj)
{
	v=obj.value;
	if(obj.checked==true)
		location.href="showadvstaffers.php?s=1&v="+v;

	if(obj.checked==false)
		location.href="showadvstaffers.php?s=2&v="+v;

}

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