<?php include("header.php"); 


?>
        <style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, sans-serif;
	font-weight: bold;
	font-size: small;
}
.style2 {color: #FF0000}
-->
        </style>
        <div class="container">
      <?php include("left3.php"); ?>
	
	<div><h1>ACCOUNT FREEZED!</h1> </div>
	<div id="content_area_mid_inner1">
		<div class="border2"><center>
       
  <br />
                  <br />
                  <br />
                  <br />
                  <br />
                  <br />
                  <br />
                  <br />
                  <p class="style1"><strong>There was a problem processing your payment. </strong></p>
                  <p class="style1"><strong>Please make a payment within <?php echo $_GET['s']; ?> business days or your account will be at risk of deactivation 
and a reactivation fees of <span class="style2">$35</span> will be charged.</strong></p>
                <p class="paynow">&nbsp;</p>
    </center></div>
		<div class="hei">&nbsp;</div>
        <div class="hei">&nbsp;</div>
		 </div>
	<div id="content_area_right"><?php echo showbanners("right"); ?></div>
	<div class="clear"></div>
	<!-- Content Area End -->
	
	<div class="hei"></div>
	
<?php include("footer.php"); ?>