<?php include('header.php'); 
$sql="delete from cart where sessionid='".session_id()."'";	
		
mysql_query($sql) or die(mysql_error()."----".$sql);

//session_regenerate_id();
?>	
<?php include("left1.php"); ?>
			

  <div id="content_area_mid_inner1">
  <div>
    <h2>Payment Un-Successful!</h2>
  </div>
   
    <div class="moremarketing"><br />
            <p>Sorry !!.. There was a problem processing your payment. Please try again after some time.</p>
      <div class="clear"></div>
</div>
  
</div>
  <div id="content_area_right"><?php echo showbanners("right"); ?></div>
  <div class="clear"></div>
  <!-- Content Area End -->
  <div class="hei"></div>
  
 

<?php include("footer.php"); ?>