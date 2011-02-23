<?php
class Map extends CI_Model {
	
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
				$table = 'map_district';
				break;
			case('map'):
				$table = 'map_map';
				break;
			case('zone'):
				$table = 'map_zone';
				break;
			case('section'):
				$table = 'map_section';
				break;
			case('store'):
				$table = 'map_store';
				break;
			case('dungeon'):
				$table = 'map_dungeon';
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
	  * @return	array	$result			id_location, name, descrption
	  */
	  
	function get_detail($location_type, $id_location)
	{
		$this->db->select('map_' . $location_type . '.id_' . $location_type . ',name, description');
		$this->db->from('map_' . $location_type);
		$this->db->where('status', 1);
		$this->db->where('map_' . $location_type . '.id_' . $location_type, $id_location);
		$this->db->join('language_map_' . $location_type, 'map_' . $location_type . '.id_' . $location_type . ' = language_map_' . $location_type . '.id_' . $location_type, 'left');
		$this->db->where('id_language', 1);
		
		$row = $this->db->get()->result_array();
		
		$result = comma_to_array($row[0]['id_' . $location_type] . ',' . $row[0]['name'] . ',' . $row[0]['description']);
		
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
		 
		$this->db->select('map_map.id_map, name, type');
		$this->db->from('map_map');
		
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
		
		$this->db->join('language_map_map', 'map_map.id_map = language_map_map.id_map', 'left');
		$this->db->where('id_language', 1);
		
		return $this->db->get()->result();
		
	 }
	 
	 
	// ------------------------------------------------------------------------
	 
	/**
	  * Get guidepost in section
	  *
	  * @access	public
	  * @param 	int		$id_section		id of section
	  * @return	array	$result			id_target, name, descrption, image
	  */
	  
	function get_guidepost($id_section)
	{ 
		$sql = 'SELECT id_guidepost, target, image FROM map_guidepost WHERE location = ' . $id_section;
		$query = $this->db->query($sql);
		$result = array();
		
		foreach($query->result() as $row)
		{
		 $section = $this->get_detail('section', $row->target);
		 $guidepost = $row->id_guidepost . ',' . $section[1] . ',' . $section[2] . ',' . $row->image;
		 array_push($result, comma_to_array($guidepost));
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
		$sql = 'SELECT monster.id_monster, level_monster, id_section, name, description 
				 FROM monster
				 LEFT JOIN map_section_monster ON monster.id_monster = map_section_monster.id_monster
				 LEFT JOIN language_monster ON monster.id_monster = language_monster.id_monster 
				 WHERE id_section = ' . $id_section . ' AND id_language = 1';
			 
		$query = $this->db->query($sql);
		$result = array();
		
		foreach($query->result() as $row)
		{
		 array_push($result, comma_to_array($row->id_monster . ',' . $row->name . ',' . $row->description . ',' . $row->level_monster)); 
		}
		
		return $result;
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
		$result = array();
		
		foreach($query->result() as $row)
		{
		 array_push($result, comma_to_array($row->id_company . ',' . $row->name . ',' . $row->description . ',' . $row->image)); 
		}
		
		return $result;
	}
	
	// ------------------------------------------------------------------------
	
}

/* End of file map.php */
/* Location: ./application/models/map.php */