<?php include("header.php"); ?>
<?php
if($_SERVER['REQUEST_METHOD']=="POST")
{
	mysql_query("insert into soe_addonmembers set memid=".$_SESSION['memberid'].",addonid=".$_POST['packid']."") or die(mysql_error());
	$addonid=mysql_insert_id();
	?>
    <script>
	location.href="paypaladdon.php?addonid=<?php echo $addonid; ?>";
	</script>
    <?php
}
?>
<?php include("left3.php"); ?>
  
  <div id="content_area_mid_inner1">
  <div>
    <h2>More Marketing</h2>
  </div>
  
   <a href="advsendpromotion.php"><img src="images/sendpromotion_button.jpg" border="0" /></a>
   <form action="" method="post" name="myfrm">
    <div class="moremarketing">
         
      <?php
				$rs=mysql_query("select * from soe_addons order by price");
				while($row=mysql_fetch_array($rs))
				{
				?>
      <div class="addonpack">
        <input type="radio" name="packid" id="packid"  value="<?php echo $row['addonid']; ?>" checked="checked"/>
        <br>
        <h3><?php echo $row['name']; ?> - $<?php echo $row['price']; ?></h3>
        <br>
        <div class="addonpackcontent">
          <p> <?php echo nl2br($row['description']); ?></p>
        </div>
      </div>
      
      <?php
		   }
		   ?>
      <div class="clear"></div>
      <div class="paynow">
      <input type="image" src="http://images.paypal.com/images/x-click-but01.gif" border="0" name="submit" alt="Make payments with PayPal - it’s fast, free and secure!" />
      </div>
    </div>
    </form>
  </div>
  <div id="content_area_right"><?php echo showbanners("right"); ?></div>
  <div class="clear"></div>
  <!-- Content Area End -->
  <div class="hei"></div>
<?php include("footer.php"); ?>