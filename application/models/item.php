<?php
class Item extends CI_Model {
	/**
	 * get Item information
	 *
	 * @param 	string	$field		fieldname in table. for multiple field used comma(,) to separate ex.($field = 'field1, field2, field3')
	 *
	 * @return	array
	 */
	function get_info($fields = '*')
	{
		$sql_join = '';
		foreach(comma_to_array($fields) as $row)
		{
			if($row == 'name' || $row == 'description' || $row == '*')
			{
				$sql_join = ' LEFT JOIN language_item ON item.id_item = language_item.id_item';		
				break;
			}
		}
		$sql = 'SELECT ' . $fields . ' FROM item' . $sql_join;
		$query = $this->db->query($sql);
		return $query->result_array();
	}
}

/* End of file item.php */
/* Location: ./application/models/item.php */