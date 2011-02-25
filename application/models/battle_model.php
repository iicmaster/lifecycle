<?php

class Battle_model extends CI_Model 
{
	function get_battle_result($id_character, $id_monster)
	{
		$character = $this->get_character_status($id_character);
		$monster = $this->get_monster_status($id_monster);
		$character_damage = ($character[0]['attack'] > $monster[0]['defend']) ? $character[0]['attack'] - $monster[0]['defend'] : 0;
		$monster_damage = ($monster[0]['attack'] > $character[0]['defend']) ? $monster[0]['attack'] - $character[0]['defend'] : 0;	
		if($character_damage > $monster_damage)
		{
			$data = array(
				'win' => 'character',
				'damage' => $monster_damage
			);	
		}
		else
		{
			$data = array(
				'win' => 'monster',
				'damage' => $monster_damage
			);	
		}
		return $data;
	}
	
	function get_character_status($id_character)
	{
		$sql = 'SELECT attack, defend FROM character_status_general WHERE id_character = ' . $id_character;
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	function get_monster_status($id_monster)
	{
		$sql_monster = 'SELECT attack, defend FROM monster_status_general WHERE id_monster = ' . $id_monster;	
		$query = $this->db->query($sql);
		return $query->result_array();
	}
}

?>