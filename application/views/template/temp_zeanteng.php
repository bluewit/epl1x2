<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta property="og:url" content="<?php echo site_url() ?>">
<meta property="og:title" content="ท้าเซียนพรีเมียร์ลีกทั่วไทย เล่นฟรี ได้เงินจริง">
<meta property="og:description" content="มีผู้เข้าร่วมแล้วกว่า 4,000 คน">
<meta property="og:image" content="<?php echo base_url('images/fb-share27822.png') ?>">
<title>เกมส์ เซียน บอล EPL</title>
<link rel="icon" href="<?php echo base_url('images/favicon.png') ?>">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Oswald|Prompt" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
<link rel="stylesheet" href="<?php echo base_url('assets/css/mystyle.css?v=1.8') ?>" />
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
<script type="text/javascript">
	$(function(){
		sweetAlertInitialize();
		<?php if($this->session->flashdata('msg_success')){ ?>
		swal("Good job!", "<?php echo $this->session->flashdata('msg_success') ?>", "success");	
		<?php } ?>
	})
</script>
<style>
.cellRating{
    align-items: center;
    border-radius: 4px;
    display: flex;
    font-size: 12px;
    font-weight: 700;
    height: 20px;
    justify-content: center;
    width: 20px;
}
</style>
</head>
<body>
<section class="container-fluid bg-pm">
	<div class="bg-player">
    <nav class="navbar navbar-expand-sm navbar-dark">
      <a class="navbar-brand head-logo" href="<?php echo site_url() ?>"><img src="<?php echo base_url('images/pl-logo-lion.svg') ?>" alt="Premier League" width="50%">	
      <span class="d-none d-sm-inline fz-10">EPL1x2.COM</span>
      </a>
    </nav>
    </div>
</section>
<section class="container-fluid">
  <div class="row">
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-xs-12">
      <?php //include 'include/leaugescore.php';?>
      <?php echo $Content ?>
    </div>    
    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-xs-12">
    	<div class="col mt-1">
            <img src="<?php echo base_url('images/messageImage_1660775853147.jpg') ?>" width="100%">
        </div>
		<?php if(isset($rs_teamded)){ ?>
    	<div class="col">
          <h3 class="f-prompt"><i class="fas fa-chart-line fz-15"></i>
          3 ทีมฮอตประจำสัปดาห์
          </h3>        
        </div>
        <div class="col">
          <div class="divranking bg-white">
            <div class="numrank f-oswald">อันดับ</div>
            <div class="userrank f-oswald">ทีม</div>
            <div class="ptsrank f-oswald">คนเลือก</div>
          </div>
          <?php $i=1; foreach($rs_teamded->result() as $row){ ?>
          <div class="divranking" style="height: 40px;">
            <div class="numrank"><?php echo $i++ ?></div>
            <div class="userrank"><img src="<?php echo base_url('images/uploads/S/'.$row->club_image) ?>"> <?php echo $row->club_name ?></div>
            <div class="ptsrank"><?php echo $row->tengnum ?></div>
          </div>
          <?php } ?>
        </div>
        <?php } ?>
        <div class="col mt-1">
            <a href="https://line.me/R/ti/p/~@kickoff4u" target="_blank"><img src="<?php echo base_url('images/kickoff4u 2382022.png') ?>" width="100%"></a>
        </div>
        <?php if(isset($rs_matchalded)){ ?>
    	<div class="col">
          <h3 class="f-prompt"><i class="fas fa-chart-line fz-15"></i>
          3 คู่เจ๊าสุดฮอตในสัปดาห์
          </h3>        
        </div>
        <div class="col">
          <div class="divranking bg-white">
            <div class="numrank f-oswald">อันดับ</div>
            <div class="userrank f-oswald">คู่</div>
            <div class="ptsrank f-oswald">คนเลือก</div>
          </div>
          <?php $i=1; foreach($rs_matchalded->result() as $row){ ?>
          <div class="divranking" style="height: 40px;">
            <div class="numrank"><?php echo $i++ ?></div>
            <div class="userrank" title="<?php echo $row->matchvs ?>"><img src="<?php echo base_url('images/uploads/S/'.$row->club_home_image) ?>"> vs <img src="<?php echo base_url('images/uploads/S/'.$row->club_away_image) ?>"></div>
            <div class="ptsrank"><?php echo $row->tengnum ?></div>
          </div>
          <?php } ?>
        </div>
        <?php } ?>
        
    	<?php if(isset($rs_memberranking)){ ?>
    	<div class="col">
          <h3 class="f-prompt"><i class="fas fa-chart-line fz-15"></i>
          3 อันดับผู้นำสัปดาห์ก่อน
          <a href="<?php echo site_url('zeanteng/list-zean/?zeanweek='.$rs_memberranking->row()->gw_id) ?>"><button type="button" class="btn btn-outline-dark btn-sm fz-05">ดูทั้งหมด</button></a>
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
            <div class="userrank">
            	<img src="<?php echo base_url('images/shirt/'.$row->club_shirt); ?>" height="30">
                <?php echo $row->nickname ?>
            </div>
            <div class="ptsrank"><?php echo floatval($row->teng_score) ?></div>
          </div>
          <?php } ?>
        </div>
        <?php } ?>
        <div class="col mt-1">
           <iframe src="https://www.facebook.com/plugins/group.php?href=https%3A%2F%2Fwww.facebook.com%2Fgroups%2F1473068232851201&width=280&show_metadata=false&appId=1842872169084290&height=250" width="280" height="250" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
        </div>
        <div class="col">
          <h3 class="f-prompt"><i class="fas fa-chart-line fz-15"></i>
          ตารางคะแนนพรีเมียร์ลีก
          </h3>        
        </div>
        <div class="col fz-08">
        	<?php $this->load->view('table-score/cache/table_mini_92') ?>
            <br>
            <table>
              <tbody>
                <tr>
                  <td><span class="cellRating" style="background-color: rgb(0, 70, 130); color: white;">&nbsp;</span></td>
                  <td>- ไปเล่น แชมเปี้ยนส์ลีก (รอบแบ่งกลุ่ม)</td>
                </tr>
                <tr>
                  <td><span class="cellRating" style="background-color: rgb(127, 0, 41); color: white;">&nbsp;</span></td>
                  <td>- ไปเล่น ยูโรปาลีก (รอบแบ่งกลุ่ม)</td>
                </tr>
                <tr>
                  <td><span class="cellRating" style="background-color: rgb(189, 0, 0); color: white;">&nbsp;</span></td>
                  <td>- ไปเล่น แชมเปี้ยนชิพ</td>
                </tr>
              </tbody>
            </table>
        </div>
    </div>
  </div>
</section>
<div class="container-fluid bg-pm1" style="padding:10px 0px 1px 0px; margin-top:20px">
  <div class="col text-center">
    <p class="fc-black"> &copy Copy right reserve epl1x2.com</p>
  </div>
</div>
</body>
</html>