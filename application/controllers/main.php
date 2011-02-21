<?php

//require_once(APPPATH . 'libraries/facebook.php');

class Main extends CI_Controller
{
	private $facebook;
	
 	function index() 
	{
		/*$this->facebook = new Facebook(array(
			'appId'  => '119204944778534',
			'secret' => '1375dadc2ad75f35365a99ab3cc02c2a',
			'cookie' => true,
			'domain' => 'http://lc.in.th/'
		));
		
		$session = $this->facebook->getSession();
		
		if(!$session)
		{
			$url = $this->facebook->getLoginUrl(array(
				'req_perms' => 'publish_stream',
				'canvas'    => 1,
				'fbconnect' => 0,
				'next'      => 'http://apps.facebook.com/thelifecycle/'
			));
			echo '<script>top.location.href = "' . $url . '";</script>';
		}
		else
		{
			$me = $this->facebook->api('/me');
			print_array($me);
		}
		*/
		$this->get_guidepost(267);
		//$this->get_detail('guidepost', 2);
		//$this->load->view('index.php');
	}
	
	function get_detail($location_type, $id_location)
	{
		$this->load->model('map');
		$data['arr'] = $this->map->get_detail($location_type, $id_location);
		print_array($data['arr']);
		exit();	
	}
	
	function get_guidepost($id_location)
	{
		$this->load->model('map');
		$data['arr'] = $this->map->get_guidepost($id_location);
		print_array($data['arr']);
		exit();
	}
	
	function get_monster()
	{

	}
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */