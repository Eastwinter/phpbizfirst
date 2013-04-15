<?php
include("header.php");
if($_SERVER['REQUEST_METHOD']=="POST")
{
	mysql_query("insert into soe_reviews set sto_id=".$_GET['stoid'].",fldshoeid=".$_GET['id'].",flduserid=".$_SESSION['memberid'].",fldcomments='".mysql_real_escape_string($_POST['comments'])."'") or die(mysql_error());
}
?>
				
				<div class="container">	
                
					<?php include("left.php"); ?>

	
	<div class="mid_body">
		<?php
		  $rs=mysql_query("select * from soe_shoe where soe_id=".$_GET['id']);
		  $row=mysql_fetch_array($rs);
		  $shoename=$row['name'];
		  
		   $rs=mysql_query("select * from soe_stores where sto_id=".$_GET['stoid']);
		  $row=mysql_fetch_array($rs);
		  $storename=$row['store_name'];
		  ?>
		<div class="heading">
		  <h1><a href="detail.php?id=<?php echo $_GET['id']; ?>"><?php echo $shoename; ?></a>, <?php echo $storename; ?> - Store Reviews</h1>
	  </div>
		
		<div align="left" style="padding-left:20px; padding-right:20px;"><br class="clear"/>
		  
		  <?php
		  $rs=mysql_query("select * from soe_reviews where fldapprove=1 and sto_id=".$_GET['stoid']." and fldtype='review'" );
		  while($row=mysql_fetch_array($rs))
		  {	
		  	$rs1=mysql_query("select * from soe_members where mem_id=".$row['flduserid']);
			$row1=mysql_fetch_array($rs1);
		  ?>
		  <span class="msg"><?php echo $row1['first_name']; ?></span> &nbsp;&nbsp;on <?php echo date(' F d, Y h:i a',strtotime($row['flddate'])); ?>	
          <hr style="border:1px solid #2EABD9" width="60%" align="left"  />

	      <br class="clear"/>
			<?php echo nl2br($row['fldcomments']); ?>	
            <br />
<br />
<br />
          <?php
		  }
		  ?>

          <?php 
			  if($_SESSION['memtype']=='mem' or $_SESSION['memtype']=='adv')
			  {
			  ?>
			    <a href="#" onclick="javascript: openfrm();" style="font-weight:bold">ADD A REVIEW</a>
               <?php
			   }
			   else
			   {
			   ?>
	               <a href="loginmember.php" style="font-weight:bold">Login</a> or <a href="registermember.php" style="font-weight:bold">Signup</a> to <strong>ADD A REVIEW</strong>
               <?php
			   }
			   ?>
               <div id="frmid" style="display:none">
               <form name="myfrm" id="myfrm" action="" method="post">
               Comments:<br />
				<textarea name="comments" cols="40" rows="10"></textarea><br />
				<input name="mybut" type="submit" value="Submit" />&nbsp;&nbsp;&nbsp;<input name="mybut" type="button" value="Cancel" onclick="javascript: closefrm();" />
                
               </form>
               </div>
          </div>
	</div>
    <script>
	function openfrm()
	{
		document.getElementById("frmid").style.display="block";
	}

	function closefrm()
	{
		document.getElementById("frmid").style.display="none";
	}

	</script>
					
				
				
				<?php include("footer.php"); ?>