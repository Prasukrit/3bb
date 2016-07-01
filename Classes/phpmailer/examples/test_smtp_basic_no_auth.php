<html>
<head>
<title>PHPMailer - SMTP basic test with no authentication</title>
</head>
<body>

<?php

//error_reporting(E_ALL);
error_reporting(E_STRICT);

//date_default_timezone_set('America/Toronto');
date_default_timezone_set("Asia/Bangkok");

require_once('../class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail             = new PHPMailer();

$body             = file_get_contents('contents.html');
$body             = eregi_replace("[\]",'',$body);

$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "smtp.jasmine.com"; // SMTP server
//$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only

$mail->SetFrom('ro10_system@jasmine.com', 'RO10 System');

$mail->AddReplyTo("ro10_system@jasmine.com","RO10 System");

$mail->Subject    = "PHPMailer Test Subject via smtp, basic with no authentication";

$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML($body);

$address = "puwadon.sa@jasmine.com";
$mail->AddAddress($address, "Puwadon.SA");

//$mail->AddCC('person1@domain.com', 'Person One');
//$mail->AddCC('person2@domain.com', 'Person Two');
$recipients = array(
   'puwadon.sa@jasmine.com' => 'Puwadon.SA'   
     
);
foreach($recipients as $email => $name)
{
   $mail->AddAddress($email, $name);
}
$mail->AddCC('puwadon_saensai@hotmail.com', 'Puwadon Hotmail');

$mail->AddAttachment("images/phpmailer.gif");      // attachment
$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}

?>

</body>
</html>
