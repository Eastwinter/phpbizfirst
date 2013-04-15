<?php
include("../connect.php");
require_once('phpthumb/phpthumb.class.php');

if($_SESSION['admlogged']!='yes')
{
?>
<script>
location.href='index.php';
</script>
<?php
}

		mysql_query("SET NAMES 'utf8'") or die(mysql_error());
		mysql_query("SET CHARACTER SET utf8") or die(mysql_error());
		mysql_query("SET COLLATION_CONNECTION = 'utf8_general_ci'") or die(mysql_error());


mysql_query("delete from soe_statistics where city like 'MAX CONNECTIONS REACHED'") or die(mysql_error());		
$pself=$_SERVER['PHP_SELF'];

function chkdel($fld,$val,$file)
{
	$rs=mysql_query("select * from soe_shoe where `".$fld."`=".intval($val));
	
	if(mysql_num_rows($rs)>0)
	{
	?>
		<script>
        alert("Cannot delete , a shoes is associated with it");
        location.href="<?php echo $file; ?>";
        </script>
<?php
		die();
	}	
}

function chkunique($fld,$tbl,$val,$id=0,$pid=0)
{
	if($tbl!='soe_shoe_category')
	{
		if($id=='0' or $id=='')
			$sql="select * from ".$tbl." where `name` like '".mysql_real_escape_string($val)."'";
		else
			$sql="select * from ".$tbl." where `name` like '".mysql_real_escape_string($val)."' and `".$fld."` <> ".intval($id);
	}
	else
	{
		if($id=='0' or $id=='')
			$sql="select * from ".$tbl." where `name` like '".mysql_real_escape_string($val)."' and parent_id=".$pid;
		else
			$sql="select * from ".$tbl." where `name` like '".mysql_real_escape_string($val)."' and `".$fld."` <> ".intval($id)." and parent_id=".$pid;	
	}
//die($sql);
	$rs=mysql_query($sql) or die(mysql_error().'<br />'.$sql);

	if(mysql_num_rows($rs)>0)
		return 1;
	else 
		return 0;
	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//Dtd XHTML 1.0 transitional//EN" "http://www.w3.org/tr/xhtml1/Dtd/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

	<title>shoe Admin</title>
	<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
	
	<script>var script_url = "/";</script>
	<link href="http://www.innogenius.com/shoebreeze/images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
	<script language="JavaScript" type="text/javascript" src="jquery.js"></script>

	<script language="JavaScript" type="text/javascript" src="jquery.validate.js"></script>
	<script language="JavaScript" type="text/javascript" src="script.js"></script>

	<link rel="stylesheet" type="text/css" href="admin.css" />
<script type="text/javascript" src="ntc.js"></script>

</head>

	<body onLoad="mk_height();">
	
		<table border="0" cellpadding="0" cellspacing="0"  align="center" class="mainbody">		
		
			<tr>
			    <td width="100%" valign="top">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" align="ceneter" class="bodycontent">
						<tr>
						    <td width="100%">					
							
								<table cellpadding="0" cellspacing="0" border="0" width="100%">

									<tr> 
										<td width="80%" class="topTitle">shoe admin<!-- <img src="http://www.quickworkz.com/dev/shoe/application/public/images/logo.gif" width="215" height="94" alt="logo" title="" /> --></td>
										<td class="hright" nowrap><?php echo date("l, F d, Y"); ?> | </td>
										<td class="hright" nowrap>Current user: <b>admin</b> | </td>
										<td class="hright" nowrap><a href="index.php"><b>Logout</b></a>&nbsp;&nbsp;</td>
									</tr>

							    </table>
							</td>
						</tr>
						
						<tr>
							<td class="menuBG">
								<table cellpadding="0" cellspacing="0" border="0" width="100%">
  <tr>
    <td width="200"></td>
    <td ><table cellpadding="0" cellspacing="0" border="0" width="100%">
      <tr>
      
<?php if(strpos($pself,'statistics') > 0) 
	  {
	  ?>
      <td class=" tab_on "><a class=" tab_o " href="statistics1.php">STATISTICS</a> </td>
  <?php
  }
  else
  {
  ?>
      <td class=" tab_sC "><a class=" tab " href="statistics1.php">STATISTICS</a> </td>
  <?php

  }
  ?>
      
<?php if(strpos($pself,'settings') > 0) 
	  {
	  ?>
      <td class=" tab_on "><a class=" tab_o " href="adminsettings.php">Settings</a> </td>
  <?php
  }
  else
  {
  ?>
      <td class=" tab_sC "><a class=" tab " href="adminsettings.php">Settings</a> </td>
  <?php

  }
  ?>


      <?php if(strpos($pself,'man') > 0 and strpos($pself,'manage') <= 0)
	  {
	  ?>
      <td class=" tab_on "><a class=" tab_o " href="footwareman.php">Utility</a> </td>
  <?php
  }
  else
  {
  ?>
      <td class=" tab_sC "><a class=" tab " href="footwareman.php">Utility</a> </td>
  <?php

  }
  ?>
  
   <?php if(strpos($pself,'manage') > 0)
	  {
	  ?>
      <td class=" tab_on "><a class=" tab_o " href="bannermanage.php">Manage</a> </td>
  <?php
  }
  else
  {
  ?>
      <td class=" tab_sC "><a class=" tab " href="bannermanage.php">Manage</a> </td>
  <?php

  }
  ?>
  
    <?php if(strpos($pself,'mem') > 0)
	  {
	  ?>
      <td class=" tab_on "><a class=" tab_o " href="showmem.php?t=v">Members</a> </td>
  <?php
  }
  else
  {
  ?>
      <td class=" tab_sC "><a class=" tab " href="showmem.php?t=v">Members</a> </td>
  <?php

  }
  ?>
  
   <?php if(strpos($pself,'adv') > 0)
	  {
	  ?>
      <td class=" tab_on "><a class=" tab_o " href="showadv.php?t=v">Advertisers</a> </td>
  <?php
  }
  else
  {
  ?>
      <td class=" tab_sC "><a class=" tab " href="showadv.php?t=v">Advertisers</a> </td>
  <?php

  }
  ?>

<?php if(strpos($pself,'shoeadm') > 0 or strpos($pself,'colors') > 0 or strpos($pself,'shoesadm') > 0)
	  {
	  ?>
      <td class=" tab_on "><a class=" tab_o " href="shoesadm.php">Shoes Database</a> </td>
  <?php
  }
  else
  {
  ?>
      <td class=" tab_sC "><a class=" tab " href="shoesadm.php">Shoes Database</a> </td>
  <?php

  }
  ?>

     
       
      </tr>
    </table></td>
    <td width="300"></td>
  </tr>
</table>   
							</td>
						</tr>
                        
                        				<tr>

							<td class="leftBGcolor">
 
 
 <?php if(strpos($pself,'statistics') > 0) 
{ 
?> 
	<div class="leftBody">
					<div class="menu_head">View Statistics</div>
            <div class="left_menu1"><a href="statistics1.php">Footwear Views</a></div>
            <div class="left_menu2"><a href="statistics9.php">Store Profile Views</a></div>
            <div class="left_menu2"><a href="statistics13.php">Store Coming Up in Detail Page</a></div>
             <div class="left_menu2"><a href="statistics14.php">Storewise Order Details</a></div>
            <div class="left_menu2"><a href="statistics2.php">Search Attributes</a></div>
            <div class="left_menu2"><a href="statistics3.php">Shoe Ratings</a></div>
            <div class="left_menu2"><a href="statistics4.php">Site Visits</a></div>
            <div class="left_menu2"><a href="statistics5.php">Category Stats</a></div>
            <div class="left_menu2"><a href="statistics6.php">Advertiser Signups</a></div>
            <div class="left_menu2"><a href="statistics7.php">Member Signups</a></div>
            <div class="left_menu2"><a href="statistics8.php"># Logins</a></div>
            <div class="left_menu2"><a href="statistics10.php">Shoes Added By Members</a></div>
            <div class="left_menu2"><a href="statistics11.php">Shoes Added By Advertisers</a></div>
            <div class="left_menu2"><a href="statistics12.php">Shoes Added By Guests</a></div>             
			</div>
 <?php
 }
 ?>    
 

                           
                            
<?php if(strpos($pself,'settings') > 0) 
{ 
?> 
	<div class="leftBody">
					<div class="menu_head">Manage Settings</div>

			<div class="left_menu2"><a href="adminsettings.php">Admin Settings</a></div>
            <div class="left_menu2"><a href="uploadsettings.php">Upload Settings</a></div>
			</div>
	<?php
 }
 ?>    
 
 <?php if(strpos($pself,'man') > 0 and strpos($pself,'manage') <= 0) 
{ 
?> 
       
     <div class="leftBody">
					<div class="menu_head">Manage All</div>
            <div class="left_menu1"><a href="catman.php">Categories</a></div>
			<div class="left_menu2"><a href="footwareman.php">Foot Ware</a></div>
			<div class="left_menu2"><a href="brandman.php">Brand</a></div>
			<div class="left_menu2"><a href="materialman.php">Material</a></div>
			<div class="left_menu2"><a href="heelheightman.php">Heel Height</a></div>
			<div class="left_menu2"><a href="heelsizeman.php">Heel Size</a></div>
			<div class="left_menu2"><a href="closureman.php">Closure Type</a></div>
			<div class="left_menu2"><a href="adccolorman.php">Advance Color Options</a></div>
			<div class="left_menu2"><a href="shoetypeman.php">Shoe Type</a></div>			
			<div class="left_menu2"><a href="soltypeman.php">Sole Type</a></div>
			<div class="left_menu2"><a href="shoesizeman.php">Shoe Size</a></div>
			<div class="left_menu2"><a href="shoewidthman.php">Shoe Width</a></div>
            <div class="left_menu2"><a href="seasonman.php">Seasons</a></div>
			<div class="left_menu2"><a href="languagesspokenman.php">Languages Spoken</a></div>
			<div class="left_menu2"><a href="paymentmethodsman.php">Payment Methods</a></div>
			</div>
 <?php
 }
 ?>
 
    <?php if(strpos($pself,'manage') > 0)
	  {
	  ?>
<div class="leftBody">
					<div class="menu_head">Manage All</div>
			<div class="left_menu1"><a href="bannermanage.php">Banners</a></div>
			<div class="left_menu2"><a href="newslettersmanage.php">Newsletter</a></div>
			<div class="left_menu2"><a href="static_pagesmanage.php">Static Pages</a></div>
			<div class="left_menu2"><a href="site_contactsmanage.php">Site Contacts</a></div>
            <div class="left_menu2"><a href="feedbackmanage.php">Feedback for Shoes</a></div>
            <div class="left_menu2"><a href="newsletterlistmanage.php">Newsletter Mailing List</a></div>
			</div>
<?php
}
?>

<?php if(strpos($pself,'mem') > 0)
	  {
	  ?>
<div class="leftBody">
					<div class="menu_head">Manage Members</div>
			<div class="left_menu1"><a href="showmem.php?t=v">Verified Members</a></div>

			<div class="left_menu2"><a href="showmem.php?t=u">Unverified Members</a></div>
			</div>
<?php
}
?>


<?php if(strpos($pself,'adv') > 0)
	  {
	  ?>
<div class="leftBody">
					<div class="menu_head">Manage Advertisers</div>
			<div class="left_menu1"><a href="showadv.php?t=v">Verified Advertisers</a></div>
			<div class="left_menu2"><a href="showadv.php?t=u">Unverified Advertisers</a></div>
            <div class="left_menu2"><a href="storesadv.php">Stores</a></div>
			<div class="left_menu2"><a href="showadvpackages.php">Packages</a></div>
            <div class="left_menu2"><a href="showadvaddons.php">Addons</a></div>
            <div class="left_menu2"><a href="advaddons.php">Addon Purchases</a></div>
            <div class="left_menu2"><a href="showadvstaffers.php">Staffers</a></div>
            <div class="left_menu2"><a href="storesremadv.php">Reminder Section</a></div>
            <div class="left_menu2"><a href="downgradesadv.php">Downgrade Requests</a></div>
			</div>
            
            <?php
}
?>

