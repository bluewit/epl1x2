<div class="">
  <div class="page-header-title">
    <h4 class="page-title">ลีก</h4>
  </div>
</div>

<div class="page-content-wrapper ">

    <div class="container">
    	<div class="row">                                     
            <div class="col-sm-12 col-md-12">
                <div class="panel">
                    <div class="panel-body">
                        <button class="btn btn-primary waves-effect waves-light" href="#Create" type="button" data-toggle="modal">สร้างลีก</button>
                    </div>
                </div>
            </div>                                     
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <h4 class="m-t-0">รายการ ประเทศ</h4>
						<table class="table table-striped table-bordered table-hover" id="datatables" width="100%">
                          <thead>
                            <tr role="row">
                              <th width="5%"></th>	
                              <th width="30%">ประเทศ/โซน</th>
                              <th width="30%">ลีก</th>
                              <th width="30%">ธงสัญลักษณ์</th>
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
      <form class="form-horizontal" id="form-create" action="<?php echo site_url('ad-manage/league-add-operate') ?>" method="POST" role="form" enctype="multipart/form-data">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">สร้าง ลีก</h4>
        </div>
        <div class="modal-body">
          <div class="form-group  ">
            <label for="inputAame" class="col-sm-3 control-label">ประเทศ:</label>
            <div class="col-sm-8">
                <select class="form-control" name="national_id" required>
                <option value="" selected="selected">=เลือก=</option>
                <?php foreach($rs_national->result() as $row){ ?>
                <option value="<?php echo $row->national_id ?>"><?php echo $row->national_name ?></option>
                <?php } ?>
                </select>
            </div>           
          </div>
          <div class="form-group  ">
            <label for="inputAame" class="col-sm-3 control-label">ลีก:</label>
            <div class="col-sm-8">
              <input type="text" name="league_name" class="form-control" id="league_name" placeholder="ลีก" value="" required data-parsley-minlength="4">
            </div>           
          </div>
          <div class="form-group">
            <label for="inputUsername" class="col-sm-3 control-label">รูปภาพประกอบ:</label>
            <div class="col-sm-8">
            <input type="file" class="filestyle" data-buttonname="btn-default" placeholder="เลือกรูปภาพประกอบ" name="league_image" id="league_image" required>* ขนาดภาพ 200 X 200 Pixel
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
            "sAjaxSource": '<?php echo base_url('ad-manage/league-all'); ?>',
            "iDisplayLength": 50,
			"columnDefs": [  //+ เงื่อนไขสำหรับปิดคอลัมภ์ที่ไม่ต้องการให้ค้นหา หรือ Sort
				{"searchable": true, "orderable": false, 'className':'text-center', "targets":0},
				{
					"searchable": false, 
					"orderable": false, 
					'className':'text-center',
					"targets":4,
					"render": function(data, type, row) { // Available data available for you within the row
						var x = '<div class="btn-group btn-group-xs" align="center"><a href="<?php echo site_url('ad-manage/league-view') ?>/'+data+'" class="btn btn-default btn-xs waves-effect">ดูข้อมูล</a></div>';
						return x;
					}
				}
			],
			"order": [1, 'desc'] //+ คอลัมภ์ที่ต้องการให้เรียงลำดับ
        });
    });
</script>