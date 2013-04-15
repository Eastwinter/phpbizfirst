<?php
include("../connect.php");
$_SESSION['admlogged']='';
$_SESSION['admid']='';

		mysql_query("SET NAMES 'utf8'") or die(mysql_error());
		mysql_query("SET CHARACTER SET utf8") or die(mysql_error());
		mysql_query("SET COLLATION_CONNECTION = 'utf8_general_ci'") or die(mysql_error());
		
		if($_SERVER['REQUEST_METHOD']=="POST")
		{
			$rs=mysql_query("select * from soe_members where member_type='adm' and email like '".$_POST['email']."' and password like '".md5($_POST['password'])."'");
			if(mysql_num_rows($rs) > 0)
			{
				$row=mysql_fetch_array($rs);
				$_SESSION['admlogged']='yes';
				$_SESSION['admid']=$row['mem_id'];
				
			?>
            <script>
			location.href='statistics1.php';
			</script>
            <?php
			}
			else
			{
				$msg="Incorrect Email or Password!";
			}
		}
?>

<!DOCTYPE html PUBLIC "-//W3C//Dtd XHTML 1.0 transitional//EN" "http://www.w3.org/tr/xhtml1/Dtd/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Admin Login</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />	
	<link href="http://www.quickworkz.com/dev/shoe/application/public/images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
	<script language="JavaScript" type="text/javascript" src="jquery.js"></script>	
	<script language="JavaScript" type="text/javascript" src="script.js"></script>
	<link rel="stylesheet" type="text/css" href="admin.css" />	
</head>

	
	<body onLoad="mk_height();">

<?php
if($msg!='')
{
?>	
<script type="text/javascript">
$().ready(function()
{
	//first slide down and blink the alert box
	$("#object").animate({ 
		top: "0px"
	  }, 2000 ).fadeOut(11111);
});
</script>

<div id="object" class="message_box">
			<span id="error"><?php echo $msg; ?></span>
	</div>		
 <?php
 }
 ?>
		<table border="0" cellpadding="0" cellspacing="0"  align="center" class="mainbody">
			
			<tr>
			    <td width="100%" valign="top">

					<table width="100%" border="0" cellpadding="0" cellspacing="0" align="ceneter" class="bodycontent">
						<tr>
						    <td width="100%">							
								<table width="100%" border="0" cellpadding="0" cellspacing="0">
									<tr> 
										<td width="80%" class="topTitle">shoe admin<!-- <img src="http://www.quickworkz.com/dev/shoe/application/public/images/logo.gif" width="215" height="94" alt="logo" title="" /> --></td>
										<td class="hright" nowrap><?php echo date("l, F d, Y"); ?></td>
										<td>&nbsp;</td>
									</tr>

							    </table>
							</td>
						</tr>
						
						<tr><td class="menuBG">&nbsp;</td></tr>						
						
						<tr>
							<td class="leftBGcolor">
								
								<div class="leftBody">&nbsp;</div>								
									
								<div class="body" id="mk_height">
									
									<table width="95%" border="0" cellpadding="0" cellspacing="0" align="center">		
										<tr>

											<td class="header">.: Admin Login</td>
										</tr>
										
										<tr>
											<td width="100%">
												<form  name="admin_login" method="post" action="">
													
													<table width="100%" border="0" cellpadding="0" cellspacing="5" align="ceneter" class="marginTop">
														
														<tr>
															<td class="tblcell30">&nbsp;</td>

															<td class="tblcell1">&nbsp;</td>
														</tr>
														
														<tr>
															<td class="tblcell30">Login #</td>
															<td class="tblcell1"><input id="email" name="email" value="" class="input_wh" /></td>
														</tr>   
														
														<tr>
															<td class="tblcell30">Password</td>

															<td><input id="password" type="password" name="password" class="input_wh" /></td>
														</tr>
														
														<tr>
															<td class="tblcell30">&nbsp;</td>
															<td class="tblcell1"><input type="submit" name="submit" value="Login" class="button" /></td>
														</tr> 
														
													</table>					
														
												</form>			
											</td>
										</tr>

										
									</table>
								</div>									
								
							</td>
						</tr>
					</table>
					
			    </td>
			</tr>			
			
		</table>

	</body>

</html>