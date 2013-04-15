<?php include("header.php"); 
if($_GET['action']=='del')
{
	mysql_query("delete from soe_stores where sto_id=".$_GET['id']);
	mysql_query("delete from soe_storelocations where sto_id=".$_GET['id']);
}



delstores($_SESSION['memberid']);

?>
<?php include("left3.php"); ?>
  
  <div id="content_area_mid_inner2">
  <div>
    <h2>Purchase Lot</h2>
  </div>
    <div class="sbdatabase">
      <div class="edittable" style="padding-left:10px;">
        <div align="left">
        <table width="99%" border="1" cellpadding="8" cellspacing="1" bgcolor="#E0D6E1">
        
		  <tr>
            <td width="19%"><span style="font-weight: bold">Name</span></td>
            <td width="27%"><strong>Package</strong></td>
            <td width="18%"><strong>Valid</strong></td>
            <td width="4%" align="center" valign="middle"><span style="font-weight: bold">Edit</span></td>
            <td width="7%" align="center" valign="middle"><span style="font-weight: bold">Published</span></td>
            </tr>
          
		  <?php
		  $stores=0;
		  $s="select * from soe_stores where mem_id=".$_SESSION['memberid']." order by sto_id";
		 // echo $s;
		  $rs=mysql_query($s) or die(mysql_error());
		  while($row=mysql_fetch_array($rs))
		  {
		  	$stores++;
			if($row['active']==1)
			{
				$str='<img src="images/published.png" width="20" height="20" />';
			}			
			else
			{
			    $str='<img src="images/unpublished.png" width="20" height="20" />';
			}
			

			$hrs1=mysql_query("select * from soe_membership where sto_id=".$row['sto_id']);
			$hrsrow1=mysql_fetch_array($hrs1);
			
			$hrs=mysql_query("select * from soe_packages where packageid=".$hrsrow1['packageid']);			
			$hrsrow=mysql_fetch_array($hrs);

		  ?>
          
          <tr>
          <td bgcolor="#FFFFFF">
		  		<span class="msg" style="text-align:left; "><?php echo $row['store_name']; ?></span>                </td>
          <td bgcolor="#FFFFFF"><?php echo $hrsrow['code']." - ".$hrsrow['name']; ?> </td>
          <td bgcolor="#FFFFFF"><?php echo date('m/d/Y',$hrsrow1['paydate']); ?> TO <?php echo date('m/d/Y',$hrsrow1['expire']); ?></td>
          <td align="center" valign="middle" bgcolor="#FFFFFF">
          <?php
		  if($row['active']==1)
		  {
		  ?>
          <a href="packages2.php?memshipid=<?php echo $hrsrow1['memshipid']; ?>&stoid=<?php echo $row['sto_id']; ?>&diff=<?php echo $row['diff']; ?>">Switch Package</a>
          <?php
		  }
		  ?>
          
          </td>
          <td align="center" valign="middle" bgcolor="#FFFFFF"><?php echo $str; ?></td>
          </tr>
          	      <br class="clear"/>
          <?php
		  }
		  ?>
          </table>
          <p><br />
          </p>
          <?php
		  if($stores>0)
		  {
		  ?>
          <p><strong><u>Additional Store In state (Has to be in  the same as main store):&nbsp; </u></strong>&nbsp;&nbsp;&nbsp;<a href="addstore1.php?diff=false" class="style2 style3">Add New Store</a></p>
          
          <table width="90%" border="1" cellpadding="0" cellspacing="0">
            <tr>
              <td rowspan="2" align="center" valign="middle"><p>Each Additional&nbsp; Store</p>                </td>
              <?php
			  $gh=mysql_query("select * from soe_packages where name not like 'Default' order by packageid");
			  while($ghrow=mysql_fetch_array($gh))
			  {
			  ?>
              <td valign="top"><p><?php echo $ghrow['name']; ?></p></td>
              <?php
			  }
			  ?>
            </tr>
            <tr>
           <?php
			  $gh=mysql_query("select * from soe_packages where name not like 'Default' order by packageid");
			  while($ghrow=mysql_fetch_array($gh))
			  {
			  ?>
            
              <td valign="top"><p>$<?php echo $ghrow['addstoresamestate']; ?></p></td>
            <?php
			}
			?>
            </tr>
          </table>
          <p><strong><u>Additional Store different state:</u></strong>&nbsp;&nbsp;<a href="addstore1.php?diff=true" class="style4">Add New Store</a></p>
          <table width="90%" border="1" cellpadding="0" cellspacing="0">
            <tr>
              <td rowspan="2" align="center" valign="middle"><p>Each Additional&nbsp; Store</p>                </td>
              <?php
			  $gh=mysql_query("select * from soe_packages where name not like 'Default' order by packageid");
			  while($ghrow=mysql_fetch_array($gh))
			  {
			  ?>
              <td valign="top"><p><?php echo $ghrow['name']; ?></p></td>
              <?php
			  }
			  ?>
            </tr>
            <tr>
           <?php
			  $gh=mysql_query("select * from soe_packages where name not like 'Default' order by packageid");
			  while($ghrow=mysql_fetch_array($gh))
			  {
			  ?>
            
              <td valign="top"><p>$<?php echo $ghrow['addstorediffstate']; ?></p></td>
            <?php
			}
			?>
            </tr>
          </table>
      <?php
	  }
	  else
	  {
	  ?>
      <p><strong><u>Add A Store:</u></strong>&nbsp;&nbsp;<a href="addstore1.php" class="style4">Add New Store</a></p>
          <table width="90%" border="1" cellpadding="0" cellspacing="0">
            <tr>
              <td rowspan="2" align="center" valign="middle"><p> Store Packages</p>                </td>
              <?php
			  $gh=mysql_query("select * from soe_packages order by packageid");
			  while($ghrow=mysql_fetch_array($gh))
			  {
			  ?>
              <td valign="top"><p><?php echo $ghrow['name']; ?></p></td>
              <?php
			  }
			  ?>
            </tr>
            <tr>
           <?php
			  $gh=mysql_query("select * from soe_packages order by packageid");
			  while($ghrow=mysql_fetch_array($gh))
			  {
			  ?>
            
              <td valign="top"><p>$<?php echo $ghrow['price']; ?></p></td>
            <?php
			}
			?>
            </tr>
          </table>
      <?php
	  }
	  ?>
      </div>
      </div>
    </div>
  </div>
  <div class="clear"></div>
  <!-- Content Area End -->
  <div class="hei"></div>
<?php include("footer.php"); ?>