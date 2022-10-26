<?php if($rs_teng->num_rows()>10){ ?>
<div id="accordion-gw">
	<?php for($i=$rs_teng->result()[0]->gw_id;$i>=1;$i--){ ?>    
    <?php
		$scoreofweek = 0;
		for($x=0;$x<$rs_teng->num_rows();$x++){
			if($rs_teng->result()[$x]->gw_id==$i){
				$scoreofweek += $rs_teng->result()[$x]->teng_score;
			}
		}
	?>
	<div class="card">
    <div class="card-header" id="headingw<?php echo $i ?>" style="padding: 0.25rem 1.25rem;">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsew<?php echo $i ?>" aria-expanded="false" aria-controls="collapsew<?php echo $i ?>"> วีค <?php echo $i;?> <span class="fc-purple">[ <?php echo $scoreofweek ?> คะแนน ]</span></button>
      </h5>
    </div>
    <div id="collapsew<?php echo $i ?>" class="collapse" aria-labelledby="headingw<?php echo $i ?>" data-parent="#accordion-gw">
      <div class="card-body" style="padding:0px;">
            
      	<div class="row bg-purple fc-white" style="padding:10px;">
          <div class="col-1 d-none d-sm-block text-center p-1">เวลา</div>
          <div class="col-3 text-center p-1">เจ้าบ้าน</div>
          <div class="col-1 text-center p-1"></div>
          <div class="col-3 text-center p-1">ทีมเยือน</div>
          <div class="col-2 text-center p-1">เลือก</div>
          <div class="col-1 text-center p-1">ผล</div>
          <div class="col-1 text-center p-1"></div>
        </div>
        <?php $matchdate = ''; ?>
        <?php foreach($rs_teng->result() as $row) { ?>
        <?php if($row->gw_id==$i){ ?>
        <?php if($matchdate!=$row->matchdate){ ?>
        <div class="row" style="padding:10px; background-color: #b8e5fe;">
        <?php echo conv_thaidate($row->matchdate) ?>
        </div>
        <?php } ?>
        <div class="row <?php if($row->match_special=='y'){echo 'bg-lightpink bg-special-l';} ?>" style="padding:10px">
          <div class="col-1 d-none d-sm-block text-center p-1"><?php echo $row->matchtime ?></div>
          <div class="col-3 text-center p-1"><?php echo $row->club_home_name ?></div>
          <div class="col-1 text-center p-1">vs</div>
          <div class="col-3 text-center p-1"><?php echo $row->club_away_name ?></div>
          <div class="col-2 text-center p-1"><span class="badge badge-primary">
          <?php //echo ($row->teng_predict=='h')?$row->club_home_name:$row->club_away_name ?>
          <?php if($row->teng_predict=='h'){ echo 'เจ้าบ้าน';}elseif($row->teng_predict=='a'){echo 'ทีมเยือน';}else{echo 'เสมอ';} ?>
          </span></div>  
          <div class="col-2 col-sm-1 text-center p-1"><?php echo ($row->match_score_status=='n')?'? - ?':$row->club_home_score.' - '.$row->club_away_score ?></div>
          <div class="col-1 text-center p-1"><div class="<?php echo ($row->match_score_status=='n')?'?':score_color($row->teng_score) ?>"><?php echo ($row->match_score_status=='n')?'?':floatval($row->teng_score) ?></div></div>
        </div>
        <?php $matchdate = $row->matchdate; ?>
        <?php } // End foreach($rs_teng->result() as $row) {?>
        <?php } ?>
        
      </div><!-- End <div class="card-body" style="padding:0px;"> -->
    </div>
  </div>
  <?php } ?>
  <!--<div class="card">
    <div class="card-header" id="headingw2" style="padding: 0.25rem 1.25rem;">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsew2" aria-expanded="false" aria-controls="collapsew2"> วีค 2 </button>
      </h5>
    </div>
    <div id="collapsew2" class="collapse" aria-labelledby="headingw2" data-parent="#accordion-gw">
      <div class="card-body">
        <ul>
          <li>2</li>
        </ul>
      </div>
    </div>
  </div>-->
  <!--<div class="card">
    <div class="card-header" id="headingw3" style="padding: 0.25rem 1.25rem;">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsew3" aria-expanded="false" aria-controls="collapsew3"> วีค 3</button>
      </h5>
    </div>
    <div id="collapsew3" class="collapse" aria-labelledby="headingw3" data-parent="#accordion-gw">
      <div class="card-body">
        <ul>
          <li>3</li>
        </ul>
      </div>
    </div>
  </div>-->  
</div>
<?php }else{ ?>
<div class="row bg-purple fc-white" style="padding:10px;">
  <div class="col-1 d-none d-sm-block text-center">เวลา</div>
  <div class="col-3 text-center p-1">เจ้าบ้าน</div>
  <div class="col-1 text-center p-1"></div>
  <div class="col-3 text-center p-1">ทีมเยือน</div>
  <div class="col-2 text-center p-1">เลือก</div>
  <div class="col-1 text-center p-1">ผล</div>
  <div class="col-1 text-center p-1"></div>
</div>
<?php $matchdate = ''; foreach($rs_teng->result() as $row) { ?>
<?php if($matchdate!=$row->matchdate){ ?>
<div class="row" style="padding:10px; background-color: #b8e5fe;">
<?php echo conv_thaidate($row->matchdate) ?>
</div>
<?php } ?>
<div class="row <?php if($row->match_special=='y'){echo 'bg-lightpink bg-special-l';} ?>" style="padding:10px">
  <div class="col-1 d-none d-sm-block text-center"><?php echo $row->matchtime ?></div>
  <div class="col-3 text-center p-1"><?php echo $row->club_home_name ?></div>
  <div class="col-1 text-center p-1">vs</div>
  <div class="col-3 text-center p-1"><?php echo $row->club_away_name ?></div>
  <div class="col-2 text-center p-1"><span class="badge badge-primary">
  <?php //echo ($row->teng_predict=='h')?$row->club_home_name:$row->club_away_name ?>
  <?php if($row->teng_predict=='h'){ echo 'เจ้าบ้าน';}elseif($row->teng_predict=='a'){echo 'ทีมเยือน';}else{echo 'เสมอ';} ?>
  </span></div>  
  <div class="col-2 col-sm-1 text-center p-1"><?php echo ($row->match_score_status=='n')?'? - ?':$row->club_home_score.' - '.$row->club_away_score ?></div>
  <div class="col-1 text-center p-1"><div class="<?php echo ($row->match_score_status=='n')?'?':score_color($row->teng_score) ?>"><?php echo ($row->match_score_status=='n')?'?':floatval($row->teng_score) ?></div></div>
</div>
<?php $matchdate = $row->matchdate; } ?>
<?php } // end if($rs_teng->num_rows()>10){?>