<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
require_once('recaptchalib.php');
  $publickey = "6LcT9MISAAAAAGHeB-xUmKeE2oDP7xJXcJ7w23d2";
  $privatekey = "6LcT9MISAAAAALX5so4idD5Sg9FBFnJvi5mQIP6W";
 
$resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);
 
if ($resp->is_valid) {
    ?>success<?php
}
else
{
    die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." ."(reCAPTCHA said: " . $resp->error .")");
}
?>