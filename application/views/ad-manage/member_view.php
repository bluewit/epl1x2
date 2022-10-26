<div class="">
  <div class="page-header-title">
    <h4 class="page-title"><?php echo $row_club->club_name ?></h4>
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
                              <p class="form-control-static"><?php echo $row_club->national_name ?></p>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="registered" class="col-sm-2 col-md-2 control-label">ลีก:</label>
                            <div class="col-sm-4 col-md-4">
                              <p class="form-control-static"><?php echo $row_club->league_name ?></p>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="registered" class="col-sm-2 col-md-2 control-label">สโมสร:</label>
                            <div class="col-sm-4 col-md-4">
                              <p class="form-control-static"><?php echo $row_club->club_name ?></p>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="username" class="col-sm-2 col-md-2 control-label">รูปเดิม:</label>
                            <div class="col-sm-4 col-md-4">
                              <p class="form-control-static"><img src="<?php echo base_url('images/uploads/S/'.$row_club->club_image) ?>" width="30" /></p>
                            </div>                   
                          </div>                 
                        </form>
                      </div>              
                      <div role="tabpanel" class="tab-pane" id="profile">
                        <div class="modal-content" id="modal-content">
                          <form class="form-horizontal" id="form-edit" action="<?php echo site_url('ad-manage/club-edit-operate') ?>" method="POST" role="form" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="col-sm-4 col-md-3 col-lg-3"> </div>
                            </div>
                            <div class="form-group ">
                                <label for="inputUsername" class="col-sm-3 control-label">ประเทศ/โซน:</label>
                                <div class="col-sm-8">
                                   <select class="form-control" name="national_id" id="national_id" required>
                                    <option value="" selected="selected">=เลือก=</option>
                                    <?php foreach($rs_national->result() as $row){ ?>
                                    <option value="<?php echo $row->national_id ?>" <?php echo ($row->national_id==$row_club->national_id)?'selected="selected"':'' ?>><?php echo $row->national_name ?></option>
                                    <?php } ?>
                                   </select>
                                </div>            
                            </div>
                            <div class="form-group ">
                                <label for="inputUsername" class="col-sm-3 control-label">ลีก:</label>
                                <div class="col-sm-8">
                                   <select class="form-control" name="league_id" id="league_id" required>
                                    <option value="" selected="selected">=เลือก=</option>
                                    <?php foreach($rs_league->result() as $row){ ?>
                                    <option value="<?php echo $row->league_id ?>" <?php echo ($row->league_id==$row_club->league_id)?'selected="selected"':'' ?>><?php echo $row->league_name ?></option>
                                    <?php } ?>
                                   </select>
                                </div>            
                            </div>
                            <div class="form-group ">
                                <label for="inputUsername" class="col-sm-3 control-label">ลีก:</label>
                                <div class="col-sm-8">
                                   <input type="text" class="form-control" placeholder="ลีก" name="club_name" id="club_name" value="<?php echo $row_club->club_name ?>" required data-parsley-minlength="4">
                                </div>            
                            </div>
                            <div class="form-group">
                                <label for="inputUsername" class="col-sm-3 control-label">รูปภาพประกอบ:</label>
                                <div class="col-sm-8">
                                <input type="file" class="filestyle" data-buttonname="btn-default" placeholder="เลือกรูปภาพประกอบ" name="club_image" id="club_image" required>* ขนาดภาพ 200 X 200 Pixel
                                </div>
                              </div>                    
                            <div class="form-group">
                                <div class="col-sm-4 col-md-3"></div>
                                <div class="col-sm-4 col-md-4">
                                <input  type="hidden" name="club_id" id="club_id" value="<?php echo $row_club->club_id ?>" />
        						<input  type="hidden" name="club_image_old" id="club_image_old" value="<?php echo ($row_club->club_image=='default.jpg')?'':$row_club->club_image ?>" />
                                <button type="submit" id="submit" name="button" class="btn btn-default"><i class=" fa fa-refresh "></i> Submit Changes</button>
                                </div>
                            </div>
                          </form>
                        </div><!-- End <div class="modal-content" id="modal-content"> -->
                      </div><!-- End <div role="tabpanel" class="tab-pane" id="profile"> -->
                      <div role="tabpanel" class="tab-pane" id="delete">
                        <form id="form-delete" class="form-horizontal" method="POST" role="form" action="<?php echo site_url('ad-manage/club-delete') ?>">
                          <div class="form-group">
                            <div class="m-t-10 m-l-15">
                              <input name="club_id" value="<?php echo $row_club->club_id ?>" type="hidden">
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
	$('#national_id').change(function(){
		change_select('<?php echo site_url('ad-manage/league_by_national_id') ?>', $(this).val(), function(response){
				//alert(response);
				var opt = '<option value="">=เลือก=</option>';
				for(var i =0; i<response.length; i++){
					opt += '<option value="'+response[i].league_id+'">'+response[i].league_name+'</option>';
				}
				$('#league_id').html( opt );	
		});
	}); 
});
function change_select(url_target, id_target, callback){
	//alert(id_target);
	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: url_target,
		data: {id: id_target},
		success: callback,
	});		
}
</script>