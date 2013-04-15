<?php include("top.php");
if($_SERVER['REQUEST_METHOD']=="POST")
{
	if($_POST['button2']!='')
	{
						$d1=date('m/d/Y');
			$d2=date("m/d/Y");


			$period='t';
	}
	else
	{
		$d1=$_POST['from'];
		$d2=$_POST['to'];
		$period=$_POST['period'];
	}
}
else
{
						$d1=date('m/d/Y');
			$d2=date("m/d/Y");

			$period='t';
}
?>
	<link rel="stylesheet" href="../js/themes/base/jquery.ui.all.css">
	<script src="../js/ui/jquery.ui.core.js"></script>
	<script src="../js/ui/jquery.ui.widget.js"></script>
	<script src="../js/ui/jquery.ui.datepicker.js"></script>

	<script>

var curdate='<?php echo date('m/d/Y'); ?>';
var selperiod='<?php echo $period; ?>';
	</script>
    <script src="setdate.js"></script>
		


<div class="body" id="mk_height">
	  <table width="95%" border="0" align="center" cellpadding="5" cellspacing="0">
        <tr>
          <td class="header">Shoes Added By Advertisers
          &nbsp;&nbsp;&nbsp;&nbsp;
          <input type="button" name="button3" id="button3" value="          EXPORT TO EXCEL          " onclick="javascript: location.href='exporttoexcel.php?stat=11&d1=<?php echo $d1; ?>&d2=<?php echo $d2; ?>&period=<?php echo $period; ?>';" /></td>
        </tr>
        <tr>
          <td><div id="advertiseraccountpage">
            <div class="advertiseraccount">
<form action="" method="post" name="datefrm" id="datefrm">
  <br />
  <label for="from">From</label>
  <input name="from" type="text" id="from" value="<?php echo $d1; ?>" size="20"/>
  <label for="to">To</label>
  <input name="to" type="text" id="to" value="<?php echo $d2; ?>" size="20"/>
  &nbsp;&nbsp;&nbsp;
  <select name="period" id="period">
    <option value="t" selected="selected">Total</option>
  </select>
  <input type="submit" name="button" id="button" value="Submit" />
  <input type="submit" name="button2" id="button2" value="Reset" />
  <p>&nbsp;</p>
</form>
<div style="float:left; width:100%;">
<table width="95%" border="1" cellpadding="5" cellspacing="1" align="center" >
                  <tr class="tableheader1">
                    <td width="29%">Date</td>
                    <td width="6%">Total #</td>
                  </tr>
                  <?php
				  
				  $ds = date('Y-m-d',strtotime(date("Y-m-d", strtotime($d2)) . " +1 day"));
			$cond='';
		  	if($d1!='')
				$cond.=" and added>='".strtotime($d1)."'";

		  	if($d2!='')
				$cond.=" and added<='".strtotime($ds)."'";


		  if($period=='t')
			  $s="select count(*) as cnt,added from soe_shoe where 1=1 ".$cond."  and mem_id in (select mem_id from soe_members where member_type='adv') order by cnt desc";  	

		  if($period=='d')
			  $s="select count(*) as cnt,added from soe_shoe where 1=1 ".$cond."  and mem_id in (select mem_id from soe_members where member_type='adv') group by year(FROM_UNIXTIME(added)),month(FROM_UNIXTIME(added)),day(FROM_UNIXTIME(added)) order by cnt desc";  	

		  if($period=='w')
			  $s="select week(FROM_UNIXTIME(added)) as w,year(FROM_UNIXTIME(added)) as y,count(*) as cnt,added from soe_shoe where 1=1 ".$cond." and mem_id in (select mem_id from soe_members where member_type='adv')  group by year(FROM_UNIXTIME(added)),week(FROM_UNIXTIME(added)) order by cnt desc";  	

		  if($period=='m')
			  $s="select year(FROM_UNIXTIME(added)) as y,month(FROM_UNIXTIME(added)) as m,sto_id,count(*) as cnt,added from soe_shoe where 1=1 ".$cond." and mem_id in (select mem_id from soe_members where member_type='adv')  group by year(FROM_UNIXTIME(added)),month(FROM_UNIXTIME(added)) order by cnt desc";  	

		  if($period=='y')
			  $s="select year(FROM_UNIXTIME(added)) y,sto_id,count(*) as cnt,added from soe_shoe where 1=1 ".$cond." and mem_id in (select mem_id from soe_members where member_type='adv')  group by year(FROM_UNIXTIME(added)) order by cnt desc";  	

			//echo $s;

		 // $s="select  sto_id,count(*) as cnt from soe_statistics where sto_id>0 ".$cond." group by sto_id order by cnt desc";  		
		  $rs=mysql_query($s) or die(mysql_error().'<br />'.$s);
		  $i=0;
		  while($row=mysql_fetch_array($rs))
		  {
		  		$i++;	

					
			
				if($period=="w")
				{
					$arr=week_limits($row['w'],$row['y'],"m/d/Y");
					$dt=$arr[0]. " <strong>to</strong> ".$arr[1];
				}

				if($period=="m")
				{
					$dt=$row['m']. "/".$row['y'];
				}

				if($period=="y")
				{
					$dt=$row['y'];
				}

				if($period=="d")
				{
					$dt=date('m/d/Y h:i:s',$row['added']);
				}
				
				if($period=="t")
				{
					$dt=$d1." <strong>to</strong> ".$d2;
				}

			
		  ?>
                  <tr class="tbl_text">
                    <td><?php echo $dt; ?></td>
                    <td><?php echo $row['cnt']; ?></td>
                  </tr>
                  <?php
				 }
				 
				 if($i==0)
				 {
				 	echo '<tr><td colspan=2><strong>No Results!</strong></td></tr>';
				 }
				 ?>
                </table>
              <p>&nbsp;</p>
              <table width="95%" border="0" cellpadding="0" cellspacing="1" align="center">
<form name="site_banners" method="post" action="">

				<input type="hidden" name="page" value="1" />
                <input type="hidden" name="memtype" value="<?php echo $memtype; ?>" />
				
				<tr class="tableheader1">
				  <td width="2%">ID</td>
				  <td width="23%">Name</td>
				  <td width="7%">Price</td>
				  <td width="20%">Added By (Email)</td>
				  <td width="12%">Added On</td>
				  <td width="11%">Status</td>
				  </tr>
                <?php
				  
				  $ds = date('Y-m-d',strtotime(date("Y-m-d", strtotime($d2)) . " +1 day"));
			$cond='';
		  	if($d1!='')
				$cond.=" and added>='".strtotime($d1)."'";

		  	if($d2!='')
				$cond.=" and added<='".strtotime($ds)."'";
					
		$sql="select * from soe_shoe where mem_id in (select mem_id from soe_members where member_type='adv') ".$cond;
		$rs=mysql_query($sql) or die(mysql_error());	
				$i=0;
				while($row=mysql_fetch_array($rs))
				{
					$i++;
					extract($row);
					if($active=='1')
						$a='active';
					else
						$a='inactive';
					
					if($featured=='1')
						$b='Yes';
					else
						$b='No';
						$rs1=mysql_query("select * from soe_members where mem_id=".$mem_id) or die(mysql_error());
						$row1=mysql_fetch_array($rs1);
					if($row1['member_type']=='adm')
						$nm='Administrator';
					if($row1['member_type']=='adv')	
						$nm=''.$row1['first_name']." ".$row1['last_name'].'';	

					if($row1['member_type']=='mem')	
						$nm=''.$row1['first_name']." ".$row1['last_name'].'';	
						
				?>
					<tr class="tbl_text">
					  <td><?php echo $soe_id; ?></td>
					  <td><?php echo $name; ?></td>
					  <td><?php echo $price; ?></td>
					  <td><?php echo $row1['email']; ?></td>
					  <td><?php echo date('F d, Y',$added); ?></td>
					  <td><?php echo $a; ?></td>
				    </tr>
                <?php
				}
				 if($i==0)
				 {
				 	echo '<tr><td colspan=8><strong>No Results!</strong></td></tr>';
				 }
				?>
								
			</form>
		</table>
              </div>
            </div>
          </div></td>
        </tr>
      </table>
	</div>

	
	<?php include("bottom.php"); ?>