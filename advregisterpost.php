<?php
include("connect.php");
include_once "class.phpmailer.php";

	$_POST['email']=mysql_real_escape_string($_POST['email']);
	$_POST['first_name']=mysql_real_escape_string($_POST['first_name']);
	$_POST['last_name']=mysql_real_escape_string($_POST['last_name']);
	$_POST['password']=mysql_real_escape_string($_POST['password']);
	$_POST['business_name']=mysql_real_escape_string($_POST['business_name']);
	$_POST['address']=mysql_real_escape_string($_POST['address']);
	$_POST['securityquestion']=mysql_real_escape_string($_POST['securityquestion']);
	$_POST['securityanswer']=mysql_real_escape_string($_POST['securityanswer']);
	$_POST['dateofbirth']=mysql_real_escape_string($_POST['dateofbirth']);
	
	if($_POST['display_address']==1)
		$dispaddr=1;
	else
		$dispaddr=0;
	$_POST['con_id']=mysql_real_escape_string($_POST['con_id']);
	$_POST['sta_id']=mysql_real_escape_string($_POST['sta_id']);	
	$_POST['city']=mysql_real_escape_string($_POST['cty_id']);		
	$_POST['zip_code']=mysql_real_escape_string($_POST['zip_code']);		


	$sql="update soe_members set password='".md5($_POST['password'])."',first_name='".$_POST['first_name']."',last_name='".$_POST['last_name']."',dateofbirth='".$_POST['dateofbirth']."',gender='".$_POST['gender']."',joined='".strtotime(date("Y-m-d"))."',member_type='adv',from_ip='".$_SERVER['REMOTE_ADDR']."',securityquestion='".$_POST['securityquestion']."',securityanswer='".$_POST['securityanswer']."',dateofbirth='".$_POST['dateofbirth']."',banned='0' where mem_id=".$_GET['id'];
	mysql_query($sql) or die(mysql_error().'<br/ >'.$sql);
	$custid=$_GET['id'];
	
	
	$sql="insert into soe_stores set mem_id='".$custid."',business_name='".$_POST['business_name']."',address='".$_POST['address']."',zip_code='".$_POST['zip_code']."',con_id='".$_POST['con_id']."',sta_id='".$_POST['sta_id']."',cty_id='".$_POST['city']."',display_address='".$dispaddr."',added='".strtotime(date("Y-m-d"))."',expire='".strtotime(date("Y-m-d")." +1 year")."'";
	mysql_query($sql) or die(mysql_error().'<br/ >'.$sql);
	$stoid=mysql_insert_id();

				$_SESSION['memberlogged']='yes';
				$_SESSION['memberid']=$_GET['id'];
				$_SESSION['memtype']='adv';
				$_SESSION['memname']=$_POST['first_name'];			
				$_SESSION['reggoingon']=1;

	$sql="update soe_stores set packageid='".$_POST['packid']."' where sto_id=".$stoid."";
	mysql_query($sql) or die(mysql_error());
	
	$rs=mysql_query("select * from soe_settings where field='price_vat'");
	$row=mysql_fetch_array($rs);
	$price_vat=$row[2];
	
	$rs=mysql_query("select * from soe_packages where packageid=".$_POST['packid']) or die(mysql_error());
	$row=mysql_fetch_array($rs);
	$price=$row['price'];
	
	$package=$_POST['packid'];
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
	
$sql="insert into soe_membership set mem_id='".$_SESSION['memberid']."',sto_id=".$stoid.",packageid='".$_POST['packid']."',price_exc_vat='".floatval($price_exc_vat)."',vat='".floatval($vat)."',total='".floatval($total)."',subscription='".$_POST['subscription']."'";
mysql_query($sql) or die(mysql_error());
$memshipid=mysql_insert_id();


				$_SESSION['memberlogged']='yes';
				$_SESSION['memberid']=$_GET['id'];
				$_SESSION['memtype']='adv';
				$_SESSION['memname']=$_POST['first_name'];			


?>
<script>
location.href="addstore.php?stoid=<?php echo $stoid; ?>&memshipid=<?php echo $memshipid; ?>";
</script>