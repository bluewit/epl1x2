<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once(dirname(__FILE__).'/Ad_manage.php');

class Table_score extends Ad_manage{
	
	public function __construct(){
		parent::__construct();
		//$this->check_admin_login();
		$this->load->library('Teamtable');
	}

	public function index(){
		$Content['tables'] = array(
		'พรีเมียร์ลีก'=>'92',
		'ลาลีก้า' =>'85',
		'บุนเดสลีกา' =>'39',
		'กัลโช่ เซเรีย อา' =>'34',
		'ลีกเอิง' =>'93',
		'ไทยพรีเมียร์ลีก' =>'722',
		);
		$this->load->view('table-score/index_view', $Content);
	}
	
	private function translate_teamname($teamnamech){
		$teamnameth = array(
			'阿仙奴'=>'อาร์เซน่อล',
			'曼城'=>'แมนฯ ซิตี้',
			'熱刺'=>'สเปอร์ส',
			'白禮頓'=>'ไบรท์ตัน',
			'曼聯'=>'แมนฯ ยูไนเต็ด',
			'車路士'=>'เชลซี',
			'利物浦'=>'ลิเวอร์พูล',
			'賓福特'=>'เบรนท์ฟอร์ด',
			'列斯聯'=>'ลีดส์',			
			'富咸'=>'ฟูแล่ม',
			'紐卡素'=>'นิวคาสเซิ่ล',
			'修咸頓'=>'เซาธ์แฮมป์ตัน',
			'般尼茅夫'=>'บอร์นมัธ',
			'狼隊'=>'วูล์ฟ',
			'水晶宮'=>'คริสตัล พาเลซ',
			'愛華頓'=>'เอฟเวอร์ตัน',
			'阿士東維拉'=>'แอสตัน วิลล่า',
			'韋斯咸'=>'เวสต์แฮม',
			'諾定咸森林'=>'ฟอเรสต์',
			'李斯特城'=>'เลสเตอร์ ซิตี้'
		);
		return $teamnameth[$teamnamech];
	}
	
	public function update($leage_id=NULL){
		if(!$leage_id){
			$leage_id =$this->input->post('leage_id');
		}
		
			$res = $this->teamtable->get_table($leage_id);
			
			if(!$res){
				echo 'ดึงข้อมูลไม่ได้ขณะนี้';
				exit;
			}
			
			$teams = $this->teamtable->teams($res);
			$matches = $this->teamtable->matches($res);
			$win = $this->teamtable->win($res);
			$drawn = $this->teamtable->drawn($res);
			$lost = $this->teamtable->lost($res);
			$goal_for = $this->teamtable->goal_for($res);
			$goal_against = $this->teamtable->goal_against($res);
			$pts = $this->teamtable->pts($res);
			
			$cache = '<table class="standing">
						<thead>
							<tr class="roll_team">
								<td class="tb_rank">อันดับ</td>
								<td class="tb_team">ทีม</td>
								<td class="tb_match text-center">แข่ง</td>
								<td class="tb_win text-center">ชนะ</td>
								<td class="tb_draw text-center">เสมอ</td>
								<td class="tb_lost text-center">แพ้</td>
								<td class="tb_ga text-center">ได้</td>
								<td class="tb_gd text-center">เสีย</td>
								<td class="tb_point text-center">คะแนน</td>
							</tr>
						</thead>
						<tbody>';
			
			$cache_mini = '<table class="standing" id="league_'.$leage_id.'" width="100%">
						<thead>
							<tr class="roll_team">
								<td class="tb_rank"></td>
								<td class="tb_team">ทีม</td>
								<td class="tb_match text-center">แข่ง</td>
								<td class="tb_win text-center">ชนะ</td>
								<td class="tb_draw text-center">เสมอ</td>
								<td class="tb_lost text-center">แพ้</td>
								<td class="tb_point text-center">คะแนน</td>
							</tr>
						</thead>
						<tbody>';
									
			$i=1;
			foreach($teams AS $index=> $team){
				$teamnameth = $this->translate_teamname(trim($team));

				switch($i){
					case 1:
					case 2:
					case 3:
					case 4:
						$rating = '<span class="cellRating" style="background-color: rgb(0, 70, 130); color: white;">'.$i.'</span>';
						break;
					case 5:
						$rating = '<span class="cellRating" style="background-color: rgb(127, 0, 41); color: white;">'.$i.'</span>';
						break;
					case 18:
					case 19:
					case 20:
						$rating = '<span class="cellRating" style="background-color: rgb(189, 0, 0); color: white;">'.$i.'</span>';
						break;
					default:
						$rating = '<span class="cellRating">'.$i.'</span>';
						break;					
				}
				
				$cache.='<tr class="roll_point">
						<td class="tb_rank">'.$rating.'</td>
						<td class="tb_team">'.$teamnameth.'</td>
						<td class="tb_match text-center">'.trim($matches[$index]).'</td>
						<td class="tb_win text-center">'.trim($win[$index]).'</td>
						<td class="tb_draw text-center">'.trim($drawn[$index]).'</td>
						<td class="tb_lost text-center">'.trim($lost[$index]).'</td>
						<td class="tb_ga text-center">'.trim($goal_for[$index]).'</td>
						<td class="tb_gd text-center">'.trim($goal_against[$index]).'</td>
						<td class="tb_point text-center">'.trim($pts[$index]).'</td>
					</tr>';
					
				//if($i <=10){	
				$cache_mini.='<tr class="roll_point">
					<td class="tb_rank">'.$rating.'</td>
					<td class="tb_team">'.$this->translate_teamname(trim($team)).'</td>
					<td class="tb_match text-center">'.trim($matches[$index]).'</td>
					<td class="tb_win text-center">'.trim($win[$index]).'</td>
					<td class="tb_draw text-center">'.trim($drawn[$index]).'</td>
					<td class="tb_lost text-center">'.trim($lost[$index]).'</td>
					<td class="tb_point text-center">'.trim($pts[$index]).'</td>
				</tr>';
				//} //if เอาทั้งหมด
				
				// อัพเดทอันดับลงตาราง
				$this->db->update('fb_clubs',array('club_order'=>$i),array('club_name'=>$teamnameth));
				
				$i++;
			}
			$cache .= '</tbody></table>';				
			$cache_mini .= '</tbody></table>';
			
			$path = APPPATH.'views/table-score/cache/table_'.$leage_id.'.php';
			write_file($path,$cache);
			
			$path_mini = APPPATH.'views/table-score/cache/table_mini_'.$leage_id.'.php';
			write_file($path_mini,$cache_mini);
			echo '<meta charset="utf-8"/><span style="color:green">อับเดท OK</span>';
						
	}
		
	//+ auto update form cron job
	public function auto_update(){
		//$tables = array('92','85','39','34','93','722');
		$tables = array('92');
		foreach($tables AS $table){
			$this->update($table);
		}		
	}
			
}