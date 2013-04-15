<?php
	error_reporting(E_ALL);
		include("../connect.php");
		header("Content-type: text/xml");
		header("Cache-Control: no-cache");		
		
		$shc_id = $_GET['shc_id'];
				mysql_query("SET NAMES 'utf8'") or die(mysql_error());
		mysql_query("SET CHARACTER SET utf8") or die(mysql_error());
		mysql_query("SET COLLATION_CONNECTION = 'utf8_general_ci'") or die(mysql_error());

		$query = mysql_query("SELECT siz_id,name FROM soe_shoe_size WHERE shc_id=".$shc_id." ORDER BY name");
		
		echo "<?xml version=\"1.0\"?>\n";
		echo "<response>\n";
			
			if(mysql_num_rows($query) > 0)
			{
				while($result = mysql_fetch_array($query))
				{
					echo "\t<size>\n";
					echo "\t<siz_id>".$result['siz_id']."</siz_id>\n";
					echo "\t<name>".$result['name']."</name>\n";
					echo "\t</size>\n";
				}
			}
			
		echo "</response>";
?>