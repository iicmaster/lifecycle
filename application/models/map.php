<?php
class Map extends Model 
{
	/**
	* get NPC in location
	*
	* @param 	string	$location_type		type of location (state, map, zone, section, store, dungeon)
	* @param 	int		$id_location	id of location
	*
	* @return	array
	*/
	function get_npc($location_type, $id_location)
	{
		$query = $this->db->get_where($location_type, array('id_'.$location_type, => $id_location));
		
		return $query->result_array();
	}
}

/* End of file map.php */
/* Location: ./application/models/map.php */