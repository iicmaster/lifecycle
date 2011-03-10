<?php

//@auther Infinity Imagine Corporation
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
		$character = $this->get_character_status(2);
		
		// set session
		$data = array(
						'id'				=> $facebook[0]['uid'],
						'name'				=> $facebook[0]['name'],
						'id_language'		=> $language,
						'image'				=> $facebook[0]['pic_square'],
						'id_character'		=> $character['id_character'],
						'level'				=> $character['level'], 
						'money'				=> $character['money'], 
						'exp'				=> $character['exp'],  
						'exp_max'			=> $character['exp_max'],  
						'hs'				=> $character['hs'], 
						'id_location'		=> $character['id_location'],
						'location_type'		=> $character['location_type'],
						'is_fighting' 		=> $character['is_fighting'],
						'is_working'		=> $character['is_working'],
						'is_moving' 		=> $character['is_moving'],
						'date_working_start'=> $character['date_working_start'],
						'date_working_end'	=> $character['date_working_end'],
						'date_moving_start'	=> $character['date_moving_start'],
						'date_moving_end'	=> $character['date_moving_end'],
						'age'				=> $character['age'],	 
						'age_max'			=> $character['age_max'],	  
						'str'				=> $character['str'],   
						'str_ori'			=> $character['str_ori'], 
						'vit'				=> $character['vit'],	
						'vit_ori'			=> $character['vit_ori'],	
						'spd'				=> $character['spd'],	
						'spd_ori'			=> $character['spd_ori'],	
						'com'				=> $character['com'],	
						'com_ori'			=> $character['com_ori'],	
						'int'				=> $character['int'],	
						'int_ori'			=> $character['int_ori'],	
						'dex'				=> $character['dex'],	
						'dex_ori'			=> $character['dex_ori'],	
						'mp'				=> $character['mp'],	
						'mp_max'			=> $character['mp_max'],		
						'lp'				=> $character['lp'],	
						'lp_max'			=> $character['lp_max'],	
						'sta'				=> $character['sta'],	
						'sta_max'			=> $character['sta_max'],	
						'atk'				=> $character['atk'],	
						'atk_ori'			=> $character['atk_ori'],	
						'def'				=> $character['def'],	
						'def_ori'			=> $character['def_ori'],		
						'dod'				=> $character['dod'],	
						'dod_ori'			=> $character['dod_ori'],	
						'cha'				=> $character['cha'],	
						'cha_ori'			=> $character['cha_ori'],	
						'acc'				=> $character['acc'],	
						'acc_ori'			=> $character['acc_ori'],	
						'neg'				=> $character['neg'],	
						'neg_ori'			=> $character['neg_ori'],	
						'pop'				=> $character['pop'],	 
						'pop_ori'			=> $character['pop_ori']
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
	  * Get Monster in location (section, store, company)
	  *
	  * @access	public
	  * @param 	int		$id_section		id of section
	  * @return	json
	  */
	
	function get_monster($id_location)
	{
		$this->load->model('map_model');		
		echo json_encode($this->map_model->get_monster($id_location));
	}
	
	// ------------------------------------------------------------------------
	
	/**
	  * Get Map detail (section, store, company)
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
	  * Get NPC conversation
	  *
	  * @access	public
	  * @param 	int		$id_npc				id of NPC
	  * @param 	int		$id_dialog_group	id of group of dialog
	  * @return	json
	  */
	
	function get_npc_dialog($id_npc, $id_dialog_group = NULL)
	{
		$this->load->model('npc_model');
		echo json_encode($this->npc_model->get_dialog($id_npc, $id_dialog_group));
	}
	
	// ------------------------------------------------------------------------
	
	/**
	  * Get NPC Item
	  *
	  * @access	public
	  * @param 	int		$id_npc		id of NPC
	  * @return	json
	  */
	
	function get_npc_item($id_npc)
	{
		$this->load->model('npc_model');
		echo json_encode($this->npc_model->get_npc_item($id_npc));
	}
	
	// ------------------------------------------------------------------------
	
	/**
	  * Get battle result
	  *
	  * @access	public
	  * @param 	int		$id_npc		id of monster
	  * @return	json
	  */
	
	function get_battle_result($id_monster)
	{
		$this->load->model('battle_model');
		echo json_encode($this->battle_model->get_battle_result($this->session->userdata('id_character'), $id_monster));
	}
	
	// ------------------------------------------------------------------------
	
	/**
	  * Get character item
	  *
	  * @access	public
	  * @return	json
	  */
	
	function get_character_item()
	{
		$this->load->model('character_model');
		echo json_encode($this->character_model->get_item($this->session->userdata('id_character')));
	}
	
	// ------------------------------------------------------------------------
	
	/**
	  * Set character item
	  *
	  * @access	public
	  * @return	json
	  */
	
	function set_character_location($location_type, $id_location)
	{
		switch($location_type)
		{
			case 'section':
				$_location_type = 0;
				break;
			case 'store':
				$_location_type = 1;
				break;
			case 'dungeon':
				$_location_type = 2;
				break;
		}
		
		$arr_status = array(
							'location_type' => $_location_type,
							'id_location' => $id_location,
							);
							
		$this->load->model('character_model');
		$this->character_model->set_character_status($arr_status);	
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
	
	function feedback($type, $topic, $detail)
	{
		$this->load->model('support_model');
		$this->support_model->feedback($type, urldecode($topic), urldecode($detail));
	}
	
	function get_character_status($id_character)
	{
		$this->load->model('character_model');
		return $this->character_model->get_status($id_character);	
	}
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */