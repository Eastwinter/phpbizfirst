<?php include("connect.php");

$rs=mysql_query("select * from cart where itemid=".intval($_GET['id'])." and sessionid='".session_id()."'");
if(mysql_num_rows($rs)<=0)
{
	$rs1=mysql_query("select * from soe_shoe where soe_id=".intval($_GET['id']));
	$row1=mysql_fetch_array($rs1);
	
	$rs2=mysql_query("select * from soe_stores where sto_id=".intval($_GET['stoid']));
	$row2=mysql_fetch_array($rs2);
	
	$sql="insert into cart set memid=".$_SESSION['memberid'].",advid=".$row2['mem_id'].",itemid=".intval($_GET['id']).",colid=".intval($_GET['colid']).",qty=1,price=".floatval($row1['price']).",sessionid='".session_id()."',stoid=".intval($_GET['stoid']);
	mysql_query($sql) or die(mysql_error().'<br />'.$sql);
		
	?>
    <script>
		location.href="cart.php";
	</script>
    <?php
	
	
}
else
{
	?>
    <script>
		alert("This item is already added in your cart");
		location.href="cart.php";
	</script>
    <?php

}

?>