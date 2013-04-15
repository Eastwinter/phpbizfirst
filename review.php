<?php
include("connect.php");
$name=mysql_real_escape_string($_POST['yourname']);
$email=mysql_real_escape_string($_POST['email']);
$country=mysql_real_escape_string($_POST['country']);
$overall=intval($_POST['overall']);
$comfort=intval($_POST['comfort']);
$style=intval($_POST['style']);
$desc=mysql_real_escape_string($_POST['description']);
$soeid=intval($_POST['soe_id']);
$msg='';
if($name=='')
$msg='Name is required <br />';

if($email=='')
$msg='Email is required <br />';

if($desc=='')
$msg='Comments is required <br />';


if($msg=='')
{
	$rs=mysql_query("select * from soe_reviews where email like '".$email."' and fldshoeid=".$soeid) or die(mysql_error());
	if(mysql_num_rows($rs)>0)
		echo '<br /><br /><center><strong> You have already reviewd this shoe!</strong></center><br />';
	else
	{
	echo '<br /><br /><center><strong>You`re about to help millions of customers make a better buying decision. <br /> <br />Thanks for your help!<br /><br />Our team loves reading customer reviews, so they`re looking forward to giving yours a look-see within the next 5 business days.<br/></strong></center>';
	
	mysql_query("insert into soe_reviews set name='".$name."',email='".$email."',country='".$country."',overall='".$overall."',comfort='".$comfort."',style='".$style."',fldcomments='".$desc."',fldshoeid=".$soeid.",fldtype='review',ip='".$_SERVER['REMOTE_ADDR']."'") or die(mysql_error());
	}
}
else
	echo "<br /><br /><br /> <center><strong>".$msg."</strong></center><br /><br /><br />";
?>