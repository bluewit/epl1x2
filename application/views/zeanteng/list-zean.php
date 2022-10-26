<div class="row" style="margin-top:15px">
  <div class="col-6 col-sm-9">
    <h4>ทำเนียบ</h4>    
  </div>
  <div class="col-6 col-sm-3">
  	<form id="form-listzean" action="<?php echo site_url('zeanteng/list-zean') ?>" method="get">
    <select class="form-control" name="zeanweek" id="zeanweek" required>
    <!--<option value="all" <?php echo ($row->gw_id==$zeanweek)?'selected':'' ?>>=ทุกวีค=</option>-->
    <?php foreach($rs_gameweek->result() as $row){ ?>
    <option value="<?php echo $row->gw_id ?>" <?php echo ($row->gw_id==$zeanweek)?'selected':'' ?>><?php echo 'วีค '.$row->gw ?></option>
    <?php } ?>
    </select>
    </form>
  </div>
</div>
<!-- END Row -->

<div class="row  fz-08">
	<div class="col table-responsive">                                     
        <table class="table table-striped table-bordered table-hover fz-10" id="datatables" width="100%">
          <thead>
            <tr role="row">
              <!--<th width="5%"></th>-->
              <th width="75%">ชื่อ</th>
              <th width="10%">คะแนน</th>
              <th width="15%"></th>
              <th></th>
            </tr>
          </thead>
            <tbody>
            </tbody>
        </table> 
    </div>                                    
</div>
<!-- END Row -->

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

<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        var t = $('#datatables').DataTable({
			"bPaginate": true, 
			"bLengthChange": false, //+ แสดงจำนวนต่อหน้า
			"bFilter": false, //+ ช่องค้นหา
			"bInfo": false, //+ รายละเอียดจำนวนแถว
            "bProcessing": true,
            "bServerSide": true,
            "sServerMethod": "GET",
            "sAjaxSource": '<?php echo base_url('zeanteng/list-zean-all/'.$zeanweek); ?>',
            "iDisplayLength": 50,
			"columnDefs": [  //+ เงื่อนไขสำหรับปิดคอลัมภ์ที่ไม่ต้องการให้ค้นหา หรือ Sort
				<!--{"searchable": true, "orderable": false, "targets":0,'className':'text-center'},-->
				{"targets":[0],'className':'text-left'},
				{"targets":[1],'className':'text-center'},
				{"targets":[3],'visible':false},
				{"searchable": false, "orderable": false,"targets":2,'className':'text-center',
					"render": function(data, type, row) { // Available data available for you within the row
						var x = '<a href="" data-toggle="modal" data-target="#list-month-teng" data-id="'+data+'" data-name="'+row[3]+'" data-week="<?php echo $zeanweek ?>" title="รายการที่เล่น"> รายการที่เล่น</a>';
						return x;
					}
				}
			],
			"ordering": false
			//"order": [2, 'desc'] //+ คอลัมภ์ที่ต้องการให้เรียงลำดับ
        });
		
		$('#list-month-teng').on('show.bs.modal', function (e) {
			$(this).find('#namezean').html('รายการที่เล่น วีค '+$(e.relatedTarget).attr('data-week')+' ของ : '+$(e.relatedTarget).attr('data-name'));
			$(this).find('.modal-body').html('<center><img src="<?php echo base_url('images/ajax-loader.gif') ?>"></center>').delay(1000).load('<?php echo site_url('zeanteng/list-teng-month')?>/'+$(e.relatedTarget).attr('data-id')+'/'+$(e.relatedTarget).attr('data-week'));
		});
		
		$("#zeanweek").change(function() {
			if($(this).val()!=''){
				$('#form-listzean').submit();
			}
		});
    });
</script>