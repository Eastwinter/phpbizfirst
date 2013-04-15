<?php
	error_reporting(E_ALL);
		include("connect.php");
		header("Content-type: text/xml");
		header("Cache-Control: no-cache");		
		
		$con_id = $_GET['con_id'];
		$query = mysql_query("SELECT sta_id,name FROM soe_geo_states WHERE con_id=".$con_id." ORDER BY name");
		
		echo "<?xml version=\"1.0\"?>\n";
		echo "<response>\n";
			
			if(mysql_num_rows($query) > 0)
			{
				while($result = mysql_fetch_array($query))
				{
					echo "\t<states>\n";
					echo "\t<sta_id>".$result['sta_id']."</sta_id>\n";
					echo "\t<name>".$result['name']."</name>\n";
					echo "\t</states>\n";
				}
			}
			
		echo "</response>";
?>