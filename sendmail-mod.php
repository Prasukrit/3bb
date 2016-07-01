<?php

### INCLUDE PHPMAILER ����� ###
include ("./Classes/phpmailer/class.phpmailer.php");

### FUNCTION SEND MAIL ####

function scriptdd_sendmail($to_name,$to_email,$from_name,$email_user_send,$email_pass_send,$subject,$body_html,$body_text) {

$mail = new PHPMailer();
$mail -> From     = $email_user_send;
$mail -> FromName = $from_name;

$mail -> AddAddress($to_email,$to_name);
$mail -> Subject	= $subject;
$mail -> Body		= $body_html;
$mail -> AltBody	= $body_text;
$mail -> IsHTML (true);

$mail->IsSMTP();
$mail->Host = 'ssl://smtp.gmail.com';
$mail->Port = 465;
$mail->SMTPAuth		= true;
//$mail->SMTPDebug	= true;
$mail->Username = $email_user_send;
$mail->Password = $email_pass_send;

$mail->Send();
$mail->ClearAddresses();


}
### FUNCTION SEND MAIL ####


#### เวลาเรียกใช้เรียกเป็น Function แบบนี้ #####
$to_name			="ผู้รับผิดชอบโครงการ"; //"ชื่อของปลายทาง";
$to_email			="palm.ricing@hotmail.com"; //ปลายทาง";
$from_name			="คุณปาล์ม";
$email_user_send                ="palm.ricing@gmail.com"; 
$email_pass_send                ="P@LM.Google94";
$subject			="มอบหมายผู้รับผิดชอบโครงการ";
$body_html			="ทดสอบการส่งไฟล์";
$body_text			="เนื้อหาเป็น Text ธรรมดา";

scriptdd_sendmail($to_name,$to_email,$from_name,$email_user_send,$email_pass_send,$subject,$body_html,$body_text);

echo "ส่งไปแล้ว";

?>