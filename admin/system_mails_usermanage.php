<?php include("top.php");
include_once "../class.phpmailer.php";

if($_SERVER['REQUEST_METHOD']=="POST")
{
	$rs=mysql_query("select * from soe_smsgs");
	while($row=mysql_fetch_array($rs))
	{
		$id=$row['msg_id'];
		$v=mysql_real_escape_string($_POST['info'][$id]['subject']);
		$v1=mysql_real_escape_string($_POST['info'][$id]['body']);
		$a="update soe_smsgs set subject='".$v."',body='".$v1."' where msg_id=".$id;
		mysql_query($a) or die(mysql_error().'<br />'.$a);
	}


			
}

$rs=mysql_query("select * from soe_smsgs");
while($row=mysql_fetch_array($rs))
{
	$id=$row['msg_id'];
	$info[$id]['subject']=$row['subject'];
	$info[$id]['body']=$row['body'];	
}
?>

<div class="body" id="mk_height">
  <table width="95%" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr>
      <td class="header">System Message User</td>
    </tr>
    <tr>
      <td width="100%"><form action="" method="post" name="settings" id="settings">
        <table width="100%" border="0" cellpadding="0" cellspacing="5" align="ceneter" class="marginTop">
          <tr>
            <td class="tblcell21">Subject</td>
            <td><input type="text" name="info[1][subject]" value="<?php echo $info[1]['subject']; ?>" class="defaultWH" /></td>
          </tr>
          <tr>
            <td class="tblcell32" colspan="2">Message</td>
          </tr>
          <tr>
            <td class="tblcell34" colspan="2"><textarea name="info[1][body]" rows="8" class="taWidth"><?php echo $info[1]['body']; ?></textarea></td>
          </tr>
          <tr>
            <td class="tblcell32" colspan="2">|recipient_name| : recipient name</td>
          </tr>
          <tr>
            <td class="tblcell32" colspan="2">|login| : member login (email)</td>
          </tr>
          <tr>
            <td class="tblcell32" colspan="2">|password| : member password</td>
          </tr>
          <tr>
            <td class="tblcell32" colspan="2">|site_name| : site name</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td class="tblcell21">Subject</td>
            <td><input type="text" name="info[2][subject]" value="<?php echo $info[2]['subject']; ?>" class="defaultWH" /></td>
          </tr>
          <tr>
            <td class="tblcell32" colspan="2">Message</td>
          </tr>
          <tr>
            <td class="tblcell34" colspan="2"><textarea name="info[2][body]" rows="8" class="taWidth"><?php echo $info[2]['body']; ?></textarea></td>
          </tr>
          <tr>
            <td class="tblcell32" colspan="2">|recipient_name| : recipient name</td>
          </tr>
          <tr>
            <td class="tblcell32" colspan="2">|login| : member login (email)</td>
          </tr>
          <tr>
            <td class="tblcell32" colspan="2">|password| : member password</td>
          </tr>
          <tr>
            <td class="tblcell32" colspan="2">|site_name| : site name</td>
          </tr>
          <tr>
            <td class="tblcell32" colspan="2">|person| : admin or own self</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td class="tblcell21">Subject</td>
            <td><input type="text" name="info[3][subject]" value="<?php echo $info[3]['subject']; ?>" class="defaultWH" /></td>
          </tr>
          <tr>
            <td class="tblcell32" colspan="2">Message</td>
          </tr>
          <tr>
            <td class="tblcell34" colspan="2"><textarea name="info[3][body]" rows="8" class="taWidth"><?php echo $info[3]['body']; ?></textarea></td>
          </tr>
          <tr>
            <td class="tblcell32" colspan="2">|recipient_name| : recipient name</td>
          </tr>
          <tr>
            <td class="tblcell32" colspan="2">|login| : member login (email)</td>
          </tr>
          <tr>
            <td class="tblcell32" colspan="2">|password| : member password</td>
          </tr>
          <tr>
            <td class="tblcell32" colspan="2">|site_name| : site name</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td class="tblcell21">Subject</td>
            <td><input type="text" name="info[4][subject]" value="<?php echo $info[4]['subject']; ?>" class="defaultWH" /></td>
          </tr>
          <tr>
            <td class="tblcell32" colspan="2">Message</td>
          </tr>
          <tr>
            <td class="tblcell34" colspan="2"><textarea name="info[4][body]" rows="8" class="taWidth"><?php echo $info[4]['body']; ?></textarea></td>
          </tr>
          <tr>
            <td class="tblcell32" colspan="2">|recipient_name| : recipient name</td>
          </tr>
          <tr>
            <td class="tblcell32" colspan="2">|email| : new email from admin</td>
          </tr>
          <tr>
            <td class="tblcell32" colspan="2">|email_password| : new email password from admin</td>
          </tr>
          <tr>
            <td class="tblcell32" colspan="2">|site_name| : site name</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td class="tblcell21">Subject</td>
            <td><input type="text" name="info[5][subject]" value="<?php echo $info[5]['subject']; ?>" class="defaultWH" /></td>
          </tr>
          <tr>
            <td class="tblcell32" colspan="2">Message</td>
          </tr>
          <tr>
            <td class="tblcell34" colspan="2"><textarea name="info[5][body]" rows="8" class="taWidth"><?php echo $info[5]['body']; ?></textarea></td>
          </tr>
          <tr>
            <td class="tblcell32" colspan="2">|link| : email verification link</td>
          </tr>
          <tr>
            <td class="tblcell32" colspan="2">|code| : email verification code</td>
          </tr>
          <tr>
            <td class="tblcell32" colspan="2">|site_name| : site name</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td class="tblcell21">Subject</td>
            <td><input type="text" name="info[7][subject]" value="<?php echo $info[7]['subject']; ?>" class="defaultWH" /></td>
          </tr>
          <tr>
            <td class="tblcell32" colspan="2">Message</td>
          </tr>
          <tr>
            <td class="tblcell34" colspan="2"><textarea name="info[7][body]" rows="8" class="taWidth"><?php echo $info[7]['body']; ?></textarea></td>
          </tr>
          <tr>
            <td class="tblcell32" colspan="2">|recipient_name| : recipient name</td>
          </tr>
          <tr>
            <td class="tblcell32" colspan="2">|login| : member login (email)</td>
          </tr>
          <tr>
            <td class="tblcell32" colspan="2">|password| : member password</td>
          </tr>
          <tr>
            <td class="tblcell32" colspan="2">|link| : email verification link</td>
          </tr>
          <tr>
            <td class="tblcell32" colspan="2">|code| : email verification code</td>
          </tr>
          <tr>
            <td class="tblcell32" colspan="2">|site_name| : site name</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td class="tblcell21">Subject</td>
            <td><input type="text" name="info[9][subject]" value="<?php echo $info[9]['subject']; ?>" class="defaultWH" /></td>
          </tr>
          <tr>
            <td class="tblcell32" colspan="2">Message</td>
          </tr>
          <tr>
            <td class="tblcell34" colspan="2"><textarea name="info[9][body]" rows="8" class="taWidth"><?php echo $info[9]['body']; ?></textarea></td>
          </tr>
          <tr>
            <td class="tblcell32" colspan="2">|site_name| : site name</td>
          </tr>
          <tr>
            <td class="tblcell32" colspan="2">|email| : new email</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td class="tblcell21">Subject</td>
            <td><input type="text" name="info[13][subject]" value="<?php echo $info[13]['subject']; ?>" class="defaultWH" /></td>
          </tr>
          <tr>
            <td class="tblcell32" colspan="2">Message</td>
          </tr>
          <tr>
            <td class="tblcell34" colspan="2"><textarea name="info[13][body]" rows="8" class="taWidth"><?php echo $info[13]['body']; ?></textarea></td>
          </tr>
          <tr>
            <td class="tblcell32" colspan="2">|recipient_name| : recipient name</td>
          </tr>
          <tr>
            <td class="tblcell32" colspan="2">|duration| : subscription duration</td>
          </tr>
          <tr>
            <td class="tblcell32" colspan="2">|site_name| : site name</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td class="tblcell21">Subject</td>
            <td><input type="text" name="info[14][subject]" value="<?php echo $info[14]['subject']; ?>" class="defaultWH" /></td>
          </tr>
          <tr>
            <td class="tblcell32" colspan="2">Message</td>
          </tr>
          <tr>
            <td class="tblcell34" colspan="2"><textarea name="info[14][body]" rows="8" class="taWidth"><?php echo $info[14]['body']; ?></textarea></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td class="tblcell21">Subject</td>
            <td><input type="text" name="info[15][subject]" value="<?php echo $info[15]['subject']; ?>" class="defaultWH" /></td>
          </tr>
          <tr>
            <td class="tblcell32" colspan="2">Message</td>
          </tr>
          <tr>
            <td class="tblcell34" colspan="2"><textarea name="info[15][body]" rows="8" class="taWidth"><?php echo $info[15]['body']; ?></textarea></td>
          </tr>
          <tr>
            <td class="tblcell32" colspan="2">|recipient_name| : recipient name</td>
          </tr>
          <tr>
            <td class="tblcell32" colspan="2">|details| : subscription details</td>
          </tr>
          <tr>
            <td class="tblcell32" colspan="2">|site_name| : site name</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td class="tblcell34" colspan="2"><input type="submit" name="submit" value="Update" class="button" /></td>
          </tr>
          <tr>
            <td><br class="clear" /></td>
          </tr>
        </table>
      </form></td>
    </tr>
  </table>
</div>
<?php include("bottom.php"); ?>