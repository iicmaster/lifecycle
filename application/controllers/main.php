<?php

//require_once(APPPATH . 'libraries/facebook.php');

class Main extends CI_Controller
{
	private $facebook;
	
	// ------------------------------------------------------------------------
	
	/**
	  * Mian page and only this to display to player
	  *
	  * @access	public
	  */
	
 	function index() 
	{		
		$facebook = $this->facebook_connect();
		$language = $this->get_id_language($facebook[0]['locale']);
		
		/*print_array($data);
		exit();*/
		
		$data = array(
			'id' => $facebook[0]['uid'],
			'name' => $facebook[0]['name'],
			'id_language' => $language,
			'image' => $facebook[0]['pic_square'],
			'id_character' => 1,
			'location' => 399,
			'id_job' => 0,
			'fighting' => 0,
			'working' => 0,
			'moving' => 0,
			'working_start' => 0,
			'working_end' => 0,
			'moving_start' => 0,
			'moving_end' => 0,
			'life_point' => 0,	 
			'stamina_point' => 0,	 
			'strength' => 0, 
			'vitality' => 0,	 
			'speed' => 0, 
			'commucation' => 0, 
			'inteliigent' => 0, 
			'dexterity' => 0, 
			'attack' => 0,	 
			'defend' => 0, 
			'dodge' => 0,	 
			'accuracy' => 0, 
			'mind_power' => 0,	 
			'charisma' => 0, 
			'negotiation' => 0, 
			'level' => 1, 
			'job_level' => 1,	 
			'age' => 1,	 
			'experience' => 0
		);	

		$this->session->set_userdata($data);
		
		// set date
		$data['map_icon'] = $this->_gen_map_icon();
		
		$this->load->view('index.php', $data);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	  * Generate map's icon in world map
	  *
	  * @access	private
	  * @return	string	$_html
	  */
	  
	function _gen_map_icon($status = 'enable', $type = 'all')
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
	
	/**
	  * Get guidepost in location (section, store, company)
	  *
	  * @access	public
	  * @param 	int		$id_section		id of section
	  * @return json
	  */
	
	function get_guidepost($id_section)
	{
		$this->load->model('map_model');
		echo json_encode($this->map_model->get_guidepost($id_section));
	}
	
	// ------------------------------------------------------------------------
	
	/**
	  * Get NPC in location (section, store, company)
	  *
	  * @access	public
	  * @param 	int		$id_section		id of section
	  * @return	json
	  */
	
	function get_npc($id_location)
	{
		$this->load->model('map_model');		
		echo json_encode($this->map_model->get_npc($id_location));
	}
	
	// ------------------------------------------------------------------------
	
	/**
	  * Get NPC in location (section, store, company)
	  *
	  * @access	public
	  * @param 	int		$id_section		id of section
	  * @return	json
	  */
	
	function get_map_detail($id_section)
	{
		$this->load->model('map_model');		
		echo json_encode($this->map_model->get_map_detail($id_section));
	}
	
	// ------------------------------------------------------------------------
	
	/**
	  *
	  * Check facebook login and permission
	  *
	  * $access public
	  * $retuen array	$data 
	  */
	  
	function facebook_connect()
	{
		$data = array(array(
			'uid' => '100001090580233',
			'name' => 'Infinity Imagine',
			'locale' => 'en_US',
			'pic_square' => 'http://profile.ak.fbcdn.net/hprofile-ak-snc4/186726_100001090580233_2911516_q.jpg'
		));
		return $data;
		
		$this->facebook = new Facebook(array(
			'appId'  => '119204944778534',
			'secret' => '1375dadc2ad75f35365a99ab3cc02c2a',
			'cookie' => true,
			'domain' => 'http://lc.in.th/'
		));
		
		$session = $this->facebook->getSession();
		
		$url = $this->facebook->getLoginUrl(array(
			'req_perms' => 'publish_stream,user_online_presence,friends_online_presence',
			'canvas'    => 1,
			'fbconnect' => 0,
			'next'      => 'http://apps.facebook.com/thelifecycle/'
		));
			
		if($session)
		{
			try
			{
				$id_facebook = $this->facebook->getUser();
				
				$check_user_online = array(
					'method' => 'users.hasAppPermission',
					'uid' => $id_facebook,
					'ext_perm' => 'user_online_presence'
				);
				
				$check_friends_online = array(
					'method' => 'users.hasAppPermission',
					'uid' => $id_facebook,
					'ext_perm' => 'friends_online_presence'
				);
				
				$check_post_wall = array(
					'method' => 'users.hasAppPermission',
					'uid' => $id_facebook,
					'ext_perm' => 'publish_stream'
				);
				
				if($this->facebook->api($check_user_online) && $this->facebook->api($check_friends_online) && $this->facebook->api($check_post_wall))
				{
					$sql = 'SELECT uid, name, locale, pic_square 
							FROM user 
							WHERE uid = ' . $id_facebook;
							
					$data = $this->facebook->api(
						array(
							'method' => 'fql.query',
							'query'	 => $sql
						)
					);
					//$data = $this->facebook->api('/me');
					
					return $data;
				}
				else
				{
					echo '<script>top.location.href = "' . $url . '";<script>';
				}
			}
			catch(Exception $e)
			{
				echo '<script>top.location.href = "' . $url . '";</script>';
			}
		}
		else
		{
			echo '<script>top.location.href = "' . $url . '";</script>';
		}	
	}
	
	// ------------------------------------------------------------------------
	
	/**
	  *
	  * Check player register
	  *
	  * $access	public
	  * $return boolean		$data 
	  */
	  
	function check_register($id_facebook)
	{
		$this->load->model('player_model');
		$data = $this->player_model->check_register($id_facebook);
		return $data;
	}
	
	// ------------------------------------------------------------------------
	
	function get_detail($location_type, $id_location)
	{
		$this->load->model('map_model');
		$data = $this->map_model->get_detail($location_type, $id_location);
		echo json_encode($data);
	}
	
	function get_id_language($abbreviation)
	{
		$this->load->model('player_model');
		return $this->player_model->get_id_language($abbreviation);
	}
	
	function feedback()
	{
		$this->load->model('support_model');
		$this->support_model->feedback($_POST['type'], $_POST['topic'], $_POST['detail']);
	}
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */