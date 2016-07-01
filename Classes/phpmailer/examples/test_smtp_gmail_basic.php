<html>
<head>
<title>PHPMailer - SMTP (Gmail) basic test</title>
</head>
<body>

<?php

//error_reporting(E_ALL);
//error_reporting(E_STRICT);
//ini_set("display_errors", 1);

date_default_timezone_set("Asia/Bangkok");

require_once('../class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail             = new PHPMailer();

$body             = file_get_contents('contents.html');
$body             = eregi_replace("[\]",'',$body);

$mail->IsSMTP(); // telling the class to use SMTP
//$mail->Host       = "smtp.jasmine.com"; // SMTP server
$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = true;                  // enable SMTP authentication
//$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
$mail->SMTPSecure = "ssl";   
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
//$mail->Port       = 587;  
$mail->Username   = "rx.portal@gmail.com";  // GMAIL username
$mail->Password   = "21482149";            // GMAIL password

$mail->SetFrom('rx.portal@gmail.com', 'RO10 System');

$mail->AddReplyTo("puwadon.sa@jasmine.com","Puwadon.Sa");

$mail->Subject    = "PHPMailer Test Subject via smtp (Gmail), basic";

$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->CharSet = "utf-8";
$mail->isHTML(true);   
$mail->MsgHTML($body);

//$address = "puwadon.sa@jasmine.com";
//$mail->AddAddress($address, "Puwadon.Sa");
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
