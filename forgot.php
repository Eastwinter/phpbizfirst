<?php include("header.php"); 
if($_SESSION['ems']=='')
{
		?>
        <script>
		location.href='index.php';
		</script>
        <?php
		die();

}
	
if($_SERVER['REQUEST_METHOD']=="POST")
{
	$pass=md5($_POST['password']);
	mysql_query("update soe_members set password='".$pass."' where email like '".$_SESSION['ems']."'") or die(mysql_error());
	$rs=mysql_query("select * from soe_members where email like '".$_SESSION['ems']."'") or die(mysql_error());
	if(mysql_num_rows($rs)>0)
	{
		$row=mysql_fetch_array($rs);
		$typ=$row['member_type'];
		if($typ=='mem')
		{
		?>
        <script>
		location.href='memberlogin.php?msg=pr';
		</script>
        <?php

		}
		else
		{
		?>
        <script>
		location.href='advlogin.php?msg=pr';
		</script>
        <?php
		
		}
		die();
	}
}
?>

<?php
if($msg!='')
{
?>
<script type="text/javascript">
$().ready(function()
{
	$("#object").animate({ 
		top: "0px"
	  }, 2000 ).fadeOut(11111);
});
</script>
<div id="object" class="message_box">
		<span class="err"><?php echo $msg; ?></span></div>
<?php
}
?>



<script type="text/javascript">
$(document).ready(function() {


	jQuery.validator.addMethod("noSpace", function(value, element) { 
  return value.indexOf(" ") < 0; 
}, "No space please and don't leave it empty");



	$("#fgp").validate({
		rules: {
			password: {
			required: true,
			minlength: 6,
			maxlength: 20,
			noSpace: true
			},
			confirm_password: {
				required: true,
				equalTo: "#password"
			}
		},
		messages: {
			password: {
						required: "Password can not be empty.",
			minlength: "Minimum 6 chars required",
			maxlength: "Password cannot exceed 20 chars"
			},
			
			confirm_password: {
				required: "<br/>Please repeat your password.",
				equalTo: "<br/>Password & Confirm Password mismatch."
			}
		}
	});
	
	$("#savebtn").click(function() {
           $('#fgp').submit();
        });

});
</script>

   
      <?php include("left.php"); ?>
	
	<div id="content_area_mid">
	<div><h2>Reset Password</h2></div>
    
     <form action="" method="post" name="fgp" id="fgp">
		<div class="border2">
			<div class="hei">&nbsp;</div>
			 <div class="search_lable_innerpage">New Password:</div>
             <div class="search_txtbox_innerpage"><input name="password" type="password" id="password"  style="width:150px;" maxlength="20" class="txt_box1"/></div>
              
                <div class="search_lable_innerpage"> Confirm Password:</div>
                <div class="search_txtbox_innerpage"><input name="confirm_password" type="password" id="confirm_password"  style="width:150px;" maxlength="20" class="txt_box1"/></div>
               
			<div class="clear"></div>
			<div></div>
			<div class="search_lable_innerpage"></div>
			<div class="search_txtbox_innerpage"><a id='savebtn'><img src="images/blue_submit_button.jpg" alt="" width="78" height="35"></a><a href="#" onClick="javascript: document.fgp.reset();"><img src="images/clear_buton.jpg" alt=""></a></div>
			<div class="clear"></div>
		</div>
        
        </form>
	</div>
	
	<div id="content_area_right"><?php echo showbanners("right"); ?></div>
	<div class="clear"></div>
	<!-- Content Area End -->
	
	<div class="hei">&nbsp;</div>
	
<?php include("left.php"); ?>