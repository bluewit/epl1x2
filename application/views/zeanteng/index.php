<div class="row" style="margin-top:15px">
  <div class="col">
    <h4>เล่นเกม EPL1X2</h4>
  </div>
</div>
<div class="row bg-grey" style="padding:10px">
	<?php if($this->session->userdata('logined')) { ?>
    <div class="col-12 text-center" style="margin-bottom:10px;">
    	สวัสดีครับคุณ <?php echo $this->session->userdata('nickname') ?>&nbsp;
        <?php if($this->session->userdata('member_shirt')==''){ ?>
        <a href="#" data-toggle="modal" data-target="#cheer-team" class="text-danger">[คุณเป็นแฟนทีม?]</a>
        <?php }else{ ?>
        <img src="<?php echo base_url('images/shirt/'.$this->session->userdata('member_shirt')); ?>" height="35">
        <?php } ?>
    </div>
    <div class="col-12 text-center" style="margin-bottom:10px;">
        <button class="btn btn-sm bg-lightgreen" type="button" data-toggle="modal" data-target="#list-month-teng" data-id="<?php echo $this->session->userdata('member_id') ?>" data-name="<?php echo $this->session->userdata('nickname') ?>">
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
    <div class="col-12 text-center" style="margin-bottom:10px;">
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
<div class="row" style="margin-top:10px;">
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
	<div class="col-12 text-center"><h3 style="p">หมดเวลาเล่นเกมวีคนี้ <?php echo conv_thaidate(date('Y-m-d',strtotime($row_gameweek->gw_datetime))) ?> <?php echo date('H:i',strtotime($row_gameweek->gw_datetime)) ?></h3></div>
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
<div class="row title-program fz-08">
	<div class="col-4 col-sm-2 text-center bg-purple fc-white pt-1 pb-1 fz-10"><?php echo conv_thaidate($row->matchdate) ?></div>
    <div class="col-8 col-sm-10 text-center bg-purple fc-white pt-1 pb-1"> 1 X 2 </div>
</div>
<?php } ?>
<div class="row list-program fz-08 <?php if($row->match_special=='y'){echo 'bg-lightpink bg-special-r';} ?> no-gutters" style="padding:10px; border-bottom: 1px solid rgba(0, 0, 0, 0.1);">
  <div class="col-2 col-sm-2 text-center"><?php echo $row->matchtime ?></div>
  <div class="col-4 col-sm-3 text-right  d-none d-sm-block"><?php echo $row->club_home_name ?> <img src="<?php echo base_url('images/uploads/S/'.$row->club_home_image) ?>"></div>
  <div class="col-4 col-sm-3 text-right d-block d-sm-none fz-07"><?php echo $row->club_home_name ?> <img src="<?php echo base_url('images/uploads/S/'.$row->club_home_image) ?>"></div>
  <div class="col-2 text-center d-block d-sm-none pt-2"> VS </div>
  <div class="col-4 col-sm-3 text-left d-block d-sm-none fz-07"><img src="<?php echo base_url('images/uploads/S/'.$row->club_away_image) ?>"> <?php echo $row->club_away_name ?></div>
  
  <div class="col-12 d-block d-sm-none">&nbsp;</div>
  <div class="col-2 d-block d-sm-none">&nbsp;</div>
  <div class="col-10 col-sm-4 text-center">
  	<?php echo ($row->match_score_status=='n')?'':$row->club_home_score.' - '.$row->club_away_score.'<br>' ?>
  	<?php if($this->session->userdata('logined')) { ?>
    	<?php if(array_key_exists($row->match_id,$member_predict)){ ?>
            <button class="btn btn-sm btn-warning fz-08" disabled="true">คุณเลือก | <?php echo conv_predict($member_predict[$row->match_id]); ?></button>            
        <?php }elseif(time()>strtotime($row_gameweek->gw_datetime)){ ?>
        	<button class="btn btn-sm btn-danger fz-08" disabled="true">หมดเวลาร่วมเล่นเกม</button>
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
  <div class="col-4 col-sm-3 text-left d-none d-sm-block"><img src="<?php echo base_url('images/uploads/S/'.$row->club_away_image) ?>"> <?php echo $row->club_away_name ?></div>
</div>
<?php $matchdate = $row->matchdate; } ?>

<?php if($this->session->userdata('logined')) { ?>
<div class="row">
	<div class="col-2 text-center mt-1"></div>
	<div class="col-10 text-center mt-1">
  	<button type="button" class="btn btn-sm bg-lightgreen fz-10" id="predictbutton" data-mtt="<?php echo $rs_match->num_rows(); ?>" data-toggle="modal" data-target="#predict" style="display:none;">ส่งผล</button>
    <input type="hidden" name="gw_id" value="<?php echo $row_gameweek->gw_id ?>">
    <input type="hidden" name="method" value="confirm">
    <input type="hidden" name="club_cheer" id="club_cheer" value="">
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
    <div class="modal-body text-center fz-08">
    	<!--ลีเกีย วอร์ซอว์ vs คอร์ก ซิตี้ | คุณเลือก > เสมอ-->    
    </div>
    <div class="modal-footer">
    	<?php if($this->session->userdata('logined')){ ?>
		<?php if($this->session->userdata('member_shirt')==''){ ?>
        <select class="form-control" name="club_id" id="club_id_cheer" required style="color:red !important; font-size:14px;">
        	<option value='' selected style="color:gray !important;">คุณเป็นแฟนทีม?</option>
			<?php foreach($rs_clubshirt->result() as $row){ ?>
            <option value="<?php echo $row->club_id ?>" style="color:gray !important;"><?php echo 'ทีม '.$row->club_name ?></option>
            <?php } ?>
        </select>
        <?php } ?>
        <?php } ?>
      <button type="button" class="btn btn-secondary" data-dismiss="modal">เลือกใหม่</button>
      <button type="button" class="btn btn-success" id="predictconfirmbutton" <?php if($this->session->userdata('member_shirt')==''){ ?>disabled<?php } ?>>ตรวจสอบแล้ว</button>
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
      <h5 class="modal-title" id="namezean"></h5>
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
    <div id="accordion">
      <div class="card">
        <div class="card-header" id="headingOne">
          <h5 class="mb-0">
            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne"> การลงทะเบียน ล็อกอิน </button>
          </h5>
        </div>
        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
          <div class="card-body">
          	<ul>
            	<li>ลงทะเบียนด้วยเฟสบุ๊คของคุณ โดยกดลิงก์เว็บ -> <a href="https://www.facebook.com/groups/1473068232851201" target="_blank">epl1x2.com</a> หากกดลิงก์ผ่านเฟสบุ๊คจะมีปุ่ม "เข้าสู่ระบบเพื่อเล่นเกม" สามารถกดปุ่มดังกล่าวเพื่อล็อกอินเล่นเกมได้ทันทีแบบไม่ต้องกรอก ID และ Password เฟสบุ๊ค(ถ้ากดลิงก์ผ่านช่องทางอื่นอาจต้องกรอกข้อมูลเพื่อล็อกอิน)</li>
                <li>เมื่อล็อกอินแล้วให้เลือกทีมเชียร์ที่จะติดกับชื่อโปรโฟล์ของคุณ เลือกว่าคุณเป็นแฟนบอลทีมไหน(มีให้เลือก 11 ทีม) เลือกได้ตามใจชอบ</li>
                <li>เข้ากลุ่มชุมชนเกมของเราเพื่อติดตามข่าวสารและติดต่อรับรางวัลหากคุณชนะเกมของเราแล้วสิทธิ์นั้นตกหล่น -> <a href="https://www.facebook.com/groups/1473068232851201" target="_blank">https://www.facebook.com/groups/1473068232851201</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header" id="headingTwo">
          <h5 class="mb-0">
            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"> วิธีเล่นเกม </button>
          </h5>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
          <div class="card-body">
          <ul>
          	<li>เล่นเกมโดยทายผลแบบราคาพูล 1X2 ซึ่งสามารถเลือกได้แค่ เจ้าบ้านชนะ, เสมอ, ทีมเยือนชนะ เท่านั้น บอล 1 คู่ เลือกผลได้แค่คู่ละ 1 อย่าง และต้องทายผลให้ครบ 10 คู่ถึงจะส่งผลเข้าสู่ระบบเพื่อลุ้นคะแนนชิงรางวัลได้</li>
            <li>แข่งทีละเกมวีค เริ่มเล่นเกมทายผลใหม่ได้ตั้งแต่บอลคู่สุดท้ายของเกมวีคเก่าเตะจบ โดยแต่ละเกมวีคจะตั้งเดดไลน์เปิดให้เล่นเกมทายผลได้ถึงช่วงเวลาที่บอลคู่แรกของเกมวีคนั้นเริ่มคิกออฟ เมื่อบอลคู่แรกของเกมวีคนั้นเริ่มเตะ นั่นหมายถึงหมดเวลาทายผลเกมวีคนั้นทันที</li>
          </ul>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header" id="headingThree">
          <h5 class="mb-0">
            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"> การคิดคะแนน </button>
          </h5>
        </div>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
          <div class="card-body">
          	<ul>
            	<li>คู่แข่งขันธรรมดา : ทายถูก+1 คะแนน, ทายผิด=0 คะแนน</li>
                <li>คู่แข่งขันพิเศษ(Special Combo) : ทายถูก+2 คะแนน, ทายผิด-1 คะแนน</li>
                <li>โดยจะแข่งเป็นแต่ละเกมวีคไป มีทั้งสิ้น 38 เกมวีค จบเกมวีคเริ่มนับคะแนนใหม่ ยังไม่มีการรวมคะแนนสะสมใดๆ ใครมีคะแนนสูงสุดติดท็อป 3 ในแต่ละเกมวีคจะได้สิทธิ์ลุ้นรับรางวัลตามเงื่อนไข</li>
                <li>ในกรณีหากคะแนนเท่ากัน จะนับที่คะแนนสัมประสิทธิ์(ดูอันดับทีมในตารางพรีเมียร์ลีกที่คุณทายผลชนะถูกต้อง/ทายผลเสมอถูกต้อง)มาเป็นเกณฑ์ตัดสิน เช่น<br>ผู้เล่น A มีคะแนนทายผล 2 คะแนน : ทายทีมแมนเชสเตอร์ ซิตี้(อันดับ 1 ตารางพรีเมียร์ลีก) ชนะถูกต้อง และทายทีมลิเวอร์พูล(อันดับ 2 ตารางพรีเมียร์ลีก) ชนะถูกต้อง จะมีคะแนนสัมประสิทธิ์รวม 1+2 =3<br>ผู้เล่น B มีคะแนนทายผล 2 คะแนน : ทายทีมลีดส์(อันดับ 16 ตารางพรีเมียร์ลีก) ชนะถูกต้อง และทายทีมฟอเรสต์(อันดับ 20 ตารางพรีเมียร์ลีก) ชนะถูกต้อง จะมีคะแนนสัมประสิทธิ์รวม 16+20=36<br>ผู้เล่น C มีคะแนนทายผล 2 คะแนน : ทายคู่แมนเชสเตอร์ ยูไนเต็ด(อันดับ 6 ตารางพรีเมียร์ลีก) กับ นิวคาสเซิ่ล(อันดับ 10 ตารางพรีเมียร์ลีก) เสมอถูกต้อง และทายคู่เวสต์แฮม(อันดับ 12 ตารางพรีเมียร์ลีก) กับ เลสเตอร์(อันดับ 15 ตารางพรีเมียร์ลีก) เสมอถูกต้อง จะมีคะแนนสัมประสิทธิ์รวม 6+10+12+15=43<br>เท่ากับในเคสตัวอย่างนี้ ผู้เล่น C จะเป็นฝ่ายชนะคะแนนสัมประสิทธิ์ ตามมาด้วยผู้เล่น B และผู้เล่น A คะแนนสัมประสิทธิ์น้อยสุด<br>*หมายเหตุ : ยึดเอาตารางคะแนนพรีเมียร์ลีกหลังจบเกมวีคนั้นๆ อย่างเป็นทางการมานับคะแนนสัมประสิทธิ์</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header" id="headingFour">
          <h5 class="mb-0">
            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour"> รางวัลเกม+การรับรางวัล </button>
          </h5>
        </div>
        <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
          <div class="card-body">
          <ul>
          	<li>เฉพาะผู้ที่ทำคะแนนติดอันดับท็อป 3 ในแต่ละสัปดาห์เท่านั้นจะมีสิทธิ์รับรางวัล โดยรายละเอียดและเงื่อนไขการจ่ายรางวัลมีดังนี้</li>
            <li>ติดต่อรับรางวัลที่ไลน์ : @kickoff4u หรือคลิก -> <a href="https://line.me/R/ti/p/~@kickoff4u" target="_blank">https://line.me/R/ti/p/~@kickoff4u</a></li>
            <li>เงื่อนไขการรับรางวัล<br><img src="<?php echo base_url('images/S__2891803_new.jpg?v=1') ?>" width="100%"></li>
            <li>พิเศษ! ผู้เล่นที่สมัครสมาชิกสามารถติดตามภารกิจ Kickoff4U เพื่ออัพเกรดรางวัลเงินสดสูงสุดถึง 1,000 บาท ได้ทุกเกมวีคในกลุ่มชุมชนเฟสบุ๊คของเรา -> <a href="https://www.facebook.com/groups/1473068232851201" target="_blank">https://www.facebook.com/groups/1473068232851201</a><br>หรือสอบถามที่ไลน์ @kickoff4u คลิก -> <a href="https://line.me/R/ti/p/~@kickoff4u" target="_blank">https://line.me/R/ti/p/~@kickoff4u</a></li>
            <li>ผู้เล่นทุกคนที่ติดท็อป 3 ติดต่อสอบถามทำเรื่องรับรางวัลได้ที่ไลน์ @kickoff4u คลิก -> <a href="https://line.me/R/ti/p/~@kickoff4u" target="_blank">https://line.me/R/ti/p/~@kickoff4u</a></li>
          </ul>
          </div>
        </div>
      </div>
    </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
    </div>
  </div>
</div>
</div>
<!-- end Modal -->

<!-- Modal Popup-->
<div class="modal fade" id="popup-home" role="dialog">
  <div class="modal-dialog">    
    <!-- Modal Popup content-->
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <div class="modal-body">
        <img src="images/popup-home.gif" width="100%">
      </div>
    </div>
  </div>
</div>
<!-- end Modal Popup-->
<?php if($this->session->userdata('logined')) { ?>
<!-- Modal Cheer team -->
<div class="modal fade" id="cheer-team" tabindex="-1" role="dialog" aria-labelledby="cheer-team" aria-hidden="true">
<div class="modal-dialog" role="document">
  <form id="form-teamcheer" action="<?php echo site_url('zeanteng/cheerteam') ?>" method="post">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="price">คุณเป็นแฟนทีม?</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body" style="font-size:80%;">    
    <select class="form-control" name="club_id" id="club_id" required>
    <?php foreach($rs_clubshirt->result() as $row){ ?>
    <option value="<?php echo $row->club_id ?>" <?php echo ($this->session->userdata('member_shirt')==$row->club_shirt)?'selected':'' ?>><?php echo 'ทีม '.$row->club_name ?></option>
    <?php } ?>
    </select>    
    </div>
    <div class="modal-footer">
      <button type="submit" class="btn btn-success">อัพเดท</button>
    </div>
  </div>
  </form>
</div>
</div>
<!-- end Modal Modal Cheer team-->
<?php } ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/2.2.1/js.cookie.min.js" ></script>
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
			$('#predict').find('.modal-body').append('<div style="border-bottom: 1px solid rgba(0, 0, 0, 0.1); margin-bottom: 10px;">'+$(this).attr('data-match')+' | คุณเลือก > '+predicttxt+' </div>');
		 }
		});
	});
		
	$('#list-month-teng').on('show.bs.modal', function (e) {
		$(this).find('#namezean').html('รายการที่เล่น ของ : '+$(e.relatedTarget).attr('data-name'));
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
	
	$("#club_id_cheer").on("change", function(evt) {
	   var self = $(this);
	   if(self.val()!=''){
		   $('#club_cheer').val(self.val());
		   $('#predictconfirmbutton').prop("disabled",false);
	   }else{
		   $('#club_cheer').val('');
		   $('#predictconfirmbutton').prop("disabled",true);
	   }
	});
	<?php } ?>
	
	if (!Cookies.get('alert-popup-home')) { 
	  $('#popup-home').modal('show');
 	  Cookies.set('alert-popup-home', true, { expires: 1 });
	}
	
});
</script>