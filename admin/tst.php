<?php
include("../connect.php");
mysql_query("update soe_membership set paydate=".strtotime('10-july-2011').", expire=".strtotime('10-jan-2012')." where memshipid=216") or die(mysql_error());
?>