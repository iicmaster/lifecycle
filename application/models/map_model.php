<?php
class Map_model extends CI_Model {
	 
	// ------------------------------------------------------------------------
	
	/**
	  * Get name of table of location in databse
	  *
	  * @access	public
	  * @param 	string	$location_type	type of location (district, map, zone, section, store, dungeon)
	  * @return	string	$table			name of table
	  */
	  
	function get_location_table($location_type)
	{
		switch($location_type)
		{
			case('district'):
				$table = 'atlas_district';
				break;
			case('map'):
				$table = 'atlas_map';
				break;
			case('zone'):
				$table = 'atlas_zone';
				break;
			case('section'):
				$table = 'atlas_section';
				break;
			case('store'):
				$table = 'atlas_store';
				break;
			case('dungeon'):
				$table = 'atlas_dungeon';
				break;
				
			return $table;
		}
	}
	 
	// ------------------------------------------------------------------------
	
	/**
	  * Get detail of location
	  *
	  * @access	public
	  * @param 	string	$location_type	type of location (district, map, zone, section, store, dungeon)
	  * @param 	int		$id_location	id of location
	  * @return	array	$result			id_location, name, descrption [,alphabet (if location type = section)]
	  */
	  
	function get_detail($location_type, $id_location)
	{
		$this->db->select('atlas_' . $location_type . '.id_' . $location_type . ',name, description');
		
		if($location_type == 'section')
		{
			$this->db->select('alphabet');
		}
		else if($location_type == 'store')
		{
			$this->db->select('id_section');
		}
		
		$this->db->from('atlas_' . $location_type);
		$this->db->where('status', 1);
		$this->db->where('atlas_' . $location_type . '.id_' . $location_type, $id_location);
		$this->db->join('language_atlas_' . $location_type, 'atlas_' . $location_type . '.id_' . $location_type . ' = language_atlas_' . $location_type . '.id_' . $location_type, 'left');
		$this->db->where('id_language', 1);
		
		//if( $this->db->get()->result_row() == )
		
		$rows = $this->db->get()->row_array();
		
		//print_array($rows);
		
		$result = array(
			'id_location'	=> $rows['id_' . $location_type],
			'name'			=> $rows['name'],
			'description'	=> $rows['description']
		);
		
		if($location_type == 'section')
		{
			$result['alphabet'] = $rows['alphabet'];
		}
		else if($location_type == 'store')
		{
			$result['id_section'] = $rows['id_section'];
		}
		
		return $result;
	}	
	 
	// ------------------------------------------------------------------------
	
	/**
	  * Get all of map in the world
	  *
	  * @access	public
	  * @param 	string	$status		map status (enable, disable, all)
	  * @param 	string	$type		map type (normal, city, all)
	  * @return	array	$result		id_map, name, type
	  */
	 function get_map($status = 'enable', $type = 'all')
	 {
		 
		$this->db->select('atlas_map.id_map, name, type');
		$this->db->from('atlas_map');
		
		if($status == 'disable')
		{
			$this->db->where('status', 0);
		}
		else if($status == 'enable')
		{
			$this->db->where('status', 1);
		}
		
		if($type == 'normal')
		{
			$this->db->where('type', 0);
		}
		else if($type == 'city')
		{
			$this->db->where('type', 1);
		}
		
		$this->db->join('language_atlas_map', 'atlas_map.id_map = language_atlas_map.id_map', 'left');
		$this->db->where('id_language', 1);
		
		return $this->db->get()->result();
		
	 }
	 
	 
	// ------------------------------------------------------------------------
	 
	/**
	  * Get guidepost in section
	  *
	  * @access	public
	  * @param 	int		$id_section		id of section
	  * @return	array	$result			target_type, id_target, name, descrption, image
	  */
	  
	function get_guidepost($id_section)
	{ 
		$sql = 'SELECT id_guidepost, id_target, target_type, image FROM atlas_guidepost WHERE id_location = ' . $id_section .' ORDER BY target_type';
		$query = $this->db->query($sql);
		$result = array();
		
		//print_array($query->result_array());
		
		foreach($query->result() as $row)
		{
			//print_array($row);
			
			//$target_type = ($row->target_type == 0) ? 'section' : 'store';
			
			switch($row->target_type)
			{
				case 0:
					$target_type = 'section';
					break;
				case 1:
					$target_type = 'store';
					break;
				case 2:
					$target_type = 'dungeon';
					break;
			}
			
			$section = $this->get_detail($target_type, $row->id_target);
			
			//print_array($section);
			
			$quidepost = array(
				'target_type'	=> $target_type,
				'id_target'	  	=> $row->id_target,
				'name'	  	 	=> $section['name'],
				'description'	=> $section['description'],
				'image'	      	=> $row->image
			);
		
			if($target_type == 'section')
			{
				$quidepost['alphabet'] = $section['alphabet'];
			}
			
			array_push($result, $quidepost);
		}
		
		return $result;
	}
	 
	// ------------------------------------------------------------------------
	
	/**
	  * Get NPC in section
	  *
	  * @access	public
	  * @param 	int		$id_section		id of section
	  * @return	array					id_npc, name, descrption
	  */
	  
	function get_npc($id_section)
	{
		$sql = 'SELECT npc.id_npc, name, description 
				 FROM npc 
				 LEFT JOIN language_npc ON npc.id_npc = language_npc.id_npc 
				 WHERE location = ' . $id_section . ' AND id_language = 1';
				 
		$query = $this->db->query($sql);
		
		return $query->result_array();
	}
	 
	// ------------------------------------------------------------------------
	
	/**
	  * Get monster in section
	  *
	  * @access	public
	  * @param 	int		$id_section		id of section
	  * @return	array					id_monster, name, descrption, level
	  */
	  
	function get_monster($id_section)
	{
		$sql = 'SELECT monster.id_monster, name, description 
				 FROM monster
				 LEFT JOIN atlas_section_monster ON monster.id_monster = atlas_section_monster.id_monster
				 LEFT JOIN language_monster ON monster.id_monster = language_monster.id_monster 
				 WHERE id_section = ' . $id_section . ' AND id_language = 1';
			 
		$query = $this->db->query($sql);
		
		return $query->result_array();
	}
	
	// ------------------------------------------------------------------------
	
	/**
	  * Get company in section
	  *
	  * @access	public
	  * @param 	int		$id_section		id of section
	  * @return	array					id_company, name, descrption, image
	  */
	  
	function get_company($id_section)
	{
		$sql = 'SELECT id_company, name, description, image
				 FROM job_salaryman_company
				 LEFT JOIN language_job_salaryman_company ON job_salaryman_company.id_company = language_job_salaryman_company.id_company
				 WHERE id_section = ' . $id_section . ' AND id_language = 1';
			 
		$query = $this->db->query($sql);
		
		return json_encode($query->result_array());
	}
	
	// ------------------------------------------------------------------------
	
	function get_map_detail($id_section)
	{
		$sql = 'SELECT atlas_map.id_map, name, description
				FROM atlas_section
				LEFT JOIN atlas_zone ON atlas_section.id_zone = atlas_zone.id_zone
				LEFT JOIN atlas_map ON atlas_zone.id_map = atlas_map.id_map
				LEFT JOIN language_atlas_map ON atlas_map.id_map = language_atlas_map.id_map
				WHERE atlas_section.id_section = ' . $id_section . ' AND id_language = 1';
		$query = $this->db->query($sql);
		
		//print_array($query->result_array());
		
		return $query->row_array();
	}
}

/* End of file map_model.php */
/* Location: ./application/models/map_model.php */