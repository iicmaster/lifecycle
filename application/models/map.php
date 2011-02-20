<?php
class Map extends CI_Model {
	
	/**
	 * Get name of table of location in databse
	 *
	 * @param 	string	$location_type	type of location (district, map, zone, section, store, dungeon)
	 *
	 * @return	string	name of table
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
	 * @param 	string	$location_type	type of location (district, map, zone, section, store, dungeon)
	 * @param 	int		$id_location	id of location
	 *
	 * @return	array	id, name, descrption
	 */
	 function get_detail($location_type, $id_location)
	 {
		 $query = array();
		 foreach(comma_to_array($location_type) as $type)
		 {
			$this->db->select('map_' . $type . '.id_' . $type . ', name, description');
			$this->db->from('map_' . $type);
			$this->db->where('status', 1);
			$this->db->where('map_' . $type . '.id_' . $type, $id_location);
			$this->db->join('language_map_' . $type, 'map_' . $type . '.id_' . $type . ' = language_map_' . $type . '.id_' . $type, 'left');
			$this->db->where('id_language', 1);
			
			array_push($query, $this->db->get()->result_array());
		 }
		 return $query;
	 }	
	 
	/**
	 * Get guidepost in location
	 *
	 * $access  public
	 * @param 	int		$id_section		id of location
	 *
	 * @return	array	id, name, descrption
	 */
	 function get_guidepost($id_section)
	 { 
		 $sql = 'SELECT target FROM map_guidepost WHERE location = ' . $id_section;
		 $query = $this->db->query($sql);
		 $result = array();
		 
		 foreach($query->result() as $row)
		 {
			 array_push($result, $this->get_detail('section', $row->target));
		 }
		 return $result;
	 }
	
	/**
	 * Get NPC in location
	 *
	 * @param 	int		$id_location	id of location
	 *
	 * @return	array	id, name, descrption
	 */
	 function get_npc($location_type, $id_section)
	 {
		 $query = $this->db->get_where('map_'.$location_type, array('id_'.$location_type => $id_section));
		
		 return $query->result_array();
	 }
	
	/**
	 * Get monster in location
	 *
	 * @param 	int		$id_location	id of location
	 *
	 * @return	array	id, name, descrption, level
	 */
	 function get_monster($location_type, $id_section)
	 {
		 $query = $this->db->get_where('map_'.$location_type, array('id_'.$location_type => $id_section));
		
		 return $query->result_array();
	 }
	
}

/* End of file map.php */
/* Location: ./application/models/map.php */