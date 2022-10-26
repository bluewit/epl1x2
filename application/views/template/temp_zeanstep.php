<html>
<head>
<meta charset="utf-8">
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>เกมส์ เซียน บอลสเต็ป</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Oswald|Prompt" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
<link rel="stylesheet" href="<?php echo base_url('assets/css/mystyle.css') ?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/css/price_table.css') ?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/css/sbobet_fetcher.css') ?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap-sweetalert/sweet-alert.css') ?>" />
<!-- DataTables -->
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="http://cdn.jsdelivr.net/jquery.marquee/1.3.1/jquery.marquee.min.js"></script>
<script src="https://rawgit.com/tobia/Pause/master/jquery.pause.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/plugins/loadingoverlay/loadingoverlay.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js') ?>"></script>
<!-- Datatables-->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>
<section class="container-fluid bg-purple">
    <nav class="navbar navbar-expand-sm bg-purple navbar-dark">
      <a class="navbar-brand" href="<?php echo site_url() ?>">FOOTBALLSOD.COM</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#">ผลบอล</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">โปรแกรมการแข่งขัน</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
              ถ่ายทอดสดคาสิโน
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#">บาคาร่า</a>
              <a class="dropdown-item" href="#">รูเล็ต</a>
              <a class="dropdown-item" href="#">ไฮโล</a>
              <a class="dropdown-item" href="#">เสือ มังกร</a>
              <a class="dropdown-item" href="#">หวยออนไลน์</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('zeanstep') ?>">เซียนบอลสเต็ป <div class="new">New</div></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('zeanteng') ?>">เซียนบอลเต็ง <div class="new">New</div></a>
          </li>
        </ul>
      </div>
    </nav>
</section>
<section class="container-fluid">
  <div class="row">
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-xs-12">
      <?php //include 'include/leaugescore.php';?>
      <?php echo $Content ?>
    </div>    
    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-xs-12">
    	<?php if(isset($rs_teamded)){ ?>
    	<div class="col">
          <h3 class="f-prompt"><i class="fas fa-chart-line fz-15"></i>
          5 ทีมเด็ด บอลสเต็ป
          <!--<a href=""><button type="button" class="btn btn-outline-dark btn-sm fz-05">ดูทั้งหมด</button></a>-->
          </h3>        
        </div>
        <div class="col">
          <div class="divranking bg-white">
            <div class="numrank f-oswald">อันดับ</div>
            <div class="userrank f-oswald">ทีม</div>
            <div class="ptsrank f-oswald">คนเลือก</div>
          </div>
          <?php $i=1; foreach($rs_teamded->result() as $row){ ?>
          <div class="divranking">
            <div class="numrank"><?php echo $i++ ?></div>
            <div class="userrank"><?php echo $row->club_name ?></div>
            <div class="ptsrank"><?php echo $row->stepnum ?></div>
          </div>
          <?php } ?>
        </div>
        <?php } ?>
        
        <?php if(isset($rs_memberranking)){ ?>
    	<div class="col">
          <h3 class="f-prompt"><i class="fas fa-chart-line fz-15"></i>
          5 อันดับ เซียนบอลสเต็ป
          <a href="<?php echo site_url('zeanstep/list-zean') ?>"><button type="button" class="btn btn-outline-dark btn-sm fz-05">ดูทั้งหมด</button></a>
          </h3>
        
        </div>
        <div class="col">
          <div class="divranking bg-white">
            <div class="numrank f-oswald">อันดับ</div>
            <div class="userrank f-oswald">ชื่อ</div>
            <div class="ptsrank f-oswald">คะแนน</div>
          </div>
          <?php $i=1; foreach($rs_memberranking->result() as $row){ ?>
          <div class="divranking">
            <div class="numrank"><?php echo $i++ ?></div>
            <a href="" data-toggle="modal" data-target="#list-month-step" data-id="<?php echo $row->member_id ?>" title="ดูรายการที่เล่น"><div class="userrank"><?php echo $row->nickname ?></div></a>
            <div class="ptsrank"><?php echo floatval($row->cs_score) ?></div>
          </div>
          <?php } ?>
        </div>
        <?php } ?>
        
        <?php if(isset($rs_memberrankingyesterday)){ ?>
    	<div class="col">
          <h3 class="f-prompt"><i class="fas fa-chart-line fz-15"></i>
         เซียนสเต็ป แตกเต็ม ๆ เมื่อวาน
          <!--<a href=""><button type="button" class="btn btn-outline-dark btn-sm fz-05">ดูทั้งหมด</button></a>-->
          </h3>
        
        </div>
        <div class="col">
          <div class="divranking bg-white">
            <div class="numrank f-oswald">อันดับ</div>
            <div class="userrank f-oswald">ชื่อ</div>
            <div class="ptsrank f-oswald">คะแนน</div>
          </div>
          <?php $i=1; foreach($rs_memberrankingyesterday->result() as $row){ ?>
          <div class="divranking">
            <div class="numrank"><?php echo $i++ ?></div>
            <a href="" data-toggle="modal" data-target="#list-yesterday-step" data-id="<?php echo $row->cs_id ?>" title="ดูรายการที่เล่น"><div class="userrank"><?php echo $row->nickname ?></div></a>
            <div class="ptsrank"><?php echo floatval($row->cs_score) ?></div>
          </div>
          <?php } ?>
        </div>
        <?php } ?>
    </div>
  </div>
</section>
<div class="container-fluid bg-purple" style="padding:10px 0px 1px 0px; margin-top:20px">
  <div class="col text-center">
    <p class="fc-white"> &copy Copy right reserve by design BOY </p>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="list-month-step" tabindex="-1" role="dialog" aria-labelledby="list-month-step" aria-hidden="true">
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
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
</div>
<!-- end Modal -->

<!-- Modal -->
<div class="modal fade" id="list-yesterday-step" tabindex="-1" role="dialog" aria-labelledby="list-yesterday-step" aria-hidden="true">
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
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
</div>
<!-- end Modal -->

<script type="text/javascript">
$(function(){
	$('#list-month-step').on('show.bs.modal', function (e) {
		$(this).find('.modal-body').html('<center><img src="<?php echo base_url('images/ajax-loader.gif') ?>"></center>').delay(1000).load('<?php echo site_url('zeanstep/list-step-month')?>/'+$(e.relatedTarget).attr('data-id'));
	});	
	$('#list-yesterday-step').on('show.bs.modal', function (e) {
		$(this).find('.modal-body').html('<center><img src="<?php echo base_url('images/ajax-loader.gif') ?>"></center>').delay(1000).load('<?php echo site_url('zeanstep/list-step-yesterday')?>/'+$(e.relatedTarget).attr('data-id'));
	});
});
</script>
</body>
</html>