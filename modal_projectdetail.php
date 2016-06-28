<!-- Modal -->
    <div class="modal fade" id="myModal<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
          </div>
          <div class="modal-body">
            <input type="text" name="id" id="id" value="<?php echo $id; ?>">
            <input type="text" name="project_name" id="project_name" value="<?php echo $project_name; ?>">
            <input type="text" name="location_lat_long" id="location_lat_long" value="<?php echo $location_lat_long; ?>">
            <input type="text" name="province" id="province" value="<?php echo $province; ?>">
            <input type="text" name="district" id="district" value="<?php echo $district; ?>">
            <input type="text" name="location_code" id="location_code" value="<?php echo $location_code; ?>">
            <input type="text" type="type" id="type" value="<?php echo $type; ?>">
            <input type="text" id="builder" name="builder" value="<?php echo $builder; ?>">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div><!--Modal-->