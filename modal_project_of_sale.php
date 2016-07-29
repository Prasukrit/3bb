<div class="modal fade " id="projectSale<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">โครงการที่ได้รับมอบหมายของ <span style="color: green"><?php echo $result["user_name"]; ?></span></h4>
            </div>
            <div class="modal-body">
                <div class="panel-body">
                    <div class="row panel-default active" style="border-bottom: solid #124a5b 1px;padding: 5px;">
                        <b>
                            <div class="col-md-4 ">ชื่อโครงการ</div>
                            <div class="col-md-2 ">Location_code</div>
                            <div class="col-md-2 ">จังหวัด</div>
                            <div class="col-md-2 ">เจ้าหน้าที่โครงการ</div>
                            <div class="col-md-2 ">เบอร์โทรศัพท์</div>
                        </b>
                    </div>
                    <?php
                        
                        $sql_project = "SELECT * FROM project WHERE sale_personal_id = '" . $user_code . "' ";
                        $query_project = mysqli_query($conn, $sql_project);

                        $j = 0;
                        while ($result_project = mysqli_fetch_array($query_project, MYSQLI_ASSOC)) {
                            $j++;
                            
                            if($j%2 == 0){
                                $switch_color = "bg-faded";
                            }else{
                                $switch_color = "bg-white";
                            }
                            ?>
                    <div class="row padding-small box-border-small <?php echo $switch_color; ?>">
                        <div class="col-md-4">
                            <?php echo $result_project["project_name"]; ?>
                        </div>
                        <div class="col-md-2 text-center">
                            <?php echo $result_project["location_code"]; ?>
                        </div>                        
                        <div class="col-md-2">
                            <?php echo $result_project["province"]; ?>
                        </div>
                        <div class="col-md-2">
                            <?php echo $result_project["contact_name"]; ?>
                        </div>
                        <div class="col-md-2">
                            <?php echo $result_project["contact_tel1"]; ?>
                        </div>
                        
                    
                    </div>
                    <?php } ?>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-danger" data-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>