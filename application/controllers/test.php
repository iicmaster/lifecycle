<?php

//require_once(APPPATH . 'libraries/facebook.php');

class Test extends CI_Controller
{
	private $facebook;
	
	// ------------------------------------------------------------------------
	
	/**
	  * Page for test code
	  *
	  * @access	public
	  */
	
 	function index() 
	{		
		/*$data = $this->facebook_connect();

		if($this->check_register($data['id_facebook']))
		{
			$data['isFirst'] = TRUE;
			$this->load->view('test.php', $data);
		}
		else
		{
			$data['isFirst'] = FALSE;
			$this->load->view('test.php', $data);
		}
		$this->load->model('quest_model');
		print_array($this->quest_model->get_full_description(13));*/
		
		$this->load->view('map.php');
	}
	
	// ------------------------------------------------------------------------
	
	/**
	  * Generate map's icon in world map
	  *
	  * @access	public
	  * @return	string	$_html
	  */
	  
	function gen_map_icon($status = 'enable', $type = 'all')
	{
		$this->load->model('map_model');
		$_rows = $this->map_model->get_map($status, $type);
		$_html = '';
		
		foreach($_rows as $_row)
		{
			$_class = ($_row->type == 0) ? 'map_icon_map' : 'map_icon_city';
			
			$_html .= '<div id="map_icon_'.$_row->id_map.'" class="'.$_class.'" rel="'.$_row->id_map.'" title="'.$_row->name.'"></div>';
		}
		
		return $_html;
	}
	
	// ------------------------------------------------------------------------
	
	function facebook_connect()
	{
		$this->facebook = new Facebook(array(
			'appId'  => '119204944778534',
			'secret' => '1375dadc2ad75f35365a99ab3cc02c2a',
			'cookie' => true,
			'domain' => 'http://192.168.9.39/lifecycle/test/'
		));
		
		$session = $this->facebook->getSession();
		
		$url = $this->facebook->getLoginUrl(array(
			'req_perms' => 'publish_stream,user_online_presence,friends_online_presence',
			'canvas'    => 1,
			'fbconnect' => 1,
			'next'      => 'http://apps.facebook.com/thelifecycle/'
		));	
			
		if($session)
		{
			try
			{
				$data['id_facebook'] = $this->facebook->getUser();
					
				return $data;
			}
			catch(Exception $e)
			{
				echo '<script>top.location.href = "' . $url . '";<script>';
			}
		}
		else
		{
			echo '<script>top.location.href = "' . $url . '";</script>';
		}	
	}
	
	// ------------------------------------------------------------------------
	
	function check_register($id_facebook)
	{
		$this->load->model('player_model');
		$data = $this->player_model->check_register($id_facebook);
		
		return $data;
	}
	
	// ------------------------------------------------------------------------
	
	function get_item()
	{
		$this->load->model('item');
		$data['arr'] = $this->item->get_info();
		echo $data['arr'];	
	}
	
	function get_npc_dialog($id_npc)
	{
		$this->load->model('npc_model');
		$data['arr'] = $this->npc_model->get_dialog($id_npc, 141);
		echo $data['arr'];
	}
	
	function get_detail($location_type, $id_location)
	{
		$this->load->model('map_model');
		$data['arr'] = $this->map_model->get_detail($location_type, $id_location);
		echo $data['arr'];
	}
	
	function get_guidepost($id_location)
	{
		$this->load->model('map_model');
		$data['arr'] = $this->map_model->get_guidepost($id_location);
		echo $data['arr'];
	}
	
	function get_monster($id_section)
	{
		$this->load->model('map_model');
		$data['arr'] = $this->map_model->get_monster($id_section);
		echo $data['arr'];
	}
}

/* End of file test.php */
/* Location: ./application/controllers/test.php */