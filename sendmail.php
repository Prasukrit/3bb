<?php
require_once('Classes/phpmailer/class.phpmailer.php');
$mail             = new PHPMailer();
$mail->IsSMTP(); // telling the class to use SMTP
//$mail->Host       = "smtp.jasmine.com"; // SMTP server
$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = true;                  // enable SMTP authentication
//$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
$mail->SMTPSecure = "ssl";   
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
//$mail->Port       = 587;  
$mail->Username   = "palm.ricing@gmail.com";  // GMAIL username
$mail->Password   = "P@LM.Google94";            // GMAIL password

//$mail->SetFrom('xxxxxx@gmail.com', 'RO10 System');
//$mail->AddReplyTo("xxxxxx@jasmine.com","RO10 System");
$mail->SetFrom('palm.ricing@gmail.com', 'PALM System');
$mail->AddReplyTo("palm.ricing@hotmail.com","PALM Sub-System");
$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

 
//ถ้าผู้รับคนเดียว//ถ้าผู้รับคนเดียว
//$address = "puwadon.sa@jasmine.com";
//$mail->AddAddress($address, "Puwadon.Sa");

//ถ้าผู้รับหลายคน
$recipients = array(
   //'mujalin.c@jasmine.com' => 'Mujalin.C',   
   //'supakit.n@jasmine.com' => 'Supakit.N',
   //'ro10_system@jasmine.com' => 'RO10 System'
   //'puwadon.sa@jasmine.com' => 'Boo',
    'palm.ricing@gmail.com' => 'Palm'
     
);
foreach($recipients as $email => $name)
{
   $mail->AddAddress($email, $name);
}
//สิ้นสุดผู้รับหลายคน


//ถ้ามีไฟล์แนบ
//$mail->AddAttachment("images/phpmailer.gif");      // attachment
//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

//ส่งอีเมล์
//Send Mail
$mail->Subject    = "แจ้งโครงการที่ได้รับมอบหมายไปยัง ".$sale_name."";
//$mail->AddCC("$btn_emp_email);

		$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>                
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>RO10 | การจัดสรรโครงการ</title>
            <style>
                .text-header{
                    color:  #F57C00 ;
                }
                .box-detail{
                    background-color: #FFCDD2 ;
                    padding: 20px;
                    border:solid 1px gray;
                    display: block;
                    max-width: 300px;
                }
            </style>
    </head>

    <body>
        <div style="width: 80%; padding: 20px 30px 20px 30px;" >
            <font style="font-family: Tahoma; font-size: 12;">
                <div class="header">
                    <h3 class="text-header">เรียน คุณ <?php echo $_POST["sale_name"]; ?></h3>
                </div>
                <br/>
                <font color="#0000CC">เราได้ทำอัพเดทการมอบหมายโครงการที่ต้องรับผิดชอบไปยังคุณ <b><?php echo $_POST["sale_name"]; ?></b> เรียบร้อยแล้ว</font>
                <br />
                <br />
                <font color="#0000CC"><strong><u>รายชื่อโครงการ ดังนี้</u></strong></font>
                <ol>
                    <?php  
                        for ($i = 0; $i < count($project_id); $i++) {
                        
                        $sql = "SELECT * FROM project WHERE id="$project_id[$i]";
                        $query = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_assoc($query)) {
                            ?>
                            <li><?php echo $row["project_name"]; ?></li>
                            <?php
                        }
                    }
                    ?>

                </ol>

                <?php ?>
                <hr />
                <font style="font-family: Tahoma; font-size: 12;">			
                    ท่านสามารถเข้าตรวจสอบสถานะงานโครงการ และ แก้ไขบันทึกข้อมูลโครงการได้ผ่าน ลิ้งค์ด้านล่าง
                    <br />
                    <a href="" target="_blank">link website</a>
                    <br />
                    <br />
                    <br />
                    จึงเรียนมาเพื่อทราบ
                    <br />
                    <br />
                    <div class="box-detail">
                        <u>ติดปัญหาสอบถาม</u></br>
                        Admin : นายสมชาย  รายได้ดี
                        <br />
                        Tel. 089-991-1991
                        <br />
                        <br />
                        
                        </div>
                    <br />
                    <br />
                    <strong>ข้อความอัตโนมัติจากระบบจัดสรรโครงการ RO10</strong>
                </font>
            </font>
        </div>

    </body>
</html> ';

		$mail->CharSet = "utf-8";
		$mail->isHTML(true);   
		$mail->MsgHTML($body);
		$mail->Send();

//End Send Mail


/*
if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}
*/
?>