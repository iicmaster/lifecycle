<?php
class Language_model extends CI_Model {
	 
	// ------------------------------------------------------------------------
	
	/**
	 * Get All of language UI
	 *
	 * @param 	int		$id_language	id of id_language
	 * @return	array					id_ui, name
	 *
	 */
	 
	function get_language_ui($id_language)
	{
		$sql = 'SELECT id_ui, name FROM language 
				WHERE id_language = ' . $id_language;
		$query = $this->db->query($sql);
		
		return $query->result_array();
	}
	 
	// ------------------------------------------------------------------------
	
}

/* End of file language_model.php */
/* Location: ./application/models/language_model.php */