<?php include("header.php"); ?>
<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: x-small;
	color: #FF0000;
}
-->
</style>


				
				

	
					
					<?php include("left.php"); ?>
			

  
  <div id="content_area_mid_inner1">
  <div>
    <h2>Account Reactivation</h2>
  </div>
   
    <div class="moremarketing">


		<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" name="payaddonmyfrm">
        <input type="hidden" name="cmd" value="_xclick">
        <input type="hidden" name="business" value="user1_1305209813_biz@gmail.com">
        <input type="hidden" name="item_name" value="Reactivation Fees on ShoeBreeze.com">
        <input type="hidden" name="item_number" value="<?php echo $_SESSION['memberid']; ?>">
        <input type="hidden" name="no_shipping" value="1">
        <input type="hidden" name="amount" value="35">
        <input type="hidden" name="return" value="http://www.innogenius.com/shoebreeze/thankyoureactive.php">
        <input type="hidden" name="cancel_return" value="http://www.innogenius.com/shoebreeze/cancelreactive.php">

        
        
		</form>
        <p align="center"> <img src="throbber.gif" width="100" height="100" align="absmiddle" /> <br />
           <span class="style1">Do not press 'back' or close the window until the process is complete</span></p>
      <div class="clear"></div>
</div>
  
  </div>
  <div id="content_area_right"><?php echo showbanners("right"); ?></div>
  <div class="clear"></div>
  <!-- Content Area End -->
  <div class="hei"></div>
  
  <script type="text/javascript">


function f()
{

	 document.payaddonmyfrm.submit();	

	//location.href="approval_test.php";
}
setTimeout("f()", 2000);
</script>

<?php include("footer.php"); ?>