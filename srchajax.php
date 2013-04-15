<?php include("connect.php"); ?>
<script src="js/main.js" type="text/javascript"></script>

<style>
#preview{
	position:absolute;
	border:1px solid #ccc;
	background:#333;
	padding:1px;
	display:none;
	color:#ccc;
	}

.zoomPreload{
	display:none !important;
}	
</style>
      <script>
$j(document).ready(function() { 
    var options = { 
        target:        '#savefrmdiv',   // target element(s) to be updated with server response 
    }; 
 
    // bind form using 'ajaxForm' 
    $('#savefrm').ajaxForm(options); 
	
	
	$("#svesrch").click(function() {
		if(document.savefrm.title.value=='')
			alert("Please enter a title to save");
		else
           $('#savefrm').submit();
        });
}); 
 
</script>

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
      
  <div><h2>
   <?php
		  if($_GET['ja']==1)
          	echo "Just Added";
		  elseif($_GET['ja']==2)
          	echo "Most Popular";
		  else
          	echo "Search Results";
		?>	
        </h2></div>	 

<?php 
		if(($_GET['curpage']=='' or $_GET['sort']>0) and $_GET['vs']!=1)
		{
		$attr='';
		//print_r($_POST);
		foreach($_POST as $key => $val)
		{
			if($val!='')
			{
				if($key=='mtr_id')
				{
					$a=implode(",",$val);
					if($a=='')
						continue;
				}
				
				if($attr=='')
					$attr=$key;
				else
					$attr.=",".$key;
			}
		}
		insertstats('search',0,0,$attr);
		$sql="select * from soe_shoe where active='1' and hide=0 ";
		$cond='';
		
		if($_GET['catid']!='')
		{
			$cond.=" and shc_id = '".$_GET['catid']."'";
			$rs=mysql_query("select * from soe_shoe_category where shc_id=".$_GET['catid']);
			$row=mysql_fetch_array($rs);
			$rs=mysql_query("select * from soe_shoe_category where shc_id=".$row['parent_id']);
			$row=mysql_fetch_array($rs);
			insertstats('category',0,0,$row['name']);
		}
				

		if($_POST['shoe_name']!='')
			$cond.=" and s.name like '%".$_POST['shoe_name']."%'";

		if($_POST['shc_id']!='')
		{
			$cond.=" and shc_id = '".$_POST['shc_id']."'";
			$rs=mysql_query("select * from soe_shoe_category where shc_id=".$_POST['shc_id']);
			$row=mysql_fetch_array($rs);
			$rs=mysql_query("select * from soe_shoe_category where shc_id=".$row['parent_id']);
			$row=mysql_fetch_array($rs);
			insertstats('category',0,0,$row['name']);
			
		}	
		if($_POST['fot_id']!='')
			$cond.=" and fot_id = '".$_POST['fot_id']."'";
		
		if($_POST['brn_id']!='')
			$cond.=" and brn_id = '".$_POST['brn_id']."'";

		if($_POST['maincolor']!='')
			$cond.=" and soe_id in (select soe_id from soe_shoecolors where color like '".$_POST['maincolor']."')";
		
		$rsbb=mysql_query("select * from soe_advcolor");
		while($rowbb=mysql_fetch_array($rsbb))
		{
			$nm="color".$rowbb['advcol_id'];
			$v=$_POST[$nm];
			if($v!='')
			{
				$cond.=" and soe_id in (select soeid from advcolorvalues where value='".$v."' and advcolid=".intval($rowbb['advcol_id']).")";
			}
		}
		
		if(isset($_POST['mtr_id']))
		{
			$a=implode(",",$_POST['mtr_id']);
			if($a!='')
			$cond.=" and mtr_id in (".$a.")";
		}

		if($_POST['hlh_id']!='')
			$cond.=" and hlh_id = '".$_POST['hlh_id']."'";

		if($_POST['hls_id']!='')
			$cond.=" and hls_id = '".$_POST['hls_id']."'";

		if($_POST['sol_id']!='')
			$cond.=" and sol_id = '".$_POST['sol_id']."'";

		if($_POST['clo_id']!='')
			$cond.=" and clo_id = '".$_POST['clo_id']."'";
			
		if($_POST['shoe_lace']=='1')
			$cond.=" and lace = '1'";

		if($_POST['shoe_lace']=='0' and $_POST['shoe_lace']!='')
			$cond.=" and lace = '0'";


		if($_POST['sht_id']!='')
			$cond.=" and sht_id = '".$_POST['sht_id']."'";

		if($_POST['shw_id']!='')
			$cond.=" and shw_id = '".$_POST['shw_id']."'";


		if($_POST['sea_id']!='')
			$cond.=" and sea_id = '".$_POST['sea_id']."'";
		
		if($_POST['con_id']!='')
			$cond.=" and cnt_id = '".$_POST['con_id']."'";
		
		if($_POST['store_name']!='')
			$cond.=" and s.sto_id in (select sto_id from soe_stores where store_name like '%".$_POST['store_name']."%' and active='1')";
		
		if($_POST['sta_id']!='')
			$cond.=" and sta_id = '".$_POST['sta_id']."'";
		
		if($_POST['cty_id']!='')
			$cond.=" and cty_id = '".$_POST['cty_id']."'";
		
		if($_POST['zip_code']!='')
			$cond.=" and zip_code = '".$_POST['zip_code']."'";
		
		if($_POST['price']>0)
			$cond.=" and price <= ".$_POST['price'];
			
			
			
			if($_GET['sort']>0)
				$cond=$_SESSION['cond'];		
			if($_GET['ja']==1)
			{
				if($_GET['sort']==2)
				{
					$order="ORDER BY cnt DESC,FROM_UNIXTIME( added, '%Y-%m-%d %H:%i:%s' ) DESC";
					$cond.=" and FROM_UNIXTIME( added, '%Y-%m-%d %H:%i:%s' ) > NOW( ) - INTERVAL 24 HOUR";
				}
				elseif($_GET['sort']==1)
				{
					$order="ORDER BY av desc,FROM_UNIXTIME( added, '%Y-%m-%d %H:%i:%s' ) DESC";
					$cond.=" and FROM_UNIXTIME( added, '%Y-%m-%d %H:%i:%s' ) > NOW( ) - INTERVAL 24 HOUR";
				}
				else
				{
					$order="ORDER BY FROM_UNIXTIME( added, '%Y-%m-%d %H:%i:%s' ) DESC";
					$cond.=" and FROM_UNIXTIME( added, '%Y-%m-%d %H:%i:%s' ) > NOW( ) - INTERVAL 24 HOUR";
				}
			}
			elseif($_GET['ja']==2)
			{
				if($_GET['sort']==2)
				{
					$order="ORDER BY cnt DESC,av desc";
				}
				else
				{
					$order="ORDER BY av desc";
				}
			}
			else
			{
				if($_GET['sort']==2)
				{
					$order="ORDER BY cnt DESC,soe_id DESC";
				}
				elseif($_GET['sort']==1)
				{
					$order="ORDER BY av desc,soe_id DESC";
				}
				else
				{
					$order="ORDER BY soe_id DESC";
				}
			}

$sql="SELECT rgroup. * , IFNULL( count( st.date ) , 0 ) cnt
FROM (

SELECT s.*, IFNULL( avg( r.overall ) , 0 ) av
FROM soe_shoe s
LEFT JOIN soe_reviews r ON ( r.fldshoeid = s.soe_id
AND r.fldapprove =1  and r.fldtype='review' )
WHERE s.active = '1'
AND s.hide =0 ".$cond."
GROUP BY soe_id
)rgroup
LEFT JOIN soe_statistics st ON st.soe_id = rgroup.soe_id
GROUP BY soe_id ".$order;
//echo $sql;

/*
$sql="SELECT a.*, fldshoeid, avg( overall ) AS av, count( c.soe_id ) AS cnt, fldapprove
FROM `soe_shoe` a
LEFT OUTER JOIN soe_reviews b ON ( b.fldshoeid = a.soe_id
AND b.fldapprove =1 )
LEFT OUTER JOIN soe_statistics c ON ( c.soe_id = a.soe_id and type='clicks' )
WHERE active = '1'
AND hide =0 ".$cond."
GROUP BY a.soe_id ".$order;
echo $sql;		*/
			
		$_SESSION['srchqry']=$sql;
		$_SESSION['cond']=$cond;
		}
		else
			$sql=$_SESSION['srchqry'];
			
		$rs=mysql_query($sql) or die(mysql_error());	
		$totrec=mysql_num_rows($rs);
		$totpages=ceil($totrec/21);
		if($_GET['curpage']=='')
			$curpage=1;
		else
			$curpage=$_GET['curpage'];
		$start=($curpage-1)*21;	
		//echo $sql;
		$sql=$sql." limit ".$start.",21";
		
		$rs=mysql_query($sql) or die(mysql_error());	
?>

<?php
 if($totrec>1 and $_GET['ja']!=1)
  {
  ?>
		<div id="search_result_top_l"><strong>Sort By <a href="searchresults.php?ja=<?php echo $_GET['ja']; ?>&sort=1" class="brown_link">Rating</a> | <a href="searchresults.php?ja=<?php echo $_GET['ja']; ?>&sort=2" class="brown_link">Clicks</a></strong></div>
     <?php
  }
  ?>
  <?php
   if($_SESSION['memberlogged']=='yes' and ($_SESSION['memtype']=='adv' or $_SESSION['memtype']=='mem') and $_GET['ja']!=1 and $_GET['ja']!=2)
   {
   			$qry=mysql_real_escape_string($_SESSION['srchqry']);
   			$a="select * from soe_savesearch where memid=".$_SESSION['memberid']." and search='".$qry."'";
			$rsrch=mysql_query($a) or die(mysql_error().'<br />'.$a);
			if(mysql_num_rows($rsrch)<=0)
			{
   ?>
   	<div id="savefrmdiv">
   			<form action="savesearch.php" id="savefrm" name="savefrm" method="post">
            <strong>Enter Title and Click 'Save' To Save This Search:</strong> <input name="title" type="text" id="title" value="" />
            &nbsp;&nbsp;
            
            <input name="svesrch" id="svesrch" type="button" value="     SAVE     " />
            </form>
           </div><br />

   <?php
   		}
   }
   
  ?>    
 <?php
if($totrec>3)
{
?>
       
		<div id="search_result_top_r"><a href="#" onclick="javascript: chk1(); "><img src="images/compare.jpg" alt="" border="0"></a></div>
<?php
  }
 ?>        
		<div class="clear"></div>
        <form action="compare.php" method="post" name="comparefrm">
    <div class="border">
    <?php 
			$n=1;
          	 while($row=mysql_fetch_array($rs))
             {
			 	//$ph="uploads/shoe_photo/"."thumb98_".$row['logo'];
				$t=strtotime(date('Y-m-d'))-$row['added'];
				//echo '<br />'.$t;
				if(getcol($row['soe_id'])=='')
					continue;
				$ph="uploads/shoe_photo/"."thumb98_".getcol($row['soe_id']);
				
				$str='<a href="detail-id-'.$row['soe_id'].'.htm">'.$row['name'].'</a>';
				$rs1=mysql_query("select * from soe_brand where brn_id=".$row['brn_id']);
				if(mysql_num_rows($rs1)>0)
				{
					$row1=mysql_fetch_array($rs1);
					$str.='<br />'.$row1['name'];
				}
				
				
				$rs2=mysql_query("select * from soe_season where sea_id=".$row['sea_id']);
				if(mysql_num_rows($rs2)>0)
				{
					$row2=mysql_fetch_array($rs2);
					$str.='<br />'.$row2['name'];
				}
								
				if($row['price']>0)
				{
					$str.='<br /><span style="color:#FF0000">$'.$row['price'].'</span>';
				}
				
			$ph1="uploads/shoe_photo/".getcol($row['soe_id']);
        ?>
      <div class="results_shoes">
      <div  align="left"><input type="checkbox" value="<?php echo $row['soe_id']; ?>" name="chkbox[]"  id="chkbox[]" onclick="chk(this);" /></div>
        <div class="center"><a href="detail-id-<?php echo $row['soe_id']; ?>.htm" rel="<?php echo $ph1; ?>" class="preview" ><img src="<?php echo $ph; ?>" alt="" border="0" width="90" height="55" /></a></div>
        <div class="center"><strong><a href="detail-id-<?php echo $row['soe_id']; ?>.htm"><?php echo $row['name']; ?></a></strong></div>
        <div class="price">Price : $<?php echo $row['price']; ?> </div>
        <div class="center"><?php echo $row1['name']; ?></div>
        <div class="center"> <?php
					if($_GET['ja']!=1)
					{
						echo 'Rating: ';
						if($row['av']>0)
						{
						for($i=1;$i<=round($row['av']);$i++)
							echo '<img src="images/staryellow.jpg" alt="" border="0" />';						
						}
						else
						{
							for($i=1;$i<=5;$i++)
								echo '<img src="images/stargrey.jpg" alt="" border="0" />';
						}
							
				echo '<br />Clicks: '.$row['cnt'];
			}
					?></div>
        </div>
  <?php
		  }
		  if($totrec==0 and $_GET['ja']==1)
   		  	echo '<strong>No shoes added recently!</strong>';
		elseif($totrec==0)
		  	echo '<strong>No matching records found for your search criteria</strong>';
  ?>      
      
      
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
   <li class="numbers"><a onclick="shcalc('<?php echo $i; ?>','<?php echo $_GET['ja']; ?>');" class="gray_link"><?php echo $i; ?></a></li>
         <?php
		  }
		  ?>
          </ul>
        <div class="clear"></div>
      </div>
      <?php
	  }
	  ?>
    </div>
    
    </form>
    <div class="hei"></div>