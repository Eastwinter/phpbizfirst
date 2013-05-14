<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();
set_magic_quotes_runtime(0);

//mysql_connect("localhost","yashlive_yash","yashlive135");
//mysql_select_db("yashlive_shoebreeze");


//mysql_connect("localhost","root","");
//mysql_select_db("yashlive_shoebreeze");

//mysql_connect("localhost","quickwor_shoebr","BreeZe_Shoe_123") or die(mysql_error());
//mysql_select_db("quickwor_shoebreeze") or die(mysql_error());



mysql_connect("www.feichaoshi.com","root","wswlnf") or die(mysql_error());
mysql_select_db("innoge65_shoebreeze") or die(mysql_error());

		mysql_query("SET NAMES 'utf8'") or die(mysql_error());
		mysql_query("SET CHARACTER SET utf8") or die(mysql_error());
		mysql_query("SET COLLATION_CONNECTION = 'utf8_general_ci'") or die(mysql_error());



function dateDiff($start, $end) {
  $start_ts = strtotime($start);
  $end_ts = strtotime($end);
  $diff = $end_ts - $start_ts;
  return round(abs($end_ts-$start_ts)/60/60/24);
}


function delstores($memid)
{
	mysql_query("delete from soe_stores where sto_id not in (select sto_id from soe_membership)");
	mysql_query("delete from soe_stores where mem_id not in (select mem_id from soe_members)");
	updmemship($memid);
	mysql_query("delete from soe_stores where sto_id in (select sto_id from soe_membership where payment='notpaid' and loc_id=0 and mem_id=".$memid.")");
	
	mysql_query("delete from soe_membership where payment='notpaid' and loc_id=0 and mem_id=".$memid);	
	mysql_query("delete from soe_membership where sto_id not in (select sto_id from soe_stores)");	
}

function updmemship($memid)
{
	 $s="select * from soe_stores where mem_id=".$memid;
	  $rs=mysql_query($s) or die(mysql_error());
		  while($row=mysql_fetch_array($rs))
		  {
		  		$hrs1=mysql_query("select * from soe_membership where sto_id=".$row['sto_id']);
				$hrsrow1=mysql_fetch_array($hrs1);
				if(mysql_num_rows($hrs1)>0)
				{
				$id=$hrsrow1['memshipid'];
				
				$rst=mysql_query("select * from temp_membership where memshipid=".$id);
				if(mysql_num_rows($rst)>0)
				{ 
					$sql="delete from soe_membership where memshipid=".$id;
					mysql_query($sql) or die(mysql_error().'<br />'.$sql);	
					mysql_query("insert into soe_membership select * from temp_membership where memshipid=".$id) or die(mysql_error());	
					mysql_query("delete from temp_membership where memshipid=".$id) or die(mysql_error());	
				}
				}
			}
}


function getcol($soeid=0,$fld='',$colid=0)
{
	if($colid==0)
		$sql="select * from soe_shoecolors where soe_id=".$soeid." order by id";
	else
		$sql="select * from soe_shoecolors where soe_id=".$soeid." and id=".$colid;
	$rs=mysql_query($sql) or die(mysql_error().'<br />'.$sql);
	$row=mysql_fetch_array($rs);
	if($fld=='')
		$fld='logo';
	return $row[$fld];
}

function showbanners($position)
{
	$rs=mysql_query("select * from soe_banners where position='".$position."' and status='1'");
	$s='';
	while($row=mysql_fetch_array($rs))
	{
		extract($row);
			
			
		if($type=='flash')
		{
			$file=str_replace('.swf','',$url_file);
		if($orginal_param=='0')
		{
			$s.='<div id="flash'.$bnr_id.'" style="z-index:0" onclick="bannerclicked.php?id='.$bnr_id.'"><script src="js/AC_RunActiveContent.js" type="text/javascript"></script>';
			$s.="
<script type='text/javascript'>
AC_FL_RunContent('codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','".$width."','height','".$height."','src','uploads/banner/".$file."','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','movie','uploads/banner/".$file."' ); //end AC code";
$s.='

</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="'.$width.'" height="'.$height.'">
  <param name="movie" value="uploads/banner/'.$url_file.'" />
  <param name="quality" value="high" />
  <param name="url" valuetype="ref" value="bannerclicked.php?id='.$bnr_id.'">
  <param name="embed" value="transparent" >
  <PARAM NAME="wmode" VALUE="transparent">
  <embed src="uploads/banner/'.$url_file.'" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="'.$width.'" height="'.$height.'" wmode="transparent"></embed>
</object>
</noscript></div>';
	}
	else
	{
			$s.='<div id="flash'.$bnr_id.'" onclick="bannerclicked.php?id='.$bnr_id.'"><script src="js/AC_RunActiveContent.js" type="text/javascript"></script>';
			$s.="
<script type='text/javascript'>
AC_FL_RunContent('codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','src','uploads/banner/".$file."','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','movie','uploads/banner/".$file."' ); //end AC code";
$s.='

</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" >
  <param name="movie" value="uploads/banner/'.$url_file.'" />
  <param name="quality" value="high" />
    <param name="url" valuetype="ref" value="bannerclicked.php?id='.$bnr_id.'">
	<PARAM NAME="wmode" VALUE="transparent">
  <embed src="uploads/banner/'.$url_file.'" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash"></embed>
</object>
</noscript></div>';
	}
		}

		if($type=='image')
		{
			if($orginal_param=='0')
			$s.='<div><a href="bannerclicked.php?id='.$bnr_id.'" target="_blank"><img src="uploads/banner/'.$url_file.'" border=0 width="'.$width.'" height="'.$height.'" ></a></div>';
			else
			$s.='<div><a href="bannerclicked.php?id='.$bnr_id.'" target="_blank"><img src="uploads/banner/'.$url_file.'" border=0 ></a></div>';
		}

		if($type=='remote')
		{
			if($orginal_param=='0')
				$s.='<div><a href="bannerclicked.php?id='.$bnr_id.'"><img src="'.$url_file.'" border=0 width="'.$width.'" height="'.$height.'" ></a></div>';
			else
				$s.='<div><a href="bannerclicked.php?id='.$bnr_id.'"><img src="'.$url_file.'" border=0 ></a></div>';
			
		}

	}
	
	
	return $s;
}

function curl_get_contents ($url) {
$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_URL, $url);
$html = curl_exec($curl);
curl_close($curl);
//$html=file_get_contents($url);
return $html;
}

function insertstats($type,$soeid=0,$stoid=0,$attr='')
{

	$ip=$_SERVER['REMOTE_ADDR'];
	
	$url="http://api.geoio.com/q.php?key=ZGRzuHx47LRfkgAV&qt=geoip&d=pipe&q=";
	
	
	$sid=session_id();
	if($type=='visit')
	{
		$a="select * from soe_statistics where ip='".$ip."' and sessionid='".$sid."' and type='visit'";
		//echo $a;
		$rs=mysql_query($a);
		if(mysql_num_rows($rs)<=0)
		{
				$dat = curl_get_contents($url . $ip);
				$inf = explode('|', $dat);

			mysql_query("insert into soe_statistics set ip='".$ip."',sessionid='".$sid."',type='".$type."',city='".$inf[0]."',country='".$inf[2]."',state='".$inf[1]."'") or die(mysql_error());
		}

	}

	if($type=='clicks' and $stoid>0)
	{
		$rs=mysql_query("select * from soe_statistics where ip='".$ip."' and sessionid='".$sid."' and sto_id=".$stoid." and type='".$type."'");
		if(mysql_num_rows($rs)<=0)
		{
				$dat = curl_get_contents($url . $ip);
				$inf = explode('|', $dat);

			mysql_query("insert into soe_statistics set ip='".$ip."',sessionid='".$sid."',type='".$type."',sto_id=".$stoid.",city='".$inf[0]."',country='".$inf[2]."',state='".$inf[1]."'") or die(mysql_error());
		}

	}

	if($type=='clicks' and $soeid>0)
	{
		$rs=mysql_query("select * from soe_statistics where ip='".$ip."' and sessionid='".$sid."' and soe_id=".$soeid);
		if(mysql_num_rows($rs)<=0)
		{
				$dat = curl_get_contents($url . $ip);
				$inf = explode('|', $dat);		
			mysql_query("insert into soe_statistics set ip='".$ip."',sessionid='".$sid."',type='".$type."',soe_id=".$soeid.",city='".$inf[0]."',country='".$inf[2]."',state='".$inf[1]."'") or die(mysql_error());
		}

	}
	
	if($type=='came' and $stoid>0)
	{
		$rs=mysql_query("select * from soe_statistics where ip='".$ip."' and sessionid='".$sid."' and sto_id=".$stoid." and type='".$type."'");
		if(mysql_num_rows($rs)<=0)
		{
				$dat = curl_get_contents($url . $ip);
				$inf = explode('|', $dat);
		
		
			$k="insert into soe_statistics set ip='".$ip."',sessionid='".$sid."',type='".$type."',sto_id=".$stoid.",city='".$inf[0]."',country='".$inf[2]."',state='".$inf[1]."'";
			mysql_query($k) or die(mysql_error().'<br />'.$k);
		}

	}

	if($type=='search')
	{
		$rs=mysql_query("select * from soe_statistics where ip='".$ip."' and sessionid='".$sid."' and sto_id=".$stoid." and type='".$type."' and attributes='".$attr."'");
		if(mysql_num_rows($rs)<=0)
		{
				$dat = curl_get_contents($url . $ip);
				$inf = explode('|', $dat);
		
	mysql_query("insert into soe_statistics set ip='".$ip."',sessionid='".$sid."',type='".$type."',attributes='".$attr."',city='".$inf[0]."',country='".$inf[2]."',state='".$inf[1]."'") or die(mysql_error());
	}

	}
	
	if($type=='category')
	{
		$rs=mysql_query("select * from soe_statistics where ip='".$ip."' and sessionid='".$sid."' and sto_id=".$stoid." and type='".$type."' and attributes='".$attr."'");
		if(mysql_num_rows($rs)<=0)
		{
				$dat = curl_get_contents($url . $ip);
				$inf = explode('|', $dat);
		
	mysql_query("insert into soe_statistics set ip='".$ip."',sessionid='".$sid."',type='".$type."',attributes='".$attr."',city='".$inf[0]."',country='".$inf[2]."',state='".$inf[1]."'") or die(mysql_error());
	}

	}

	if($type=='login')
	{
		$rs=mysql_query("select * from soe_statistics where ip='".$ip."' and sessionid='".$sid."' and soe_id=".$soeid." and type='".$type."' and attributes='".$attr."'");
		if(mysql_num_rows($rs)<=0)
		{
				$dat = curl_get_contents($url . $ip);
				$inf = explode('|', $dat);
		
	mysql_query("insert into soe_statistics set ip='".$ip."',sessionid='".$sid."',soe_id=".$soeid.",type='".$type."',attributes='".$attr."',city='".$inf[0]."',country='".$inf[2]."',state='".$inf[1]."'") or die(mysql_error());
	}

	}

}

/*function week_limits($weekNumber, $year, $pattern)
{
    $pattern = ($pattern) ? $pattern : "m/d";
    $stday = 7 * $weekNumber - 7;
    $stDayNumber = date("w", mktime(0,0,0,1, 1+$stday, $year));
    $stUtime = mktime(0,0,0,1,1+$stday-$stDayNumber, $year);
    $start_time = date($pattern, $stUtime);
    $end_time = date($pattern, $stUtime+6*24*60*60);
   return array($start_time, $end_time);
}//week_limits() */

function week_limits($week, $year,$pattern='')
{
$from = date("m/d/Y", strtotime("{$year}-W{$week}-1")); //Returns the date of monday in week
$to = date("m/d/Y", strtotime("{$year}-W{$week}-7")); //Returns the date of sunday in week
//return "Week {$week} in {$year} is from {$from} to {$to}.";
return array($from,$to);
} 

function getpack($memid,$stoid=0)
{
	if($stoid==0)
		$rs=mysql_query("select * from soe_membership where mem_id=".$memid." order by memshipid") or die(mysql_error());
	else
		$rs=mysql_query("select * from soe_membership where mem_id=".$memid." and sto_id=".$stoid." order by memshipid") or die(mysql_error());
	if(mysql_num_rows($rs)>0)
	{
		$row=mysql_fetch_array($rs);
		$arr=$row;
		$rs=mysql_query("select * from soe_packages where packageid=".$row['packageid']);
		if(mysql_num_rows($rs)>0)
		{
			$row=mysql_fetch_array($rs);
			$arr['shoes']=$row['shoes'];
			$arr['stores']=$row['stores'];
			$arr['location']=$row['location'];
			$arr['shoeprice']=$row['shoeprice'];
			$arr['addlocation']=$row['addlocation'];
			$arr['addstoresamestate']=$row['addstoresamestate'];
			$arr['addstorediffstate']=$row['addstorediffstate'];
		}
	}
	return $arr;
}


$rset=mysql_query("select * from soe_settings");
while($rowset=mysql_fetch_array($rset))
{
	$nm=$rowset['field'];
	$settings[$nm]=$rowset['value'];
}

?>