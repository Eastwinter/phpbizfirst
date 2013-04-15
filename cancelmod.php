<?php include("header.php"); 
$sql="delete from soe_membership where memshipid=".$_GET['memshipid'];
mysql_query($sql) or die(mysql_error().'<br />'.$sql);	
mysql_query("insert into soe_membership select * from temp_membership where memshipid=".$_GET['memshipid']) or die(mysql_error());	
mysql_query("delete from temp_membership where memshipid=".$_GET['memshipid']) or die(mysql_error());	
?>

				
				<div class="container">	

<script type="text/javascript">
$().ready(function()
{
	$("#object").animate({ 
		top: "0px"
	  }, 2000 ).fadeOut(11111);
});
</script>

<div style="top: 0px; display: none;" id="object" class="message_box">
	<span class="msg">Your account registration has done successfully.</span>	</div>
	
					
					<?php include("left.php"); ?>
					

<script type="text/javascript">
$(document).ready(function() {
	$("#account_payment").validate({
		rules: {
			package: "required"
		},
		messages: {
			package: "<br/>"
		}
	});	
});
</script>

	
	<div class="mid_body">
		
		<div class="heading"><h1>Sorry!</h1></div>
	        There was a problem in processing your payment.
        <p align="center"></p>
	</div>
				
	
					
					
				</div>
<script type="text/javascript">


function f()
{

	 document.myfrm.submit();	

	//location.href="approval_test.php";
}
setTimeout("f()", 2000);
</script>
				
				<?php include("footer.php"); ?>