<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require_once FCPATH. '/facebook-sdk-v5/autoload.php';

use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRedirectLoginHelper;

class Member extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('member_model');
	}
	
	public function index(){
		if($this->session->userdata('logined'))redirect('member/detail');
		
		$fb = new Facebook\Facebook([
		  'app_id' => '1842872169084290',
		  'app_secret' => '8078c67b4b7db19449b386fecd716b4b',
		  'default_graph_version' => 'v2.5',
		]);
		
		$helper = $fb->getRedirectLoginHelper();	
		$permissions = ['email', 'user_likes']; // optional		
		$loginUrl = $helper->getLoginUrl(site_url('member/callback'), $permissions);
		echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
		

		//$data['Content'] = $this->load->view('member/index', null, true);
		//$this->load->view('template/temp_football', $data);
	}		
	
	public function callback(){
		
		$fb = new Facebook\Facebook([
		  'app_id' => '1842872169084290',
		  'app_secret' => '8078c67b4b7db19449b386fecd716b4b',
		  'default_graph_version' => 'v2.5',
		]);
		
		$helper = $fb->getRedirectLoginHelper();
		try {
		  $accessToken = $helper->getAccessToken();
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  // When Graph returns an error
		  echo 'Graph returned an error: ' . $e->getMessage();
		  exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  // When validation fails or other local issues
		  echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  exit;
		}
		
		if (isset($accessToken)) {
		  // Logged in!
		  $_SESSION['facebook_access_token'] = (string) $accessToken;
		
		  // Now you can redirect to another page and use the
		  // access token from $_SESSION['facebook_access_token']
		
		  $response = $fb->get('/me?fields=id,name,gender,email,link', $accessToken);
		
		  $user = $response->getGraphUser();
		  //echo'<pre>';
		  //print_r($user);
		  //echo'</pre>';
		  $rs_member = $this->member_model->get_by_fbid($user['id']);
		  if($rs_member->num_rows()>0){
			$row_member = $rs_member->row();
			$data = array(
				'last_login'=>date('Y-m-d H:i:s')
			);
			$this->db->update('fb_members',$data,array('member_id'=>$row_member->member_id));
			$this->session->set_userdata('member_id', $row_member->member_id);	
			$this->session->set_userdata('nickname', $row_member->nickname);	
			$this->session->set_userdata('logined', true);				
			redirect(site_url('member/detail'));
		  }else{
			$data = array(
				'facebook_id'=>$user['id'],
				'nickname'=>$user['name'],
				'email'=>$user['email'],
				'gender'=>$user['gender'],
				'image'=>$user['link'],
				'registerdate'=>date('Y-m-d H:i:s')
			);
			$this->db->insert('fb_members',$data);
			$member_id = $this->db->insert_id();
			$this->session->set_userdata('member_id', $member_id);	
			$this->session->set_userdata('nickname', $user['name']);	
			$this->session->set_userdata('logined', true);				
			redirect(site_url('member/detail'));
		  }		
		}
	}
	
	public function detail(){
		echo $this->session->userdata('nickname');
	}
	
	public function logout(){
		$this->session->sess_destroy();
		redirect(site_url('member'));
	}
		
}