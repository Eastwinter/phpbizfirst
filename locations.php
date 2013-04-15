<?php
include("header.php");
if($_GET['action']=='del')
{
	mysql_query("delete from soe_storelocations where loc_id=".intval($_GET['locid'])) or die(mysql_error());
}

?>
<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: small;
}
-->
</style>
<?php include("left3.php"); ?>
 
  <div id="content_area_mid_inner1">
    <div class="border1" >
     <div>
    <h2>My Stores - Locations</h2>
  </div>
      <table align="center" border="1" cellpadding="5" cellspacing="1" width="98%">
        
		  <tr>
            <td width="19%"><span style="font-weight: bold">Address</span></td>
            <td width="27%"><strong>City</strong></td>
            <td width="18%"><strong>State</strong></td>
            <td width="14%" align="center" valign="middle"><strong>Country</strong></td>
            <td width="4%" align="center" valign="middle"><span style="font-weight: bold">Edit</span></td>
            <td width="5%" align="center" valign="middle"><span style="font-weight: bold">Delete</span></td>
          </tr>
          
		  <?php
		  $n=0;
		  $s="select * from soe_storelocations where sto_id=".$_GET['id'];
		  $rs=mysql_query($s) or die(mysql_error());
		  while($row=mysql_fetch_array($rs))
		  {
		  		$n++;
		  		$rs1=mysql_query("select * from soe_geo_countries where con_id=".$row['con_id']);
				$row1=mysql_fetch_array($rs1);
				$cname=$row1['name'];

		  		$rs1=mysql_query("select * from soe_geo_states where sta_id=".$row['sta_id']);
				$row1=mysql_fetch_array($rs1);
				$stname=$row1['name'];

		  		$rs1=mysql_query("select * from soe_geo_cities where cty_id=".$row['cty_id']);
				$row1=mysql_fetch_array($rs1);
				$ctname=$row1['name'];

		  ?>
          
          <tr>
          <td bgcolor="#FFFFFF">
		  		<span class="msg" style="text-align:left; "><?php echo $row['address']; ?></span>                </td>
          <td bgcolor="#FFFFFF"><?php echo $ctname; ?> </td>
          <td bgcolor="#FFFFFF"><?php echo $stname; ?></td>
          <td align="center" valign="middle" bgcolor="#FFFFFF"><?php echo $cname; ?></td>
          <td align="center" valign="middle" bgcolor="#FFFFFF"><a href="addlocation.php?id=<?php echo $row['loc_id']; ?>&stoid=<?php echo $row['sto_id']; ?>">
          <img src="images/edit.png" width="32" height="32" border="0" /></a></td>
          <td align="center" valign="middle" bgcolor="#FFFFFF">
          <a href="javascript: show('<?php echo $_GET['id']; ?>','<?php echo $row['loc_id']; ?>');"><img src="images/delete.png" width="32" height="32" border="0" /></a></td>          
          </tr>
          	      <br class="clear"/>
          <?php
		  }
		  ?>
          </table>
          <br />
<br />
<?php
$arr=getpack($_SESSION['memberid'],$_GET['id']);
if($n<($arr['location']-1))
{
	echo '<a href="addlocation.php?stoid='.$_GET['id'].'" class="style1">Add Location</a>';
}
else
{
?>
    Want to add additional locations for the store. But should be in the same state.<br />
	You need to subscribe for a monthly payment of  $<?php echo $arr['addlocation']; ?>.<br /><br />
<input name="b1" type="button" value="          CONTINUE          " onclick="javascript: location.href='addlocation.php?stoid=<?php echo $_GET['id']; ?>&pay=true';"/>
    <?php
}
   ?>
    </div>
  </div>
  <div id="content_area_right"><?php echo showbanners("right"); ?></div>
  <div class="clear"></div>
  <!-- Content Area End -->
  <div class="hei"></div>
   <script>
		function show(id,locid)
		{
			ans=confirm("Are you sure to delete?");
			if(ans==true)
				location.href="locations.php?id="+id+"&action=del&locid="+locid;
				
		}
		</script>  
<?php include("footer.php"); ?>