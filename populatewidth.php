<?php
	error_reporting(E_ALL);
		include("connect.php");
		header("Content-type: text/xml");
		header("Cache-Control: no-cache");		
		
		$shc_id = $_GET['shc_id'];
		$query = mysql_query("SELECT shw_id,name FROM soe_shoe_width WHERE shc_id=".$shc_id." ORDER BY name");
		
		echo "<?xml version=\"1.0\"?>\n";
		echo "<response>\n";
			
			if(mysql_num_rows($query) > 0)
			{
				while($result = mysql_fetch_array($query))
				{
					echo "\t<width>\n";
					echo "\t<shw_id>".$result['siz_id']."</shw_id>\n";
					echo "\t<name>".htmlentities($result['name'], ENT_QUOTES, 'UTF-8')."</name>\n";
					echo "\t</width>\n";
				}
			}
			
		echo "</response>";
?>