<?php include("header.php"); 
if($_GET['action']=='del')
{
	$rs=mysql_query("select * from soe_shoecolors where id=".$_GET['id']);
	$row=mysql_fetch_array($rs);
	for($i=0;$i<=6;$i++)
	{
		if($i==0)
			$fld='logo';
		else
			$fld='logo'.$i;
		$file=$row[$fld];
		if($file!='')
		unlink('uploads/shoe_photo/'.$file);
	}
	mysql_query("delete from soe_shoecolors where id=".$_GET['id']);
	
}

?>

  
   <?php include("left2.php"); ?>
  <div id="content_area_mid_inner">
    <div>
      <h2> Shoe Colors</h2>
    </div>
    <div class="border1">
      <table width="100%" border="1" cellpadding="5" cellspacing="1" align="center" >
                    
                      <tr class="tableheader1">
                        
                        
                        <td width="49%">Color</td>
                        
                        <td width="12%">Edit</td>
                        <td width="12%">Delete</td>
                      </tr>
                      <?php
		  	
		
		$sql="select * from soe_shoecolors where soe_id=".$_GET['soeid'];
		$rs=mysql_query($sql) or die(mysql_error());			  
		  while($row=mysql_fetch_array($rs))
		  {
		  
		  ?>
                      <tr class="tbl_text">
                       
                        <td><?php echo $row['color']; ?></td>
                        
                        <td><a href="addshoecolor.php?id=<?php echo $row['id']; ?>&soeid=<?php echo $_GET['soeid']; ?>"><img src="images/edit.png" alt="" border="0" /></a></td>
                        
                        <td><a onclick="javascript: ans=confirm('Are you sure to delete?'); if(ans==true) { location.href='shoecolors.php?id=<?php echo $row['id']; ?>&soeid=<?php echo $row['soe_id']; ?>&action=del'; }"><img src="images/delete.png" alt="" border="0" /></a></td>
                      </tr>
                 <?php
				 }
				 ?>     
                      
                    </form>
                      <button type="button" onclick="javascript: location.href='addshoecolor.php?soeid=<?php echo $_GET['soeid']; ?>';" class="button">Add New Shoe Color</button>
                    
            </table>
    </div>
  </div>
  <div id="content_area_right"> <?php echo showbanners("right"); ?></div>
  <div class="clear"></div>
  <!-- Content Area End -->
  <div class="hei">&nbsp;</div>
  <!-- Footer Area Start -->
 <?php include("footer.php"); ?>