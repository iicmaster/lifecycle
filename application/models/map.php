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
	
	
	/**
	 * Get guidepost in location
	 *
	 * @param 	string	$location_type	type of location (state, map, zone, section, store, dungeon)
	 * @param 	int		$id_location	id of location
	 *
	 * @return	array	id, name, descrption
	 */
	 function get_guidepost($location_type, $id_location)
	 {
		 
	 }
	
	/**
	 * Get detail of location
	 *
	 * @param 	string	$location_type	type of location (state, map, zone, section, store, dungeon)
	 * @param 	int		$id_location	id of location
	 *
	 * @return	array	id, name, descrption
	 */
	 function get_detail($location_type, $id_location)
	 {
		 
	 }
	
	/**
	 * Get NPC in location
	 *
	 * @param 	string	$location_type	type of location (state, map, zone, section, store, dungeon)
	 * @param 	int		$id_location	id of location
	 *
	 * @return	array	id, name, descrption
	 */
	function get_npc($location_type, $id_location)
	{
		$query = $this->db->get_where('map_'.$location_type, array('id_'.$location_type => $id_location));
		
		return $query->result_array();
	}
	
	/**
	 * Get monster in location
	 *
	 * @param 	string	$location_type	type of location (state, map, zone, section, store, dungeon)
	 * @param 	int		$id_location	id of location
	 *
	 * @return	array	id, name, descrption, level
	 */
	 function get_monster($location_type, $id_location)
	 {
		 
	 }
	 
	 
	
}

/* End of file map.php */
/* Location: ./application/models/map.php */