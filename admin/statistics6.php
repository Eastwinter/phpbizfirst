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
          <td class="header">Advertiser Signups
          &nbsp;&nbsp;&nbsp;&nbsp;
          <input type="button" name="button3" id="button3" value="          EXPORT TO EXCEL          " onclick="javascript: location.href='exporttoexcel.php?stat=6&d1=<?php echo $d1; ?>&d2=<?php echo $d2; ?>&period=<?php echo $period; ?>';" /></td>
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
                    <td width="18%">Date</td>
                    <td width="15%">Count</td>
                  </tr>
                  <?php
				  
		  $ds = date('Y-m-d',strtotime(date("Y-m-d", strtotime($d2)) . " +1 day"));
			$cond='';
		  	if($d1!='')
				$cond.=" and joined>='".strtotime($d1)."'";

		  	if($d2!='')
				$cond.=" and joined<='".strtotime($ds)."'";


		  if($period=='t')
			  $s="select count(*) as cnt,joined from soe_members where 1=1 ".$cond."  and member_type='adv' order by cnt desc";  	

		  if($period=='d')
			  $s="select count(*) as cnt,joined from soe_members where 1=1 ".$cond."  and member_type='adv' group by year(FROM_UNIXTIME(joined)),month(FROM_UNIXTIME(joined)),day(FROM_UNIXTIME(joined)) order by cnt desc";  	

		  if($period=='w')
			  $s="select week(FROM_UNIXTIME(joined)) as w,year(FROM_UNIXTIME(joined)) as y,count(*) as cnt,joined from soe_members where 1=1 ".$cond." and member_type='adv' group by year(FROM_UNIXTIME(joined)),week(FROM_UNIXTIME(joined)) order by cnt desc";  	

		  if($period=='m')
			  $s="select year(FROM_UNIXTIME(joined)) as y,month(FROM_UNIXTIME(joined)) as m,count(*) as cnt,count(*) as cnt,joined from soe_members where 1=1 ".$cond." and member_type='adv' group by year(FROM_UNIXTIME(joined)),month(FROM_UNIXTIME(joined)) order by cnt desc";  	

		  if($period=='y')
			  $s="select year(FROM_UNIXTIME(joined)) y,count(*) as cnt,count(*) as cnt,joined from soe_members where 1=1 ".$cond." and member_type='adv'  group by year(FROM_UNIXTIME(joined)) order by cnt desc";  	

			//echo $s;

		 // $s="select  soe_id,count(*) as cnt from soe_statistics where soe_id>0 ".$cond." group by soe_id order by cnt desc";  		
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
					$dt=date('d/m/Y',$row['joined']);
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
                <form action="" method="post" name="site_banners" id="site_banners">
                  <input type="hidden" name="page2" value="1" />
                  <tr class="tableheader1">
                    <td width="8%">ID</td>
                    <td width="26%">Name</td>
                    <td width="20%">Email</td>
                    <td width="14%">Status</td>
                    <td width="14%">Joined On</td>
                  </tr>
                  <?php

		  $ds = date('Y-m-d',strtotime(date("Y-m-d", strtotime($d2)) . " +1 day"));
			$cond='';
		  	if($d1!='')
				$cond.=" and joined>='".strtotime($d1)."'";

		  	if($d2!='')
				$cond.=" and joined<='".strtotime($ds)."'";
					$i=0;				
			$rs=mysql_query("select * from soe_members where member_type='adv'".$cond) or die(mysql_error());
				while($row=mysql_fetch_array($rs))
				{
					$i++;
					extract($row);
					if($banned==1 and $first_name!='' and $last_name!='')
						$a='banned';
					elseif($banned==1 and $first_name=='' and $last_name=='')
						$a='inactive';
					else
						$a='active';
				?>
                  <tr class="tbl_text">
                    <td><?php echo $mem_id; ?></td>
                    <td><?php echo $first_name." ".$last_name; ?></td>
                    <td><?php echo $email; ?></td>
                    <td><?php echo $a; ?></td>
                    <td><?php echo date('F d, Y',$joined); ?></td>
                  </tr>
                  <?php
				}
				if($i==0)
				 {
				 	echo '<tr><td colspan=5><strong>No Results!</strong></td></tr>';
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