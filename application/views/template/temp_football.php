<html>
<head>
<meta charset="utf-8">
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ดูบอลสด ดูบอลออนไลน์ 24 ชม. ฟุตบอลสด ถ่ายทอดสดฟุตบอล ฟรี</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Oswald|Prompt" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
<link rel="stylesheet" href="<?php echo base_url('assets/css/mystyle.css?v=1') ?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/css/price_table.css') ?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/css/sbobet_fetcher.css') ?>" />
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="http://cdn.jsdelivr.net/jquery.marquee/1.3.1/jquery.marquee.min.js"></script>
<script src="https://rawgit.com/tobia/Pause/master/jquery.pause.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</head>
<body>
<section class="container-fluid bg-pm">
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
<section class="container">
  <div class="row">
    <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-xs-12">
      <?php //include 'include/leaugescore.php';?>
      <?php echo $Content ?>
    </div>    
    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12">
    	<?php $this->load->view('table-score/index_view') ?>
        <div class="col" style="margin-top:10px">
          <img src="<?php echo base_url('images/banner600/sbobet99-600.jpg') ?>" width="100%" />
        </div>
        <script>$('.collapse').collapse('hide')</script>
    </div>
  </div>
</section>
<div class="container-fluid bg-purple" style="padding:10px 0px 1px 0px; margin-top:20px">
  <div class="col text-center">
    <p class="fc-white"> &copy Copy right reserve by design BOY </p>
  </div>
</div>
</body>
</html>