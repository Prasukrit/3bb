<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
                        
                        $sql = "SELECT * FROM project WHERE id='$project_id[$i]'";
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
</html> 