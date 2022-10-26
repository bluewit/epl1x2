<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Ad_manage extends CI_Controller{
	
	var $segment = 3;
	
	public function __construct(){
		parent::__construct();
		$this->load->model('national_model');
		$this->load->model('league_model');
		$this->load->model('club_model');
		$this->load->model('match_model');
		$this->load->model('gameweek_model');
	}
	
	public function check_admin_login(){
		if(!$this->session->userdata('admin_logined'))redirect('ad-manage/login');
	}
	
	public function login(){
		if($this->session->userdata('admin_logined'))redirect('ad-manage/index');
		$this->load->view('ad-manage/login_view', NULL);
	}
	
	public function logout(){
		$this->session->sess_destroy();
		$this->session->unset_userdata('admin_logined');
		redirect(site_url('admin'));	
	}
	
	public function check_admin(){		
		$post = $this->input->post();
		if($post){
			extract($post);
			if($username=='admin' && $password=='error1234'){		
				$this->session->set_userdata('name', 'Admin');	
				$this->session->set_userdata('admin_logined', true);				
				redirect(site_url('ad-manage/index'));
			}else{
				$this->session->set_flashdata('msg_error', 'Username / Password ไม่ถูกต้อง');				
				redirect(site_url('ad-manage/login'));
			}
			exit();
		}
	}
	
	public function index(){
		$this->check_admin_login();
		$data['Content'] = $this->load->view('ad-manage/index_view', NULL, true);
		$this->load->view('template/temp_admin', $data);
	}
	
	public function make_thumb($tempimage, $width=NULL, $height=NULL)
    {
		$this->load->library('image_lib');
        $config['image_library'] = 'gd2';
        $config['source_image']    = $tempimage;
        $config['new_image'] = "images/uploads/S";
        $config['maintain_ratio'] = TRUE;
        $config['width']     = $width;
        $config['height']    = $height;
        $this->image_lib->initialize($config); 
		@$this->image_lib->resize();
    } 
	
	public function upload_pic($pic_name){
		
		$config['upload_path'] = "images/uploads/";
		$config['allowed_types'] = "jpg|gif|png";
		$config['max_size'] = 1024; // kb
		$config['max_height'] = 200; //pixel
		$config['max_width'] = 200; //pixel
		
		$this->load->library('upload');
		$this->upload->initialize($config);
		
		if($this->upload->do_upload($pic_name)){
			$data = $this->upload->data();
			$new_name = date('YmdHis').$data['file_ext'];
			rename($data['full_path'], $data['file_path'].$new_name);
			
			//+ สร้างภาพเล็ก
			unset($config);
        	$this->make_thumb($data['file_path'].$new_name, 30, 30); //+ ทำให้เป็นภาพเล็ก 30 * 
			//+ สร้างภาพเล็ก
			
			$status = 'success';
			 return compact('status', 'data', 'new_name'); 
		}else{
			$data = $this->upload->display_errors();
			$status = 'error';
			return compact('status', 'data'); 
		}
		
	}
		
	//+ ประเทศ/โซน
	public function national(){
		$this->check_admin_login();
		$data['Content'] = $this->load->view('ad-manage/national_index', null, true);
		$this->load->view('template/temp_admin', $data);
	}
	
	public function national_all(){
		/* Array of database columns which should be read and sent back to DataTables. Use a space where
		* you want to insert a non-database field (for example a counter or static image)
		*/
		$aColumns = array('national_name','national_image','national_id');

		// DB table to use
		$sTable = 'fb_nationals';
		
		$iDisplayStart = $this->input->get_post('iDisplayStart', true);
		$iDisplayLength = $this->input->get_post('iDisplayLength', true);
		$iSortCol_0 = $this->input->get_post('iSortCol_0', true);
		$iSortingCols = $this->input->get_post('iSortingCols', true);
		$sSearch = $this->input->get_post('sSearch', true);
		$sEcho = $this->input->get_post('sEcho', true);

		// Paging
		if(isset($iDisplayStart) && $iDisplayLength != '-1')
		{
			$this->db->limit($this->db->escape_str($iDisplayLength), $this->db->escape_str($iDisplayStart));
		}

		// Ordering
		if(isset($iSortCol_0))
		{
			for($i=0; $i<intval($iSortingCols); $i++)
			{
				$iSortCol = $this->input->get_post('iSortCol_'.$i, true);
				$bSortable = $this->input->get_post('bSortable_'.intval($iSortCol), true);
				$sSortDir = $this->input->get_post('sSortDir_'.$i, true);

				if($bSortable == 'true')
				{
					$this->db->order_by($aColumns[intval($this->db->escape_str($iSortCol))], $this->db->escape_str($sSortDir));
				}
			}
		}

		/*
		 * Filtering
		 * NOTE this does not match the built-in DataTables filtering which does it
		 * word by word on any field. It's possible to do here, but concerned about efficiency
		 * on very large tables, and MySQL's regex functionality is very limited
		 */
		if(isset($sSearch) && !empty($sSearch)){
			for($i=0; $i<=count($aColumns); $i++)
			{
				$bSearchable = $this->input->get_post('bSearchable_'.$i, true);

				// Individual column filtering
				if(isset($bSearchable) && $bSearchable == 'true'){
					//if($aColumns[$i]=='created'){
						//(preg_match('/^\d{4}-\d{2}-\d{2}$/', $sSearch))? $this->db->or_like($aColumns[$i], $this->db->escape_like_str($sSearch)) : '';
					//}else{
						$like[] = $aColumns[$i]." LIKE '%".$this->db->escape_like_str($sSearch)."%'";
					//}
				}
			}
		}
		if(isset($like) && !empty($like)){
			$where = "(".implode(" OR ", $like).")";
			$this->db->where($where, NULL, FALSE);
		}
		$this->db->where('national_status', 1);
		

		// Select Data
		$this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
		$rResult = $this->db->get($sTable);

		// Data set length after filtering
		$this->db->select('FOUND_ROWS() AS found_rows');
		$iFilteredTotal = $this->db->get()->row()->found_rows;

		// Total data set length
		$iTotal = $this->db->count_all($sTable);

		// Output
		$output = array(
			'sEcho' => intval($sEcho),
			'iTotalRecords' => $iTotal,
			'iTotalDisplayRecords' => $iFilteredTotal,
			'aaData' => array()
		);		
		
		foreach($rResult->result() as $aRow){
			$iDisplayStart = $iDisplayStart+1; //+ นำค่าเริ่มต้นการแบ่งหน้า มาบวก 1 เพื่อแสดงจำนวนรายการแต่ละหน้า
			$row = array();
			$row[0] = $iDisplayStart;			
			$row[1] = $aRow->national_name;
			$row[2] = '<img src="'.base_url("images/uploads/S/".$aRow->national_image).'" width="30"/>';
			$row[3] = $aRow->national_id;		
			$output['aaData'][] = $row;			
		}		 
		echo json_encode($output);
	}
		
	public function national_add_operate(){
		$this->check_admin_login();
		$post = $this->input->post();
		extract($post);
		if(!is_uploaded_file($_FILES['national_image']['tmp_name'])){
			
				$sql = "INSERT INTO fb_nationals(national_name, national_image, created) VALUES ('$national_name', 'default.jpg', '".date('Y-m-d H:i:s')."')";
				$this->db->query($sql);				
				
				$this->session->set_flashdata('msg_success','เพิ่มเรียบร้อย !!');
				redirect('ad-manage/national');
				
		}else{			
			$value_return = $this->upload_pic('national_image');
			extract($value_return);
			if($status == 'success'){
					$sql = "INSERT INTO fb_nationals(national_name, national_image, created) VALUES ('$national_name', '$new_name', '".date('Y-m-d H:i:s')."')";
					$this->db->query($sql);
					
					$this->session->set_flashdata('msg_success','เพิ่มเรียบร้อย !!');
					redirect('ad-manage/national');
			}else{
					$this->session->set_flashdata('msg_error', $data);
					redirect('ad-manage/national');
			}
		}
	}
	
	public function national_view(){
		$this->check_admin_login();
		$Content['row_national'] = $this->national_model->select_national_id($this->uri->segment(3,0));
		$data['Content'] = $this->load->view('ad-manage/national_view', $Content, true);
		$this->load->view('template/temp_admin', $data);
	}
	
	public function national_edit_operate(){
		$this->check_admin_login();
		$post = $this->input->post();
		extract($post);		
		if(!is_uploaded_file($_FILES['national_image']['tmp_name'])){
			
				$sql = "UPDATE fb_nationals SET national_name='$national_name', modified='".date('Y-m-d H:i:s')."' WHERE national_id = $national_id";
				$this->db->query($sql);
								
				$this->session->set_flashdata('msg_success','แก้ไขเรียบร้อย !!');
				redirect('ad-manage/national');
		
		}else{						
			$value_return = $this->upload_pic('national_image');
			extract($value_return);
			if($status == 'success'){
				
					$sql = "UPDATE fb_nationals SET national_name='$national_name', national_image='$new_name', modified='".date('Y-m-d H:i:s')."' WHERE national_id = $national_id";
					$this->db->query($sql);
					if($national_image_old!=''){
						@unlink(FCPATH.'images/uploads/'.$national_image_old); // ลบภาพเก่าออก
						@unlink(FCPATH.'images/uploads/S/'.$national_image_old); // ลบภาพเก่าออก
					}					
					$this->session->set_flashdata('msg_success','แก้ไขเรียบร้อย !!');
					redirect('ad-manage/national');
		
			}else{
					$this->session->set_flashdata('msg_error', $data);
					redirect('ad-manage/national');
			}
		}
	}
	
	public function national_delete(){
		$this->check_admin_login();
		$sql = "UPDATE fb_nationals SET national_status=0, modified='".date('Y-m-d H:i:s')."' WHERE national_id = ".$this->input->post('national_id')."";
		$this->db->query($sql);
		$this->session->set_flashdata('msg_success','ลบเรียบร้อย !!');
		redirect('ad-manage/national');
	}
	
	//+ ลีก/รายการในประเทศ
	public function league(){
		$this->check_admin_login();
		$Content['rs_national'] = $this->national_model->select_national_all();
		$data['Content'] = $this->load->view('ad-manage/league_index', $Content, true);
		$this->load->view('template/temp_admin', $data);
	}
	
	public function league_all(){
		/* Array of database columns which should be read and sent back to DataTables. Use a space where
		* you want to insert a non-database field (for example a counter or static image)
		*/
		$aColumns = array('national_name','league_name','league_image','league_id');

		// DB table to use
		$sTable = 'fb_leagues';
		
		$iDisplayStart = $this->input->get_post('iDisplayStart', true);
		$iDisplayLength = $this->input->get_post('iDisplayLength', true);
		$iSortCol_0 = $this->input->get_post('iSortCol_0', true);
		$iSortingCols = $this->input->get_post('iSortingCols', true);
		$sSearch = $this->input->get_post('sSearch', true);
		$sEcho = $this->input->get_post('sEcho', true);

		// Paging
		if(isset($iDisplayStart) && $iDisplayLength != '-1')
		{
			$this->db->limit($this->db->escape_str($iDisplayLength), $this->db->escape_str($iDisplayStart));
		}

		// Ordering
		if(isset($iSortCol_0))
		{
			for($i=0; $i<intval($iSortingCols); $i++)
			{
				$iSortCol = $this->input->get_post('iSortCol_'.$i, true);
				$bSortable = $this->input->get_post('bSortable_'.intval($iSortCol), true);
				$sSortDir = $this->input->get_post('sSortDir_'.$i, true);

				if($bSortable == 'true')
				{
					$this->db->order_by($aColumns[intval($this->db->escape_str($iSortCol))], $this->db->escape_str($sSortDir));
				}
			}
		}

		/*
		 * Filtering
		 * NOTE this does not match the built-in DataTables filtering which does it
		 * word by word on any field. It's possible to do here, but concerned about efficiency
		 * on very large tables, and MySQL's regex functionality is very limited
		 */
		if(isset($sSearch) && !empty($sSearch)){
			for($i=0; $i<=count($aColumns); $i++)
			{
				$bSearchable = $this->input->get_post('bSearchable_'.$i, true);

				// Individual column filtering
				if(isset($bSearchable) && $bSearchable == 'true'){
					//if($aColumns[$i]=='created'){
						//(preg_match('/^\d{4}-\d{2}-\d{2}$/', $sSearch))? $this->db->or_like($aColumns[$i], $this->db->escape_like_str($sSearch)) : '';
					//}else{
						$like[] = $aColumns[$i]." LIKE '%".$this->db->escape_like_str($sSearch)."%'";
					//}
				}
			}
		}
		if(isset($like) && !empty($like)){
			$where = "(".implode(" OR ", $like).")";
			$this->db->where($where, NULL, FALSE);
		}
		$this->db->where('league_status', 1);
		

		// Select Data
		$this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
		$this->db->join('fb_nationals', 'fb_leagues.national_id = fb_nationals.national_id');
		$rResult = $this->db->get($sTable);

		// Data set length after filtering
		$this->db->select('FOUND_ROWS() AS found_rows');
		$iFilteredTotal = $this->db->get()->row()->found_rows;

		// Total data set length
		$iTotal = $this->db->count_all($sTable);

		// Output
		$output = array(
			'sEcho' => intval($sEcho),
			'iTotalRecords' => $iTotal,
			'iTotalDisplayRecords' => $iFilteredTotal,
			'aaData' => array()
		);		
		
		foreach($rResult->result() as $aRow){
			$iDisplayStart = $iDisplayStart+1; //+ นำค่าเริ่มต้นการแบ่งหน้า มาบวก 1 เพื่อแสดงจำนวนรายการแต่ละหน้า
			$row = array();
			$row[0] = $iDisplayStart;			
			$row[1] = $aRow->national_name;
			$row[2] = $aRow->league_name;
			$row[3] = '<img src="'.base_url("images/uploads/S/".$aRow->league_image).'" width="30"/>';
			$row[4] = $aRow->league_id;		
			$output['aaData'][] = $row;			
		}		 
		echo json_encode($output);
	}
	
	public function league_add_operate(){
		$this->check_admin_login();
		$post = $this->input->post();
		extract($post);			
		$league_table = isset($league_table)?$league_table:'n';		
		if(!is_uploaded_file($_FILES['league_image']['tmp_name'])){
			
				$sql = "INSERT INTO fb_leagues(national_id, league_name, league_image, created) VALUES ('$national_id', '$league_name', 'default.jpg', '".date('Y-m-d H:i:s')."')";
				$this->db->query($sql);				
				$this->session->set_flashdata('msg_success','เพิ่มเรียบร้อย !!');
				redirect('ad-manage/league');
				
		}else{			
			$value_return = $this->upload_pic('league_image');
			extract($value_return);
			if($status == 'success'){
				
					$sql = "INSERT INTO fb_leagues(national_id, league_name, league_image, created) VALUES ('$national_id', '$league_name', '$new_name', '".date('Y-m-d H:i:s')."')";
					$this->db->query($sql);
					$this->session->set_flashdata('msg_success','เพิ่มเรียบร้อย !!');
					redirect('ad-manage/league');
					
			}else{
					$this->session->set_flashdata('msg_error', $data);
					redirect('ad-manage/league');
			}
		}
	}
	
	public function league_view(){
		$this->check_admin_login();
		$Content['rs_national'] = $this->national_model->select_national_all();
		$Content['row_league'] = $this->league_model->select_league_id($this->uri->segment(3,0));
		$data['Content'] = $this->load->view('ad-manage/league_view', $Content, true);
		$this->load->view('template/temp_admin', $data);
	}
	
	public function league_edit_operate(){
		$this->check_admin_login();
		$post = $this->input->post();
		extract($post);		
		$league_table = isset($league_table)?$league_table:'n';
		
		if(!is_uploaded_file($_FILES['league_image']['tmp_name'])){
				
				$sql = "UPDATE fb_leagues SET national_id='$national_id', league_name='$league_name', league_table='$league_table',
							league_detail='$league_detail', league_order='$league_order', modified='".date('Y-m-d H:i:s')."' WHERE league_id = $league_id";
				$this->db->query($sql);
				$this->session->set_flashdata('msg_success','แก้ไขเรียบร้อย !!');
				redirect('ad-manage/league');
		
		}else{						
			$value_return = $this->upload_pic('league_image');
			extract($value_return);
			if($status == 'success'){
				
					$sql = "UPDATE fb_leagues SET national_id='$national_id', league_name='$league_name', league_image='$new_name', league_table='$league_table',
								league_detail='$league_detail', league_order='$league_order',modified='".date('Y-m-d H:i:s')."' WHERE league_id = $league_id";
					$this->db->query($sql);
					if($league_image_old!=''){
						unlink(FCPATH.'images/uploads/'.$league_image_old); // ลบภาพเก่าออก
						unlink(FCPATH.'images/uploads/S/'.$league_image_old); // ลบภาพเก่าออก
					}					
					$this->session->set_flashdata('msg_success','แก้ไขเรียบร้อย !!');
					redirect('ad-manage/league');
			}else{
					$this->session->set_flashdata('msg_error', $data);
					redirect('ad-manage/league');
			}
		}
	}
	
	public function league_delete(){
		$this->check_admin_login();		
		$sql = "UPDATE fb_leagues SET league_status=0, modified='".date('Y-m-d H:i:s')."' WHERE league_id = ".$this->input->post('league_id')."";
		$this->db->query($sql);
		$this->session->set_flashdata('msg_success','ลบเรียบร้อย !!');
		redirect('ad-manage/league');
	}
	
	public function league_by_national_id(){
		$rs_league = $this->league_model->select_league_by_national($this->input->post('id'));
		$league = array();
		$counter = 0;
		foreach($rs_league->result() as $row_league){
				foreach ($row_league as $key=>$value)
				{
					$league[$counter][$key] = $value;
				}
			$counter++;
		}
		$data = json_encode($league);
		echo $data;
	}
	
	//+ สโมสร
	public function club(){
		$this->check_admin_login();
		$Content['rs_national'] = $this->national_model->select_national_all();
		$Content['rs_league'] = $this->league_model->select_league_all();
		$data['Content'] = $this->load->view('ad-manage/club_index', $Content, true);
		$this->load->view('template/temp_admin', $data);
	}
	
	public function club_all(){
		/* Array of database columns which should be read and sent back to DataTables. Use a space where
		* you want to insert a non-database field (for example a counter or static image)
		*/
		$aColumns = array('national_name','league_name','club_name','club_image','club_id');

		// DB table to use
		$sTable = 'fb_clubs';
		
		$iDisplayStart = $this->input->get_post('iDisplayStart', true);
		$iDisplayLength = $this->input->get_post('iDisplayLength', true);
		$iSortCol_0 = $this->input->get_post('iSortCol_0', true);
		$iSortingCols = $this->input->get_post('iSortingCols', true);
		$sSearch = $this->input->get_post('sSearch', true);
		$sEcho = $this->input->get_post('sEcho', true);

		// Paging
		if(isset($iDisplayStart) && $iDisplayLength != '-1')
		{
			$this->db->limit($this->db->escape_str($iDisplayLength), $this->db->escape_str($iDisplayStart));
		}

		// Ordering
		if(isset($iSortCol_0))
		{
			for($i=0; $i<intval($iSortingCols); $i++)
			{
				$iSortCol = $this->input->get_post('iSortCol_'.$i, true);
				$bSortable = $this->input->get_post('bSortable_'.intval($iSortCol), true);
				$sSortDir = $this->input->get_post('sSortDir_'.$i, true);

				if($bSortable == 'true')
				{
					$this->db->order_by($aColumns[intval($this->db->escape_str($iSortCol))], $this->db->escape_str($sSortDir));
				}
			}
		}

		/*
		 * Filtering
		 * NOTE this does not match the built-in DataTables filtering which does it
		 * word by word on any field. It's possible to do here, but concerned about efficiency
		 * on very large tables, and MySQL's regex functionality is very limited
		 */
		if(isset($sSearch) && !empty($sSearch)){
			for($i=0; $i<=count($aColumns); $i++)
			{
				$bSearchable = $this->input->get_post('bSearchable_'.$i, true);

				// Individual column filtering
				if(isset($bSearchable) && $bSearchable == 'true'){
					//if($aColumns[$i]=='created'){
						//(preg_match('/^\d{4}-\d{2}-\d{2}$/', $sSearch))? $this->db->or_like($aColumns[$i], $this->db->escape_like_str($sSearch)) : '';
					//}else{
						$like[] = $aColumns[$i]." LIKE '%".$this->db->escape_like_str($sSearch)."%'";
					//}
				}
			}
		}
		if(isset($like) && !empty($like)){
			$where = "(".implode(" OR ", $like).")";
			$this->db->where($where, NULL, FALSE);
		}
		$this->db->where('club_status', 1);
		

		// Select Data
		$this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
		$this->db->join('fb_nationals', 'fb_clubs.national_id = fb_nationals.national_id');
		$this->db->join('fb_leagues', 'fb_clubs.league_id = fb_leagues.league_id');
		$rResult = $this->db->get($sTable);

		// Data set length after filtering
		$this->db->select('FOUND_ROWS() AS found_rows');
		$iFilteredTotal = $this->db->get()->row()->found_rows;

		// Total data set length
		$iTotal = $this->db->count_all($sTable);

		// Output
		$output = array(
			'sEcho' => intval($sEcho),
			'iTotalRecords' => $iTotal,
			'iTotalDisplayRecords' => $iFilteredTotal,
			'aaData' => array()
		);		
		
		foreach($rResult->result() as $aRow){
			$iDisplayStart = $iDisplayStart+1; //+ นำค่าเริ่มต้นการแบ่งหน้า มาบวก 1 เพื่อแสดงจำนวนรายการแต่ละหน้า
			$row = array();
			$row[0] = $iDisplayStart;			
			$row[1] = $aRow->national_name;
			$row[2] = $aRow->league_name;
			$row[3] = $aRow->club_name;
			$row[4] = '<img src="'.base_url("images/uploads/S/".$aRow->club_image).'" width="30"/>';
			$row[5] = $aRow->club_id;		
			$output['aaData'][] = $row;			
		}		 
		echo json_encode($output);
	}
	
	public function club_add_operate(){
		$this->check_admin_login();
		$national_id = $this->input->post('national_id');
		$league_id = $this->input->post('league_id');
		$club_name = $this->input->post('club_name');
		
		if(!is_uploaded_file($_FILES['club_image']['tmp_name'])){
			
				$sql = "INSERT INTO fb_clubs(national_id, league_id, club_name, club_image, created) VALUES ('$national_id', '$league_id', '$club_name', 'default.jpg', '".date('Y-m-d H:i:s')."')";
				$this->db->query($sql);
				$this->session->set_flashdata('msg_success','เพิ่มเรียบร้อย !!');
				redirect('ad-manage/club');
				
		}else{			
			$value_return = $this->upload_pic('club_image');
			extract($value_return);
			if($status == 'success'){
				
					$sql = "INSERT INTO fb_clubs(national_id, league_id, club_name, club_image, created) VALUES ('$national_id', '$league_id', '$club_name', '$new_name', '".date('Y-m-d H:i:s')."')";
					$this->db->query($sql);					
					$this->session->set_flashdata('msg_success','เพิ่มเรียบร้อย !!');
					redirect('ad-manage/club');
					
			}else{
					$this->session->set_flashdata('msg_error', $data);
					redirect('ad-manage/club');
			}
		}
	}
	
	public function club_view(){
		$this->check_admin_login();
		$Content['rs_national'] = $this->national_model->select_national_all();
		$Content['rs_league'] = $this->league_model->select_league_all();
		$Content['row_club'] = $this->club_model->select_club_id($this->uri->segment(3,0));
		$data['Content'] = $this->load->view('ad-manage/club_view', $Content, true);
		$this->load->view('template/temp_admin', $data);
	}
	
	public function club_edit_operate(){
		$this->check_admin_login();
		$national_id = $this->input->post('national_id');
		$league_id = $this->input->post('league_id');
		$club_image_old = $this->input->post('club_image_old');
		$club_name = $this->input->post('club_name');
		$club_id = $this->input->post('club_id');		
		
		if(!is_uploaded_file($_FILES['club_image']['tmp_name'])){
			
				$sql = "UPDATE fb_clubs SET national_id='$national_id', league_id='$league_id', club_name='$club_name', modified='".date('Y-m-d H:i:s')."' WHERE club_id = $club_id";
				$this->db->query($sql);				
				$this->session->set_flashdata('msg_success', 'แก้ไขเรียบร้อย !!');
				redirect('ad-manage/club');
				
		}else{						
			$value_return = $this->upload_pic('club_image');
			extract($value_return);
			if($status == 'success'){
				
					$sql = "UPDATE fb_clubs SET national_id='$national_id', league_id='$league_id', club_name='$club_name', club_image='$new_name', modified='".date('Y-m-d H:i:s')."' WHERE club_id = $club_id";
					$this->db->query($sql);
					if($club_image_old!=''){
						unlink(FCPATH.'images/uploads/'.$club_image_old); // ลบภาพเก่าออก
						unlink(FCPATH.'images/uploads/S/'.$club_image_old); // ลบภาพเก่าออก
					}					
					$this->session->set_flashdata('msg_success', 'แก้ไขเรียบร้อย !!');
					redirect('ad-manage/club');
					
			}else{
					$this->session->set_flashdata('msg_error', $data);
					redirect('ad-manage/club');
			}
		}
	}
	
	public function club_delete(){
		$this->check_admin_login();
		$sql = "UPDATE fb_clubs SET club_status=0, modified='".date('Y-m-d H:i:s')."' WHERE club_id = ".$this->input->post('club_id')."";
		$this->db->query($sql);
		$this->session->set_flashdata('msg_success', 'ลบเรียบร้อย !!');
		redirect('ad-manage/club');
	}
	
	public function club_by_league_id(){
		$this->check_admin_login();
		$rs_club = $this->club_model->select_club_by_league($this->input->post('id'));
		$club = array();
		$counter = 0;
		foreach($rs_club->result() as $row_club){
				foreach ($row_club as $key=>$value)
				{
					$club[$counter][$key] = $value;
				}
			$counter++;
		}
		$data = json_encode($club);
		echo $data;
	}
	
	//+ สมาชิก
	public function member(){
		$this->check_admin_login();
		$data['Content'] = $this->load->view('ad-manage/member_index', NULL, true);
		$this->load->view('template/temp_admin', $data);
	}
	
	public function member_all(){
		/* Array of database columns which should be read and sent back to DataTables. Use a space where
		* you want to insert a non-database field (for example a counter or static image)
		*/
		$aColumns = array(1=>'nickname',2=>'email',3=>'registerdate');

		// DB table to use
		$sTable = 'fb_members';
		
		$iDisplayStart = $this->input->get_post('iDisplayStart', true);
		$iDisplayLength = $this->input->get_post('iDisplayLength', true);
		$iSortCol_0 = $this->input->get_post('iSortCol_0', true);
		$iSortingCols = $this->input->get_post('iSortingCols', true);
		$sSearch = $this->input->get_post('sSearch', true);
		$sEcho = $this->input->get_post('sEcho', true);

		// Paging
		if(isset($iDisplayStart) && $iDisplayLength != '-1')
		{
			$this->db->limit($this->db->escape_str($iDisplayLength), $this->db->escape_str($iDisplayStart));
		}

		// Ordering
		if(isset($iSortCol_0))
		{
			for($i=0; $i<intval($iSortingCols); $i++)
			{
				$iSortCol = $this->input->get_post('iSortCol_'.$i, true);
				$bSortable = $this->input->get_post('bSortable_'.intval($iSortCol), true);
				$sSortDir = $this->input->get_post('sSortDir_'.$i, true);

				if($bSortable == 'true')
				{
					$this->db->order_by($aColumns[intval($this->db->escape_str($iSortCol))], $this->db->escape_str($sSortDir));
				}
			}
		}

		/*
		 * Filtering
		 * NOTE this does not match the built-in DataTables filtering which does it
		 * word by word on any field. It's possible to do here, but concerned about efficiency
		 * on very large tables, and MySQL's regex functionality is very limited
		 */
		if(isset($sSearch) && !empty($sSearch)){
			for($i=1; $i<=count($aColumns); $i++)
			{
				$bSearchable = $this->input->get_post('bSearchable_'.$i, true);

				// Individual column filtering
				if(isset($bSearchable) && $bSearchable == 'true'){
					//if($aColumns[$i]=='created'){
						//(preg_match('/^\d{4}-\d{2}-\d{2}$/', $sSearch))? $this->db->or_like($aColumns[$i], $this->db->escape_like_str($sSearch)) : '';
					//}else{
						$like[] = $aColumns[$i]." LIKE '%".$this->db->escape_like_str($sSearch)."%'";
					//}
				}
			}
		}
		if(isset($like) && !empty($like)){
			$where = "(".implode(" OR ", $like).")";
			$this->db->where($where, NULL, FALSE);
		}	

		// Select Data
		$this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
		$rResult = $this->db->get($sTable);

		// Data set length after filtering
		$this->db->select('FOUND_ROWS() AS found_rows');
		$iFilteredTotal = $this->db->get()->row()->found_rows;

		// Total data set length
		$iTotal = $this->db->count_all($sTable);

		// Output
		$output = array(
			'sEcho' => intval($sEcho),
			'iTotalRecords' => $iTotal,
			'iTotalDisplayRecords' => $iFilteredTotal,
			'aaData' => array()
		);		
		
		foreach($rResult->result() as $aRow){
			$iDisplayStart = $iDisplayStart+1; //+ นำค่าเริ่มต้นการแบ่งหน้า มาบวก 1 เพื่อแสดงจำนวนรายการแต่ละหน้า
			$row = array();
			$row[0] = $iDisplayStart;			
			$row[1] = $aRow->nickname;
			$row[2] = $aRow->email;
			$row[3] = $aRow->registerdate;	
			$output['aaData'][] = $row;			
		}		 
		echo json_encode($output);
	}
	
	//+ gameweek
	public function gameweek(){
		$this->check_admin_login();
		$Content['rs_gameweek'] = $this->gameweek_model->get_all();
		$data['Content'] = $this->load->view('ad-manage/gameweek_view', $Content, true);
		$this->load->view('template/temp_admin', $data);
	}
	
	public function gameweek_edit_operate(){
		$this->check_admin_login();
		$gw_id = $this->input->post('gw_id');
		$gw_datetime = $this->input->post('gw_datetime');
		//print_r($gw_datetime[1]); die();
		$gw_display = $this->input->post('gw_display');
		foreach($gw_id as $key=>$value){
			$sql = "UPDATE fb_gameweek SET gw_datetime='".$gw_datetime[$key]."'";
						
			if($gw_display==$key){
				$sql .= ", gw_display='y'";
			}else{
				$sql .= ", gw_display='n'";
			}
			
			$sql .= " WHERE gw_id = ".$key."";
			$this->db->query($sql);
		}
		$this->session->set_flashdata('msg_success', 'แก้ไขเรียบร้อย !!');
		redirect('ad-manage/gameweek');
	}
		
	//+  คู่แข่งขัน
	public function match(){
		$this->check_admin_login();
		$Content['rs_gameweek'] = $this->gameweek_model->get_all();
		$Content['rs_national'] = $this->national_model->select_national_all();
		$Content['rs_league'] = $this->league_model->select_league_all();
		$data['Content'] = $this->load->view('ad-manage/match_index', $Content, true);
		$this->load->view('template/temp_admin', $data);
	}
		
	public function match_all(){
		/* Array of database columns which should be read and sent back to DataTables. Use a space where
		* you want to insert a non-database field (for example a counter or static image)
		*/
		$aColumns = array(1=>'league_name',2=>'club_home.club_name AS club_home_name',3=>'club_away.club_name AS club_away_name',4=>'match_date',5=>'gw_id',6=>'match_special',7=>'match_score_status',8=>'match_id');

		// DB table to use
		$sTable = 'fb_match';
		
		$iDisplayStart = $this->input->get_post('iDisplayStart', true);
		$iDisplayLength = $this->input->get_post('iDisplayLength', true);
		$iSortCol_0 = $this->input->get_post('iSortCol_0', true);
		$iSortingCols = $this->input->get_post('iSortingCols', true);
		$sSearch = $this->input->get_post('sSearch', true);
		$sEcho = $this->input->get_post('sEcho', true);

		// Paging
		if(isset($iDisplayStart) && $iDisplayLength != '-1')
		{
			$this->db->limit($this->db->escape_str($iDisplayLength), $this->db->escape_str($iDisplayStart));
		}

		// Ordering
		if(isset($iSortCol_0))
		{
			for($i=0; $i<intval($iSortingCols); $i++)
			{
				$iSortCol = $this->input->get_post('iSortCol_'.$i, true);
				$bSortable = $this->input->get_post('bSortable_'.intval($iSortCol), true);
				$sSortDir = $this->input->get_post('sSortDir_'.$i, true);

				if($bSortable == 'true'){
					if($aColumns[intval($this->db->escape_str($iSortCol))]=='club_home.club_name AS club_home_name'){
						$this->db->order_by('club_home.club_name', $this->db->escape_str($sSortDir));
					}elseif($aColumns[intval($this->db->escape_str($iSortCol))]=='club_away.club_name AS club_away_name'){
						$this->db->order_by('club_away.club_name', $this->db->escape_str($sSortDir));
					}else{
						$this->db->order_by($aColumns[intval($this->db->escape_str($iSortCol))], $this->db->escape_str($sSortDir));				
					}
					
				}
			}
		}
		
		/*
		 * Filtering
		 * NOTE this does not match the built-in DataTables filtering which does it
		 * word by word on any field. It's possible to do here, but concerned about efficiency
		 * on very large tables, and MySQL's regex functionality is very limited
		 */
		if(isset($sSearch) && !empty($sSearch)){
			for($i=1; $i<=count($aColumns); $i++){
				
				$bSearchable = $this->input->get_post('bSearchable_'.$i, true);

				// Individual column filtering
				if(isset($bSearchable) && $bSearchable == 'true'){
					if($aColumns[$i]=='match_date'){
						(preg_match('/^\d{4}-\d{2}-\d{2}$/', $sSearch))? $like[] = $aColumns[$i]." LIKE '%".$this->db->escape_like_str($sSearch)."%'" : '';
					}elseif($aColumns[$i]=='club_home.club_name AS club_home_name'){
						$like[] = "club_home.club_name LIKE '%".$this->db->escape_like_str($sSearch)."%'";
					}elseif($aColumns[$i]=='club_away.club_name AS club_away_name'){
						$like[] = "club_away.club_name LIKE '%".$this->db->escape_like_str($sSearch)."%'";
					}else{
						$like[] = $aColumns[$i]." LIKE '%".$this->db->escape_like_str($sSearch)."%'";						
					}
				}
			}
		}
		if(isset($like) && !empty($like)){
			$where = "(".implode(" OR ", $like).")";
			$this->db->where($where, NULL, FALSE);
		}
		$this->db->where('match_status', 1);
		
		// Select Data
		$this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
		$this->db->join('fb_nationals', 'fb_nationals.national_id = fb_match.national_id');
		$this->db->join('fb_leagues', 'fb_leagues.league_id = fb_match.league_id');
		$this->db->join('fb_clubs AS club_home', 'club_home.club_id = fb_match.club_home_id');
		$this->db->join('fb_clubs AS club_away', 'club_away.club_id = fb_match.club_away_id');
		$rResult = $this->db->get($sTable);

		// Data set length after filtering
		$this->db->select('FOUND_ROWS() AS found_rows');
		$iFilteredTotal = $this->db->get()->row()->found_rows;

		// Total data set length
		$iTotal = $this->db->count_all($sTable);

		// Output
		$output = array(
			'sEcho' => intval($sEcho),
			'iTotalRecords' => $iTotal,
			'iTotalDisplayRecords' => $iFilteredTotal,
			'aaData' => array()
		);		
		
		foreach($rResult->result() as $aRow){
			$iDisplayStart = $iDisplayStart+1; //+ นำค่าเริ่มต้นการแบ่งหน้า มาบวก 1 เพื่อแสดงจำนวนรายการแต่ละหน้า
			$row = array();
			$row[0] = $iDisplayStart;		
			$row[1] = $aRow->league_name;
			$row[2] = $aRow->club_home_name;
			$row[3] = $aRow->club_away_name;
			$row[4] = $aRow->match_date;
			$row[5] = $aRow->gw_id;
			$row[6] = $aRow->match_special;
			$row[7] = $aRow->match_score_status;
			$row[8] = $aRow->match_id;		
			$output['aaData'][] = $row;			
		}		 
		echo json_encode($output);
	}
		
	public function match_add_operate(){
		$this->check_admin_login();
		$post = $this->input->post();
		extract($post);
		$match_special = isset($match_special)?$match_special:'n';
		$match_live = isset($match_live)?$match_live:'n';
		$sql = "INSERT INTO fb_match(gw_id,national_id, league_id, club_home_id, club_away_id, match_date, match_rate, team_handicap,match_special,match_live, created) 
					VALUES ('$gw_id','$national_id', '$league_id', '$club_home_id', '$club_away_id', '$match_date', '$match_rate', '$team_handicap','$match_special','$match_live', '".date('Y-m-d H:i:s')."')";
		$this->db->query($sql);		
		$this->session->set_flashdata('msg_success', 'เพิ่มเรียบร้อย !!');
		redirect('ad-manage/match');	
	}
	
	public function match_view(){
		$this->check_admin_login();
		$Content['rs_gameweek'] = $this->gameweek_model->get_all();
		$Content['rs_national'] = $this->national_model->select_national_all();
		$Content['rs_league'] = $this->league_model->select_league_all();
		$Content['row_match'] = $this->match_model->get_by_id($this->uri->segment(3,0));
		$data['Content'] = $this->load->view('ad-manage/match_view', $Content, true);
		$this->load->view('template/temp_admin', $data);
	}
	
	public function match_edit_operate(){
		$this->check_admin_login();
		$post = $this->input->post();
		extract($post);			
		$match_special = isset($match_special)?$match_special:'n';
		$match_live = isset($match_live)?$match_live:'n';		
		$sql = "UPDATE fb_match SET gw_id='$gw_id', national_id='$national_id', league_id='$league_id', club_home_id='$club_home_id', club_away_id='$club_away_id', match_date='$match_date', match_rate='$match_rate', team_handicap='$team_handicap',match_special='$match_special',match_live='$match_live', modified='".date('Y-m-d H:i:s')."' WHERE match_id = $match_id";
		$this->db->query($sql);		
		$this->session->set_flashdata('msg_success', 'แก้ไขเรียบร้อย !!');
		redirect('ad-manage/match');
	}
	
	public function match_delete(){
		$this->check_admin_login();
		$match_id = $this->input->post('match_id');	
		
		$sql = "DELETE FROM fb_match WHERE match_id = $match_id";
		$this->db->query($sql);	
		//$sql = "DELETE FROM fb_step WHERE match_id = $match_id";
		//$this->db->query($sql);	
		$sql = "DELETE FROM fb_teng WHERE match_id = $match_id";
		$this->db->query($sql);	
			
		$this->session->set_flashdata('msg_success', 'ลบเรียบร้อย !!');
		redirect('ad-manage/match');
	}
	
	//+ ฟังชั่นก์เช็คคะแนนฝั่งเจ้าบ้านต่อ
	public function predict_home($rate, $home_score, $away_score){		
		$score = $home_score-$away_score;
		$t_score = $score-$rate;
		return $t_score;
	}
	
	//+ ฟังชั่นก์เช็คคะแนนฝั่งทีมเยือนต่อ
	public function predict_away($rate, $home_score, $away_score){
		$score = $home_score+$rate;
		$t_score = $score-$away_score;
		return $t_score;
	}
	
	public function match_score_operate(){
		$this->check_admin_login();
		$post = $this->input->post();
		if($post){
			extract($post);
			$sql = "UPDATE fb_match SET club_home_score='$club_home_score', club_away_score='$club_away_score', match_score_status='y', modified='".date('Y-m-d H:i:s')."' WHERE match_id=$match_id";
			$result = $this->db->query($sql);
					
			$row_match = $this->match_model->get_by_id($match_id); //+ เลือกแมตช์นี้มาเพื่อดูราคา
			
			$teng_score_win = 1; //+ คะแนน
			$teng_score_lost = 0; //+ คะแนน
			$club_home_order = $row_match->club_home_order; //ใช้เป็นคะแนนสัมประสิทธิ์คู่พิเศษ
			$club_away_order = $row_match->club_away_order; //ใช้เป็นคะแนนสัมประสิทธิ์คู่พิเศษ
			
			if($row_match->match_special=='y'){
				$teng_score_win = 2; //+ คะแนนพิเศษ
				$teng_score_lost = -1; //+ คะแนนพิเศษ
			}
			
			if($club_home_score>$club_away_score){ //+ ถ้าเจ้าบ้านชนะ
								
				//+ ปรับให้บอลเต็ง คนที่เลือก เจ้าบ้าน เป็น 1
				$data = array(
					'teng_score'=>$teng_score_win,
					'teng_result'=>'w',
					'teng_coefficient'=>$club_home_order,
					'modified'=>date('Y-m-d H:i:s')
				);
				$this->db->where('teng_predict', 'h');
				$this->db->where('match_id', $match_id);
				$result = $this->db->update('fb_teng', $data);
				
				//+ ปรับให้บอลเต็ง คนที่เลือกทีมเยือน กับ เสมอ เป็น 0
				$data = array(
					'teng_score'=>$teng_score_lost,
					'teng_result'=>'l',
					'teng_coefficient'=>0,
					'modified'=>date('Y-m-d H:i:s')
				);
				$this->db->where_in('teng_predict', array('a','al'));
				$this->db->where('match_id', $match_id);
				$result = $this->db->update('fb_teng', $data);
				
			}
			
			if($club_home_score==$club_away_score){ //+ หากเสมอ
				//+ ปรับให้บอลเต็ง คนที่เลือก เสมอ เป็น 1
				$data = array(
					'teng_score'=>$teng_score_win,
					'teng_result'=>'w',
					'teng_coefficient'=>($club_home_order+$club_away_order),
					'modified'=>date('Y-m-d H:i:s')
				);
				$this->db->where('teng_predict', 'al');
				$this->db->where('match_id', $match_id);
				$result = $this->db->update('fb_teng', $data);
				
				//+ ปรับให้บอลเต็ง คนที่เลือก เจ้าบ้าน และ ทีมเยือน เป็น 0
				$data = array(
					'teng_score'=>$teng_score_lost,
					'teng_result'=>'l',
					'teng_coefficient'=>0,
					'modified'=>date('Y-m-d H:i:s')
				);
				$this->db->where_in('teng_predict', array('a','h'));
				$this->db->where('match_id', $match_id);
				$result = $this->db->update('fb_teng', $data);
			}
			
			if($club_home_score<$club_away_score){ //+ หากทีมเยือนชนะ
				//+ ปรับให้บอลเต็ง คนที่เลือก ทีมเยือน เป็น 1
				$data = array(
					'teng_score'=>$teng_score_win,
					'teng_result'=>'w',
					'teng_coefficient'=>$club_away_order,
					'modified'=>date('Y-m-d H:i:s')
				);
				$this->db->where('teng_predict', 'a');
				$this->db->where('match_id', $match_id);
				$result = $this->db->update('fb_teng', $data);
				
				//+ ปรับให้บอลเต็ง คนที่เลือก เจ้าบ้าน กับ เสมอ เป็น 0
				$data = array(
					'teng_score'=>$teng_score_lost,
					'teng_result'=>'l',
					'teng_coefficient'=>0,
					'modified'=>date('Y-m-d H:i:s')
				);
				$this->db->where_in('teng_predict', array('h','al'));
				$this->db->where('match_id', $match_id);
				$result = $this->db->update('fb_teng', $data);
			}
			
			$this->session->set_flashdata('msg_success', 'เพิ่มผลเรียบร้อย !!');
			redirect('ad-manage/match-view/'.$match_id.'#score');
		} // End if($post){
	}		
	
	//+ สมาชิก
	public function memberscore(){
		$this->check_admin_login();		
				
		$gw_start = $this->input->post('gw_start');
		$gw_end = $this->input->post('gw_end');

		$this->db->select('fb_members.nickname,COUNT(fb_teng.match_id) AS teng_match,SUM(teng_score) AS teng_score,SUM(teng_coefficient) AS teng_coefficient');
		$this->db->join('fb_teng', 'fb_teng.member_id = fb_members.member_id');
		$this->db->join('fb_match', 'fb_match.match_id = fb_teng.match_id');
		//$this->db->where('teng_result IS NOT NULL');
		if($gw_start!=''&&$gw_end!=''){
			$this->db->where('fb_teng.gw_id BETWEEN "'.$gw_start.'" AND "'.$gw_end.'"');
		}
		$this->db->group_by('fb_members.member_id');
		$this->db->order_by('teng_score','desc');
		$this->db->order_by('teng_coefficient','desc');
		$this->db->order_by('fb_members.nickname','asc');
		$rs_memberscore= $this->db->get('fb_members');
		
		$Content['rs_memberscore'] = $rs_memberscore;
		$Content['gw_start'] = $gw_start;
		$Content['gw_end'] = $gw_end;
		$Content['rs_gameweek'] = $this->gameweek_model->get_all();
		$data['Content'] = $this->load->view('ad-manage/memberscore_index', $Content, true);
		$this->load->view('template/temp_admin', $data);
	}
}