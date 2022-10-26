<div class="row" style="margin-top:15px">
  <div class="col">
    <h4>เล่นเกม เซียนบอล EPL</h4>
  </div>
</div>
<div class="row bg-grey" style="padding:10px">
	<?php if($this->session->userdata('logined')) { ?>
    <div class="col-12 text-center" style="margin-bottom:10px;">
    	สวัสดีครับคุณ <?php echo $this->session->userdata('nickname') ?> <img src="<?php echo base_url('images/shirt/'.$this->session->userdata('member_shirt')); ?>" height="35">
    </div>
    <?php } ?>
    <div class="col-12 text-center" style="margin-bottom:10px;">
        <button class="btn btn-sm bg-lightgreen" type="button" onclick="window.location='<?php echo site_url('zeanteng') ?>'">
            กลับไปเล่นเกม
        </button>
    </div>
    
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
  <?php 
  	$gw_previous = $row_gameweek->gw-1;
	$gw_next = $row_gameweek->gw+1;
  ?>  
  <div class="col-4 text-left">
    <?php if($gw_previous>0){ ?><a href="<?php echo site_url('zeanteng/week/'.$gw_previous) ?>"><button class="btn btn-default btn-sm fz-10">&laquo; ก่อนหน้า</button></a><?php } ?>
  </div>
  
  <div class="col-4 text-center mb-1 bg-gw">
    <h4 class="fz-12 fc-gw">เกมวีค <?php echo $row_gameweek->gw ?></h4>
  </div>
  <div class="col-4 text-right">
    <?php if($gw_next<=40){ ?><a href="<?php echo site_url('zeanteng/week/'.$gw_next) ?>"><button class="btn btn-default btn-sm fz-10">ถัดไป &raquo;</button></a><?php } ?>
  </div>
</div>
<div class="row">
	<div class="col-12 text-center"><h3 style="p">เปิดให้ทายผล..หลังคู่แข่งขันสุดท้ายของเกมวีคก่อนหน้านี้เตะจบ</h3></div>
</div>
<?php $matchdate = ''; foreach($rs_match->result() as $row) { ?>
<?php if($matchdate!=$row->matchdate){ ?>
<div class="row title-program fz-08">
	<div class="col-4 col-sm-2 text-center bg-purple fc-white pt-1 pb-1 fz-10"><?php echo conv_thaidate($row->matchdate) ?></div>
    <div class="col-8 col-sm-10 text-center bg-purple fc-white pt-1 pb-1"> ผล </div>
</div>
<?php } ?>
<div class="row list-program fz-08 <?php if($row->match_special=='y'){echo 'bg-lightpink bg-special-r';} ?> no-gutters" style="padding:10px; border-bottom: 1px solid rgba(0, 0, 0, 0.1);">
  <div class="col-2 text-center"><?php echo $row->matchtime ?></div>
  <div class="col-4 text-right"><?php echo $row->club_home_name ?> <img src="<?php echo base_url('images/uploads/S/'.$row->club_home_image) ?>"></div>
  <div class="col-2 text-center"><?php echo ($row->match_score_status=='n')?'? - ?':$row->club_home_score.' - '.$row->club_away_score ?></div>
  <div class="col-4 text-left"><img src="<?php echo base_url('images/uploads/S/'.$row->club_away_image) ?>"> <?php echo $row->club_away_name ?></div>
</div>
<?php $matchdate = $row->matchdate; } ?>

<?php if($this->session->userdata('logined')) { ?>
<div class="row">
	<div class="col-2 text-center mt-1"></div>
	<div class="col-10 text-center mt-1">
  	<button type="button" class="btn btn-sm bg-lightgreen fz-10" id="predictbutton" data-mtt="<?php echo $rs_match->num_rows(); ?>" data-toggle="modal" data-target="#predict" style="display:none;">ส่งผล</button>
    <input type="hidden" name="gw_id" value="<?php echo $row_gameweek->gw_id ?>">
    <input type="hidden" name="method" value="confirm">
  </div>
</div>
<?php } ?>