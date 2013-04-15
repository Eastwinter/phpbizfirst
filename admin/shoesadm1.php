<?php
include("top.php");
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
		$rs=mysql_query('delete from soe_shoecolors where soe_id='.$value) or die(mysql_error());
	} 
}


if($_POST['hfld']==4)
{
	//$rs=mysql_query('update soe_shoe set featured=0') or die(mysql_error());
	foreach($_POST['checkbox'] as $key=>$value) 
	{
		//$rs=mysql_query('update soe_shoe set featured=0') or die(mysql_error());	
		$rs=mysql_query('update soe_shoe set featured=1 where soe_id='.$value) or die(mysql_error());
	} 
}

if($_POST['hfld']==8)
{
	//$rs=mysql_query('update soe_shoe set featured=0') or die(mysql_error());
	foreach($_POST['checkbox'] as $key=>$value) 
	{
		//$rs=mysql_query('update soe_shoe set featured=0') or die(mysql_error());	
		$rs=mysql_query('update soe_shoe set featured=0 where soe_id='.$value) or die(mysql_error());
	} 
}


if($_POST['hfld']==6)
{
	foreach($_POST['checkbox'] as $key=>$value) 
	{
		$rs=mysql_query("update soe_shoe set email='',mem_id=1,added='".strtotime(date('Y-m-d'))."',active='1' where soe_id=".$value) or die(mysql_error());
	} 
}



if($_POST['hfld']==5)
{
	foreach($_POST['checkbox'] as $key=>$value) 
	{
		$rs=mysql_query("select * from soe_shoe where soe_id=".$value);
		$row=mysql_fetch_array($rs);
		mysql_query("insert into soe_banned set banvalue='".$row['email']."'");
		$rs=mysql_query('delete from soe_shoe where soe_id='.$value) or die(mysql_error());
		$rs=mysql_query('delete from soe_shoecolors where soe_id='.$value) or die(mysql_error());
	} 
}

if($_POST['memtype']!='')
{
	$memtype=$_POST['memtype'];
	$_GET['curpage']=1;
}
elseif($_GET['memtype']!='')
	$memtype=$_GET['memtype'];
else
	$memtype='adm';
	

if($_POST['stat']!='')
{
	$stat=$_POST['stat'];
	$_GET['curpage']=1;
}
elseif($_GET['stat']!='')
	$stat=$_GET['stat'];
else
	$stat='1';

//print_r($_POST);
?>
<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: medium;
}
-->
</style>


	
	
		<script type="text/javascript">
$().ready(function()
{
	$("#object").animate({ 
		top: "0px"
	  }, 2000 ).fadeOut(11111);
});
</script>

<link rel="stylesheet" href="../style.css" type="text/css" />
<link rel="stylesheet" href="admin.css" type="text/css" />
<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: medium;
}


	body{
		padding:0px;
		margin:0px;
		font-family: Verdana,Tahoma,Sans-Serif; 
		background-color:#C0C0C0;
		background-image:none;
	}

-->
</style>


	
	
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
				<td class="style1">Shoes Database&nbsp;&nbsp;&nbsp; (<a href="shoesadm.php?memtype=<?php echo $memtype; ?>">Click Here To View Grid</a>)</td>
		  </tr>
			<tr>
			  <td class="style1">
                <form action="" method="post" name="selfrm">  
              <span class="style1">
              Select : 
			  </span>
			  
<select name="memtype" class="style1" id="memtype" onchange="javascript: document.selfrm.submit();">
			      <option value="adm" <?php if($memtype=='adm') { ?> selected="selected" <?php } ?> >SB Database</option>
			      <option value="adv" <?php if($memtype=='adv') { ?> selected="selected" <?php } ?> >Shoes added by Advertisers</option>
			      <option value="mem" <?php if($memtype=='mem') { ?> selected="selected" <?php } ?> >Shoes added by Members</option>
      <option value="guest" <?php if($memtype=='guest') { ?> selected="selected" <?php } ?> >Shoes added by Guests</option>
		        </select>
                
                
				  <?php
				  if($memtype!='guest')
				  {
				  ?>
                <select name="stat" class="style1" id="stat" onchange="javascript: document.selfrm.submit();">
			      <option value="1" <?php if($stat=='1') { ?> selected="selected" <?php } ?> >Active</option>
			      <option value="0" <?php if($stat=='0') { ?> selected="selected" <?php } ?> >Inactive</option>
		        </select>
                <?php
				}
				?>
              </form>		      </td>
		  </tr>
			
			<tr><td class="height">&nbsp;</td></tr>
		</table>		
		
		<table width="95%" border="0" cellpadding="0" cellspacing="1" align="center">
<form name="site_banners" method="post" action="">

				<input type="hidden" name="page" value="1" />
                <input type="hidden" name="memtype" value="<?php echo $memtype; ?>" />
				
				<tr class="tableheader1">
				  <td width="7%"><input type="hidden" name="hfld" id="hfld" /></td>
				  <td width="2%">ID</td>
				  <td width="11%">Featured</td>
				  <td width="20%">Name</td>
				  <td width="5%">Price</td>
				  <td width="14%">Added By</td>
				  <td width="8%">Added On</td>
				  <td width="8%">Status</td>
				  <td width="8%">&nbsp;</td>
				  <td width="8%">&nbsp;</td>
				  <td width="9%">Action</td>
	  </tr>
                <?php
				
		if($memtype=='guest')
			$sql="select * from soe_shoe where email!='' order by soe_id desc";
		else
			$sql="select * from soe_shoe where mem_id in (select mem_id from soe_members where member_type='".$memtype."')  and active='".$stat."' order by soe_id desc";
			

		$rs=mysql_query($sql) or die(mysql_error());	
		$totrec=mysql_num_rows($rs);
		$totpages=ceil($totrec/15);
		if($_GET['curpage']=='')
			$curpage=1;
		else
			$curpage=$_GET['curpage'];
		$start=($curpage-1)*15;	
		$sql=$sql." limit ".$start.",15";
		$rs=mysql_query($sql) or die(mysql_error());	

				while($row=mysql_fetch_array($rs))
				{
					extract($row);
					if($active=='1')
						$a='active';
					else
						$a='inactive';
					
					if($featured=='1')
						$b='Yes';
					else
						$b='No';
						$rs1=mysql_query("select * from soe_members where mem_id=".$mem_id) or die(mysql_error());
						$row1=mysql_fetch_array($rs1);
					if($memtype=='adm')
						$nm='Administrator';
					if($memtype=='adv')	
						$nm='<a href="addadv.php?id='.$row1['mem_id'].'" >'.$row1['first_name']." ".$row1['last_name'].'</a>';	

					if($memtype=='mem')	
						$nm='<a href="addmem.php?id='.$row1['mem_id'].'" >'.$row1['first_name']." ".$row1['last_name'].'</a>';	
						
				?>
					<tr class="tbl_text">
					  <td><input type="checkbox" name="checkbox[]" id="checkbox[]" value="<?php echo $soe_id; ?>" /></td>
					  <td><?php echo $soe_id; ?></td>
					  <td><?php echo $b; ?></td>
					  <td><?php echo $name; ?></td>
					  <td><?php echo $price; ?></td>
					  <td><?php echo $nm; ?></td>
					  <td><?php echo date('F d, Y',$added); ?></td>
					  <td><?php echo $a; ?></td>
					  <td><a href="shoecolors.php?soeid=<?php echo $soe_id; ?>">SHOE COLORS</a></td>
					  <td><a href="shoesadvreviews.php?id=<?php echo $soe_id; ?>">Reviews</a></td>
					  <td><a href="addshoeadm.php?id=<?php echo $soe_id; ?>"> <img src="images/edit.gif" alt="edit" border="0" title="click to edit" /></a></td>
					</tr>
                <?php
				}
				?>
								
				<tr class="tblrow">
				  <td colspan="13" align="left" valign="middle" class="tac_ptb">
                  <?php
				  if($memtype=='guest')
				  {
				  ?>
                  <table width="100%" border="0" cellpadding="5" cellspacing="5">
                    <tr>
                      <td align="center" valign="middle"><a href="javascript: selactiv(3,'delete');"><img src="images/delete.gif" alt="edit" border="0" align="absmiddle" title="click to delete" /></a></td>
                      <td align="center" valign="middle"><button type="button" onclick="javascript: selactiv(6,' add to SB DB');" class="button">Add To SB Database</button></td>
                      <?php
					  if($memtype=='guest')
					  {
					  ?>
                      <td align="center" valign="middle"><button type="button" onclick="javascript: selactiv(5,' Ban the email');" class="button">Ban The Email</button></td>
                      <?php
					  }
					  ?>
                    </tr>
                  </table>
                  <?php
				  }
				  else
				  {
				  ?>
                  <table width="100%" border="0" cellpadding="2" cellspacing="2">
                    <tr>
                      <td width="4%" align="center" valign="middle"><a href="javascript: selactiv(3,'delete');"><img src="images/delete.gif" alt="edit" border="0" align="absmiddle" title="click to delete" /></a></td>
                      <td width="5%" align="center" valign="middle"><a href="javascript: selactiv(1,'activate');"><img src="images/do-publish.png" alt="edit" border="0" align="absmiddle" title="click to active" /></a></td>
                      <td width="7%" align="center" valign="middle"><a href="javascript: selactiv(2,'deactivate');"><img src="images/do-unpublish.png" alt="edit" border="0" align="absmiddle" title="click to inactive" /></a></td>
                      <td width="19%" align="center" valign="middle"><button type="button" onclick="javascript: location.href='addshoeadm.php';" class="button">Add New Shoes</button></td>
                      <td width="28%" align="center" valign="middle"><button type="button" onclick="javascript: selactiv(4,'make featured');" class="button">Make Featured
                            (Home Page)</button>                      </td>
                      <td width="28%" align="center" valign="middle"><button type="button" onclick="javascript: selactiv(8,'remove from featured');" class="button">Remove from  Featured <br />
                        (Home Page)</button></td>
                    </tr>
                  </table>
                  <?php
				  }
				  ?>                  </td>
	  </tr>
				
				<tr class="tblrow">
				  <td colspan="13" align="left" valign="middle" class="tac_ptb"> <?php
			 if($totpages>1)
			 {
			 ?>
             <div class="feedbuttons">
                  <p class="buttons">
                  
                   <?php 
		  if($curpage>1)
		  	$l='shoesadm1.php?curpage='.($curpage-1)."&memtype=".$memtype."&stat=".$stat;
		   else
		  	$l='shoesadm1.php?curpage='.($curpage)."&memtype=".$memtype."&stat=".$stat;
		  ?> 
                  <a href="<?php echo $l; ?>"> Previous </a> &nbsp;&nbsp;
                  
              <?php 
		  if($curpage<$totpages)
		  	$l='shoesadm1.php?curpage='.($curpage+1)."&memtype=".$memtype."&stat=".$stat;
		   else
		  	$l='shoesadm1.php?curpage='.($curpage)."&memtype=".$memtype."&stat=".$stat;
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