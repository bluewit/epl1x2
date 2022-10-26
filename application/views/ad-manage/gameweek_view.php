<div class="">
  <div class="page-header-title">
    <h4 class="page-title">เกมส์วีค</h4>
  </div>
</div>
<div class="page-content-wrapper ">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="panel">
          <div class="panel-body"> 
            <!-- Tab panes -->
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="profile">
                <div class="modal-content" id="modal-content">
                  <form class="form-inline m-l-10 m-t-10 m-r-10 m-b-10" id="form-edit" action="<?php echo site_url('ad-manage/gameweek-edit-operate') ?>" method="POST" role="form">
                  <?php foreach($rs_gameweek->result() as $row){ ?>
                    <div class="form-group">
                        <label for="gw_id">เกมส์วีค :</label>
                        <input type="text" class="form-control" name="gw_id[<?php echo $row->gw_id ?>]" value="<?php echo $row->gw ?>" readonly>
                    </div>

                    <div class="form-group m-l-10">
                        <label class="sr-only" for="gw_datetime">วันที่</label>
                        <input type="text" class="form-control datetimepicker" name="gw_datetime[<?php echo $row->gw_id ?>]" value="<?php echo $row->gw_datetime ?>">
                    </div>
                    <div class="form-group m-l-10">
                        <div class="radio radio-primary">
                            <input id="gw_display" name="gw_display" type="radio" <?php if($row->gw_display=='y'){ echo 'checked';} ?> value="<?php echo $row->gw_id ?>">
                            <label for="gw_display">
                                แสดงวีคนี้
                            </label>
                        </div>
                    </div>
                    <br>
                    <br>
                    <?php } ?>
                    <br>
                    <br>
                    <button type="submit" id="submit" name="button" class="btn btn-default"><i class=" fa fa-refresh "></i> Submit Changes</button>                    
                  </form>
                </div>
              </div>
              <!-- End <div role="tabpanel" class="tab-pane" id="profile"> --> 
            </div>
          </div>
        </div>
        <!-- End panel --> 
      </div>
    </div>
    <!-- End row --> 
  </div>
  <!-- container --> 
</div>
<!-- Page content Wrapper -->