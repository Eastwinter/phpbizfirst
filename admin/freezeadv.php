<?php
include("../connect.php");
mysql_query("update soe_members set freeze=".$_GET['v'].",freezedate='".date('Y-m-d')."' where mem_id=".$_GET['id']);
?>
<script>
location.href='showadv.php?t=v';
</script>