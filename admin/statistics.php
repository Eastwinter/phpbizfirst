<?php include("top.php");
if($_SERVER['REQUEST_METHOD']=="POST")
{
	if($_POST['button2']!='')
	{
						$d1=date('m/d/Y');
			$d2=date("m/d/Y");

	}
	else
	{
		$d1=$_POST['from'];
		$d2=$_POST['to'];
	}
}
else
{
						$d1=date('m/d/Y');
			$d2=date("m/d/Y");

}
?>
	<link rel="stylesheet" href="../js/themes/base/jquery.ui.all.css">
	<script src="../js/ui/jquery.ui.core.js"></script>
	<script src="../js/ui/jquery.ui.widget.js"></script>
	<script src="../js/ui/jquery.ui.datepicker.js"></script>

	<script>
	$(function() {
		var dates = $( "#from, #to" ).datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			numberOfMonths: 1,
			dateFormat: 'yy-mm-dd',
			onSelect: function( selectedDate ) {
				var option = this.id == "from" ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
			}
		});
	});
	
	
	</script>
    
    	<script type="text/javascript">
$().ready(function() {
	
	$("#datefrm").validate({
		rules: {
			from: "required",
			to: {
			required: true,
			greaterThan: "#from"

			}
		},
		messages: {
			from: "<br/>From Date can not be empty.",
			to: {
			required: "<br/>ToDate can not be empty.",
			greaterThan: "<br/>To date should be greater than from date."			
			}
		}
	});
	
    jQuery.validator.addMethod("greaterThan", function(value, element, params) {

            if (!/Invalid|NaN/.test(new Date(value))) {
                return new Date(value) > new Date($(params).val());
            }
            return isNaN(value) && isNaN($(params).val()) || (parseFloat(value) > parseFloat($(params).val())); 
        },'Must be greater than {0}.');

	
	
	
});
</script>			


<div class="body" id="mk_height">
	  <table width="95%" border="0" align="center" cellpadding="5" cellspacing="0">
        <tr>
          <td class="header">STATISTICS</td>
        </tr>
        <tr>
          <td><div id="advertiseraccountpage">
            <div class="advertiseraccount">
              <form action="" method="post" name="datefrm" id="datefrm">
                <br />
                <strong>Select Dates:</strong>
                <label for="from">From</label>
                <input type="text" id="from" name="from" value="<?php echo $d1; ?>"/>
                <label for="to">to</label>
                <input type="text" id="to" name="to" value="<?php echo $d2; ?>"/>
                &nbsp;&nbsp;&nbsp;
                <input type="submit" name="button" id="button" value="Submit" />
                <input type="submit" name="button2" id="button2" value="Reset" />
              </form>
              <div style="float:left; width:100%;">
                <p><strong>Shoes Visits:</strong></p>
                <table width="95%" border="1" cellpadding="5" cellspacing="1" align="center" >
                  <tr class="tableheader1">
                    <td width="29%">Shoe Name</td>
                    <td width="6%">Total Visits</td>
                  </tr>
                  <?php
			$cond='';
		  	if($d1!='')
				$cond.=" and date>='".date('Y-m-d',strtotime($d1))."'";

		  	if($d2!='')
				$cond.=" and date<='".$d2."'";

		  $s="select  soe_id,count(*) as cnt from soe_statistics where soe_id>0 ".$cond." group by soe_id order by cnt desc";  		
		  $rs=mysql_query($s) or die(mysql_error().'<br />'.$s);
		  $i=0;
		  while($row=mysql_fetch_array($rs))
		  {
		  		$i++;	
			$sts=mysql_query("select * from soe_shoe where soe_id=".$row['soe_id']."") or die(mysql_error());
			if(mysql_num_rows($sts)<=0)
				continue;
			$stsrow=mysql_fetch_array($sts);
			$nm=$stsrow['name'];
			
			
		  ?>
                  <tr class="tbl_text">
                    <td><?php echo $nm; ?></td>
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
                <p><strong>Stores Visits:</strong></p>
                <table width="95%" border="1" cellpadding="5" cellspacing="1" align="center" >
                  <tr class="tableheader1">
                    <td width="29%">Store Name</td>
                    <td width="6%">Total Visits</td>
                  </tr>
                  <?php
		  			
					$cond='';
		  	if($d1!='')
				$cond.=" and date>='".date('Y-m-d',strtotime($d1))."'";

		  	if($d2!='')
				$cond.=" and date<='".$d2."'";
						
			  $s="select  sto_id,count(*) as cnt from soe_statistics where sto_id>0 ".$cond." group by sto_id order by cnt desc";  
		  $rs=mysql_query($s) or die(mysql_error());
		  $i=0;
		  while($row=mysql_fetch_array($rs))
		  {
		  		$i++;	
			$sts=mysql_query("select * from soe_stores where sto_id=".$row['sto_id']."") or die(mysql_error());
			if(mysql_num_rows($sts)<=0)
				continue;
			$stsrow=mysql_fetch_array($sts);
			$nm=$stsrow['store_name'];
			
			
		  ?>
                  <tr class="tbl_text">
                    <td><?php echo $nm; ?></td>
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
                <p><strong> Shoes Added By Members:</strong></p>
                <table width="95%" border="0" cellpadding="0" cellspacing="1" align="center">
<form name="site_banners" method="post" action="">

				<input type="hidden" name="page" value="1" />
                <input type="hidden" name="memtype" value="<?php echo $memtype; ?>" />
				
				<tr class="tableheader1">
				  <td width="2%">ID</td>
				  <td width="23%">Name</td>
				  <td width="7%">Price</td>
				  <td width="20%">Added By</td>
				  <td width="12%">Added On</td>
				  <td width="11%">Status</td>
				  </tr>
                <?php
			$cond='';
		  	if($d1!='')
				$cond.=" and added>='".strtotime($d1)."'";

		  	if($d2!='')
				$cond.=" and added<='".strtotime($d2)."'";
					
		$sql="select * from soe_shoe where mem_id in (select mem_id from soe_members where member_type='mem') ".$cond;
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
					if($memtype=='adm')
						$nm='Administrator';
					if($memtype=='adv')	
						$nm='<a href="addadv.php?id='.$row1['mem_id'].'" >'.$row1['first_name']." ".$row1['last_name'].'</a>';	

					if($memtype=='mem')	
						$nm='<a href="addmem.php?id='.$row1['mem_id'].'" >'.$row1['first_name']." ".$row1['last_name'].'</a>';	
						
				?>
					<tr class="tbl_text">
					  <td><?php echo $soe_id; ?></td>
					  <td><?php echo $name; ?></td>
					  <td><?php echo $price; ?></td>
					  <td><?php echo $nm; ?></td>
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
        
        
                <p><strong> Shoes Added By Advertisers:</strong></p>
                <table width="95%" border="0" cellpadding="0" cellspacing="1" align="center">
<form name="site_banners" method="post" action="">

				<input type="hidden" name="page" value="1" />
                <input type="hidden" name="memtype" value="<?php echo $memtype; ?>" />
				
				<tr class="tableheader1">
				  <td width="2%">ID</td>
				  <td width="23%">Name</td>
				  <td width="7%">Price</td>
				  <td width="20%">Added By</td>
				  <td width="12%">Added On</td>
				  <td width="11%">Status</td>
				  </tr>
                <?php
			$cond='';
		  	if($d1!='')
				$cond.=" and added>='".strtotime($d1)."'";

		  	if($d2!='')
				$cond.=" and added<='".strtotime($d2)."'";
					
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
					if($memtype=='adm')
						$nm='Administrator';
						
					if($memtype=='adv')	
						$nm='<a href="addadv.php?id='.$row1['mem_id'].'" >'.$row1['first_name']." ".$row1['last_name'].'</a>';	

					if($memtype=='mem')	
						$nm='<a href="addmem.php?id='.$row1['mem_id'].'" >'.$row1['first_name']." ".$row1['last_name'].'</a>';	
						
				?>
					<tr class="tbl_text">
					  <td><?php echo $soe_id; ?></td>
					  <td><?php echo $name; ?></td>
					  <td><?php echo $price; ?></td>
					  <td><?php echo $nm; ?></td>
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
                
           <p><strong> Member Registrations</strong></p>
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

			$cond='';
		  	if($d1!='')
				$cond.=" and joined>='".strtotime($d1)."'";

		  	if($d2!='')
				$cond.=" and joined<='".strtotime($d2)."'";
									$i=0;
			$rs=mysql_query("select * from soe_members where member_type='mem' ".$cond) or die(mysql_error());
				while($row=mysql_fetch_array($rs))
				{
					$i++;
					extract($row);
					if($banned==1)
						$a='banned';
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
                
                
                 <p><strong> Advertiser Registrations</strong></p>
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

			$cond='';
		  	if($d1!='')
				$cond.=" and joined>='".strtotime($d1)."'";

		  	if($d2!='')
				$cond.=" and joined<='".strtotime($d2)."'";
					$i=0;				
			$rs=mysql_query("select * from soe_members where member_type='adv'".$cond) or die(mysql_error());
				while($row=mysql_fetch_array($rs))
				{
					$i++;
					extract($row);
					if($banned==1)
						$a='banned';
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