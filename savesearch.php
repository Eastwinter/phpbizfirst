<?php
	include("connect.php");
	$qry=mysql_real_escape_string($_SESSION['srchqry']);
	$_POST['title']=mysql_real_escape_string($_POST['title']);
	$a="select * from soe_savesearch where memid=".$_SESSION['memberid']." and search='".$qry."'";
	$rs=mysql_query($a) or die(mysql_error().'<br />'.$a);
	if(mysql_num_rows($rs)<=0)
	{
		$a="select * from soe_savesearch where memid=".$_SESSION['memberid']." and title='".$_POST['title']."'";
		$rs=mysql_query($a) or die(mysql_error().'<br />'.$a);
		if(mysql_num_rows($rs)<=0)
		{
			mysql_query("insert into soe_savesearch set memid=".$_SESSION['memberid'].",search='".$qry."',title='".$_POST['title']."'") or die(mysql_error());
			echo "<strong>Search Saved!</strong>";
		}
		else
			echo "<strong>Duplicate Title Not Allowed!</strong>";
	}
	else
		echo "<strong>This Search already Saved!</strong>";
?>