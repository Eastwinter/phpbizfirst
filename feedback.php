<?php
include("connect.php");
$name=mysql_real_escape_string($_POST['name']);
$desc=mysql_real_escape_string($_POST['comments']);
$soeid=intval($_POST['soe_id']);
$stoid=intval($_POST['stoid']);

$msg='';
if($name=='')
$msg='Name is required <br />';


if($desc=='')
$msg='Comments is required <br />';


if($msg=='')
{
	echo '<br /><br /><center><strong>Thank you for your valuable feedback. <br /> <br />Our team loves reading customer feedback, so they`re looking forward to giving yours a look-see within the next 5 business days.<br/></strong></center>';
	mysql_query("insert into soe_reviews set name='".$name."',fldapprove=1,fldcomments='".$desc."',fldshoeid=".$soeid.",fldtype='feedback',ip='".$_SERVER['REMOTE_ADDR']."',sto_id=".$stoid) or die(mysql_error());
}
else
	echo "<br /><br /><br /> <center><strong>".$msg."</strong></center><br /><br /><br />";
?>