<?php include("header.php"); 
if($_GET['action']=='del')
{
	mysql_query("delete from soe_reviews where fldid=".$_GET['id']) or die(mysql_error());
	
}

?>

  
   <?php include("left2.php"); ?>
  <div id="content_area_mid_inner">
    <div>
      <h2> My Wishlist</h2>
    </div>
    <div class="border1">
      <table width="100%" border="1" cellpadding="5" cellspacing="1" align="center" >
        <tr class="tableheader1">
          <td width="80%">Name</td>
          <td width="11%">Delete</td>
        </tr>
        <?php
 	 		$s="select * from soe_reviews where flduserid=".$_SESSION['memberid']." and fldtype='save'";
		  $rs=mysql_query($s) or die(mysql_error());
		  
		  while($row=mysql_fetch_array($rs))
		  {
		    $s="select * from soe_shoe where soe_id=".$row['fldshoeid']." and active='1' and hide=0";
			$rs1=mysql_query($s) or die(mysql_error());
			if(mysql_num_rows($rs1)>0)
				$row1=mysql_fetch_array($rs1);
			else
				continue;
		  ?>
        <tr class="tbl_text">
          <td><a href="detail-id-<?php echo $row['fldshoeid']; ?>.htm"><?php echo $row1['name']; ?></a></td>
          <td><a onclick="javascript: ans=confirm('Are you sure to delete?'); if(ans==true) { location.href='memwishlist.php?id=<?php echo $row['fldid']; ?>&action=del'; }"><img src="images/delete.png" alt="" border="0" /></a></td>
        </tr>
        <?php
				}
				?>
      </table>
    </div>
  </div>
  <div id="content_area_right"> <?php echo showbanners("right"); ?></div>
  <div class="clear"></div>
  <!-- Content Area End -->
  <div class="hei">&nbsp;</div>
  <!-- Footer Area Start -->
 <?php include("footer.php"); ?>