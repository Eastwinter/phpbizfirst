<!DOCTYPE html PUBLIC "-//W3C//Dtd XHTML 1.0 transitional//EN" "http://www.w3.org/tr/xhtml1/Dtd/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

	<title>shoe Admin</title>
	<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
	
	<script>var script_url = "/";</script>
	<link href="http://www.yashlive.com/shoebreeze/images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
	<script language="JavaScript" type="text/javascript" src="jquery.js"></script>

	<script language="JavaScript" type="text/javascript" src="jquery.validate.js"></script>
	<script language="JavaScript" type="text/javascript" src="script.js"></script>

	<link rel="stylesheet" type="text/css" href="admin.css" />

</head>

	<body onLoad="mk_height();">
	
		<table border="0" cellpadding="0" cellspacing="0"  align="center" class="mainbody">		
		
			<tr>

			    <td width="100%">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" align="ceneter" class="bodycontent">
						<tr>
						    <td width="100%">					
							
								<table cellpadding="0" cellspacing="0" border="0" width="100%">

									<tr> 
										<td width="80%" class="topTitle">shoe admin<!-- <img src="http://www.quickworkz.com/dev/shoe/application/public/images/logo.gif" width="215" height="94" alt="logo" title="" /> --></td>
										<td class="hright" nowrap>Friday, July 01, 2011 | </td>

										<td class="hright" nowrap>Current user: <b>admin</b> | </td>
										<td class="hright" nowrap><a href="index.php"><b>Logout</b></a>&nbsp;&nbsp;</td>
									</tr>

							    </table>
							</td>
						</tr>

						
						<tr>
							<td class="menuBG">
								<table cellpadding="0" cellspacing="0" border="0" width="100%">
  <tr>
    <td width="185"></td>
    <td ><table cellpadding="0" cellspacing="0" border="0" width="100%">
      <tr>
            <td class=" tab_sC "><a class=" tab " href="adminsettings.php">Settings</a> </td>

  

            <td class=" tab_sC "><a class=" tab " href="footwareman.php">Utility</a> </td>
    
         <td class=" tab_sC "><a class=" tab " href="bannermanage.php">Manage</a> </td>
    
          <td class=" tab_sC "><a class=" tab " href="showmem.php?t=v">Members</a> </td>
    
         <td class=" tab_sC "><a class=" tab " href="showadv.php?t=v">Advertisers</a> </td>
  
      <td class=" tab_on "><a class=" tab_o " href="shoesadm.php">Shoes Database</a> </td>

  
     
       
      </tr>
    </table></td>
    <td width="300"></td>
  </tr>
</table>   
							</td>
						</tr>
                        
                        				<tr>

							<td class="leftBGcolor">

                            
                            
    
 
  
    



<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: medium;
}
-->
</style>


	
	
		<script type="text/javascript">
$().ready(function()
{
	$("#object").animate({ 
		top: "0px"
	  }, 2000 ).fadeOut(11111);
});
</script>
				<div class="body1" id="mk_height">
		
		<table width="95%" border="0" cellpadding="0" cellspacing="0" align="center">		
			<tr>
				<td class="header">Shoes Database</td>
			</tr>

			<tr>
			  <td class="header">
                <form action="" method="post" name="selfrm">  
              <span class="style1">
              Select : 
			  </span>
			  
<select name="memtype" class="style1" id="memtype" onchange="javascript: document.selfrm.submit();">
			      <option value="adm"  selected="selected"  >SB Database</option>
			      <option value="adv"  >Shoes added by Advertisers</option>

			      <option value="mem"  >Shoes added by Members</option>
		        </select></form>		      </td>
		  </tr>
			
			<tr><td class="height">&nbsp;</td></tr>
		</table>		
		
		<table width="95%" border="0" cellpadding="0" cellspacing="1" align="center">
<form name="site_banners" method="post" action="">

				<input type="hidden" name="page" value="1" />

                <input type="hidden" name="memtype" value="adm" />
				
				<tr class="tableheader1">
				  <td width="10%"><input type="hidden" name="hfld" id="hfld" /></td>
				  <td width="2%">ID</td>
				  <td width="23%">Name</td>
				  <td width="7%">Price</td>
				  <td width="20%">Added By</td>

				  <td width="12%">Added On</td>
				  <td width="11%">Status</td>
				  <td width="11%">&nbsp;</td>
				  <td width="11%">&nbsp;</td>
				  <td width="4%">Action</td>
	  </tr>
                					<tr class="tbl_text">

					  <td><input type="checkbox" name="checkbox[]" id="checkbox[]" value="1" /></td>
					  <td>1</td>
					  <td>Shoe1</td>
					  <td>50</td>
					  <td>Administrator</td>
					  <td>April 19, 2011</td>

					  <td>active</td>
					  <td><a href="shoecolors.php?soeid=1">SHOE COLORS</a></td>
					  <td><a href="shoesadvreviews.php?id=1">Reviews</a></td>
					  <td><a href="addshoeadm.php?id=1"> <img src="images/edit.gif" alt="edit" border="0" title="click to edit" /></a></td>
					</tr>
                					<tr class="tbl_text">
					  <td><input type="checkbox" name="checkbox[]" id="checkbox[]" value="2" /></td>

					  <td>2</td>
					  <td>Shoe2</td>
					  <td>100</td>
					  <td>Administrator</td>
					  <td>April 20, 2011</td>
					  <td>active</td>

					  <td><a href="shoecolors.php?soeid=2">SHOE COLORS</a></td>
					  <td><a href="shoesadvreviews.php?id=2">Reviews</a></td>
					  <td><a href="addshoeadm.php?id=2"> <img src="images/edit.gif" alt="edit" border="0" title="click to edit" /></a></td>
					</tr>
                					<tr class="tbl_text">
					  <td><input type="checkbox" name="checkbox[]" id="checkbox[]" value="4" /></td>
					  <td>4</td>

					  <td>Shoe4</td>
					  <td>50</td>
					  <td>Administrator</td>
					  <td>April 25, 2011</td>
					  <td>active</td>
					  <td><a href="shoecolors.php?soeid=4">SHOE COLORS</a></td>

					  <td><a href="shoesadvreviews.php?id=4">Reviews</a></td>
					  <td><a href="addshoeadm.php?id=4"> <img src="images/edit.gif" alt="edit" border="0" title="click to edit" /></a></td>
					</tr>
                					<tr class="tbl_text">
					  <td><input type="checkbox" name="checkbox[]" id="checkbox[]" value="5" /></td>
					  <td>5</td>
					  <td>Shoe5</td>

					  <td>100</td>
					  <td>Administrator</td>
					  <td>April 26, 2011</td>
					  <td>active</td>
					  <td><a href="shoecolors.php?soeid=5">SHOE COLORS</a></td>
					  <td><a href="shoesadvreviews.php?id=5">Reviews</a></td>

					  <td><a href="addshoeadm.php?id=5"> <img src="images/edit.gif" alt="edit" border="0" title="click to edit" /></a></td>
					</tr>
                					<tr class="tbl_text">
					  <td><input type="checkbox" name="checkbox[]" id="checkbox[]" value="6" /></td>
					  <td>6</td>
					  <td>Shoe6</td>
					  <td>155</td>

					  <td>Administrator</td>
					  <td>April 26, 2011</td>
					  <td>active</td>
					  <td><a href="shoecolors.php?soeid=6">SHOE COLORS</a></td>
					  <td><a href="shoesadvreviews.php?id=6">Reviews</a></td>
					  <td><a href="addshoeadm.php?id=6"> <img src="images/edit.gif" alt="edit" border="0" title="click to edit" /></a></td>

					</tr>
                					<tr class="tbl_text">
					  <td><input type="checkbox" name="checkbox[]" id="checkbox[]" value="13" /></td>
					  <td>13</td>
					  <td>Onitsuka Tiger Women`s </td>
					  <td>65</td>
					  <td>Administrator</td>

					  <td>May 04, 2011</td>
					  <td>active</td>
					  <td><a href="shoecolors.php?soeid=13">SHOE COLORS</a></td>
					  <td><a href="shoesadvreviews.php?id=13">Reviews</a></td>
					  <td><a href="addshoeadm.php?id=13"> <img src="images/edit.gif" alt="edit" border="0" title="click to edit" /></a></td>
					</tr>

                					<tr class="tbl_text">
					  <td><input type="checkbox" name="checkbox[]" id="checkbox[]" value="23" /></td>
					  <td>23</td>
					  <td>mynewshoes</td>
					  <td>0</td>
					  <td>Administrator</td>
					  <td>May 10, 2011</td>

					  <td>active</td>
					  <td><a href="shoecolors.php?soeid=23">SHOE COLORS</a></td>
					  <td><a href="shoesadvreviews.php?id=23">Reviews</a></td>
					  <td><a href="addshoeadm.php?id=23"> <img src="images/edit.gif" alt="edit" border="0" title="click to edit" /></a></td>
					</tr>
                					<tr class="tbl_text">
					  <td><input type="checkbox" name="checkbox[]" id="checkbox[]" value="25" /></td>

					  <td>25</td>
					  <td>new shoes for new design stores</td>
					  <td>65</td>
					  <td>Administrator</td>
					  <td>May 10, 2011</td>
					  <td>active</td>

					  <td><a href="shoecolors.php?soeid=25">SHOE COLORS</a></td>
					  <td><a href="shoesadvreviews.php?id=25">Reviews</a></td>
					  <td><a href="addshoeadm.php?id=25"> <img src="images/edit.gif" alt="edit" border="0" title="click to edit" /></a></td>
					</tr>
                					<tr class="tbl_text">
					  <td><input type="checkbox" name="checkbox[]" id="checkbox[]" value="30" /></td>
					  <td>30</td>

					  <td>ternando</td>
					  <td>2500</td>
					  <td>Administrator</td>
					  <td>May 11, 2011</td>
					  <td>active</td>
					  <td><a href="shoecolors.php?soeid=30">SHOE COLORS</a></td>

					  <td><a href="shoesadvreviews.php?id=30">Reviews</a></td>
					  <td><a href="addshoeadm.php?id=30"> <img src="images/edit.gif" alt="edit" border="0" title="click to edit" /></a></td>
					</tr>
                					<tr class="tbl_text">
					  <td><input type="checkbox" name="checkbox[]" id="checkbox[]" value="31" /></td>
					  <td>31</td>
					  <td>Black Rooster Colb</td>

					  <td>69</td>
					  <td>Administrator</td>
					  <td>June 24, 2011</td>
					  <td>active</td>
					  <td><a href="shoecolors.php?soeid=31">SHOE COLORS</a></td>
					  <td><a href="shoesadvreviews.php?id=31">Reviews</a></td>

					  <td><a href="addshoeadm.php?id=31"> <img src="images/edit.gif" alt="edit" border="0" title="click to edit" /></a></td>
					</tr>
                								
				<tr class="tblrow">
				  <td colspan="12" align="left" valign="middle" class="tac_ptb"><table width="90%" border="0" cellpadding="5" cellspacing="5">
                    <tr>
                      <td align="center" valign="middle"><a href="javascript: selactiv(3);"><img src="images/delete.gif" alt="edit" border="0" align="absmiddle" title="click to delete" /></a></td>
                      <td align="center" valign="middle"><a href="javascript: selactiv(1);"><img src="images/do-publish.png" alt="edit" border="0" align="absmiddle" title="click to active" /></a></td>
                      <td align="center" valign="middle"><a href="javascript: selactiv(2);"><img src="images/do-unpublish.png" alt="edit" border="0" align="absmiddle" title="click to inactive" /></a></td>

                      <td align="center" valign="middle"><button type="button" onclick="javascript: location.href='addshoeadm.php';" class="button">Add New Shoes</button></td>
                      <td align="center" valign="middle"><button type="button" onclick="javascript: selactiv(4);" class="button">Make Featured (Home Page)</button></td>
                    </tr>
                  </table></td>
	  </tr>
				
				<tr class="tblrow">
				  <td colspan="12" align="left" valign="middle" class="tac_ptb">              <div class="feedbuttons">

                  <p class="buttons">
                  
                    
                  <a href="shoesadm.php?curpage=1&memtype=adm"> Previous </a> &nbsp;&nbsp;
                  
                    
                  <a href="shoesadm.php?curpage=2&memtype=adm"> Next </a>&nbsp;</p>
                  </div>
                </td>
	  </tr>

			</form>
		</table>
</div>

	<script>
function selactiv(d)
{
	var chks = document.getElementsByName('checkbox[]');
	var x = 0;
	var n = 0;
	for(i=0;i<chks.length;i++)
	{
		if(chks[i].checked)
		{
			x=chks[i].value;
			n++;
		}
	}

if(n==0)
	alert("Select a record");
else
{
	ans=confirm('Are you sure?');
	if(ans==true)
	{
	document.site_banners.hfld.value=d;
	document.site_banners.submit();
	}
}
}
	</script>
	<br class="clear-both" />		


							    </td>
							</tr>			
					</table>
					
			    </td>

			</tr>			
			
		</table>

	</body>
</html>