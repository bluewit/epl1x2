<div class="row" style="margin-top:15px">
  <div class="col">
    <h4>เล่นเกมส์ เซียนบอล EPL</h4>
  </div>
</div>
<div class="row bg-grey" style="padding:10px">
	<?php if($this->session->userdata('logined')) { ?>
    <div class="col-12 text-center" style="margin-bottom:10px;">
    	<!--<img src="<?php //echo $this->session->userdata('member_img') ?>" height="30">--> สวัสดีครับคุณ <?php echo $this->session->userdata('nickname') ?>
    </div>
    <div class="col-12 text-center" style="margin-bottom:10px;">
        <button class="btn btn-sm bg-lightgreen" type="button" data-toggle="modal" data-target="#list-month-teng" data-id="<?php echo $this->session->userdata('member_id') ?>">
            <i class="glyphicon glyphicon-user"></i> คะแนน ( <?php echo floatval($row_score->score) ?> )
        </button>
        <button class="btn btn-sm bg-pink fc-white " type="button" data-toggle="modal" data-target="#rule">
            <i class="glyphicon glyphicon-log-out"></i> กฎกติกา
        </button>
        <button class="btn btn-sm bg-lightpurple fc-white" type="button" onclick="window.location='<?php echo site_url('logout') ?>'">
            <i class="glyphicon glyphicon-log-out"></i> ออกจากระบบ
        </button>
    </div>
    <?php }else{ ?>
    <div class="col-12 text-center text-white" style="margin-bottom:10px;">
    	เข้าสู่ระบบเพื่อเล่นเกม
  &nbsp; <a href=<?php echo $loginFacebook ?> title="Login with facebook"> <img src="<?php echo base_url('images/fb-login.png')?>" alt="login facebook" height="45"> </a>
    </div>
    <?php } ?>
    
    <?php if($this->session->userdata('member_teng')){ ?>
    <div class="col-12 text-center bg-yellow">
    <h4 class="mt-3">ที่คุณเลือก</h4>
    <ul>
	<?php foreach($this->session->userdata('member_teng') as $key=>$val){ ?>
        <li style="margin-bottom:5px;"><?php print_r($val['team']); ?></li>
    <?php } ?>
    </ul>
    </div>
    <?php } ?>
</div>

<div class="row" style="margin-top:15px">
  <div class="col-4 text-left">
    <a href="#"><button class="btn btn-default btn-sm fz-10">&laquo; วีค ก่อนหน้า</button></a>
  </div>
  <div class="col-4 text-center">
    <h4><a href="">โปรแกรม เล่นเกมส์ </a></h4>
  </div>
  <div class="col-4 text-right">
    <a href="#"><button class="btn btn-default btn-sm fz-10">วีค ถัดไป &raquo;</button></a>
  </div>
</div>
<form class="form-horizontal" id="form-predict" action="#" method="POST" role="form">
<!--<div class="row bg-purple fc-white" style="padding:10px">
  <div class="col-1 text-center"></div>
  <div class="col-4 text-center">เจ้าบ้าน</div>
  <div class="col-1 text-center"></div>
  <div class="col-4 text-center">ทีมเยือน</div>
  <div class="col-2 text-center">สถานะ</div>
</div>-->
<?php $matchdate = ''; foreach($rs_match->result() as $row) { ?>
<?php if($matchdate!=$row->matchdate){ ?>
<div class="row">
	<div class="col-12 text-center bg-purple fc-white pt-1 pb-1"><?php echo $row->matchdate ?></div>
</div>
<?php } ?>
<div class="row list-program fz-05 <?php if($row->match_special=='y'){echo 'bg-lightpink';} ?>" style="padding:10px">
  <div class="col-2 col-sm-1 text-center"><?php echo $row->matchtime ?></div>
  <div class="col-4 col-sm-3 text-right"><?php echo $row->club_home_name ?> <img src="<?php echo base_url('images/uploads/S/'.$row->club_home_image) ?>"></div>
  <div class="col-2 col-sm-1 text-center">vs</div>
  <div class="col-4 col-sm-3 text-left"><img src="<?php echo base_url('images/uploads/S/'.$row->club_away_image) ?>"> <?php echo $row->club_away_name ?></div>
  <div class="col-12 d-block d-sm-none">&nbsp;</div>
  <div class="col-2 d-block d-sm-none">&nbsp;</div>
  <div class="col-10 col-sm-4 text-center">
  	<?php if($this->session->userdata('logined')) { ?>
    	<?php if(array_key_exists($row->match_id,$member_predict)){ ?>
            <button class="btn btn-sm btn-warning fz-05" disabled="true">คุณเลือก | <?php echo conv_predict($member_predict[$row->match_id]); ?></button>            
        <?php }elseif(time()>strtotime($row_gameweek->gw_datetime)){ ?>
        	<button class="btn btn-sm btn-danger fz-05" disabled="true">หมดเวลาร่วมเล่นเกมส์</button>
        <?php }else{ ?>
        	<div class="form-check form-check-inline">
              <input class="form-check-input predicth" type="radio" name="predict[<?php echo $row->match_id ?>]" id="predictredio<?php echo $row->match_id ?>" value="h" data-match="<?php echo $row->club_home_name ?> vs <?php echo $row->club_away_name ?>">
              <label class="form-check-label">เจ้าบ้าน</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input predictal" type="radio" name="predict[<?php echo $row->match_id ?>]" id="predictredio<?php echo $row->match_id ?>" value="al" data-match="<?php echo $row->club_home_name ?> vs <?php echo $row->club_away_name ?>">
              <label class="form-check-label">เสมอ</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input predicta" type="radio" name="predict[<?php echo $row->match_id ?>]" id="predictredio<?php echo $row->match_id ?>" value="a" data-match="<?php echo $row->club_home_name ?> vs <?php echo $row->club_away_name ?>">
              <label class="form-check-label">ทีมเยือน</label>
            </div>
        <?php } ?>
    <?php }else{ ?>
    	<a class="btn btn-sm btn-primary fz-05" href=<?php echo $loginFacebook ?>>เข้าสู่ระบบ</a>
    <?php } ?>
  </div>  
</div>
<?php $matchdate = $row->matchdate; } ?>

<?php if($this->session->userdata('logined')) { ?>
<div class="row">
	<div class="col-12 text-center">
  	<button type="button" class="btn btn-sm bg-lightgreen fz-10" id="predictbutton" data-mtt="<?php echo $rs_match->num_rows(); ?>" data-toggle="modal" data-target="#predict" style="display:none;">ส่งผล</button>
    <input type="hidden" name="gw_id" value="<?php echo $row_gameweek->gw_id ?>">
    <input type="hidden" name="method" value="confirm">
  </div>
</div>
<?php } ?>
</form>
<!-- Modal -->
<div class="modal fade" id="predict" tabindex="-1" role="dialog" aria-labelledby="predict" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="price">คู่ทายผล</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body text-center">
    	<!--ลีเกีย วอร์ซอว์ vs คอร์ก ซิตี้ | คุณเลือก > เสมอ-->    
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">เลือกใหม่</button>
      <button type="button" class="btn btn-success" id="predictconfirmbutton">ตรวจสอบแล้ว</button>
    </div>
  </div>
</div>
</div>
<!-- end Modal -->

<!-- Modal -->
<div class="modal fade" id="list-month-teng" tabindex="-1" role="dialog" aria-labelledby="list-month-teng" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="price">รายการที่เล่น</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body" style="font-size:80%;">
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
    </div>
  </div>
</div>
</div>
<!-- end Modal -->

<!-- Modal -->
<div class="modal fade" id="rule" tabindex="-1" role="dialog" aria-labelledby="rule" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="price">กฎกติกา</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
    <ol>
    	<li>test</li>
        <li>test</li>
        <li>test</li>
    </ol>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
</div>
<!-- end Modal -->

<script>
$(function(){
	<?php if($this->session->userdata('logined')) { ?>
	$('input:radio').change(function(e) {
		var h = $('.predicth:checked').length;
		var a = $('.predicta:checked').length;
		var al = $('.predictal:checked').length;
		var mtt = $('#predictbutton').attr('data-mtt');
		var checkall = h+a+al;
		if(checkall==mtt){
			$('#predictbutton').show('slow');
		}else{
			$('#predictbutton').hide();
		}
    });
	
	$('#predict').on('show.bs.modal', function (e){
		$('#predict').find('.modal-body').html('');	
		$("input:radio").each(function(){
		 var id = $(this).attr("id");
		 if($(this).prop('checked')){
			var predict = $(this).val();
			var predicttxt = '';
			if(predict=='h'){
				predicttxt = 'เจ้าบ้าน';
			}else if(predict=='a'){
				predicttxt = 'ทีมเยือน';
			}else{
				predicttxt = 'เสมอ';
			}
			$('#predict').find('.modal-body').append('<div>'+$(this).attr('data-match')+' | คุณเลือก > '+predicttxt+' </div>');
		 }
		});
	});
		
	$('#list-month-teng').on('show.bs.modal', function (e) {
		$(this).find('.modal-body').html('<center><img src="<?php echo base_url('images/ajax-loader.gif') ?>"></center>').delay(1000).load('<?php echo site_url('zeanteng/list-teng-month')?>/'+$(e.relatedTarget).attr('data-id'));
	});
	
	$('#predictconfirmbutton').click(function(e){
		e.preventDefault();
		e.stopImmediatePropagation();
		var $form = $('#form-predict');
		swal({
		  title: "ยืนยันเลือก ส่งผล ?",
		  type: "warning",
		  showCancelButton: true,
		  cancelButtonText: "ยกเลิก",
		  confirmButtonText: "ยืนยัน",
		  closeOnConfirm: false
		},function(){			
			$.LoadingOverlay("show");
			$.ajax({
				type: 'POST',
				dataType: 'json',
				cache: false,
				url: '<?php echo site_url('zeanteng/confirm') ?>',
				data: $form.serialize(),
				success: function(resp){
					$.LoadingOverlay("hide");
					$('#predict').modal('hide');
					if(resp.error==1){
						swal({title:resp.text,confirmButtonText: 'OK', type: "warning"},function(){window.location.reload();});
					}else{
						swal({title:resp.text,confirmButtonText: 'OK', type: "success"},function(){window.location.reload();});
					}					
				}
			});
		
		});
	});
	<?php } ?>
});
</script>