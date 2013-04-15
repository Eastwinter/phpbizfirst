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


<script src="../js/main.js" type="text/javascript"></script>

<style>
#preview{
	position:absolute;
	border:1px solid #ccc;
	background:#333;
	padding:1px;
	display:none;
	color:#ccc;
	}

.zoomPreload{
	display:none !important;
}	
</style>


<style>
	body{
		padding:0px;
		margin:0px;
		font-family: Verdana,Tahoma,Sans-Serif; 
		background-color:#C0C0C0;
		background-image:none;
	}

	#searchresultdt
	{
	float:left;
	width:120px;
	height:150px;
	min-height:150px;
	max-height:300px;
	margin-left:10px;
	}
	
	#searchresultpage
	{
	width:780px;
	height:100%;
	font-family:Geneva, Arial, Helvetica, sans-serif;
	}

	#searchresultpageno
	{
	width:580px;
	float:left;
	margin-top:0px;
	margin-left:15px;
	}

</style>


				<div class="body1" id="mk_height">
		
		<table width="95%" border="0" cellpadding="0" cellspacing="0" align="center">		
<tr>
				<td class="style1">Shoes Database&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (<a href="shoesadm1.php?memtype=<?php echo $memtype; ?>">Click Here To View Tabular</a>)</td>
		  </tr>
			<tr>
			  <td class="left_menu1">
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
				
				<tr class="tblrow">
				  <td colspan="3" align="left" valign="middle" class="tac_ptb">
                  <?php
				  if($memtype=='guest')
				  {
				  ?>
                  <table width="100%" border="0" cellpadding="5" cellspacing="5">
                    <tr>
                      <td align="center" valign="middle"><a href="javascript: selactiv(3,'Delete');"><img src="images/delete.gif" alt="edit" border="0" align="absmiddle" title="click to delete" /></a></td>
                      <td align="center" valign="middle"><button type="button" onclick="javascript: selactiv(6,'Add To SB Database');" class="button">Add To SB Database</button></td>
                      <?php
					  if($memtype=='guest')
					  {
					  ?>
                      <td align="center" valign="middle"><button type="button" onclick="javascript: selactiv(5,'Ban The Email');" class="button">Ban The Email</button></td>
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
                      <td width="28%" align="center" valign="middle"><button type="button" onclick="javascript: selactiv(4,' featured');" class="button">Make Featured
                            (Home Page)</button>
                      </td>
                      <td width="28%" align="center" valign="middle"><button type="button" onclick="javascript: selactiv(8,' not featured');" class="button">Remove from  Featured <br />
                        (Home Page)</button></td>
                      <td width="9%" align="center" valign="middle"><button type="button" onclick="javascript: selactiv(7,' reviews');" class="button">Shoe Reviews</button></td>
                    </tr>
                  </table>
                  <?php
				  }
				  ?>
                  </td>
	  </tr>
				<tr class="tableheader1">
				  <td><input type="hidden" name="hfld" id="hfld" /></td>
	  </tr>
				<tr class="tableheader1">
				  <td>
                  
                  
                  <div class="feedback">
                    <?php 
		if($memtype=='guest')
			$sql="select * from soe_shoe where email!='' order by soe_id desc";
		else
			$sql="select * from soe_shoe where mem_id in (select mem_id from soe_members where member_type='".$memtype."' ) and active='".$stat."' order by soe_id desc";
			

		$rs=mysql_query($sql) or die(mysql_error());	
		$totrec=mysql_num_rows($rs);
		$totpages=ceil($totrec/24);
		if($_GET['curpage']=='')
			$curpage=1;
		else
			$curpage=$_GET['curpage'];
		$start=($curpage-1)*24;	
		$sql=$sql." limit ".$start.",24";
		//echo $sql;
		$rs=mysql_query($sql) or die(mysql_error());	
?>
<div id="searchresultpage">
                <?php 
			$n=1;
          	 while($row=mysql_fetch_array($rs))
             {
			 	extract($row);
			 	$ph="../uploads/shoe_photo/"."thumb98_".getcol($row['soe_id']);
				
				$str='<a href="addshoeadm.php?id='.$soe_id.'">'.$row['name'].'</a>';
				$rs1=mysql_query("select * from soe_brand where brn_id=".$row['brn_id']);
				if(mysql_num_rows($rs1)>0)
				{
					$row1=mysql_fetch_array($rs1);
					$str.='<br />'.$row1['name'];
				}
								
				if($row['price']>0)
				{
					$str.='<br /><span style="color:#FF0000">$'.$row['price'].'</span>';
				}

				if($row['featured']==1)
				{
					$str.='<br /><span style="color:#FF0000">FEATURED</span>';
				}
				if(getcol($row['soe_id'])=='')
					continue;
$ph1="../uploads/shoe_photo/".getcol($row['soe_id']);
        ?>
                <div id="searchresultdt">
                  <div class="optionbtn">
                    <input type="checkbox" value="<?php echo $row['soe_id']; ?>" name="checkbox[]"  id="checkbox[]" />
                  </div>
                  <div class="searchimg"><a href="addshoeadm.php?id=<?php echo $soe_id; ?>" rel="<?php echo $ph1; ?>" class="preview" ><img src="<?php echo $ph; ?>" alt="" border="0" width="98" height="55" /></a></div>
                  <div class="searchimgdt">
                    <center>
                      <?php echo $str; ?>
                      <?php
						$reviewrs=mysql_query("select * from soe_reviews where fldapprove=1 and fldshoeid=".$row['soe_id']." order by flddate desc");
						$reviewrsrow=mysql_fetch_array($reviewrs);
						echo '<br />';
						if($reviewrsrow['overall']>0)
						{
						for($i=1;$i<=$reviewrsrow['overall'];$i++)
							echo '<img src="../images/staryellow.jpg" alt="" border="0" />';						
						}
						else
						{
							for($i=1;$i<=5;$i++)
							echo '<img src="../images/stargrey.jpg" alt="" border="0" />';	
						}
						if($memtype=='guest')
						{
							echo $row['email'];				
							echo '<br /><a href="'.$row['link'].'" target="_blank">'.$row['link']."</a>";				
						}
					?>
                    </center>
                  </div>
                </div>
                <?php
		  }
		  if($totrec==0)
		  	echo '<strong>No matching records found for your search criteria</strong>';
		  ?>
              </div><br />
<br />
<br />
                  </div>                  </td>
	  </tr>
               
								
				<tr class="tblrow">
				  <td colspan="3" align="left" valign="middle" class="tac_ptb"><div id="searchresultpageno">
                    <div id="pagenocol1">
                      <?php 
		  if($curpage>1)
		  	$l='shoesadm.php?curpage='.($curpage-1).'&memtype='.$memtype.'&stat='.$stat;
		   else
		  	$l='shoesadm.php?curpage='.($curpage).'&memtype='.$memtype.'&stat='.$stat;
		  ?>
                    <a href="<?php echo $l; ?>#pagination"><img src="../images/previous.jpg" alt="" width="32" height="32" border="0" /></a></div>
				    <div id="pagenocol2">
                      <?php
		  
	    if($curpage<10)
		  {
		  	$i=1;
		  }
		  else
		   $i=$curpage-3;
		  
		  for($j=1;$j<=10 and $i<=$totpages; $i++ ,$j++)
		  {
		  ?>
                      <div id="pagenos">
                        <p id="pageno"><a href="shoesadm.php?curpage=<?php echo $i; ?>&amp;memtype=<?php echo $memtype; ?>&stat=<?php echo $stat; ?>#pagination"><?php echo $i; ?></a></p>
                      </div>
				      <?php
		  }
		  ?>
                    </div>
				    <?php 
		  if($curpage<$totpages)
		  	$l='shoesadm.php?curpage='.($curpage+1).'&memtype='.$memtype.'&stat='.$stat;
		   else
		  	$l='shoesadm.php?curpage='.($curpage).'&memtype='.$memtype.'&stat='.$stat;
		  ?>
                    <div id="pagenocol3"><a href="<?php echo $l; ?>#pagination"><img src="../images/next1.jpg" alt="" border="0" /></a> </div>
			      </div></td>
	  </tr>
				<tr class="tblrow">
				  <td colspan="3" align="left" valign="middle" class="tac_ptb">
                  <?php
				  if($memtype=='guest')
				  {
				  ?>
                  <table width="100%" border="0" cellpadding="5" cellspacing="5">
                    <tr>
                      <td align="center" valign="middle"><a href="javascript: selactiv(3,'Delete');"><img src="images/delete.gif" alt="edit" border="0" align="absmiddle" title="click to delete" /></a></td>
                      <td align="center" valign="middle"><button type="button" onclick="javascript: selactiv(6,'Add to SB DB');" class="button">Add To SB Database</button></td>
                      <?php
					  if($memtype=='guest')
					  {
					  ?>
                      <td align="center" valign="middle"><button type="button" onclick="javascript: selactiv(5,'Ban the email');" class="button">Ban The Email</button></td>
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
                      (Home Page)</button>
                      </td>
                      
                      
                      <td width="28%" align="center" valign="middle"><button type="button" onclick="javascript: selactiv(8,'remove from featured');" class="button">Remove from  Featured <br />
                      (Home Page)</button></td>
                      <td width="9%" align="center" valign="middle"><button type="button" onclick="javascript: selactiv(7,'View shoe reviews');" class="button">Shoe Reviews</button></td>
                    </tr>
                  </table>
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
	if(d==7 && n>1)
	{
		alert("Please select one shoe to view the reviews");
		return false;
	}
		
	if(d==7)
	{
		location.href='shoesadvreviews.php?id='+x;
		return true;
	}
	
	
	ans=confirm('Are you sure to '+msg+ "?");
	if(ans==true)
	{
	document.site_banners.hfld.value=d;
	document.site_banners.submit();
	}
}
}
	</script>
	<?php include("bottom.php"); ?>