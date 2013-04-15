<?php include("connect.php");

$rs=mysql_query("select * from cart where sessionid='".session_id()."'");
while($row=mysql_fetch_array($rs))
{
	$nm="qty".$row['id'];
	$v=$_POST[$nm];
	$rs1=mysql_query("update cart set qty=".intval($v)." where id=".intval($row['id']));
}
?>
    <script>
		location.href="cart.php";
	</script>
