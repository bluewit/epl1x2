<div class="">
  <div class="page-header-title">
    <h4 class="page-title"><?php echo $row_national->national_name ?></h4>
  </div>
</div>

<div class="page-content-wrapper ">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel">
                  <div class="panel-heading"> 
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                      <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">General Info</a></li>              
                      <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Edit</a></li>
                      <li role="presentation"><a href="#delete" aria-controls="delete" role="tab" data-toggle="tab">Delete</a></li>
                    </ul>
                  </div>
                  <div class="panel-body"> 
                    <!-- Tab panes -->
                    <div class="tab-content">
                      <div role="tabpanel" class="tab-pane active" id="home">
                        <form class="form-horizontal" method="POST" role="form">
                          <div class="form-group">
                            <label for="registered" class="col-sm-2 col-md-2 control-label">ประเทศ/โซน:</label>
                            <div class="col-sm-4 col-md-4">
                              <p class="form-control-static"><?php echo $row_national->national_name ?></p>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="username" class="col-sm-2 col-md-2 control-label">รูปเดิม:</label>
                            <div class="col-sm-4 col-md-4">
                              <p class="form-control-static"><img src="<?php echo base_url('images/uploads/S/'.$row_national->national_image) ?>" width="30" /></p>
                            </div>                   
                          </div>                 
                        </form>
                      </div>              
                      <div role="tabpanel" class="tab-pane" id="profile">
                        <div class="modal-content" id="modal-content">
                          <form class="form-horizontal" id="form-edit" action="<?php echo site_url('ad-manage/national-edit-operate') ?>" method="POST" role="form" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="col-sm-4 col-md-3 col-lg-3"> </div>
                            </div>
                            <div class="form-group ">
                                <label for="inputUsername" class="col-sm-3 control-label">ประเทศ/โซน:</label>
                                <div class="col-sm-8">
                                   <input type="text" class="form-control" placeholder="ประเทศ/โซน" name="national_name" id="national_name" value="<?php echo $row_national->national_name ?>" required data-parsley-minlength="4">
                                </div>            
                            </div>
                            <div class="form-group">
                                <label for="inputUsername" class="col-sm-3 control-label">รูปภาพประกอบ:</label>
                                <div class="col-sm-8">
                                <input type="file" class="filestyle" data-buttonname="btn-default" placeholder="เลือกรูปภาพประกอบ" name="national_image" id="national_image" required>* ขนาดภาพ 200 X 200 Pixel
                                </div>
                              </div>                    
                            <div class="form-group">
                                <div class="col-sm-4 col-md-3"></div>
                                <div class="col-sm-4 col-md-4">
                                <input  type="hidden" name="national_id" id="national_id" value="<?php echo $row_national->national_id ?>" />
            <input  type="hidden" name="national_image_old" id="national_image_old" value="<?php echo ($row_national->national_image=='default.jpg')?'':$row_national->national_image ?>" />
                                <button type="submit" id="submit" name="button" class="btn btn-default"><i class=" fa fa-refresh "></i> Submit Changes</button>
                                </div>
                            </div>
                          </form>
                        </div><!-- End <div class="modal-content" id="modal-content"> -->
                      </div><!-- End <div role="tabpanel" class="tab-pane" id="profile"> -->
                      <div role="tabpanel" class="tab-pane" id="delete">
                        <form id="form-delete" class="form-horizontal" method="POST" role="form" action="<?php echo site_url('ad-manage/national-delete') ?>">
                          <div class="form-group">
                            <div class="m-t-10 m-l-15">
                              <input name="national_id" value="<?php echo $row_national->national_id ?>" type="hidden">
                              <button type="submit" id="submit" name="button" value="Delete" class="btn btn-danger" onclick="return confirm ('ต้องการลบจริง ๆ หรือ ?')"><i class=" fa fa-times "></i> ยืนยันการลบ</button>
                            </div>
                          </div>
                        </form>
                      </div><!-- End  <div role="tabpanel" class="tab-pane" id="delete"> -->
                    </div>
                  </div>
                </div><!-- End panel -->
            </div>
        </div><!-- End row -->
    </div><!-- container -->
</div> <!-- Page content Wrapper -->

<script type="text/javascript">
$(function() {
	$('#form-edit').parsley();
	// Javascript to enable link to tab
	var hash = document.location.hash;
	if (hash) {
		console.log(hash);
		$('.nav-tabs a[href='+hash+']').tab('show');
	}	
	// Change hash for page-reload
	$('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
		window.location.hash = e.target.hash;
	});
});
</script>