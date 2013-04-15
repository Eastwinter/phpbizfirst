<?php include("header.php"); 
if($_GET['action']=='del')
{
	mysql_query("update soe_shoe set mem_id=1 where soe_id=".$_GET['id']) or die(mysql_error());
	
}

?>

  
   <?php include("left2.php"); ?>
  <div id="content_area_mid_inner">
    <div>
      <h2>My Shoes</h2>
    </div>
    <div class="border1">
      <table width="100%" border="1" cellpadding="5" cellspacing="1" align="center" >
                    
                      <tr class="tableheader1">
                        
                        
                        <td width="49%">Name</td>
                        
                        <td width="18%">&nbsp;</td>
                        <td width="12%">Edit</td>
                        <td width="9%">Publish</td>
                        <td width="12%">Delete</td>
                      </tr>
                      <?php
		  	
		
	  		  $s="select * from soe_shoe where mem_id=".$_SESSION['memberid']."";

		  $rs=mysql_query($s) or die(mysql_error());
		  
		  while($row=mysql_fetch_array($rs))
		  {
		  
			if($row['active']==1)
			{
				$str='<img src="images/published.png"  />';
			}			
			else
			{
			    $str='<img src="images/unpublished.png"  />';
			}
		  ?>
                      <tr class="tbl_text">
                       
                        <td><?php echo $row['name']; ?></td>
                        
                        <td><a href="shoecolors.php?soeid=<?php echo $row['soe_id']; ?>"><strong>SHOE COLORS</strong></a></td>
                        <td><a href="addshoes.php?id=<?php echo $row['soe_id']; ?>"><img src="images/edit.png" alt="" border="0" /></a></td>
                        
                        <td><?php echo $str; ?></td>
                        <td><a onclick="javascript: ans=confirm('Are you sure to delete?'); if(ans==true) { location.href='memshoes.php?id=<?php echo $row['soe_id']; ?>&action=del&stoid=<?php echo $_GET['stoid']; ?>'; } "><img src="images/delete.png" alt="" border="0" /></a></td>
                      </tr>
                 <?php
				 }
				 ?>     
                      
                    </form>
            </table>
    </div>
  </div>
  <div id="content_area_right"> <?php echo showbanners("right"); ?></div>
  <div class="clear"></div>
  <!-- Content Area End -->
  <div class="hei">&nbsp;</div>
  <!-- Footer Area Start -->
 <?php include("footer.php"); ?>