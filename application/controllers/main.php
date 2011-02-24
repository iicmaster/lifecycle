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
		$data['map_icon'] = $this->gen_map_icon();
		
		$this->load->view('index.php', $data);
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
			'domain' => 'http://127.0.0.1/'
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
				$data = $this->facebook->api('/me');
				
				$check_user_online = array(
					'method' => 'users.hasAppPermission',
					'uid' => $data['id'],
					'ext_perm' => 'user_online_presence'
				);
				
				$check_friends_online = array(
					'method' => 'users.hasAppPermission',
					'uid' => $data['id'],
					'ext_perm' => 'friends_online_presence'
				);
				
				$check_post_wall = array(
					'method' => 'users.hasAppPermission',
					'uid' => $data['id'],
					'ext_perm' => 'publish_stream'
				);
				
				if($this->facebook->api($check_user_online) && $this->facebook->api($check_friends_online) && $this->facebook->api($check_post_wall))
				{
					$sql = 'SELECT name, online_presence, locale, pic_square 
							FROM user 
							WHERE uid = ' . $data['id'];
							
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
	
	function check_register($id_facebook)
	{
		$this->load->model('player_model');
		$data = $this->player_model->check_register($id_facebook);
		if(!$data)
		{
			echo '1111';	
		}
		else
		{
			echo '222';	
		}

	}
	
	// ------------------------------------------------------------------------
	
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */