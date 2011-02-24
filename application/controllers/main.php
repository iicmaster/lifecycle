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
	  *
	  * Check facebook login and permission
	  *
	  * $access public
	  * $retuen array	$data 
	  */
	  
	function facebook_connect()
	{
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
					$sql = 'SELECT uid, name, online_presence, locale, pic_square 
							FROM user 
							WHERE uid = ' . $id_facebook;
							
					$data = $this->facebook->api(
						array(
							'method' => 'fql.query',
							'query'	 => $sql
						)
					);
					
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
	  * $access public
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
		echo $data;
	}
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */