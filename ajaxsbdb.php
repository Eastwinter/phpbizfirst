<?php
include("connect.php");
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
    <?php
	//print_r($_POST);
if($_SERVER['REQUEST_METHOD']=="POST")
{
	$cond='';
		if($_POST['shoe_name']!='')
			$cond.=" and name like '%".$_POST['shoe_name']."%'";

		if($_POST['shc_id']!='')
		{
			$cond.=" and shc_id = '".$_POST['shc_id']."'";
			$rs=mysql_query("select * from soe_shoe_category where shc_id=".$_POST['shc_id']);
			$row=mysql_fetch_array($rs);
			$rs=mysql_query("select * from soe_shoe_category where shc_id=".$row['parent_id']);
			$row=mysql_fetch_array($rs);
			
			
		}	
		if($_POST['fot_id']!='')
			$cond.=" and fot_id = '".$_POST['fot_id']."'";
		
		if($_POST['brn_id']!='')
			$cond.=" and brn_id = '".$_POST['brn_id']."'";

		
		if($_POST['sea_id']!='')
			$cond.=" and sea_id = '".$_POST['sea_id']."'";
		
		if($_POST['con_id1']!='')
			$cond.=" and cnt_id = '".$_POST['con_id1']."'";
		
		if($_POST['store_name']!='')
			$cond.=" and sto_id in (select sto_id from soe_stores where store_name like '%".$_POST['store_name']."%' and active='1')";
		
		if($_POST['sta_id1']!='')
			$cond.=" and sta_id = '".$_POST['sta_id1']."'";
		
		if($_POST['cty_id1']!='')
			$cond.=" and cty_id = '".$_POST['cty_id1']."'";
		
		if($_POST['zipcode']!='')
			$cond.=" and zip_code = '".$_POST['zipcode']."'";
		
		if($_POST['price']>0)
			$cond.=" and price <= ".$_POST['price'];
		$_SESSION['condi']=$cond;
}
else
	$cond=$_SESSION['condi'];

?>  
 <div class="edittable">
        <table align="center" border="1" cellpadding="5" cellspacing="1" width="98%">
        
                     
                  <tr class="tableheader1">
                  <th height="35">&nbsp; </th>
                  <th>&nbsp;</th>
                  <th> ID</th>
                  <th>Shoe Name</th>
                  <th>Shoe Price</th>
                  </tr>
               
		

<?php 
			   
		
			
		if($_POST['sto_id']>0)
		$sql="select * from soe_shoe where active='1' and mem_id=1 and soe_id not in (select addedfromsb from soe_shoe where sto_id=".$_POST['sto_id']." and loc_id=".$_POST['loc_id'].") ".$cond;
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
   <li class="numbers"><a  onclick="shcalc(<?php echo $i; ?>,<?php echo $_POST['sto_id']; ?>,<?php echo $_POST['loc_id']; ?>);" class="gray_link"><?php echo $i; ?></a></li>
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