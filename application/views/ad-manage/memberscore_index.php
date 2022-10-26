<div class="">
  <div class="page-header-title">
    <h4 class="page-title">คะแนนสมาชิก</h4>
  </div>
</div>

<div class="page-content-wrapper ">

    <div class="container">
    	<div class="row">                                     
            <div class="col-sm-12 col-md-12">
                <div class="panel">
                    <div class="panel-body">
                    	<form action="" method="post" id="form-search-top" class="form-inline">
                        <select class="form-control" name="gw_start" id="gw_start" required>
                        <option value="" selected="selected">=จากเกมวีค=</option>
                        <?php foreach($rs_gameweek->result() as $row){ ?>
                        <option value="<?php echo $row->gw_id ?>" <?php if($row->gw_id==$gw_start){ echo 'selected';} ?>><?php echo $row->gw ?></option>
                        <?php } ?>
                        </select>
                        <label>:</label>
                        <select class="form-control" name="gw_end" id="gw_end" required>
                        <option value="" selected="selected">=ถึงเกมวีค=</option>
                        <?php foreach($rs_gameweek->result() as $row){ ?>
                        <option value="<?php echo $row->gw_id ?>" <?php if($row->gw_id==$gw_end){ echo 'selected';} ?>><?php echo $row->gw ?></option>
                        <?php } ?>
                        </select>
                        <button type="submit" id="search-top" class="btn btn-success"><!--<i class="ti-search"></i>--> ดึงข้อมูล</button>
                        </form>
                    </div>
                </div>
            </div>                                     
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <!--<h4 class="m-t-0">รายการสมาชิกและคะแนน</h4>-->
						<table class="table table-striped table-bordered table-hover display" id="datatables" width="100%">
                          <thead>
                            <tr role="row" align="center">
                              <th width="5%"></th>	
                              <th width="30%">ชื่อ</th>
                              <th width="30%">จำนวนคู่ที่เล่น</th>
                              <th width="15%">คะแนน</th>
                              <th width="15%">คะแนนสัมประสิทธิ์</th>
                              <!--<th class="text-center" width="5%"></th>-->
                            </tr>
                          </thead>
                            <tbody>
								<?php if ($rs_memberscore->num_rows() > 0) { $i=1;?>
                                <?php foreach($rs_memberscore->result() as $row){ ?>
                                <tr align="center">
                                <td><?php echo $i++ ?></td>
                                <td><?php echo $row->nickname ?></td>
                                <td><?php echo $row->teng_match ?></td>
                                <td><?php echo floatval($row->teng_score) ?></td>
                                <td><?php echo floatval($row->teng_coefficient) ?></td>
                                </tr>
                                <?php } ?>
                                <?php } ?>
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
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        $('table.display').DataTable({
			"bPaginate": true, 
			"bLengthChange": false,
			"bFilter": true,
			"bInfo": false,
			"bAutoWidth": false,
			"iDisplayLength": 25,
			"ordering": false,
			"language": {
			  "emptyTable": "ไม่มีรายการ",
			  "sSearch": "ค้นหา : "
			}
		});
    });
</script>