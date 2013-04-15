<?php 
session_start();
session_regenerate_id();
include("header.php"); 

?>  <?php include("left.php"); ?>
 
  <div id="content_area_mid_inner1">
  <div><h2>Email Verification</h2></div>
    <div><p class="blue_bold">An email has been sent to you with a verification link.<br />
              Please click on the link to continue with the registration process.</p></div>
   
              <br class="clear" />
    <div class="clear"></div>
  </div>
  
  </form>
  <div id="content_area_right"><?php echo  showbanners('right'); ?></div>
  <div class="clear"></div>
  <!-- Content Area End -->
<?php include("footer.php"); ?>