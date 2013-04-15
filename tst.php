<?php
include("connect.php");
mysql_query("update soe_members set password='".md5('test1234')."' where email like 'quickonline.us1@gmail.com'");
?>