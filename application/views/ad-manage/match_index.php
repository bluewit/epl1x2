<style>
.bg-lessthan {
    background-color: #f26522 !important;
	color:#FFF !important;
}
</style>

<div class="">
  <div class="page-header-title">
    <h4 class="page-title">คู่แข่งขัน</h4>
  </div>
</div>

<div class="page-content-wrapper ">

    <div class="container">
    	<div class="row">                                     
            <div class="col-sm-12 col-md-12">
                <div class="panel">
                    <div class="panel-body">
                        <button class="btn btn-primary waves-effect waves-light" href="#Create" type="button" data-toggle="modal">สร้างคู่แข่งขัน</button>
                    </div>
                </div>
            </div>                                     
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-primary">
                    <div class="panel-body table-responsive">
                        <h4 class="m-t-0">รายการ คู่แข่งขัน</h4>
						<table class="table table-striped table-bordered table-hover" id="datatables" width="100%">
                          <thead>
                            <tr role="row">
                              <th width="5%"></th>	
                              <th width="10%">ลีก</th>
                              <th width="15%">เจ้าบ้าน</th>
                              <th width="15%">ทีมเยือน</th>
                              <th width="15%">วันที่เตะ</th>
                              <th width="8%">เกมส์วีค</th>
                              <th width="8%">พิเศษ</th>
                              <th width="8%">ผล</th>
                              <th class="text-center" width="5%"></th>
                            </tr>
                          </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

    </div><!-- container -->
</div> <!-- Page content Wrapper -->

<!-- END Row -->

<!-- Modals -->
<div class="modal fade" id="Create" tabindex="-1" role="dialog" aria-labelledby="Create" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="modal-content">
      <form class="form-horizontal" id="form-create" action="<?php echo site_url('ad-manage/match-add-operate') ?>" method="POST" role="form" enctype="multipart/form-data">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">สร้าง คู่แข่งขัน</h4>
        </div>
        <div class="modal-body">
          <div class="form-group  ">
            <label for="inputAame" class="col-sm-3 control-label">เกมส์วีค:</label>
            <div class="col-sm-8">
                <select class="form-control" name="gw_id" id="gw_id" required>
                <option value="" selected="selected">=เลือก=</option>
                <?php foreach($rs_gameweek->result() as $row){ ?>
                <option value="<?php echo $row->gw_id ?>"><?php echo $row->gw ?></option>
                <?php } ?>
                </select>
            </div>           
          </div>
          <div class="form-group  ">
            <label for="inputAame" class="col-sm-3 control-label">ประเทศ:</label>
            <div class="col-sm-8">
                <select class="form-control" name="national_id" id="national_id" required>
                <option value="" selected="selected">=เลือก=</option>
                <?php foreach($rs_national->result() as $row){ ?>
                <option value="<?php echo $row->national_id ?>"><?php echo $row->national_name ?></option>
                <?php } ?>
                </select>
            </div>           
          </div>
          <div class="form-group  ">
            <label for="inputAame" class="col-sm-3 control-label">ลีก/รายการ:</label>
            <div class="col-sm-8">
                <select class="form-control" name="league_id" id="league_id" required>
                <option value="" selected="selected">=เลือก=</option>
                <?php foreach($rs_league->result() as $row){ ?>
                <option value="<?php echo $row->league_id ?>"><?php echo $row->league_name ?></option>
                <?php } ?>
                </select>
            </div>           
          </div>
          <div class="form-group  ">
            <label for="inputAame" class="col-sm-3 control-label">เจ้าบ้าน:</label>
            <div class="col-sm-8">
            <select id="national_home_id" name="national_home_id" class="form-control" required style="display:none;">
            <option value="">เลือกประเทศ</option>
            <?php foreach($rs_national->result() as $row_national){ ?>
            	<option value="<?php echo $row_national->national_id ?>"><?php echo $row_national->national_name ?></option>
            <?php } ?>
            </select>
            <select id="league_home_id" name="league_home_id" class="form-control" required style="display:none;">
            <option value="">ลีก/รายการในประเทศ</option>
            <?php foreach($rs_league->result() as $row_league){ ?>
            	<option value="<?php echo $row_league->league_id ?>"><?php echo $row_league->league_name ?></option>
            <?php } ?>
            </select>
            <select id="club_home_id" name="club_home_id" class="form-control" required>
            	<option value="">ทีม</option>
            </select>
            <img id="club_home_image" style="display:none;" width="60" height="auto"  />
            </div>           
          </div>
          <div class="form-group">
            <label for="inputUsername" class="col-sm-3 control-label">ทีมเยือน:</label>
            <div class="col-sm-8">
            <select id="national_away_id" name="national_away_id" class="form-control" required style="display:none;">
            <option value="">เลือกประเทศ</option>
            <?php foreach($rs_national->result() as $row_national){ ?>
            <option value="<?php echo $row_national->national_id ?>"><?php echo $row_national->national_name ?></option>
            <?php } ?>
            </select>
            <select id="league_away_id" name="league_away_id" class="form-control" required style="display:none;">
            <option value="">ลีก/รายการในประเทศ</option>
            <?php foreach($rs_league->result() as $row_league){ ?>
            <option value="<?php echo $row_league->league_id ?>"><?php echo $row_league->league_name ?></option>
            <?php } ?>
            </select>
            <select id="club_away_id" name="club_away_id" class="form-control" required>
            <option value="">ทีม</option>
            </select>
            <img id="club_away_image" style="display:none;"  width="60" height="auto"  />
            </div>
          </div>
            <div class="form-group">
                <label for="inputUsername" class="col-sm-3 control-label">วันเตะ:</label>
                <div class="col-sm-8">
                   <input type="text" class="form-control datetimepicker" placeholder="วันเตะ" name="match_date" id="match_date" required>
                </div>            
            </div>
            <div class="form-group">
                <label for="inputUsername" class="col-sm-3 control-label">ราคาต่อรอง:</label>
                <div class="col-sm-8">
                   <select id="match_rate" name="match_rate" class="form-control" required>
                        <option value="">ราคา</option>
                        <option value="0" selected>ส</option>
                        <option value="0.25">ป</option>
                        <option value="0.5">0.5</option>
                        <option value="0.75">0.5/1</option>
                        <option value="1">1</option>
                        <option value="1.25">1/1.5</option>
                        <option value="1.5">1.5</option>
                        <option value="1.75">1.5/2</option>
                        <option value="2">2</option>
                        <option value="2.25">2/2.5</option>
                        <option value="2.5">2.5</option>
                        <option value="2.75">2.5+3</option>            
                        <option value="3">3</option>
                        <option value="3.25">3/3.5</option>
                        <option value="3.5">3.5</option>
                        <option value="3.75">3.5+4</option>            
                        <option value="4">4</option>
                        <option value="4.25">4/4.5</option>
                        <option value="4.5">4.5</option>
                        <option value="4.75">4.5+5</option>
                        <option value="5">5</option>
                        <option value="5.25">5/5.5</option>
                        <option value="5.5">5.5</option>
                        <option value="5.75">5.5+6</option>
                        <option value="6">6</option>
                    </select>
                </div>            
            </div>
            <div class="form-group">
                <label for="inputUsername" class="col-sm-3 control-label">ทีมต่อ:</label>
                <div class="col-sm-8">
                   <select id="team_handicap" name="team_handicap" class="form-control" required>
                        <option value="">ทีม</option>
                        <option value="h" selected>เจ้าบ้าน</option>
                        <option value="a">ทีมเยือน</option>
                        <!--<option value="e">เสมอ</option>-->
                    </select>
                </div>            
            </div>
            <div class="form-group">
                <label for="inputUsername" class="col-sm-3 control-label">คู่ถ่ายทอด:</label>
                <div class="col-sm-8">
                    <div class="checkbox checkbox-primary">
                        <input id="match_live" type="checkbox" name="match_live" value="y">
                        <label for="match_live">คู่นี้ถ่ายทอด</label>
                    </div>
               </div>
           </div>
           <div class="form-group">
                <label for="inputUsername" class="col-sm-3 control-label">คู่เล่นเกมส์:</label>
                <div class="col-sm-8">
                    <div class="checkbox checkbox-primary">
                        <input id="match_special" type="checkbox" name="match_special" value="y">
                        <label for="match_special">คู่นี้สำหรับคะแนนพิเศษ</label>
                    </div>
               </div>
           </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
          <button type="submit" class="btn btn-primary" id="submit" >สร้าง</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- END Modals -->
<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
	$('#form-create').parsley();
	var t = $('#datatables').DataTable({
		"bPaginate": true, 
		//"bLengthChange": false, //+ แสดงจำนวนต่อหน้า
		//"bFilter": false, //+ ช่องค้นหา
		//"bInfo": false, //+ รายละเอียดจำนวนแถว
		"bProcessing": true,
		"bServerSide": true,
		"sServerMethod": "GET",
		"sAjaxSource": '<?php echo base_url('ad-manage/match-all'); ?>',
		"iDisplayLength": 50,
		"columnDefs": [  //+ เงื่อนไขสำหรับปิดคอลัมภ์ที่ไม่ต้องการให้ค้นหา หรือ Sort
			{"searchable": true, "orderable": false, 'className':'text-center', "targets":0},
			{
				"searchable": false, 
				"orderable": false, 
				'className':'text-center',
				"targets":8,
				"render": function(data, type, row) { // Available data available for you within the row
					var x = '<div class="btn-group btn-group-xs" align="center"><a href="<?php echo site_url('ad-manage/match-view') ?>/'+data+'" class="btn btn-default btn-xs waves-effect" target="_blank">ดูข้อมูล</a></div>';
					return x;
				}
			}
		],
		"order": [4, 'desc'], //+ คอลัมภ์ที่ต้องการให้เรียงลำดับ
		"createdRow": function ( row, data, index ) {		
			var bg;
			var CurrentDate = new Date();
			var SelectedDate = new Date(data[4]);
			if(CurrentDate > SelectedDate){
				bg = "bg-lessthan";
				$(row).addClass(bg);
			}
			
        }
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