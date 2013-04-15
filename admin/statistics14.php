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
          <td class="header">Store Wise Orders
          &nbsp;&nbsp;&nbsp;&nbsp;
          <input type="button" name="button3" id="button3" value="          EXPORT TO EXCEL          " onclick="javascript: location.href='exporttoexcel.php?stat=14&amp;d1=<?php echo $d1; ?>&amp;d2=<?php echo $d2; ?>&amp;period=<?php echo $period; ?>';" /></td>
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
                    <td width="9%">Date</td>
                    <td width="29%">Advertiser</td>
                    <td width="29%">Store Name</td>
                    <td width="6%">Total Number Of Orders</td>
                    <td width="6%">Total Amount</td>
                    <td width="6%">&nbsp;</td>
                  </tr>
                  <?php
				  
				  $ds = date('Y-m-d',strtotime(date("Y-m-d", strtotime($d2)) . " +1 day"));
			$cond='';
		  	if($d1!='')
				$cond.=" and date>='".date('Y-m-d',strtotime($d1))."'";

		  	if($d2!='')
				$cond.=" and date<='".($ds)."'";

			$cond.=" and paid='paid'";
			
		  if($period=='t')
			  $s="select ocn,stoid,count(distinct ocn) as cnt,date,sum(price*qty) as total from cart where stoid>0 ".$cond."  group by stoid,ocn order by cnt desc";  	

		  if($period=='d')
			  $s="select ocn,stoid,count(distinct ocn) as cnt,date,sum(price*qty) as total from cart where stoid>0 ".$cond."  group by year(date),month(date),day(date),stoid,ocn order by cnt desc";  	

		  if($period=='w')
			  $s="select ocn,week(date) as w,year(date) as y,stoid,count(distinct ocn) as cnt,date,city,state,country,sum(price*qty) as total from cart where stoid>0 ".$cond." group by year(date),week(date),stoid,ocn order by cnt desc";  	

		  if($period=='m')
			  $s="select ocn,year(date) as y,month(date) as m,stoid,count(distinct ocn) as cnt,date,city,state,country,sum(price*qty) as total from cart where stoid>0 ".$cond."   group by year(date),month(date),stoid,ocn order by cnt desc";  	

		  if($period=='y')
			  $s="select ocn,year(date) y,stoid,count(distinct ocn) as cnt,date,city,state,country,sum(price*qty) as total from cart where stoid>0 ".$cond." group by year(date),stoid,ocn order by cnt desc";  	

			//echo $s;

		 // $s="select  sto_id,count(*) as cnt from soe_statistics where sto_id>0 ".$cond." group by sto_id order by cnt desc";  		
		  $rs=mysql_query($s) or die(mysql_error().'<br />'.$s);
		  $i=0;
		  while($row=mysql_fetch_array($rs))
		  {
		  		$i++;	
			$sts=mysql_query("select * from soe_stores where sto_id=".$row['stoid']."") or die(mysql_error());
			if(mysql_num_rows($sts)<=0)
				continue;
			$stsrow=mysql_fetch_array($sts);
			$nm=$stsrow['store_name'];

					
			$rs1=mysql_query("select * from soe_members where mem_id=".$stsrow['mem_id']) or die(mysql_error());
			$row1=mysql_fetch_array($rs1);
			
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
					$dt=date('m/d/Y',strtotime($row['date']));
				}
				
				if($period=="t")
				{
					$dt=$d1." <strong>to</strong> ".$d2;
				}

			
		  ?>
                  <tr class="tbl_text">
                    <td><?php echo $dt; ?></td>
                    <td><?php echo $row1['first_name']." ".$row1['last_name']; ?></td>
                    <td><?php echo $nm; ?></td>
                    <td><?php echo $row['cnt']; ?></td>
                    <td><?php echo $row['total']; ?></td>
                    <td><a href="orderhistoryadv.php?stoid=<?php echo $row['stoid']; ?>" class="style1">Order History</a></td>
                  </tr>
                  <?php
				 }
				 
				 if($i==0)
				 {
				 	echo '<tr><td colspan=5><strong>No Results!</strong></td></tr>';
				 }
				 ?>
                </table>
              <p>&nbsp;</p>
              </div>
            </div>
          </div></td>
        </tr>
      </table>
	</div>

	
	<?php include("bottom.php"); ?>