<?php
include("../connect.php");
if($_GET['type']=='category')
category();


if($_GET['type']=='footware')
foot_ware();

if($_GET['type']=='advcolor')
advcolor();


if($_GET['type']=='brand')
brand();

if($_GET['type']=='color')
color();

if($_GET['type']=='material')
material();

if($_GET['type']=='heel_height')
heel_height();

if($_GET['type']=='heel_size')
heel_size();

if($_GET['type']=='closure')
closure();

if($_GET['type']=='foot_type')
foot_type();

if($_GET['type']=='shoe_type')
shoe_type();

if($_GET['type']=='sole_type')
sole_type();

if($_GET['type']=='shoe_size')
shoe_size();

if($_GET['type']=='shoe_width')
shoe_width();

if($_GET['type']=='season')
season();

if($_GET['type']=='languages_spoken')
languages_spoken();

if($_GET['type']=='payment_methods')
payment_methods();



	function season()
	{
		error_reporting(E_ALL);
		
		header("Content-type: text/xml");
		header("Cache-Control: no-cache");
		
		$sea_id = $_GET['id'];
		$query = mysql_query("SELECT * FROM soe_season WHERE sea_id=".$sea_id);
		
		echo "<?xml version=\"1.0\"?>\n";
		echo "<response>\n";
			
			if(mysql_num_rows($query) > 0)
			{
				while($result = mysql_fetch_array($query))
				{			
				echo "\t<active>".$result['active']."</active>\n";
				echo "\t<season>".$result['name']."</season>\n";
				}
			}
			
		echo "</response>";
	}


	function foot_ware()
	{
		error_reporting(E_ALL);
		
		header("Content-type: text/xml");
		header("Cache-Control: no-cache");
		
		$fot_id = $_GET['id'];
		$query = mysql_query("SELECT * FROM soe_foot_ware WHERE fot_id=".$fot_id);
		
		echo "<?xml version=\"1.0\"?>\n";
		echo "<response>\n";
			
			if(mysql_num_rows($query) > 0)
			{
				while($result = mysql_fetch_array($query))
				{			
				echo "\t<active>".$result['active']."</active>\n";
				echo "\t<foot_ware>".$result['name']."</foot_ware>\n";
				}
			}
			
		echo "</response>";
	}


	function category()
	{
		error_reporting(E_ALL);
		
		header("Content-type: text/xml");
		header("Cache-Control: no-cache");
		
		$fot_id = $_GET['id'];
		$query = mysql_query("SELECT * FROM soe_shoe_category WHERE shc_id=".$fot_id);
		
		echo "<?xml version=\"1.0\"?>\n";
		echo "<response>\n";
			
			if(mysql_num_rows($query) > 0)
			{
				while($result = mysql_fetch_array($query))
				{			
				echo "\t<active>".$result['active']."</active>\n";
				echo "\t<category>".$result['name']."</category>\n";
				echo "\t<parent_id>".$result['parent_id']."</parent_id>\n";
				}
			}
			
		echo "</response>";
	}
	
	function brand()
	{
		error_reporting(E_ALL);
		
		header("Content-type: text/xml");
		header("Cache-Control: no-cache");
		
		$brn_id = $_GET['id'];
		$query = mysql_query("SELECT * FROM soe_brand WHERE brn_id=".$brn_id);
		
		echo "<?xml version=\"1.0\"?>\n";
		echo "<response>\n";
			
			if(mysql_num_rows($query) > 0)
			{
				while($result = mysql_fetch_array($query))
				{		
				echo "\t<active>".$result['active']."</active>\n";
				echo "\t<brand>".$result['name']."</brand>\n";
				}
			}
			
		echo "</response>";
	}
	
	
	function advcolor()
	{
		error_reporting(E_ALL);
		
		header("Content-type: text/xml");
		header("Cache-Control: no-cache");
		
		$brn_id = $_GET['id'];
		$query = mysql_query("SELECT * FROM soe_advcolor WHERE advcol_id=".$brn_id);
		
		echo "<?xml version=\"1.0\"?>\n";
		echo "<response>\n";
			
			if(mysql_num_rows($query) > 0)
			{
				while($result = mysql_fetch_array($query))
				{		
				echo "\t<active>".$result['active']."</active>\n";
				echo "\t<advcolor>".$result['name']."</advcolor>\n";
				}
			}
			
		echo "</response>";
	}
	
	function color()
	{
		error_reporting(E_ALL);
		
		header("Content-type: text/xml");
		header("Cache-Control: no-cache");
		
		$col_id = $_GET['id'];
		$query = mysql_query("SELECT * FROM soe_color WHERE col_id=".$col_id);
		
		echo "<?xml version=\"1.0\"?>\n";
		echo "<response>\n";
			
			if(mysql_num_rows($query) > 0)
			{
				while($result = mysql_fetch_array($query))
				{			
				echo "\t<active>".$result['active']."</active>\n";
				echo "\t<color>".$result['name']."</color>\n";
				echo "\t<code>".$result['code']."</code>\n";
				}
			}
			
		echo "</response>";
	}
	
	function material()
	{
		error_reporting(E_ALL);
		
		header("Content-type: text/xml");
		header("Cache-Control: no-cache");
		
		$mtr_id = $_GET['id'];
		$query = mysql_query("SELECT * FROM soe_material WHERE mtr_id=".$mtr_id);
		
		echo "<?xml version=\"1.0\"?>\n";
		echo "<response>\n";
			
			if(mysql_num_rows($query) > 0)
			{
				while($result = mysql_fetch_array($query))
				{
			
				echo "\t<active>".$result['active']."</active>\n";
				echo "\t<material>".$result['name']."</material>\n";
				}
			}
			
		echo "</response>";
	}
	
	function heel_size()
	{
		error_reporting(E_ALL);
		
		header("Content-type: text/xml");
		header("Cache-Control: no-cache");
		
		$hls_id = $_GET['id'];
		$query = mysql_query("SELECT * FROM soe_heel_size WHERE hls_id=".$hls_id);
		
		echo "<?xml version=\"1.0\"?>\n";
		echo "<response>\n";
			
			if(mysql_num_rows($query) > 0)
			{
				while($result = mysql_fetch_array($query))
				{
			
				echo "\t<active>".$result['active']."</active>\n";
				echo "\t<heel_size>".$result['name']."</heel_size>\n";
				}
			}
			
		echo "</response>";
	}
	
	function heel_height()
	{
		error_reporting(E_ALL);
		
		header("Content-type: text/xml");
		header("Cache-Control: no-cache");
		
		$hlh_id = $_GET['id'];
		$query = mysql_query("SELECT * FROM soe_heel_height WHERE hlh_id=".$hlh_id);
		
		echo "<?xml version=\"1.0\"?>\n";
		echo "<response>\n";
			
			if(mysql_num_rows($query) > 0)
			{
				while($result = mysql_fetch_array($query))
				{
			
				echo "\t<active>".$result['active']."</active>\n";
				echo "\t<heel_height>".str_replace('""','',$result['name'])."</heel_height>\n";
				}
			}
			
		echo "</response>";
	}	
	
	function closure()
	{
		error_reporting(E_ALL);
		
		header("Content-type: text/xml");
		header("Cache-Control: no-cache");
		
		$clo_id = $_GET['id'];
		$query = mysql_query("SELECT * FROM soe_closure WHERE clo_id=".$clo_id);
		
		echo "<?xml version=\"1.0\"?>\n";
		echo "<response>\n";
			
			if(mysql_num_rows($query) > 0)
			{
				while($result = mysql_fetch_array($query))
				{
			
				echo "\t<active>".$result['active']."</active>\n";
				echo "\t<closure>".$result['name']."</closure>\n";
				}
			}
			
		echo "</response>";
	}
	
	function shoe_type()
	{
		error_reporting(E_ALL);
		
		header("Content-type: text/xml");
		header("Cache-Control: no-cache");
		
		$sht_id = $_GET['id'];
		$query = mysql_query("SELECT * FROM soe_shoe_type WHERE sht_id=".$sht_id);
		
		echo "<?xml version=\"1.0\"?>\n";
		echo "<response>\n";
			
			if(mysql_num_rows($query) > 0)
			{
				while($result = mysql_fetch_array($query))
				{
			
				echo "\t<active>".$result['active']."</active>\n";
				echo "\t<shoe_type>".$result['name']."</shoe_type>\n";
				}
			}
			
		echo "</response>";
	}
	
	function foot_type()
	{
		error_reporting(E_ALL);
		
		header("Content-type: text/xml");
		header("Cache-Control: no-cache");
		
		$fot_id = $_GET['id'];
		$query = mysql_query("SELECT * FROM soe_foot_type WHERE fot_id=".$fot_id);
		
		echo "<?xml version=\"1.0\"?>\n";
		echo "<response>\n";
			
			if(mysql_num_rows($query) > 0)
			{
				while($result = mysql_fetch_array($query))
				{
			
				echo "\t<active>".$result['active']."</active>\n";
				echo "\t<foot_type>".$result['name']."</foot_type>\n";
				}
			}
			
		echo "</response>";
	}
	
	function sole_type()
	{
		error_reporting(E_ALL);
		
		header("Content-type: text/xml");
		header("Cache-Control: no-cache");
		
		$sol_id = $_GET['id'];
		$query = mysql_query("SELECT * FROM soe_sole_type WHERE sol_id=".$sol_id);
		
		echo "<?xml version=\"1.0\"?>\n";
		echo "<response>\n";
			
			if(mysql_num_rows($query) > 0)
			{
				while($result = mysql_fetch_array($query))
				{
			
				echo "\t<active>".$result['active']."</active>\n";
				echo "\t<sole_type>".$result['name']."</sole_type>\n";
				}
			}
			
		echo "</response>";
	}
	
	function shoe_size()
	{
		error_reporting(E_ALL);
		
		header("Content-type: text/xml");
		header("Cache-Control: no-cache");
		
		mysql_query("SET NAMES 'utf8'") or die(mysql_error());
		mysql_query("SET CHARACTER SET utf8") or die(mysql_error());
		mysql_query("SET COLLATION_CONNECTION = 'utf8_general_ci'") or die(mysql_error());
		$siz_id = $_GET['id'];
		$query = mysql_query("SELECT * FROM soe_shoe_size WHERE siz_id=".$siz_id);
		
		echo "<?xml version=\"1.0\"?>\n";
		echo "<response>\n";
			
			if(mysql_num_rows($query) > 0)
			{
				while($result = mysql_fetch_array($query))
				{
			
				echo "\t<active>".$result['active']."</active>\n";
				echo "\t<shoe_size>".$result['name']."</shoe_size>\n";
				echo "\t<shc_id>".$result['shc_id']."</shc_id>\n";
				}
			}
			
		echo "</response>";
	}
	
	function shoe_width()
	{
		error_reporting(E_ALL);
		
		header("Content-type: text/xml");
		header("Cache-Control: no-cache");
		
		$shw_id = $_GET['id'];
		$query = mysql_query("SELECT * FROM soe_shoe_width WHERE shw_id=".$shw_id);
		
		echo "<?xml version=\"1.0\"?>\n";
		echo "<response>\n";
			
			if(mysql_num_rows($query) > 0)
			{
				while($result = mysql_fetch_array($query))
				{
			
				echo "\t<active>".$result['active']."</active>\n";
				echo "\t<shoe_width>".$result['name']."</shoe_width>\n";
				echo "\t<shc_id>".$result['shc_id']."</shc_id>\n";				
				}
			}
			
		echo "</response>";
	}
	
	function languages_spoken()
	{
		error_reporting(E_ALL);
		
		header("Content-type: text/xml");
		header("Cache-Control: no-cache");
		
		$las_id = $_GET['id'];
		$query = mysql_query("SELECT * FROM soe_lan_spoken WHERE las_id=".$las_id);
		
		echo "<?xml version=\"1.0\"?>\n";
		echo "<response>\n";
			
			if(mysql_num_rows($query) > 0)
			{
				while($result = mysql_fetch_array($query))
				{
			
				echo "\t<active>".$result['active']."</active>\n";
				echo "\t<languages_spoken>".$result['name']."</languages_spoken>\n";
				}
			}
			
		echo "</response>";
	}
	
	function payment_methods()
	{
		error_reporting(E_ALL);
		
		header("Content-type: text/xml");
		header("Cache-Control: no-cache");
		
		$pay_id = $_GET['id'];
		$query = mysql_query("SELECT * FROM soe_store_payment WHERE pay_id=".$pay_id);
		
		echo "<?xml version=\"1.0\"?>\n";
		echo "<response>\n";
			
			if(mysql_num_rows($query) > 0)
			{
				while($result = mysql_fetch_array($query))
				{
			
				echo "\t<active>".$result['active']."</active>\n";
				echo "\t<payment_methods>".$result['name']."</payment_methods>\n";
				}
			}
			
		echo "</response>";
	}
    ?>