<div class="">
  <div class="page-header-title">
    <h4 class="page-title">สมาชิก</h4>
  </div>
</div>

<div class="page-content-wrapper ">

    <div class="container">
    	<!--<div class="row">                                     
            <div class="col-sm-12 col-md-12">
                <div class="panel">
                    <div class="panel-body">
                        <button class="btn btn-primary waves-effect waves-light" href="#Create" type="button" data-toggle="modal">สร้างสโมสร</button>
                    </div>
                </div>
            </div>                                     
        </div>-->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <!--<h4 class="m-t-0">สมาชิก</h4>-->
						<table class="table table-striped table-bordered table-hover" id="datatables" width="100%">
                          <thead>
                            <tr role="row">
                              <th width="5%"></th>	
                              <th width="30%">ชื่อ</th>
                              <th width="30%">อีเมล์</th>
                              <th width="30%">วันสมัคร</th>
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
		"sAjaxSource": '<?php echo base_url('ad-manage/member-all'); ?>',
		"iDisplayLength": 50,
		"columnDefs": [  //+ เงื่อนไขสำหรับปิดคอลัมภ์ที่ไม่ต้องการให้ค้นหา หรือ Sort
			{"searchable": true, "orderable": false, 'className':'text-center', "targets":0},
			/*{
				"searchable": false, 
				"orderable": false, 
				'className':'text-center',
				"targets":5,
				"render": function(data, type, row) { // Available data available for you within the row
					var x = '<div class="btn-group btn-group-xs" align="center"><a href="<?php //echo site_url('ad-manage/club-view') ?>/'+data+'" class="btn btn-default btn-xs waves-effect">ดูข้อมูล</a></div>';
					return x;
				}
			}*/
		],
		"order": [3, 'desc'] //+ คอลัมภ์ที่ต้องการให้เรียงลำดับ
	});
});
</script>