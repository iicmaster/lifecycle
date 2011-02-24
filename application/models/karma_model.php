<?php
class Karma_model extends CI_Model {
	 
	// ------------------------------------------------------------------------
	
	/**
	 * Set character karma
	 *
	 * process:
	 * 			1. update good/bad krama in table: character_krama
	 * 			2. insert/update krama in table: character_karma_retribution
	 *
	 * @param 	int		$id_character	id of id_character
	 * @param 	int		$id_karma		id of karma
	 */
	 
	function set_character_karma($id_character)
	{
		
	}
	 
	// ------------------------------------------------------------------------
	
	/**
	 * Get character karma
	 *
	 * @param 	int		$id_quest		id of quest
	 * @return	array					karma_good, karma_bad
	 */
	 
	function get_character_karma($id_character)
	{
		
	}
	 
	// ------------------------------------------------------------------------
	
	/**
	 * Get character karma retribution
	 * select id_karma_result with the highess karma_speed, karma_priority
 	 * can return more than one id if same karma_speed and karma_priority
	 *
	 * @param 	int		$id_quest			id of quest
	 * @param 	int		$karma_type			type of karma (0 = all, 1 = bad, 2 = good)
	 * @param 	int		$karma_result_type	type of karma result (0 = item, 1 = money, 2 = status, 3 = health, 4 = incarnation)
	 * @return	array						id_karma_result, karma_type
	 */
	 
	function get_character_karma_retribution($id_character)
	{
		
	}
	 
	// ------------------------------------------------------------------------
}

/* End of file karma_model.php */
/* Location: ./application/models/karma_model.php */