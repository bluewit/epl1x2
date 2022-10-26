<div class="">
  <div class="page-header-title">
    <h4 class="page-title"><?php echo $row_match->club_home_name ?> VS <?php echo $row_match->club_away_name ?></h4>
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
                      <li role="presentation"><a href="#score" aria-controls="score" role="tab" data-toggle="tab">เพิ่มผล</a></li>
                      <li role="presentation"><a href="#delete" aria-controls="delete" role="tab" data-toggle="tab">ลบ</a></li>
                    </ul>
                  </div>
                  <div class="panel-body"> 
                    <!-- Tab panes -->
                    <div class="tab-content">
                      <div role="tabpanel" class="tab-pane active" id="home">
                        <form class="form-horizontal" method="POST" role="form">
                          <div class="form-group">
                            <label for="registered" class="col-sm-2 col-md-2 control-label">เกมส์วีค:</label>
                            <div class="col-sm-4 col-md-4">
                              <p class="form-control-static"><?php echo $row_match->gw_id ?></p>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="registered" class="col-sm-2 col-md-2 control-label">ประเทศ/โซน:</label>
                            <div class="col-sm-4 col-md-4">
                              <p class="form-control-static"><?php echo $row_match->national_name ?></p>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="registered" class="col-sm-2 col-md-2 control-label">ลีก:</label>
                            <div class="col-sm-4 col-md-4">
                              <p class="form-control-static"><?php echo $row_match->league_name ?></p>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="registered" class="col-sm-2 col-md-2 control-label">เจ้าบ้าน:</label>
                            <div class="col-sm-4 col-md-4">
                              <p class="form-control-static"><?php echo $row_match->club_home_name ?></p>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="username" class="col-sm-2 col-md-2 control-label">รูป:</label>
                            <div class="col-sm-4 col-md-4">
                              <p class="form-control-static"><img src="<?php echo base_url('images/uploads/S/'.$row_match->club_home_image) ?>" width="30" /></p>
                            </div>                   
                          </div>
                          <div class="form-group">
                            <label for="registered" class="col-sm-2 col-md-2 control-label">ทีมเยือน:</label>
                            <div class="col-sm-4 col-md-4">
                              <p class="form-control-static"><?php echo $row_match->club_away_name ?></p>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="username" class="col-sm-2 col-md-2 control-label">รูป:</label>
                            <div class="col-sm-4 col-md-4">
                              <p class="form-control-static"><img src="<?php echo base_url('images/uploads/S/'.$row_match->club_away_image) ?>" width="30" /></p>
                            </div>                   
                          </div>   
                          <div class="form-group">
                            <label for="registered" class="col-sm-2 col-md-2 control-label">วันที่เตะ:</label>
                            <div class="col-sm-4 col-md-4">
                              <p class="form-control-static"><?php echo $row_match->match_date ?></p>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="registered" class="col-sm-2 col-md-2 control-label">ราคา:</label>
                            <div class="col-sm-4 col-md-4">
                              <p class="form-control-static"><?php echo $row_match->match_rate ?></p>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="registered" class="col-sm-2 col-md-2 control-label">ทีมต่อ:</label>
                            <div class="col-sm-4 col-md-4">
                              <p class="form-control-static"><?php echo $row_match->team_handicap ?></p>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="registered" class="col-sm-2 col-md-2 control-label">คู่ถ่ายทอด:</label>
                            <div class="col-sm-4 col-md-4">
                              <p class="form-control-static"><?php echo $row_match->match_live ?></p>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="registered" class="col-sm-2 col-md-2 control-label">คู่เล่นเกมส์:</label>
                            <div class="col-sm-4 col-md-4">
                              <p class="form-control-static"><?php echo $row_match->match_special ?></p>
                            </div>
                          </div>              
                        </form>
                      </div>              
                      <div role="tabpanel" class="tab-pane" id="profile">
                        <div class="modal-content" id="modal-content">
                          <form class="form-horizontal" id="form-edit" action="<?php echo site_url('ad-manage/match-edit-operate') ?>" method="POST" role="form" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="col-sm-4 col-md-3 col-lg-3"> </div>
                            </div>
                            <div class="form-group ">
                                <label for="inputUsername" class="col-sm-3 control-label">เกมส์วีค:</label>
                                <div class="col-sm-8">
                                   <select class="form-control" name="gw_id" id="gw_id" required>
                                    <option value="" selected="selected">=เลือก=</option>
                                    <?php foreach($rs_gameweek->result() as $row){ ?>
                                    <option value="<?php echo $row->gw_id ?>" <?php echo ($row->gw_id==$row_match->gw_id)?'selected="selected"':'' ?>><?php echo $row->gw ?></option>
                                    <?php } ?>
                                   </select>
                                </div>            
                            </div>
                            <div class="form-group ">
                                <label for="inputUsername" class="col-sm-3 control-label">ประเทศ/โซน:</label>
                                <div class="col-sm-8">
                                   <select class="form-control" name="national_id" id="national_id" required>
                                    <option value="" selected="selected">=เลือก=</option>
                                    <?php foreach($rs_national->result() as $row){ ?>
                                    <option value="<?php echo $row->national_id ?>" <?php echo ($row->national_id==$row_match->national_id)?'selected="selected"':'' ?>><?php echo $row->national_name ?></option>
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
                                    <option value="<?php echo $row->league_id ?>" <?php echo ($row->league_id==$row_match->league_id)?'selected="selected"':'' ?>><?php echo $row->league_name ?></option>
                                    <?php } ?>
                                   </select>
                                </div>            
                            </div>
                            <div class="form-group ">
                                <label for="inputAame" class="col-sm-3 control-label">เจ้าบ้าน:</label>
                                <div class="col-sm-8">
                                <select id="national_home_id" name="national_home_id" class="form-control" required style="display:none;">
                                <option value="">เลือกประเทศ</option>
                                <?php foreach($rs_national->result() as $row_national){ ?>
                                    <option value="<?php echo $row_national->national_id ?>" <?php echo($row_national->national_id==$row_match->national_id)?'selected="selected"':''; ?>><?php echo $row_national->national_name ?></option>
                                <?php } ?>
                                </select>
                                <select id="league_home_id" name="league_home_id" class="form-control" required style="display:none;">
                                <option value="">ลีก/รายการในประเทศ</option>
                                <?php foreach($rs_league->result() as $row_league){ ?>
                                    <option value="<?php echo $row_league->league_id ?>" <?php echo($row_league->league_id==$row_match->league_id)?'selected="selected"':''; ?>><?php echo $row_league->league_name ?></option>
                                <?php } ?>
                                </select>
                                <select id="club_home_id" name="club_home_id" class="form-control" required>
                                    <option value="<?php echo $row_match->club_home_id ?>"><?php echo $row_match->club_home_name ?></option>
                                </select>
                                <img id="club_home_image" width="60" height="auto" src="<?php echo site_url('images/uploads/'.$row_match->club_home_image) ?>" />     
                                </div>     
                            </div>
                            <div class="form-group">
                                <label for="inputUsername" class="col-sm-3 control-label">ทีมเยือน:</label>
                                <div class="col-sm-8">
                                <select id="national_away_id" name="national_away_id" class="form-control" required style="display:none;">
                                <option value="">เลือกประเทศ</option>
                                <?php foreach($rs_national->result() as $row_national){ ?>
                                <option value="<?php echo $row_national->national_id ?>" <?php echo($row_national->national_id==$row_match->national_id)?'selected="selected"':''; ?>><?php echo $row_national->national_name ?></option>
                                <?php } ?>
                                </select>
                                <select id="league_away_id" name="league_away_id" class="form-control" required style="display:none;">
                                <option value="">ลีก/รายการในประเทศ</option>
                                <?php foreach($rs_league->result() as $row_league){ ?>
                                <option value="<?php echo $row_league->league_id ?>" <?php echo($row_league->league_id==$row_match->league_id)?'selected="selected"':''; ?>><?php echo $row_league->league_name ?></option>
                                <?php } ?>
                                </select>
                                <select id="club_away_id" name="club_away_id" class="form-control" required>
                                	<option value="<?php echo $row_match->club_away_id ?>"><?php echo $row_match->club_away_name ?></option>
                                </select>
                                <img id="club_away_image"  width="60" height="auto" src="<?php echo site_url('images/uploads/'.$row_match->club_away_image) ?>" />
                                </div>
                            </div>    
                            <div class="form-group">
                                <label for="inputUsername" class="col-sm-3 control-label">วันเตะ:</label>
                                <div class="col-sm-8">
                                   <input type="text" class="form-control datetimepicker" placeholder="วันเตะ" name="match_date" id="match_date" value="<?php echo $row_match->match_date ?>" required>
                                </div>            
                            </div>
                            <div class="form-group">
                                <label for="inputUsername" class="col-sm-3 control-label">ราคาต่อรอง:</label>
                                <div class="col-sm-8">
                                   <select id="match_rate" name="match_rate" class="form-control" required>
                                        <option value="">ราคา</option>
                                        <option value="0" <?php echo ($row_match->match_rate==0)?'selected="selected"':'' ?>>ส</option>
                                        <option value="0.25" <?php echo ($row_match->match_rate==0.25)?'selected="selected"':'' ?>>ป</option>
                                        <option value="0.5" <?php echo ($row_match->match_rate==0.5)?'selected="selected"':'' ?>>0.5</option>
                                        <option value="0.75" <?php echo ($row_match->match_rate==0.75)?'selected="selected"':'' ?>>0.5/1</option>
                                        <option value="1" <?php echo ($row_match->match_rate==1)?'selected="selected"':'' ?>>1</option>
                                        <option value="1.25" <?php echo ($row_match->match_rate==1.25)?'selected="selected"':'' ?>>1/1.5</option>
                                        <option value="1.5" <?php echo ($row_match->match_rate==1.5)?'selected="selected"':'' ?>>1.5</option>
                                        <option value="1.75" <?php echo ($row_match->match_rate==1.75)?'selected="selected"':'' ?>>1.5/2</option>
                                        <option value="2" <?php echo ($row_match->match_rate==2)?'selected="selected"':'' ?>>2</option>
                                        <option value="2.25" <?php echo ($row_match->match_rate==2.25)?'selected="selected"':'' ?>>2/2.5</option>
                                        <option value="2.5" <?php echo ($row_match->match_rate==2.5)?'selected="selected"':'' ?>>2.5</option>
                                        <option value="2.75" <?php echo ($row_match->match_rate==2.75)?'selected="selected"':'' ?>>2.5+3</option>            
                                        <option value="3" <?php echo ($row_match->match_rate==3)?'selected="selected"':'' ?>>3</option>
                                        <option value="3.25" <?php echo ($row_match->match_rate==3.25)?'selected="selected"':'' ?>>3/3.5</option>
                                        <option value="3.5" <?php echo ($row_match->match_rate==3.5)?'selected="selected"':'' ?>>3.5</option>
                                        <option value="3.75" <?php echo ($row_match->match_rate==3.75)?'selected="selected"':'' ?>>3.5+4</option>            
                                        <option value="4" <?php echo ($row_match->match_rate==4)?'selected="selected"':'' ?>>4</option>
                                        <option value="4.25" <?php echo ($row_match->match_rate==4.25)?'selected="selected"':'' ?>>4/4.5</option>
                                        <option value="4.5" <?php echo ($row_match->match_rate==4.5)?'selected="selected"':'' ?>>4.5</option>
                                        <option value="4.75" <?php echo ($row_match->match_rate==4.75)?'selected="selected"':'' ?>>4.5+5</option>
                                        <option value="5" <?php echo ($row_match->match_rate==5)?'selected="selected"':'' ?>>5</option>
                                        <option value="5.25" <?php echo ($row_match->match_rate==5.25)?'selected="selected"':'' ?>>5/5.5</option>
                                        <option value="5.5" <?php echo ($row_match->match_rate==5.5)?'selected="selected"':'' ?>>5.5</option>
                                        <option value="5.75" <?php echo ($row_match->match_rate==5.75)?'selected="selected"':'' ?>>5.5+6</option>
                                        <option value="6" <?php echo ($row_match->match_rate==6)?'selected="selected"':'' ?>>6</option>
                                    </select>
                                </div>            
                            </div>     
                            <div class="form-group">
                                <label for="inputUsername" class="col-sm-3 control-label">ทีมต่อ:</label>
                                <div class="col-sm-8">
                                   <select id="team_handicap" name="team_handicap" class="form-control" required>
                                        <option value="">ทีม</option>
                                        <option value="h" <?php echo ($row_match->team_handicap=='h')?'selected="selected"':'' ?>>เจ้าบ้าน</option>
                                        <option value="a" <?php echo ($row_match->team_handicap=='a')?'selected="selected"':'' ?>>ทีมเยือน</option>
                                        <!--<option value="e" <?php //echo ($row_match->team_handicap=='e')?'selected="selected"':'' ?>>เสมอ</option>-->
                                    </select>
                                </div>            
                            </div>  
                            <div class="form-group">
                                <label for="inputUsername" class="col-sm-3 control-label">คู่ถ่ายทอด:</label>
                                <div class="col-sm-8">
                                    <div class="checkbox checkbox-primary">
                                        <input id="match_live" type="checkbox" name="match_live" <?php echo ($row_match->match_live=='y')?'checked="checked"':'' ?> value="y">
                                        <label for="match_live">คู่นี้ถ่ายทอด</label>
                                    </div>
                               </div>
                           </div>       
                           <div class="form-group">
                                <label for="inputUsername" class="col-sm-3 control-label">คู่เล่นเกมส์:</label>
                                <div class="col-sm-8">
                                    <div class="checkbox checkbox-primary">
                                        <input id="match_special" type="checkbox" name="match_special" <?php echo ($row_match->match_special=='y')?'checked="checked"':'' ?>  value="y">
                                        <label for="match_special">คู่นี้สำหรับคะแนนพิเศษ</label>
                                    </div>
                               </div>
                           </div>  
                            <div class="form-group">
                                <div class="col-sm-4 col-md-3"></div>
                                <div class="col-sm-4 col-md-4">
                                <input  type="hidden" name="match_id" id="match_id" value="<?php echo $row_match->match_id ?>" />
                                <button type="submit" id="submit" name="button" class="btn btn-default"><i class=" fa fa-refresh "></i> Submit Changes</button>
                                </div>
                            </div>
                          </form>
                        </div><!-- End <div class="modal-content" id="modal-content"> -->
                      </div><!-- End <div role="tabpanel" class="tab-pane" id="profile"> -->
                      <div role="tabpanel" class="tab-pane" id="score">
                        <form class="form-horizontal" method="POST" role="form" action="<?php echo site_url('ad-manage/match-score-operate') ?>">
                          <div class="form-group">
                            <label for="" class="col-sm-2 col-md-2 control-label">เจ้าบ้าน:</label>
                            <div class="col-sm-6 col-md-6">
                              <p class="form-control-static"><?php echo $row_match->club_home_name ?></p>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="" class="col-sm-2 col-md-2 control-label"></label>
                            <div class="col-sm-6 col-md-6">
                              <input type="number" class="form-control" placeholder="ประตูเจ้าบ้าน" name="club_home_score" id="club_home_score" required maxlength="1" value="<?php echo $row_match->club_home_score ?>">
                            </div>                   
                          </div>
                          <div class="form-group">
                            <label for="" class="col-sm-2 col-md-2 control-label">ทีมเยือน:</label>
                            <div class="col-sm-6 col-md-6">
                              <p class="form-control-static"><?php echo $row_match->club_away_name ?></p>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="" class="col-sm-2 col-md-2 control-label"></label>
                            <div class="col-sm-6 col-md-6">
                              <input type="number" class="form-control" placeholder="ประตูทีมเยือน" name="club_away_score" id="club_away_score" required maxlength="1" value="<?php echo $row_match->club_away_score ?>">
                            </div>                   
                          </div>   
                          <div class="form-group">
                          	<label for="" class="col-sm-2 col-md-2 control-label"></label>
                            <div class="col-sm-6 col-md-6">
                              <input name="match_id" value="<?php echo $row_match->match_id ?>" type="hidden">
                              <button type="submit" id="submit" name="button" class="btn btn-success" onclick="return confirm ('ยืนยันผล ?')">บันทึก</button>
                            </div>
                          </div>  
                          <input name="match_id" value="<?php echo $row_match->match_id ?>" type="hidden">      
                        </form>
                      </div><!-- End  <div role="tabpanel" class="tab-pane" id="delete"> -->
                      <div role="tabpanel" class="tab-pane" id="delete">
                        <form id="form-delete" class="form-horizontal" method="POST" role="form" action="<?php echo site_url('ad-manage/match-delete') ?>">
                          <div class="form-group">
                            <div class="m-t-10 m-l-15">
                              <input name="match_id" value="<?php echo $row_match->match_id ?>" type="hidden">
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
				var opt = '<option value="">ลีก/รายการในประเทศ</option>';
				for(var i =0; i<response.length; i++){
					opt += '<option value="'+response[i].league_id+'">'+response[i].league_name+'</option>';
				}
				$('#league_id').html( opt );	
		});
		$('#national_home_id').val($(this).val());
		$('#national_away_id').val($(this).val());
	}); 	
	$('#league_id').change(function(){
		change_select('<?php echo site_url('ad-manage/club_by_league_id') ?>', $(this).val(), function(response){
				//alert(response);
				var opt = '<option value="">ทีม</option>';
				for(var i =0; i<response.length; i++){
					opt += '<option value="'+response[i].club_id+'" rel="'+response[i].club_image+'">'+response[i].club_name+'</option>';
				}
				$('#club_home_id').html( opt );	
				$('#club_away_id').html( opt );	
		});
		$('#league_home_id').val($(this).val());
		$('#league_away_id').val($(this).val());
	}); 	
	$('#national_home_id').change(function(){
		change_select('<?php echo site_url('ad-manage/league_by_national_id') ?>', $(this).val(), function(response){
				//alert(response);
				var opt = '<option value="">ลีก/รายการในประเทศ</option>';
				for(var i =0; i<response.length; i++){
					opt += '<option value="'+response[i].league_id+'">'+response[i].league_name+'</option>';
				}
				$('#league_home_id').html( opt );	
		});
	}); 	
	$('#national_away_id').change(function(){
		change_select('<?php echo site_url('ad-manage/league_by_national_id') ?>', $(this).val(), function(response){
				//alert(response);
				var opt = '<option value="">ลีก/รายการในประเทศ</option>';
				for(var i =0; i<response.length; i++){
					opt += '<option value="'+response[i].league_id+'">'+response[i].league_name+'</option>';
				}
				$('#league_away_id').html( opt );	
		});
	}); 
	$('#league_home_id').change(function(){
		change_select('<?php echo site_url('ad-manage/club_by_league_id') ?>', $(this).val(), function(response){
				//alert(response);
				var opt = '<option value="">ทีม</option>';
				for(var i =0; i<response.length; i++){
					opt += '<option value="'+response[i].club_id+'" rel="'+response[i].club_image+'">'+response[i].club_name+'</option>';
				}
				$('#club_home_id').html( opt );	
		});
	}); 	
	$('#league_away_id').change(function(){
		change_select('<?php echo site_url('ad-manage/club_by_league_id') ?>', $(this).val(), function(response){
				//alert(response);
				var opt = '<option value="">ทีม</option>';
				for(var i =0; i<response.length; i++){
					opt += '<option value="'+response[i].club_id+'" rel="'+response[i].club_image+'">'+response[i].club_name+'</option>';
				}
				$('#club_away_id').html( opt );	
		});
	}); 		
	$('#club_home_id').change(function(){
		var rel = $("option:selected", this).attr("rel");
		$('#club_home_image').attr("src", '<?php echo site_url('images/uploads') ?>/'+rel);
		$('#club_home_image').show();
	});	
	$('#club_away_id').change(function(){
		var rel = $("option:selected", this).attr("rel");
		$('#club_away_image').attr("src", '<?php echo site_url('images/uploads') ?>/'+rel);
		$('#club_away_image').show();
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