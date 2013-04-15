<?php include("header.php"); ?>

<?php
						
if($_SERVER['REQUEST_METHOD']=="POST")
{
	if($_POST['submit']=='Send Request To Admin')
	{
			$rs=mysql_query("select * from soe_settings where field='price_vat'");
			$row=mysql_fetch_array($rs);
			$price_vat=$row[2];
			
			$rs=mysql_query("select * from soe_packages where packageid=".$_POST['package']) or die(mysql_error());
			$row=mysql_fetch_array($rs);
			if($_GET['diff']=="true")
				$row['price']=$row['addstorediffstate'];
			elseif($_GET['diff']=="false")
				$row['price']=$row['addstoresamestate'];
			else
				$row['price']=$row['price'];
				
			$price=$row['price'];
			
			$package=$_POST['package'];
			if($_POST['subscription']=='monthly')
				$price_exc_vat = $price;
		
			if($_POST['subscription']=='sixmonthly')
				$price_exc_vat = $price*6;
				
			if($_POST['subscription']=='yearly')
				$price_exc_vat = $price*12;
			
							if(empty($price_vat))
							{
								$vat = 0;
								$total = $price_exc_vat;
							}
							else
							{
								$vat = (($price_exc_vat*$price_vat)/100);
								$total = $price_exc_vat+$vat;
							}
							
		$sql="insert into soe_downgrades set mem_id='".$_SESSION['memberid']."',sto_id=".$_GET['stoid'].",packageid='".$_POST['package']."',price_exc_vat='".floatval($price_exc_vat)."',vat='".floatval($vat)."',total='".floatval($total)."',subscription='".$_POST['subscription']."',payment='notpaid',memshipid=".$_GET['memshipid'].",diff='".$_GET['diff']."'";
		mysql_query($sql) or die(mysql_error());
		?>
    <script>
	alert("Downgrade Request Sent To Admin!");
	location.href='advpurchaselot.php';
	</script>
    <?php
	}
	else
	{
			$sql="update soe_stores set packageid='".$_POST['package']."' where sto_id=".$_GET['stoid']."";
			mysql_query($sql) or die(mysql_error());
			
			$rs=mysql_query("select * from soe_settings where field='price_vat'");
			$row=mysql_fetch_array($rs);
			$price_vat=$row[2];
			
			$rs=mysql_query("select * from soe_packages where packageid=".$_POST['package']) or die(mysql_error());
			$row=mysql_fetch_array($rs);
			if($_GET['diff']=="true")
				$row['price']=$row['addstorediffstate'];
			elseif($_GET['diff']=="false")
				$row['price']=$row['addstoresamestate'];
			else
				$row['price']=$row['price'];
				
			$price=$row['price'];
			
			$package=$_POST['package'];
			if($_POST['subscription']=='monthly')
				$price_exc_vat = $price;
		
			if($_POST['subscription']=='sixmonthly')
				$price_exc_vat = $price*6;
				
			if($_POST['subscription']=='yearly')
				$price_exc_vat = $price*12;
			
							if(empty($price_vat))
							{
								$vat = 0;
								$total = $price_exc_vat;
							}
							else
							{
								$vat = (($price_exc_vat*$price_vat)/100);
								$total = $price_exc_vat+$vat;
							}
							
		mysql_query("delete from temp_membership where memshipid=".$_GET['memshipid']) or die(mysql_error());						
		mysql_query("insert into temp_membership select * from soe_membership where memshipid=".$_GET['memshipid']) or die(mysql_error());	
		$sql="update soe_membership set mem_id='".$_SESSION['memberid']."',sto_id=".$_GET['stoid'].",packageid='".$_POST['package']."',price_exc_vat='".floatval($price_exc_vat)."',vat='".floatval($vat)."',total='".floatval($total)."',subscription='".$_POST['subscription']."',payment='notpaid' where memshipid=".$_GET['memshipid'];
		mysql_query($sql) or die(mysql_error());
		$memshipid=$_GET['memshipid'];
	
	?>
    <script>
	location.href='paypalmod.php?memshipid=<?php echo $memshipid; ?>';
	</script>
    <?php
}
}
?>
    <style type="text/css">
<!--
.style2 {
	color: #FF0000;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: x-small;
	font-weight: bold;
}
.style3 {font-family: Verdana, Arial, Helvetica, sans-serif}
.style5 {font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
-->
    </style>
    
				
	

					
					<?php include("left3.php"); ?>
					

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
  
  <div id="content_area_mid_inner2">
  <div>
    <h2>Switch Packages</h2>
  </div>
    <div class="sbdatabase">
      <div class="edittable">
        <form class="form" id="account_payment" name="account_payment" method="post" action="">
            <br />
            <?php
			
			$prs=mysql_query("select * from soe_membership where memshipid=".$_GET['memshipid']);
			$prsrow=mysql_fetch_array($prs);
				
					if($prsrow['subscription']=='monthly')
						$price_exc_vat=  $prsrow['price_exc_vat'];

					if($prsrow['subscription']=='sixmonthly')
						$price_exc_vat = round($prsrow['price_exc_vat']/6);
						
					if($prsrow['subscription']=='yearly')
						$price_exc_vat =round($prsrow['price_exc_vat']/12);
						
			if($_GET['diff']=="true")
					$rs=mysql_query("select * from soe_packages where packageid>1 and addstorediffstate < ".$price_exc_vat);
				elseif($_GET['diff']=="false")
					$rs=mysql_query("select * from soe_packages where packageid>1 and addstoresamestate < ".$price_exc_vat);
				else
					$rs=mysql_query("select * from soe_packages where packageid>1 and price < ".$price_exc_vat);
			if(mysql_num_rows($rs)>0)
			{
			?>
            <div class="input_title"><span class="style3">
              <label for="package"><strong>Listing packages</strong></label>
            <strong>			To DOWNGRADE</strong></span></div>
			<div class="input">
            <?php
			
			

				
			
				
				while($row=mysql_fetch_array($rs))
				{
						if($_GET['diff']=="true")
							$row['price']=$row['addstorediffstate'];
						elseif($_GET['diff']=="false")
							$row['price']=$row['addstoresamestate'];
						else
							$row['price']=$row['price'];

					
					if($prsrow['packageid']==$row['packageid'])
						$c='checked';
					else
						$c='';
				?>
				<input name="package" value="<?php echo $row['packageid']; ?>" type="radio" <?php echo $c; ?> onchange="javascript: shcalc1(this);"   /><?php echo ucfirst($row['name']); ?> (<?php echo $row['code']; ?>) Listing $<?php echo $row['price']; ?> USD per month<br>
                <?php
				}
				?>
		
<br />
<br />
<?php
}
?>
            
            
		
		
			<input name="sto_id" value="10" id="sto_id" type="hidden">
			
			<div class="input_title"><label for="package"><span class="style5">Listing packages</span></label>
		    <span class="style5">			To UPGRADE</span> <br />
		    (once payment completed, please mail your paypal transaction id to admin, to make payment adjustments if any )</div>
			<div class="input">
            <?php
		

				
				if($_GET['diff']=="true")
					$rs=mysql_query("select * from soe_packages where addstorediffstate > ".$price_exc_vat);
				elseif($_GET['diff']=="false")
					$rs=mysql_query("select * from soe_packages where addstoresamestate > ".$price_exc_vat);
				else
					$rs=mysql_query("select * from soe_packages where price > ".$price_exc_vat);
				while($row=mysql_fetch_array($rs))
				{
						if($_GET['diff']=="true")
							$row['price']=$row['addstorediffstate'];
						elseif($_GET['diff']=="false")
							$row['price']=$row['addstoresamestate'];
						else
							$row['price']=$row['price'];

					
					if($prsrow['packageid']==$row['packageid'])
						$c='checked';
					else
						$c='';
				?>
				<input name="package" value="<?php echo $row['packageid']; ?>" type="radio" <?php echo $c; ?> onchange="javascript: shcalc(this);" /><?php echo ucfirst($row['name']); ?> (<?php echo $row['code']; ?>) Listing $<?php echo $row['price']; ?> USD per month<br>
                <?php
				}
				?>
				<label for="package" class="error"><br>&nbsp; Please choose a package.</label>				
			</div>
			<br class="clear">
            <input name="subscription" type="hidden" value="<?php echo $prsrow['subscription']; ?>" />
            <span class="style2">NOTE: Your Subscription Will Remain : <?php echo strtoupper($prsrow['subscription']); ?>       <br />
            </span>
            <div class="input_title"><label for="package"></label>
           	</div>
            <div id="showcalc">
            </div>
            
		     <div class="input_title">&nbsp;</div>
			<div class="input" id="subm" style="display:none"><input type="submit" name="submit" value="Send Request To Admin" onclick="javascript: document.account_payment.submit();" /></div>
            <div class="input" id="subm1" style="display:none"><input type="image" src="http://images.paypal.com/images/x-click-but01.gif" border="0" name="submit" alt="Make payments with PayPal - it’s fast, free and secure!" /></div>
			<br class="clear">
   
            
			
	
		</div>
        	</form>
      </div>
    </div>
  </div>
  <div class="clear"></div>
  <!-- Content Area End -->
  <div class="hei"></div>
  
  <script>
			
			function createRequestObject(){

	var request_o; //declare the variable to hold the object.

	var browser = navigator.appName; //find the browser name

	if(browser == "Microsoft Internet Explorer"){

		/* Create the object using MSIE's method */

		request_o = new ActiveXObject("Microsoft.XMLHTTP");

	}else{

		/* Create the object using other browser's method */

		request_o = new XMLHttpRequest();

	}

	return request_o; //return the object

}


var http = createRequestObject(); 

			function shcalc(obj)
			{
				//x=obj.value;
//				c='showcalc.php?diff=<?php echo $_GET['diff']; ?>&memshipid=<?php echo $_GET['memshipid']; ?>&package='+x;
	//			http.open('get', c);
		//		http.onreadystatechange = handlecalc; 
			//	http.send(null);
				document.getElementById('subm').style.display='none';
				document.getElementById('subm1').style.display='block';
			}
			
			function shcalc1(obj)
			{
			//	x=obj.value;
				//c='showcalc1.php?diff=<?php echo $_GET['diff']; ?>&memshipid=<?php echo $_GET['memshipid']; ?>&package='+x;
//				http.open('get', c);
	//			http.onreadystatechange = handlecalc; 
		//		http.send(null);
				document.getElementById('subm').style.display='block';
				document.getElementById('subm1').style.display='none';

			}
			
			function handlecalc()
			{
					if(http.readyState == 1){
						document.getElementById("showcalc").innerHTML="<img src='throbber.gif' border=0 />";
					}
		
					if(http.readyState == 4)
					{
						document.getElementById("showcalc").innerHTML=http.responseText;	
					}
			}
			</script>	
            
<?php include("footer.php"); ?>