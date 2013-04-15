<?php include('header.php'); 
if($_GET['memshipid']=='')
$_GET['memshipid']=$_SESSION['memshipid'];

$sql="delete from soe_membership where memshipid='".$_GET['memshipid']."'";
$rs=mysql_query($sql) or die(mysql_error());
				
?>
<?php include("left3.php"); ?>
			
  
  <div id="content_area_mid_inner1">
  <div>
    <h2>Payment Un-Successful!</h2>
  </div>
   
    <div class="moremarketing">
      
 
     <br /><br /><br /><br /><br /><br />
            <p>Sorry !!.. New location could not be added. There was a problem processing your payment, please try again later !</p>
      <div class="clear"></div>
</div>
  
  </div>
  <div id="content_area_right"><?php echo showbanners("right"); ?></div>
  <div class="clear"></div>
  <!-- Content Area End -->
  <div class="hei"></div>
  
 

<?php include("footer.php"); ?>