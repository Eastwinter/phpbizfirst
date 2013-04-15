<?php include("header.php"); 

if($_GET['action']=='del')
{
	mysql_query("delete from soe_savesearch where id=".$_GET['id']);
}

?>
<?php include("left3.php");?>  
  <div id="content_area_mid_inner1">
  <div>
    <h2>Saved Search</h2>
  </div>
  <div class="border1">
    <table width="95%" border="1" cellpadding="5" cellspacing="1" align="center" >
      <tr class="tableheader1">
        <td width="43%">Date</td>
        <td width="32%">Title</td>
        <td width="17%">&nbsp;</td>
        <td width="8%">Delete</td>
      </tr>
      <?php
 	 		$s="select * from soe_savesearch where memid=".$_SESSION['memberid']." order by date";
		  $rs=mysql_query($s) or die(mysql_error());
		  
		  while($row=mysql_fetch_array($rs))
		  {
		   
		  ?>
      <tr class="tbl_text">
        <td><?php echo $row['date']; ?></td>
        <td><?php echo $row['title']; ?></td>
        <td><a href="viewsearch.php?id=<?php echo $row['id']; ?>">View Search</a></td>
        <td><a onclick="javascript: ans=confirm('Are you sure to delete?'); if(ans==true) { location.href='advsavedsearches.php?id=<?php echo $row['id']; ?>&action=del'; } "><img src="images/delete.png" alt="" border="0" /></a></td>
      </tr>
      <?php
				}
				?>
    </table>
  </div>
  </div>
  <div id="content_area_right"><?php echo showbanners("right");?></div>
  <div class="clear"></div>
  <!-- Content Area End -->
  <div class="hei"></div>
  <!-- Footer Area Start -->
<?php include("footer.php");?>