<?php
class Map extends CI_Model {
	
	/**
	 * Get name of table of location in databse
	 *
	 * @access  public
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
	 * @access  public
	 * @param 	string	$location_type	type of location (district, map, zone, section, store, dungeon)
	 * @param 	int		$id_location	id of location
	 * @return	array	$query			id, name, descrption
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
	 * Get guidepost in location
	 *
	 * @access  public
	 * @param 	int		$id_section		id of location
	 * @return	array	$result			id, name, descrption, image
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
	 * Get NPC in location
	 *
	 * @access  public
	 * @param 	int		$id_location	id of location
	 * @return	array					id, name, descrption
	 */
	 function get_npc($location_type, $id_section)
	 {
		 $query = $this->db->get_where('map_'.$location_type, array('id_'.$location_type => $id_section));
		
		 return $query->result_array();
	 }
	 
	// ------------------------------------------------------------------------
	
	/**
	 * Get monster in location
	 *
	 * @access  public
	 * @param 	int		$id_location	id of location
	 * @return	array					id, name, descrption, level
	 */
	 function get_monster($location_type, $id_section)
	 {
		 $query = $this->db->get_where('map_'.$location_type, array('id_'.$location_type => $id_section));
		
		 return $query->result_array();
	 }
	
}

/* End of file map.php */
/* Location: ./application/models/map.php */