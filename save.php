<?php
include("header.php");
$rs=mysql_query("select * from soe_reviews where fldshoeid=".$_GET['id']." and flduserid=".$_SESSION['memberid']." and fldtype='save'") or die(mysql_error());
if(mysql_num_rows($rs)<=0)
{
	mysql_query("insert into soe_reviews set fldshoeid=".$_GET['id'].",flduserid=".$_SESSION['memberid'].",fldtype='save'") or die(mysql_error());
?>
<script>
location.href='detail-id-<?php echo $_GET['id']; ?>-msg-done.htm';
</script>
<?php
}
else
{
?>
<script>
location.href='detail-id-<?php echo $_GET['id']; ?>-msg-notdone.htm';
</script>
<?php
}	
?>