<?php include('header.php'); 

$sql="update cart set paid='paid' where sessionid='".session_id()."'";		
mysql_query($sql) or die(mysql_error()."----".$sql);

$header='';
$mid='';
$footer='';
$arrmid=array();
$m=0;
$advarr=array();

			$header='
			<!DOCTYPE html PUBLIC "-//W3C//Dtd XHTML 1.0 transitional//EN" "http://www.w3.org/tr/xhtml1/Dtd/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
		<head>
			<title>Home</title>
			<meta name="description" content="Home | ShoeBreeze.com" />
		
			<meta name="keywords" content="Home | ShoeBreeze.com" />
			<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
			<meta name="generator" content="shoe.com" />
			<link rel="stylesheet" href="http://www.innogenius.com/shoebreeze/style2.css" type="text/css" />
			<link rel="stylesheet" href="http://www.innogenius.com/shoebreeze/style.css" type="text/css" />
<style>
	body{
		padding:0px;
		margin:0px;
		font-size:14px;
		color: #4F4F4F;
		background:#FFFFFF;
		background-image:none;		
		font-family:Verdana,Tahoma,Arial,sans-serif;
		color:#5B2F5F;
	}
</style>
		
			
		
		</head>
			<body>
				
				<div class="mainbody">
					<div class="content" style="background-color:#E0D6E1">
						<div class="space_top">&nbsp;</div>		 
		<div class="divider_h">&nbsp;</div>
		<div class="mid_body">
		  <div class="mid_body">
		
			<p>Dear Customer,</p>
			<p><br />
			 You have successfully made a purchase on our site.<br>
			 Please see below the details of the transaction.<br />
<br />';
			  
          $rsh=mysql_query("select * from cart where sessionid='".session_id()."' and paid='paid' group by advid,stoid");
          while($rshrow=mysql_fetch_array($rsh))
          {
		  	$memid=$rshrow['memid'];
		  	$rsadv=mysql_query("select * from soe_members where mem_id=".$rshrow['advid']);
			$rsadvrow=mysql_fetch_array($rsadv);
			
			 $rs2=mysql_query("select * from soe_stores where sto_id=".$rshrow['stoid']);
             $row2=mysql_fetch_array($rs2);
			  $advarr[$m]=$rshrow['advid'];
			 $arrmid[$m]='';
         $arrmid[$m].='
          <table cellpadding="10" cellspacing="0" width="100%"  border="1" bordercolor="#fafafa" >
            <tr valign="top" bgcolor="#D7EBFF" width="100%">
              <td colspan="3" bgcolor="#D7EBFF"><b>From Seller : <span class="style1">'.$rsadvrow['first_name']." ".$rsadvrow['last_name'].'</span>&nbsp;&nbsp;&nbsp;Store : <span class="style1">'.$row2['store_name'].'</span> </b></td>
              <td bgcolor="#D7EBFF" ><b>Price:</b></td>
              <td width="8%" align="middle" bgcolor="#D7EBFF" ><b>Qty:</b></td>
              <td width="8%" align="middle" bgcolor="#D7EBFF" ><b>Total:</b></td>
            </tr>';
            
          
                $tot=0;
                $maintot=0;
				$rs=mysql_query("select * from cart where sessionid='".session_id()."' and paid='paid' and advid=".$rshrow['advid']." and stoid=".$rshrow['stoid']);
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
                    
                    $img='<img src="http://www.innogenius.com/shoebreeze/uploads/shoe_photo/thumb98_'.getcol($row['itemid'],'',$row['colid']).'" alt="" border="0"  />' ;
    
           
             $arrmid[$m].='<tr style="border-bottom:1px solid #000;" >
              <td width="8%" height="52" align="right" valign="top" >
               &nbsp;</td>
                <td style="padding-right: 20px;" valign="top">'.$img.'</td>
                <td style="padding-right: 20px;" valign="top"><b><span >'.$row1['name'].', '.$row3['name'].'</a> </span></b><br />
                  <br />
                <span  class="small">Shipped from:&nbsp;'.$row2['store_name'].'</span> </td>
              <td valign="top" class="small"><b class="price2">$ '.$row['price'].'</b><br />          </td>
              <td valign="top">'.$row['qty'].'</td>
              <td valign="top" class="small"><b class="price2">$ '.$tot.'</b></td>
            </tr>';
            
           
            }
            
            
           $arrmid[$m].='<tr style="border-bottom:1px solid #000;" >
              <td height="52" colspan="2" align="left" valign="top" ></td>
              <td height="52" align="right" valign="top" >&nbsp;</td>
              <td height="52" colspan="2" align="right" valign="top" ></td>
              <td valign="top" class="small"><b class="price2">$ '.$maintot.'</b></td>
            </tr>
          </table>';
         
          $mid.=$arrmid[$m];
		  $m++;  

          }
		  
		$footer='
      

			</p>
			<p>
			</p>
			<p>
			  <br />
			  Thanks,<br>
			  Shoesite Team.			  
			</p>
		  </div>
		  </div>
					</div>
					<div class="footer"><br class="clear"/>		
							Copyright &copy; ShoeBreeze.com All rights reserved.
				  </div>				
						
			</div>			
				</div>
		
				
				<!-- footer -->
				
			</body>
		</html>				
						
					
			';
			
			
				$rs22=mysql_query("select * from soe_members where mem_id=".$memid) or die(mysql_error());
				$row22=mysql_fetch_array($rs22);
				$em1=$row22['email'];
				$mailcontent=$header.$mid.$footer;
				
					$mail = new PHPMailer();
					$mail->IsHTML(true);
					$mail->Subject ="ShoeBreeze - Shoe(s) Purchase Successful!";
					$mail->Body    = $mailcontent;
					$mail->From = "quickonline.us1@gmail.com";
					$mail->FromName="ShoeBreeze.com";
					$mail->AddAddress($em1);					
					$mail->AddBCC('quickonline.us1@gmail.com');
					$mail->AltBody ="Your mail is not supporting html format";
					$mail->IsMail();
					if(!$mail->Send())
					{
						$msg =$mail->ErrorInfo;
					}					
					

				for($i=0;$i<$m;$i++)
				{
					$rs22=mysql_query("select * from soe_members where mem_id=".$advarr[$i]);
					$row22=mysql_fetch_array($rs22);
					$em2=$row22['email'];
					$mailcontent=$header.$arrmid[$i].$footer;
					$mail = new PHPMailer();
					$mail->IsHTML(true);
					$mail->Subject ="ShoeBreeze - Shoe(s) Purchase Successful!";
					$mail->Body    = $mailcontent;
					$mail->From = "quickonline.us1@gmail.com";
					$mail->FromName="ShoeBreeze.com";
					$mail->AddAddress($em2);
					$mail->AddBCC('quickonline.us1@gmail.com');
					$mail->AltBody ="Your mail is not supporting html format";
					$mail->IsMail();
					if(!$mail->Send())
					{
						$msg =$mail->ErrorInfo;
					}
				}
//session_regenerate_id();					
					
?>	
<?php include("left.php"); ?>
			
  
  <div id="content_area_mid_inner1">
  <div>
    <h2>Payment Successful!</h2>
  </div>
   
    <div class="moremarketing">
      
 
     
            <p class="blue_bold">Thank You !!.. Your order will be processed within 5-6 business days.</p>
      <div class="clear"></div>
</div>
  
  </div>
  <div id="content_area_right"><?php echo showbanners("right"); ?></div>
  <div class="clear"></div>
  <!-- Content Area End -->
  <div class="hei"></div>
  
 

<?php include("footer.php"); ?>