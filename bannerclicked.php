<?php include("connect.php");
$rs=mysql_query("update soe_banners set clicks=clicks+1 where bnr_id=".$_GET['id']);
$rs=mysql_query("select * from soe_banners where bnr_id=".$_GET['id']);
$row=mysql_fetch_array($rs);
extract($row);
if($target=="_blank")
{
?>
<script>
history.back();
location.href='<?php echo $url; ?>';
</script>
<?php
}
else
{
?>
<script>
location.href='<?php echo $url; ?>';
</script>

<?php
}
?>