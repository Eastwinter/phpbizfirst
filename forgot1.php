<?php include("header.php"); 
if($_SERVER['REQUEST_METHOD']=="POST")
{
	$sql="select * from soe_fgp where code like '".md5($_POST['code'])."'";
	//die($sql);
	$rs=mysql_query($sql) or die(mysql_error());
	if(mysql_num_rows($rs)>0)
	{
		$row=mysql_fetch_array($rs);
		$email=$row['email'];
		$_SESSION['ems']=$email;
		mysql_query("delete from soe_fgp where code like '".md5($_POST['code'])."'") or die(mysql_error());
		?>
        <script>
		location.href='forgot.php';
		</script>
        <?php
		die();
	}
	else
	{
		$msg='Verification Code Invalid!';
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
	$("#fgp").validate({
		rules: {
			code: "required"
		},
		messages: {
			code: "<br/>Please enter verification code."
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
			<div class="search_lable_innerpage">Reset Code</div>
			<div class="search_txtbox_innerpage">: <input name="code" type="text" class="txt_box1" size="35" id="code">
			</div>
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