<?php   if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists( 'hide_phone' ) ){
	function hide_phone($phone) {
		return substr($phone, 0, -4) . "****";
	}
}

if(! function_exists('conv_predict')){
	function conv_predict($predict="") {  	
		switch($predict){
			case 'h':
				$predicttxt = 'เจ้าบ้าน';
				break;
			case 'a':
				$predicttxt = 'ทีมเยือน';
				break;
			case 'al':
				$predicttxt = 'เสมอ';
				break;
			default:
				$predicttxt = '';
		}
		return $predicttxt; 
	}
}

if(! function_exists('conv_thaidate')){
	function conv_thaidate($date){
		$w = date('w',strtotime($date));
		list($Y,$m,$d) = explode('-',$date);
		$y = substr( $Y, -2);
		$y = $y+43;
		$dayThshort = array('อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.');
		$monthThshort = array('01'=>'ม.ค.','02'=>'ก.พ.','03'=>'มี.ค.','04'=>'เม.ย.','05'=>'พ.ค.','06'=>'มิ.ย.','07'=>'ก.ค.','08'=>'ส.ค.','09'=>'ก.ย.','10'=>'ต.ค.','11'=>'พ.ย.','12'=>'ธ.ค.');
		return $dayThshort[$w].' '.$d.' '.$monthThshort[$m].' '.$y;
	}
}

if(! function_exists('score_color')){
	function score_color($score="") {  	
		switch($score){
			case 0:
				$color = 'd';
				break;
			case 1:
				$color = 'w1';
				break;
			case 2:
				$color = 'w2';
				break;
			case 0.5:
				$color = 'w2';
				break;
			case -1:
				$color = 'l2';
				break;
			case -0.5:
				$color = 'l1';
				break;
			default:
				$color = '';
		}
		return $color; 
	}
}

if(! function_exists('score_shortness')){
	function score_shortness($score="") {  	
		switch($score){
			case 0:
				$shortness = 'D';
				break;
			case 1:
				$shortness = 'W';
				break;
			case 0.5:
				$shortness = 'w';
				break;
			case -1:
				$shortness = 'L';
				break;
			case -0.5:
				$shortness = 'l';
				break;
			default:
				$shortness = '&nbsp;';
		}
		return $shortness; 
	}
}

if(! function_exists('match_rate')){
	function match_rate($rate="") {  	
	switch($rate){
		case 0:
			$rate_name = 'ส';
			break;
		case 0.25:
			$rate_name = 'ป';
			break;
		case 0.5:
			$rate_name = '0.5';
			break;
		case 0.75:
			$rate_name = '0.5/1';
			break;
		case 1:
			$rate_name = '1';
			break;
		case 1.25:
			$rate_name = '1/1.5';
			break;
		case 1.5:
			$rate_name = '1.5';
			break;
		case 1.75:
			$rate_name = '1.5/2';
			break;
		case 2:
			$rate_name = '2';
			break;
		case 2.25:
			$rate_name = '2/2.5';
			break;
		case 2.5:
			$rate_name = '2.5';
			break;
		case 2.75:
			$rate_name = '2.5/3';
			break;
		case 3:
			$rate_name = '3';
			break;
		case 3.25:
			$rate_name = '3/3.5';
			break;
		case 3.5:
			$rate_name = '3.5';
			break;
		case 3.75:
			$rate_name = '3.5/4';
			break;
		case 4:
			$rate_name = '4';
			break;
		case 4.25:
			$rate_name = '4/4.5';
			break;
		case 4.5:
			$rate_name = '4.5';
			break;
		case 4.75:
			$rate_name = '4.5/5';
			break;
		case 5:
			$rate_name = '5';
			break;
		case 5.25:
			$rate_name = '5/5.5';
			break;
		case 5.5:
			$rate_name = '5.5';
			break;
		case 5.75:
			$rate_name = '5.5/6';
			break;
		case 6:
			$rate_name = '6';
			break;
		case 7:
			$rate_name = '7';
			break;
		case 8:
			$rate_name = '8';
			break;
		case 9:
			$rate_name = '9';
			break;
	}
		return $rate_name; 
	}
}