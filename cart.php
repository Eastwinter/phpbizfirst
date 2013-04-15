<?php include("header.php"); 

if($_GET['id']>0)
{
	mysql_query("delete from cart where id=".$_GET['id']);
}
?>
  <?php include("left.php"); ?>
  <style type="text/css">
<!--
.style1 {color: #990000}
-->
  </style>
  
  <div id="content_area_mid_inner_big">
    <div class="shoppingcarthd">
      <h2>Shopping Cart Items</h2>
    </div>
    <div class="border">
            <?php
		$rs=mysql_query("select * from cart where sessionid='".session_id()."'");
		if(mysql_num_rows($rs)>0)
		{
		?>

      <!--shopcart list -->
      <form action="updatecart.php" method="post" name="mycartfrm" id="mycartfrm">
      
		  <?php
          $rsh=mysql_query("select * from cart where sessionid='".session_id()."' and paid='not paid' group by advid,stoid");
          while($rshrow=mysql_fetch_array($rsh))
          {
		  	$rsadv=mysql_query("select * from soe_members where mem_id=".$rshrow['advid']);
			$rsadvrow=mysql_fetch_array($rsadv);
			
			 $rs2=mysql_query("select * from soe_stores where sto_id=".$rshrow['stoid']);
             $row2=mysql_fetch_array($rs2);
          ?>
          <table cellpadding="10" cellspacing="0" width="100%"  border="1" bordercolor="#fafafa" >
            <tr valign="top" bgcolor="#D7EBFF" width="100%">
              <td colspan="3" bgcolor="#D7EBFF"><b>From Seller : <span class="style1"><?php echo $rsadvrow['first_name']." ".$rsadvrow['last_name']; ?></span>&nbsp;&nbsp;&nbsp;Store : <span class="style1"><?php echo $row2['store_name']; ?></span> </b></td>
              <td bgcolor="#D7EBFF" ><b>Price:</b></td>
              <td width="8%" align="middle" bgcolor="#D7EBFF" ><b>Qty:</b></td>
              <td width="8%" align="middle" bgcolor="#D7EBFF" ><b>Total:</b></td>
            </tr>
            
            <?php
                $tot=0;
                $maintot=0;
				$rs=mysql_query("select * from cart where sessionid='".session_id()."' and paid='not paid' and advid=".$rshrow['advid']." and stoid=".$rshrow['stoid']);
                while($row=mysql_fetch_array($rs))
                {
                    $rs1=mysql_query("select * from soe_shoe where soe_id=".$row['itemid']);
                    $row1=mysql_fetch_array($rs1);
                    if($row1['active']=='0' or $row['hide']=='1')
                        continue;
                    
                    $rs3=mysql_query("select * from soe_brand where brn_id=".$row1['brn_id']);
                    $row3=mysql_fetch_array($rs3);
    
                    $rs2=mysql_query("select * from soe_stores where sto_id=".$row['stoid']);
                    $row2=mysql_fetch_array($rs2);
                    
                    $tot=$row['qty']*$row['price'];
                    $maintot+=$tot;
                    
                    $img='<img src="uploads/shoe_photo/thumb98_'.getcol($row['itemid'],'',$row['colid']).'" alt="" border="0"  />' ;
    
            ?>
            <tr style="border-bottom:1px solid #000;" >
              <td width="8%" height="52" align="right" valign="top" ><br />
                <a href="cart.php?id=<?php echo $row['id']; ?>"><img src="images/delete2.gif" border="0" /></a></td>
                <td style="padding-right: 20px;" valign="top"><?php echo $img; ?></td>
                <td style="padding-right: 20px;" valign="top"><b><span > <a href="detail-id-<?php echo $row['itemid']; ?>.htm" class="addcarthd"><?php echo $row1['name']; ?>, <?php echo $row3['name']; ?></a> </span></b><br />
                  <br />
                <span  class="small">Shipped from:&nbsp;<a onclick="window.open('advstorepop.php?id=<?php echo $row2['sto_id']; ?>','','status=no,menubar=no,toolbars=no,width=700,height=800,scrollbars=yes');" class="difclr2"><?php echo $row2['store_name']; ?></a></span> </td>
              <td valign="top" class="small"><b class="price2">$ <?php echo $row['price']; ?></b><br />          </td>
              <td valign="top"><input type="text"  size="2" maxlength="3" name="qty<?php echo $row['id']; ?>" id="qty<?php echo $row['id']; ?>" value="<?php echo $row['qty']; ?>" onblur="javascript: if(this.value<=0 || isNaN(this.value)) { alert('Qty should greater than zero'); this.value='<?php echo $row['qty']; ?>'; }"  />          </td>
              <td valign="top" class="small"><b class="price2">$ <?php echo $tot; ?></b></td>
            </tr>
            
            <?php
            }
            ?>
            
            <tr style="border-bottom:1px solid #000;" >
              <td height="52" colspan="2" align="left" valign="top" ></td>
              <td height="52" align="right" valign="top" >&nbsp;</td>
              <td height="52" colspan="2" align="right" valign="top" ></td>
              <td valign="top" class="small"><b class="price2">$ <?php echo $maintot; ?></b></td>
            </tr>
          </table>
         
            
              <?php
          }
		  ?>
           <div align="right"><br />
           <input type="image" src="images/UpdateQtyButton.gif" align="right" border="0" />
            <br /><br />

              <a href="paypalcart.php?advid=<?php echo $rshrow['advid']; ?>&stoid=<?php echo $rshrow['stoid']; ?>"><img src="images/checkout.gif" width="111" height="47" border="0" /></a>
              </div>
      </form>
          <?php
	  }
	  else
	  echo '<span style="font-variant:small-caps; font-size:18px;"><center><strong>No Items Added To Cart</strong><center></span>';
	  ?>
      
      <!-- shopcart list -->
      <div class="clear"></div>
    </div>
    <div class="hei">&nbsp;</div>
  </div>
  <!-- This contains the hidden content for inline calls -->
  
  
  
  <div class="clear"></div>
  <!-- Content Area End -->
  <div class="hei"></div>
<?php include("footer.php"); ?>