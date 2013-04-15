<?php
		error_reporting(E_ALL);
		
		include("../connect.php");
		$a=$_SERVER['REQUEST_URI'];
		$arr=explode("/",$a);
		$c=count($arr);
		$sta_id=$arr[$c-1];
		if($sta_id>0)
		{
		$cnt_id=$arr[$c-2];
		$search=$arr[$c-3];
		mysql_query("SET NAMES 'utf8'") or die(mysql_error());
		mysql_query("SET CHARACTER SET utf8") or die(mysql_error());
		mysql_query("SET COLLATION_CONNECTION = 'utf8_general_ci'") or die(mysql_error());
		$sql="SELECT * FROM soe_geo_cities WHERE con_id=".$cnt_id." AND sta_id=".$sta_id." AND
			(name= '".$search."' OR name LIKE '%".$search."%' OR name LIKE '".$search."%' OR name LIKE '%".$search."')
			ORDER BY name ASC LIMIT 100";
		$query = mysql_query($sql) or die($sql);
		if(mysql_num_rows($query) > 0)
			{
				while($result = mysql_fetch_array($query))
				{
					echo $result['name']."|".$result['cty_id']."\n";
				}
			}
		}	
?>