<?php
	include("connect.php");
	$a="select * from soe_savesearch where id=".$_GET['id'];
	$rs=mysql_query($a) or die(mysql_error().'<br />'.$a);
	if(mysql_num_rows($rs)>0)
	{
		$row=mysql_fetch_array($rs);
		$_SESSION['srchqry']=$row['search'];
	}
	else
		$_SESSION['srchqry']='select * from soe_shoe';
?>
<script>
location.href='searchresults.php?vs=1';
</script>