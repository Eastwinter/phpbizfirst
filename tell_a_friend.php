<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
include("connect.php");
	
	/******************************************************************************
     * Tell A Friend Script: 
	 * This script allows your visitors to sent invitation to their friends via email to visit your site.
	 *
	 * Usage: 
	 * The script comes with three files tell_a_friend.php, thankyou.html and install.txt
	 * You're NOT allowed to redistribute or sell this script.
	 * You are allowed to modify this script for your own personal use.	 
	 * Please see install.txt attached in the zip for installation instructions.
	 *
	 * Notes:
	 * If you like this script or used it for your website or project.
	 * Please remember too link back to www.php-learn-it.com. 
	 * Your help is always appreciated.
	 *
	 * author: webdev (php-learn-it.com (or phplearnit.com)
	 * Visit www.php-learn-it.com (or www.phplearnit.com) for more script and tutorials on PHP.
	 *****************************************************************************/

	//minimum characters allowed in the message box
	$msg_min_chars = "10";

	//maximum characters allowed in the message box
	$msg_max_chars = "250";
	
	$errors = array();

	function validate_form_items()
	{
	   global $msg_min_chars, $msg_max_chars;
	   $msg_chars = "{".$msg_min_chars.",".$msg_max_chars."}";

	   $form_items = array(
		   
		   "name"  => array(
						   "regex" => "/^([a-zA-Z '-]+)$/",
						   "error" => "Your name appears to be in improper format",
						   ),
			"email" => array(
						   "regex" =>
							"/^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$/",
						   "error" => "email address is invalid",
						   ),
		   "message" => array(
						   "regex" => "/.*/",
						   "error" => "Your message is either too short or exceeds $msg_max_chars characters",
						   ),
	   );

	   global $errors;
		
		if(!preg_match($form_items["name"]["regex"], $_POST["your_name"]))
			$errors[] = $form_items["name"]["error"];

		if(!preg_match($form_items["email"]["regex"], $_POST["your_email"]))
			$errors[] = "your ".$form_items["email"]["error"];

		if(!preg_match($form_items["email"]["regex"], $_POST["friend_email1"]))
			$errors[] = "Friend 1 ".$form_items["email"]["error"];

		if(strlen(trim($_POST["message"])) < $msg_min_chars || strlen(trim($_POST["message"])) >  $msg_max_chars )
			$errors[] = $form_items["message"]["error"];

		if(trim($_POST["friend_email2"]) != "")
		{
			if(!preg_match($form_items["email"]["regex"], $_POST["friend_email2"]))
				$errors[] = "Friend 2 ".$form_items["email"]["error"];
		}
		
		if(trim($_POST["friend_email3"]) != "")
		{
			if(!preg_match($form_items["email"]["regex"], $_POST["friend_email3"]))
				$errors[] = "Friend 3 ".$form_items["email"]["error"];
		}
		
	   return count($errors);
	}
	
	function email($from, $from_name, $to, $message)
	{
		//header("Location: thankyou.html");return;

		
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";		
$headers .= "From: ".$from."\r\n";
		
		$rs=mysql_query("select * from soe_shoe where soe_id=".$_GET['id']);
		$row=mysql_fetch_array($rs);
		$your_domian_name = "<a href='www.innogenius.com/shoebreeze/detail-id-".$_GET['id'].".htm'>".$row['name']."</a>";
		//edit what you want your vistors to see in their email here
		$subject = $from_name." sent you an invitation to view ".$row['name'];
		$your_message = "Hi!<br /><br />";
		$your_message.= ucfirst($from_name);
		$your_message.= " wants you to check out $your_domian_name<br /><br />";
		$your_message.= "<strong>Sender's Message:</strong><br /><br />";

		$message=$your_message.stripslashes($message);

		if (mail($to,$subject,$message,$headers) ) {
			return true;
		} else {
			return false;
		}
	}

	function print_error($errors)
	{
		
		foreach($errors as $error)
		{
			$err.=$error."<br/>";
		}

		echo 
		 "<div style=\"border:1px red solid; font-size:14px; font-weight:normal; color:red; margin:10px; padding:10px;\">
			$err
		 <div>";
		
	}
	
	function form_process()
	{	
		$from_name = $_POST["your_name"];
		$from_email = $_POST["your_email"];
		
		$to = $_POST["your_email"];
		$to1=$_POST["friend_email1"];
		$to2=$_POST["friend_email2"];
		$to3=$_POST["friend_email3"];
		$message = $_POST["message"];
		
		$error_count = validate_form_items();
		//die("************".$error_count);
		if($error_count == 0)
		{
			if(1)
			{
				email($from_email, $from_name, $to, $message);
				email($from_email, $from_name, $to1, $message);
				email($from_email, $from_name, $to2, $message);
				email($from_email, $from_name, $to3, $message);
				echo "<br /><br /><br /> <center><strong>YOUR MESSAGE HAS BEEN SUCCESSFULLY SENT TO YOUR FRIEND(S).</strong></center><br /><br /><br />";
			}
			else
			{
				global $errors;
				$errors[] = "Email coudn't be send at this time. <br>Please report the webmaster of this error.";
			}
		}
		else
		{
			global $errors;
			
			for($i=0;$i<$error_count;$i++)
				echo "<br /> <center><strong>".$errors[$i]."</strong></center><br />";
		}
		
		
	}
	
	

form_process();


?>