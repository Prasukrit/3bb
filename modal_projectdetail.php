<div class="modal animated fade " id="myModal<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">รายละเอียดของ<?php echo $project_name; ?></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-2">
                        <div class="form-group">
                            <label>ID</label>
                            <input type="text" class="form-control input-sm" name="id" id="id" readonly value="<?php echo $id; ?>"> 
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label>ชื่อโครงการ</label>
                            <input type="text" class="form-control input-sm" name="project_name" readonly  id="project_name" value="<?php echo $project_name; ?>">
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <label>ประเภท</label>
                            <input type="text" class="form-control input-sm" name="type" id="type"  readonly value="<?php echo $type; ?>">
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <label>จำนวนหน่วย</label>
                            <input type="text" class="form-control input-sm" name="project_unit" id="project_unit"  readonly value="<?php echo $project_unit; ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4">  
                        <div class="form-group">
                            <label>แขวง/ตำบล</label>
                            <input type="text" class="form-control input-sm" name="sub_district" id="sub_district"  readonly value="<?php echo $sub_district; ?>">   
                        </div>
                    </div>

                    <div class="col-xs-4">  
                        <div class="form-group">
                            <label>เขต/อำเภอ</label>
                            <input type="text" class="form-control input-sm" name="district" id="district"  readonly value="<?php echo $district; ?>">   
                        </div>
                    </div>

                    <div class="col-xs-4">
                        <div class="form-group">
                            <label>จังหวัด</label>
                            <input type="text" class="form-control input-sm" name="province" id="province"  readonly value="<?php echo $province; ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>ที่อยู่</label>
                            <textarea class="form-control input-sm" name="address" readonly ><?php echo $address; ?></textarea>   
                        </div>
                    </div>

                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>หมายเหตุ</label>
                            <textarea class="form-control input-sm" name="remark" readonly ><?php echo $remark; ?></textarea>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xs-3">
                        <div class="form-group">
                            <label>Location code</label>
                            <input type="text" class="form-control input-sm" name="location_code" id="location_code"  readonly value="<?php echo $location_code; ?>">   
                        </div>
                    </div>

                    <div class="col-xs-3">
                        <div class="form-group">
                            <label>พิกัด</label>
                            <input type="text" class="form-control input-sm" name="location_lat_long" id="location_lat_long"  readonly value="<?php echo $location_lat_long; ?>">   
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <label>Node ใกล้เคียง</label>
                            <input type="text" class="form-control input-sm" name="node_nearby" id="node_nearby"  readonly value="<?php echo $node_nearby; ?>">   
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <label>บริษัทผู้สร้าง</label>
                            <input type="text" class="form-control input-sm" name="builder" id="builder"  readonly value="<?php echo $builder; ?>">   
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xs-3">
                        <div class="form-group">
                            <label>ผจก. / นิติ / ประธาน โครงการ</label>
                            <input type="text" class="form-control input-sm" name="contact_name" id="builder"  readonly value="<?php echo $contact_name; ?>">   
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <label>เบอร์โทรศัพท์</label>
                            <input type="text" class="form-control input-sm" name="contact_tel1" id="builder"  readonly value="<?php echo $contact_tel1; ?>">   
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <label>เบอร์มือถือ</label>
                            <input type="text" class="form-control input-sm" name="contact_tel2" id="builder"  readonly value="<?php echo $contact_tel2; ?>">   
                        </div>
                    </div>
                    <?php
                    $user_code = $sale_id; // testdb ของอีกอันนึง
                    // Query ของ portal 
                    $sql_sale = "SELECT * FROM rx_user where user_code ='" . trim($user_code) . "' limit 1 ";
                    $row_sale = mysqli_query($conn_sale, $sql_sale);
                    while ($result = mysqli_fetch_assoc($row_sale)) {
                        ?>
                        <div class="col-xs-3">
                            <div class="form-group">
                                <label>ชื่อผู้รับผิดชอบโครงการ</label>
                                <input type="text" class="form-control input-sm bg-success" name="sale_name" id="sale_name"  readonly <?php
                                if (empty($result["user_code"])) {
                                    echo "value=''";
                                } else {
                                    echo "value='" . $result["user_name"] . "'";
                                }
                                ?>
                                       >   
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