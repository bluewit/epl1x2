<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Teamtable {
		
        public function get_table($leage_id){
			//$url = 'http://data2.7m.cn/matches_data/'.$leage_id.'/th/standing.js';
			//$url = 'http://data.7m.cn/matches_data/'.$leage_id.'/th/standing.js';
			//$url = 'http://data.7m.com.cn/matches_data/'.$leage_id.'/th/standing.js';
			$url = 'http://data.7m.com.cn/matches_data/'.$leage_id.'/big/standing.js';
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
			curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:31.0) Gecko/20100101 Firefox/31.0"	);
			curl_setopt($ch, CURLOPT_REFERER, 'http://data.7m.cn/matches_data/standing_th.shtml');
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$content = curl_exec($ch);
			curl_close($ch);
			return $content;
		}
		
		public function teams($data){
			preg_match('/var f_sds_tn = \[(.*)\]\;/',$data,$teams);
			$teams = str_replace('\'','',$teams[1]);
			$teams = explode(',',$teams);
			return $teams;
		}
		
		public function matches($data){
			preg_match('/var f_sds_mnum = \[(.*)\]\;/',$data,$matches);
			$matches = $matches[1];
			$matches = explode(',',$matches);
			return $matches;
		}
		
		public function win($data){
			preg_match('/var f_sds_mw = \[(.*)\]\;/',$data,$matches_win);
			$matches_win = $matches_win[1];
			$matches_win = explode(',',$matches_win);
			return $matches_win;
		}		
		public function drawn($data){
			preg_match('/var f_sds_md = \[(.*)\]\;/',$data,$matches_drawn);
			$matches_drawn = $matches_drawn[1];
			$matches_drawn = explode(',',$matches_drawn);
			return $matches_drawn;
		}
		
		public function lost($data){
			preg_match('/var f_sds_ml = \[(.*)\]\;/',$data,$matches_lost);
			$matches_lost = $matches_lost[1];
			$matches_lost = explode(',',$matches_lost);
			return $matches_lost;
		}
		
		public function goal_for($data){
			preg_match('/var f_sds_mgs = \[(.*)\]\;/',$data,$matches_goal_for);
			$matches_goal_for = $matches_goal_for[1];
			$matches_goal_for = explode(',',$matches_goal_for);
			return $matches_goal_for;
		} 
		
		public function goal_against($data){
			preg_match('/var f_sds_mga = \[(.*)\]\;/',$data,$matches_goal_against);
			$matches_goal_against = $matches_goal_against[1];
			$matches_goal_against = explode(',',$matches_goal_against);
			return $matches_goal_against;
		}
		public function pts($data){
			preg_match('/var f_sds_pt = \[(.*)\]\;/',$data,$matches_point);
			$matches_point = $matches_point[1];
			$matches_point = explode(',',$matches_point);
			return $matches_point;
		}
		
}