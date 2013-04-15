<?php
include ("connect.php");

//print_r($_POST);
if($_SERVER['REQUEST_METHOD']=="POST" and $_POST['subval']==0)
{
$c='';
$n1=count($_POST['chkbox']);
if($n1==0)
{
	$msg="Please select a shoes to add";
}

if($n1>0)
{
$st=$_POST['storeid'];
$st1=explode("-",$st);

		$arr=getpack($_SESSION['memberid'],$st1[0]);
		if($st1[0]>0)
		{
			$a="select * from soe_shoe where sto_id=".$st1[0]." and mem_id=".$_SESSION['memberid'];
			$gtrs=mysql_query($a) or die(mysql_error());
			$n=mysql_num_rows($gtrs);
				
			if($n>=$arr['shoes'])
			{
			 $msg="Shoes Limit For This Store is ".$arr['shoes'].". You cannot add more.";
			}
			else
						{
						
						$x=$arr['shoes']-$n;
						
						if($n1>$x)
						{
						$msg="You can select ".$x." shoes only. Please select again.";
						
						}	
						else
						{
					
					
					
					
								for($i=0;$i<count($_POST['chkbox']);$i++)
								{
								$c=$_POST['chkbox'][$i];
								
								$rs=mysql_query("select * from soe_shoe where soe_id=".$c);
								$row=mysql_fetch_array($rs);
								
								
								
								//die();
								//echo '<hr>'.$st;
								$sql="INSERT INTO soe_shoe set
								`mem_id`='".$_SESSION['memberid']."' ,
								`name`='".mysql_real_escape_string($row['name'])."',
								`description`='".mysql_real_escape_string($row['description'])."',
								`link` ='".$row['link']."',
								`cnt_id`='".$row['cnt_id']."', 
								`brn_id` ='".$row['brn_id']."',
								`fot_id` ='".$row['fot_id']."',
								`col_id` ='".$row['col_id']."',
								`mtr_id` ='".$row['mtr_id']."',
								`hlh_id` ='".$row['hlh_id']."',
								`hls_id` ='".$row['hls_id']."',
								`sol_id` ='".$row['sol_id']."',
								`clo_id` ='".$row['clo_id']."',
								`lace` ='".$row['shoe_lace']."',
								`siz_id` ='".$row['siz_id']."',
								`sht_id` ='".$row['sht_id']."',
								`shw_id` ='".$row['shw_id']."',
								`price` ='".$row['price']."',
								`sea_id` ='".$row['sea_id']."',
								`active` ='1',
								`added` ='".strtotime(date("Y-m-d"))."',
								`shc_id`='".$row['shc_id']."',
								`sto_id`='".$st1[0]."',
								`loc_id`='".$st1[1]."',
								addedfromsb=".$c;
								mysql_query($sql) or die("ERROR -> ".mysql_error().'<br>'.$sql);
								$newshoeid=mysql_insert_id();
								
								$rs=mysql_query("select * from soe_shoecolors where soe_id=".$c);
										while($row=mysql_fetch_array($rs))
										{
												$sql="INSERT INTO soe_shoecolors set
												`color`='".$row['color']."',
												`logo`='".$row['logo']."',
												`logo1`='".$row['logo1']."',
												`logo2`='".$row['logo2']."',
												`logo3`='".$row['logo3']."',
												`logo4`='".$row['logo4']."',
												`logo5`='".$row['logo5']."',
												`logo6`='".$row['logo6']."',
												`soe_id`='".$newshoeid."'";
												mysql_query($sql) or die("ERROR -> ".mysql_error().'<br>'.$sql);
												
												
										}
										
								}
								$msg="Shoe Added Successfully";
						}
					  }
	}
}
}
?>

    <!--
  jQuery library
-->
<script type="text/javascript" src="lib/jquery-1.4.2.min.js"></script>
<!--
  jCarousel library
-->
<script type="text/javascript" src="lib/jquery.jcarousel.min.js"></script>
<!--
  jCarousel skin stylesheets
-->
<link rel="stylesheet" type="text/css" href="skins/tango/skin1.css" />
<link rel="stylesheet" type="text/css" href="skins/ie7/skin.css" />

<script type="text/javascript">
 var $j = jQuery.noConflict();
$j(document).ready(function() {
	$j('.mycarousel').jcarousel();
});

</script>


<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: medium;
}

.errstyle{
color:#FF0000; 
font-weight:bold;
font-size:14px;
font-variant:small-caps
}
-->
</style>



 <div class="edittable">
<span class="errstyle" ><?php echo $msg; ?></span><br />
        <table align="center" border="1" cellpadding="5" cellspacing="1" width="98%">
                  <tr class="tableheader1">
                  <th height="35">&nbsp; </th>
                  <th>&nbsp;</th>
                  <th> ID</th>
                  <th>Shoe Name</th>
                  <th>Shoe Price</th>
                  </tr>
               
		


        	   <?php 
			   
	$cond=$_SESSION['condi'];
	if($_GET['stoid']>0)
	{
		$stoid=$_GET['stoid'];
		$locid=$_GET['locid'];
	}
	elseif($_POST['storeid']>0)
		{
			$a=explode("-",$_POST['storeid']);
			$stoid=$a[0];
			$locid=$a[1];
		}
		
		if($stoid>0)
		$sql="select * from soe_shoe where active='1' and mem_id=1 and soe_id not in (select addedfromsb from soe_shoe where sto_id=".$stoid." and loc_id=".$locid.") ".$cond;
		else
		$sql="select * from soe_shoe where active='1' and mem_id=1 ".$cond;

//echo $sql;
		$rs=mysql_query($sql) or die(mysql_error());	
		$totrec=mysql_num_rows($rs);
		$totpages=ceil($totrec/20);
		if($_GET['curpage']=='')
			$curpage=1;
		else
			$curpage=$_GET['curpage'];
		$start=($curpage-1)*20;	
		$sql=$sql." limit ".$start.",20";
		$rs=mysql_query($sql) or die(mysql_error());	
		
		$n=1;
          	 while($row=mysql_fetch_array($rs))
             {
			 	$ph="uploads/shoe_photo/"."thumb30_".getcol($row['soe_id']);
				
				$str=''.$row['name'].'';
				$rs1=mysql_query("select * from soe_brand where brn_id=".$row['brn_id']);
				if(mysql_num_rows($rs1)>0)
				{
					$row1=mysql_fetch_array($rs1);
					$str.='<br />'.$row1['name'];
				}
								
				if($row['price']>0)
				{
					$str.='<br /><span style="color:#FF0000">$'.$row['price'].'</span>';
				}
				
	$ph1="uploads/shoe_photo/".getcol($row['soe_id']);
	
	if(isset($_POST['chkbox']))
	{
		$arr=$_POST['chkbox'];
		if(in_array($row['soe_id'],$arr))
			$c='checked';
		else
			$c='';
	}

?>              
                <tr>
                  <td><input type="checkbox" value="<?php echo $row['soe_id']; ?>" name="chkbox[]"  id="chkbox[]" <?php echo $c; ?> /></td>
                  <td align="center" valign="middle"><a href="detail-id-<?php echo $row['soe_id']; ?>.htm" rel="<?php echo $ph1; ?>" class="preview" ><img src="<?php echo $ph; ?>" alt="" border="0"  /></a></td>
                  <td><?php echo $row['soe_id']; ?></td>
                  <td><?php echo $row['name']; ?></td>
                  <td><?php echo $row['price']; ?></td>
                </tr>
       <?php
	   }
	   ?>
                <tr><td colspan="5" align="center" valign="middle">  
        <a name="pagination"></a>
         <div class="clear"></div>
      <?php
		if($totpages>1)
		{
		?>
        
        
        <div id="numbring">
        <ul id="carousel" class="mycarousel jcarousel-skin-tango">
         <?php
		  
		  for($i=1;$i<=$totpages;$i++)
		  {
		  ?>
   <li class="numbers"><a  onclick="shcalc(<?php echo $i; ?>,<?php echo $stoid; ?>,<?php echo $locid; ?>);" class="gray_link"><?php echo $i; ?></a></li>
         <?php
		  }
		  ?>
          </ul>
        <div class="clear"></div>
      </div>
        
      
      <?php
	  }
	  ?>
        </td>
                </tr>
              </table>
              </div>