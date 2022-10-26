<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shooter extends CI_Controller{
		
	public function __construct(){
		parent::__construct();
	}
	
	public function get_table($leage_id){
		//$url = 'http://data2.7m.cn/matches_data/'.$leage_id.'/en/shooter.js';
		$url = 'http://data.7m.cn/matches_data/'.$leage_id.'/en/shooter.js';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:31.0) Gecko/20100101 Firefox/31.0"			);
		curl_setopt($ch, CURLOPT_REFERER, 'http://data.7m.cn/matches_data/'.$leage_id.'/th/shooter.shtml');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$content = curl_exec($ch);
		curl_close($ch);
		return $content;
	}
	
	public function players($data){
		preg_match('/var Shooters = \[(.*)\]\;/',$data,$players);
		$search = array('\'', '[', ']');
		$replace = array('', '', '');
		$players = str_replace($search, $replace ,$players[1]);		
		$players = preg_replace('/\s*,\s*/', ',', $players);
		$players = preg_replace('/([^0-9]),([^0-9])/','$1$2', $players); 
		$players = explode(',', $players);
		$players = array_chunk($players, 8);	
		return $players;
	}
		
	public function head_table(){
		$head = '<table class="shooter">
						<thead>
							<tr>
								<td class="tb_rank">ลำดับ</td>
								<td class="tb_player">นักฟุตบอล</td>
								<td class="tb_team">ทีม</td>
								<td class="tb_total">รวม(จุดโทษ)</td>
							</tr>
						</thead>
						<tbody>';
			return $head;
	}
	
	public function foot_table(){
		$foot = '</tbody></table>';
		return $foot; 
	}
	
	public function update($leage_id=NULL){
		if(!$leage_id){
			$leage_id =$this->input->post('leage_id');
		}
		
			$res = $this->get_table($leage_id);
			
			if(!$res){
				echo 'ดึงข้อมูลไม่ได้ขณะนี้';
				exit;
			}
			
			$players = $this->players($res);
			
			$table = $this->head_table();						
			foreach($players as $index=> $player){
				$table.='<tr>
						<td class="tb_rank">'.$player[0].'</td>
						<td class="tb_player">'.$player[4].'</td>
						<td class="tb_team">'.$player[2].'</td>
						<td class="tb_point">'.$player[6].'</td>
					</tr>';
			}
			$table .= $this->foot_table();
			
			$path = APPPATH.'views/shooter/shooters_'.$leage_id.'.php';
			write_file($path,$table);
			echo '<meta charset="utf-8"/><span style="color:green">อับเดท OK</span>';
						
	}
	
	//+ auto update form cron job
	public function auto_update(){
		$leagues = array('92','85','39','34','93','722');
		foreach($leagues as $league){
			$this->update($league);
		}		
	}
	
	public function en(){
		
		$d = $this->get_table(92);
		print_r($d);
		echo '<br /><br />';
		
		$players = $this->players($d);
		//print_r($players);
		//echo '<br /><br />';  
		
		//$players = preg_replace('/\s*,\s*/', ',', $players);
		//print_r($players);
		//echo '<br /><br />';  
		
		//$players = preg_replace('/([^0-9]),([^0-9])/','$1$2', $players); 
		//print_r($players);
		//echo '<br /><br />';  
						
		foreach($players as $index=> $player){
			print_r($player); echo'<br>';
		}
		
		echo '<br /><br />';	

		$table = $this->head_table();						
		foreach($players as $index=> $player){
			$table.='<tr>
					<td>'.$player[0].'</td>
					<td style="text-align:left;">'.$player[4].'</td>
					<td>'.$player[2].'</td>
					<td>'.$player[6].'</td>
				</tr>';
		}
		$table .= $this->foot_table();
			
		echo $table;
		
		$path_mini = APPPATH.'views/shooter/shooter_92.php';
		write_file($path_mini,$table);
		echo '<meta charset="utf-8"/><span style="color:green">อับเดท OK</span>';
				
	}
	
	public function sp(){
		
		$d = $this->get_table(85);
		print_r($d);
		echo '<br /><br />';
		
		$players = $this->players($d);
		//print_r($players);
		//echo '<br /><br />';  
		
		//$players = preg_replace('/\s*,\s*/', ',', $players);
		//print_r($players);
		//echo '<br /><br />';  
		
		//$players = preg_replace('/([^0-9]),([^0-9])/','$1$2', $players); 
		//print_r($players);
		//echo '<br /><br />'; 
			
		foreach($players as $index=> $player){
			print_r($player); echo'<br>';
		}
		
		echo '<br /><br />';	

		$table = $this->head_table();						
		foreach($players as $index=> $player){
			$table.='<tr>
					<td>'.$player[0].'</td>
					<td style="text-align:left;">'.$player[4].'</td>
					<td>'.$player[2].'</td>
					<td>'.$player[6].'</td>
				</tr>';
		}
		$table .= $this->foot_table();
				
		echo $table;
		
		$path_mini = APPPATH.'views/shooter/shooter_85.php';
		write_file($path_mini,$table);
		echo '<meta charset="utf-8"/><span style="color:green">อับเดท OK</span>';
				
	}
	
	public function ge(){
		
		$d = $this->get_table(39);
		print_r($d);
		echo '<br /><br />';
		
		$players = $this->players($d);
		//print_r($players);
		//echo '<br /><br />';  
		
		//$players = preg_replace('/\s*,\s*/', ',', $players);
		//print_r($players);
		//echo '<br /><br />';  
		
		//$players = preg_replace('/([^0-9]),([^0-9])/','$1$2', $players); 
		//print_r($players);
		//echo '<br /><br />'; 
			
		foreach($players as $index=> $player){
			print_r($player); echo'<br>';
		}
		
		echo '<br /><br />';	

		$table = $this->head_table();						
		foreach($players as $index=> $player){
			$table.='<tr>
					<td>'.$player[0].'</td>
					<td style="text-align:left;">'.$player[4].'</td>
					<td>'.$player[2].'</td>
					<td>'.$player[6].'</td>
				</tr>';
		}
		$table .= $this->foot_table();
				
		echo $table;
		
		$path_mini = APPPATH.'views/shooter/shooter_39.php';
		write_file($path_mini,$table);
		echo '<meta charset="utf-8"/><span style="color:green">อับเดท OK</span>';
				
	}
	
	public function it(){
		
		$d = $this->get_table(34);
		print_r($d);
		echo '<br /><br />';
		
		$players = $this->players($d);
		//print_r($players);
		//echo '<br /><br />';  
		
		//$players = preg_replace('/\s*,\s*/', ',', $players);
		//print_r($players);
		//echo '<br /><br />';  
		
		//$players = preg_replace('/([^0-9]),([^0-9])/','$1$2', $players); 
		//print_r($players);
		//echo '<br /><br />'; 
			
		foreach($players as $index=> $player){
			print_r($player); echo'<br>';
		}
		
		echo '<br /><br />';	

		$table = $this->head_table();						
		foreach($players as $index=> $player){
			$table.='<tr>
					<td>'.$player[0].'</td>
					<td style="text-align:left;">'.$player[4].'</td>
					<td>'.$player[2].'</td>
					<td>'.$player[6].'</td>
				</tr>';
		}
		$table .= $this->foot_table();
				
		echo $table;
		
		$path_mini = APPPATH.'views/shooter/shooter_34.php';
		write_file($path_mini,$table);
		echo '<meta charset="utf-8"/><span style="color:green">อับเดท OK</span>';
				
	}	
	
	public function fr(){
		
		$d = $this->get_table(93);
		print_r($d);
		echo '<br /><br />';
		
		$players = $this->players($d);
		//print_r($players);
		//echo '<br /><br />';  
		
		//$players = preg_replace('/\s*,\s*/', ',', $players);
		//print_r($players);
		//echo '<br /><br />';  
		
		//$players = preg_replace('/([^0-9]),([^0-9])/','$1$2', $players); 
		//print_r($players);
		//echo '<br /><br />'; 
			
		foreach($players as $index=> $player){
			print_r($player); echo'<br>';
		}
		
		echo '<br /><br />';	

		$table = $this->head_table();						
		foreach($players as $index=> $player){
			$table.='<tr>
					<td>'.$player[0].'</td>
					<td style="text-align:left;">'.$player[4].'</td>
					<td>'.$player[2].'</td>
					<td>'.$player[6].'</td>
				</tr>';
		}
		$table .= $this->foot_table();
				
		echo $table;
		
		$path_mini = APPPATH.'views/shooter/shooter_93.php';
		write_file($path_mini,$table);
		echo '<meta charset="utf-8"/><span style="color:green">อับเดท OK</span>';
				
	}	
	
	public function th(){
		
		$d = $this->get_table(722);
		print_r($d);
		echo '<br /><br />';
		
		$players = $this->players($d);
		//print_r($players);
		//echo '<br /><br />';  
		
		//$players = preg_replace('/\s*,\s*/', ',', $players);
		//print_r($players);
		//echo '<br /><br />';  
		
		//$players = preg_replace('/([^0-9]),([^0-9])/','$1$2', $players); 
		//print_r($players);
		//echo '<br /><br />'; 
		
		foreach($players as $index=> $player){
			print_r($player); echo'<br>';
		}
		
		echo '<br /><br />';	

		$table = $this->head_table();						
		foreach($players as $index=> $player){
			$table.='<tr>
					<td>'.$player[0].'</td>
					<td style="text-align:left;">'.$player[4].'</td>
					<td>'.$player[2].'</td>
					<td>'.$player[6].'</td>
				</tr>';
		}
		$table .= $this->foot_table();
				
		echo $table;
		
		$path_mini = APPPATH.'views/shooter/shooter_722.php';
		write_file($path_mini,$table);
		echo '<meta charset="utf-8"/><span style="color:green">อับเดท OK</span>';
				
	}
			
}