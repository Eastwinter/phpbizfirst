<?php include("header.php"); 
if($_GET['action']=='del')
{
	$rs=mysql_query("select * from soe_shoe where soe_id=".$_GET['id']);
	$row=mysql_fetch_array($rs);
	if($row['addedfromsb']>0)
	{
		mysql_query("delete from soe_shoe where soe_id=".$_GET['id']);
	}
	else
	{
		mysql_query("update soe_shoe set mem_id=1 where soe_id=".$_GET['id']);
	}
	?>
    <script>
	location.href='advshoes.php?stoid=<?php echo $_GET['stoid']; ?>&locid=<?php echo $_GET['locid']; ?>';
	</script>
    <?php
	die();
	
}

if($_GET['hide']!='')
{
	if($_GET['hide']=='Y')
		mysql_query("update soe_shoe set hide=1 where soe_id=".$_GET['soeid']);
	else
		mysql_query("update soe_shoe set hide=0 where soe_id=".$_GET['soeid']);	
	?>
    <script>
	location.href='advshoes.php?stoid=<?php echo $_GET['stoid']; ?>&locid=<?php echo $_GET['locid']; ?>';
	</script>
    <?php
	die();
	
}

?>
<?php include("left3.php"); ?>  
  <div id="content_area_mid_inner2">
  <div>
    <h2>Edit Inventory</h2>
  </div>
    <div class="editinventory">
      <div class="editinfo">
                        <?php
				  
if($_GET['stoid']=='')
{
  $s="select * from soe_stores where mem_id=".$_SESSION['memberid'];
  $rs=mysql_query($s) or die(mysql_error());
  $row=mysql_fetch_array($rs);
  $n=mysql_num_rows($rs);
  $_GET['stoid']=$row['sto_id'];
}
?>
<?php
  $s="select * from soe_stores where mem_id=".$_SESSION['memberid']." order by sto_id";
  $rs=mysql_query($s) or die(mysql_error());
  if(mysql_num_rows($rs)>0)
  {
?>
 <p><b>Select Store/Location To View Inventory:</b></p>
<select name="storeid" id="storeid" onchange="javascript: fnt(this);">
<?php
  while($row=mysql_fetch_array($rs))
  {
  	$grs=mysql_query("select * from soe_geo_states where sta_id=".$row['sta_id']);
	$grsrow=mysql_fetch_array($grs);
	$state=$grsrow['name'];

  	$grs=mysql_query("select * from soe_geo_cities where cty_id=".$row['cty_id']);
	$grsrow=mysql_fetch_array($grs);
	$city=$grsrow['name'];
	if($_GET['stoid']==$row['sto_id'])
		$c='selected="selected"';
	else
		$c='';

  ?>
  <option value="<?php echo $row['sto_id']; ?>-0" <?php echo $c; ?> ><?php echo $row['store_name']; ?> - <?php echo $state; ?>, <?php echo $city; ?></option>
  <?php
  	  $rs1=mysql_query("select * from soe_storelocations where sto_id=".$row['sto_id']." order by loc_id desc");
	  while($row1=mysql_fetch_array($rs1))
	  {
	  
	$grs=mysql_query("select * from soe_geo_states where sta_id=".$row1['sta_id']);
	$grsrow=mysql_fetch_array($grs);
	$state=$grsrow['name'];

  	$grs=mysql_query("select * from soe_geo_cities where cty_id=".$row1['cty_id']);
	$grsrow=mysql_fetch_array($grs);
	$city=$grsrow['name'];
	
		if($_GET['locid']==$row1['loc_id'] and $_GET['stoid']==$row['sto_id'])
		$c='selected="selected"';
	else
		$c='';


  ?>
  <option value="<?php echo $row['sto_id']; ?>-<?php echo $row1['loc_id']; ?>" <?php echo $c; ?> ><?php echo $row['store_name']; ?> - <?php echo $state; ?>, <?php echo $city; ?></option>
  <?php
	  
	  }
  }
?>
</select>
</div>

<br class="clear">
      <div>
<?php
  
$arr=getpack($_SESSION['memberid'],$_GET['stoid']);
//print_r($arr);

		    if($_GET['stoid']>0)
			{
				$gtrs=mysql_query("select * from soe_shoe where sto_id=".$_GET['stoid']." and mem_id=".$_SESSION['memberid']);
				$n=mysql_num_rows($gtrs);
				if($n<$arr['shoes'])
				{
		?>
        <a href="addshoes1.php?stoid=<?php echo $_GET['stoid']; ?>&locid=<?php echo $_GET['locid']; ?>"  class="addnw" >
        Add New Shoe
        </a></div>
        <?php
				}
			}
		?>
      <div class="edittable">
        <table width="95%" border="1" cellpadding="5" cellspacing="1" align="center" >
                    
                      <tr class="tableheader1">
                        <td width="3%">ID</td>
                        
                        
                        <td width="29%">Name</td>
                        
                        <td width="10%">Price</td>
                        <td width="8%">Added On</td>
                        <td width="14%"><strong>Click the link to view shoe colors</strong></td>
                        <td width="8%">Reviews</td>
                        <td width="6%">Total Visits</td>
                        <td width="6%">Edit</td>
                        <td width="5%">Publish</td>
                        <td width="11%">Delete</td>
                        <td width="11%">Hidden</td>
                      </tr>
                        <?php
		  	$cond='';
			if($_GET['stoid']>0)
				$cond.=" and sto_id=".$_GET['stoid'];

			if($_GET['locid']>0)
				$cond.=" and loc_id=".$_GET['locid'];
			else
				$cond.=" and loc_id=0";
				
			  $s="select * from soe_shoe where mem_id=".$_SESSION['memberid'].$cond;
		   
		//echo $s;
		  $rs=mysql_query($s) or die(mysql_error());
		  
		  while($row=mysql_fetch_array($rs))
		  {
		  
			if($row['active']==1)
			{
				$str='<img src="images/published.png" width="20" height="20" />';
			}			
			else
			{
			    $str='<img src="images/unpublished.png" width="20" height="20" />';
			}
			
			if($row['hide']==1)
			{
				$str1='<a href="advshoes.php?soeid='.$row['soe_id'].'&stoid='.$_GET['stoid'].'&locid='.$row['locid'].'&hide=N"><img src="images/published.png" width="20" height="20" /></a>';
			}			
			else
			{
			    $str1='<a href="advshoes.php?soeid='.$row['soe_id'].'&stoid='.$_GET['stoid'].'&locid='.$row['locid'].'&hide=Y"><img src="images/unpublished.png" width="20" height="20" />';
			}
			
			$sts=mysql_query("select count(*) as cnt from soe_statistics where soe_id=".$row['soe_id']) or die(mysql_error());
			$stsrow=mysql_fetch_array($sts);
			$c=$stsrow['cnt'];
		  ?>
                      <tr class="tbl_text">
                        <td><?php echo $row['soe_id']; ?></td>
                       
                        <td><?php echo $row['name']; ?></td>
                        
                        <td><?php echo $row['price']; ?></td>
                        <td><?php echo date('d/m/Y',$row['added']); ?></td>
                        <td><a href="shoecolors1.php?soeid=<?php echo $row['soe_id']; ?>"><strong>SHOE COLORS</strong></a></td>
                        <td><a onclick="window.open('readreview1.php?id=<?php echo $row['soe_id']; ?>','','status=no,menubar=no,toolbars=no,width=800,height=500,scrollbars=yes');" >Read Reviews</a></td>
                        <td><?php echo $c; ?></td>
                        <td><a href="addshoes1.php?id=<?php echo $row['soe_id']; ?>&stoid=<?php echo $_GET['stoid']; ?>&locid=<?php echo $_GET['locid']; ?>"><img src="images/edit.png" alt="" border="0" /></a></td>
                        
                        <td><?php echo $str; ?></td>
                        <td><a href="javascript: show('<?php echo $row['soe_id']; ?>','<?php echo $_GET['stoid']; ?>','<?php echo $_GET['locid']; ?>');"><img src="images/delete.png" alt="" border="0" /></a></td>
                        <td><?php echo $str1; ?></td>
                      </tr>
                 <?php
				 }
				 ?>     
              </table>
          </div></div></div></div>
          
     <?php
	 }
	 ?>    
            
        <script>
		function show(id,stoid,locid)
		{
			ans=confirm("Are you sure to delete?");
			if(ans==true)
				location.href="advshoes.php?id="+id+"&action=del&stoid="+stoid+"&locid="+locid;
		}
		</script>  
    </div>
 
  <div class="clear"></div>
  <!-- Content Area End -->
  <div class="hei"></div>
 <script>
  function fnt(obj)
  {
  	a=obj.options.selectedIndex;
	b=obj.options[a].value;
	c=b.split("-");
	location.href="advshoes.php?stoid="+c[0]+"&locid="+c[1];
  }
  </script>
<?php include("footer.php"); ?>