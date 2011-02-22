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
		
		$url = $this->facebook->getLoginUrl(array(
			'req_perms' => 'publish_stream',
			'canvas'    => 1,
			'fbconnect' => 0,
			'next'      => 'http://apps.facebook.com/thelifecycle/'
		));
			
		if(!$session)
		{
			echo '<script>top.location.href = "' . $url . '";</script>';
		}
		else
		{
			try
			{
				$me = $this->facebook->api('/me');
				$this->load->view('index.php');
			}
			catch(Exception $e)
			{
				echo '<script>top.location.href = "' . $url . '";</script>';
			}
		}*/
		//$this->get_npc(409);
		//$this->get_monster(142);
		//$this->gen_map_icon();
		
		$data['map_icon'] = $this->gen_map_icon();
		$this->load->view('index.php', $data);
		
	}
	
	// ------------------------------------------------------------------------
	
	/**
	  * Generate map's icon in world map
	  *
	  * @access	public
	  * @return	string	$html
	  */
	  
	function gen_map_icon($status = 'enable', $type = 'all')
	{
		$this->load->model('map');
		$_rows = $this->map->get_map($status, $type);
		$_html = '';
		
		foreach($_rows as $_row)
		{
			$_class = ($_row->type == 0) ? 'map_icon_map' : 'map_icon_city';
			
			$_html .= '<div id="map_icon_'.$_row->id_map.'" class="'.$_class.'" rel="'.$_row->id_map.'" title="'.$_row->name.'"></div>';
		}
		
		return $_html;
	}
	
	// ------------------------------------------------------------------------
	
	function get_npc($id_section)
	{
		$this->load->model('map');
		$data['arr'] = $this->map->get_npc($id_section);
		print_array($data['arr']);
		exit();	
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
	
	function get_monster($id_section)
	{
		$this->load->model('map');
		$data['arr'] = $this->map->get_monster($id_section);
		print_array($data['arr']);
		exit();	
	}
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */