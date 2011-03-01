<?php

class Battle_model extends CI_Model 
{
	function get_battle_result($id_character, $id_monster)
	{
		$character = $this->get_character_status($id_character);
		$monster = $this->get_monster_status($id_monster);
		$character_damage = ($character[0]['attack'] > $monster[0]['defend']) ? $character[0]['attack'] - $monster[0]['defend'] : 0;
		$monster_damage = ($monster[0]['attack'] > $character[0]['defend']) ? $monster[0]['attack'] - $character[0]['defend'] : 0;
		$character_life = $character[0]['life_point'] - $monster_damage;
		$monster_life = $monster[0]['life_point'] - $character_damage;	
		
		$exp = ($monster_life < 0) ? $monster[0]['experience'] : (($monster_life / $monster[0]['life_point']) * $monster[0]['experience']);
		
		$data = array(
			'character_damage' => $character_damage,
			'character_attack' => $character[0]['attack'],
			'character_defend' => $character[0]['defend'],
			'character_die' => ($character_life < 0) ? 1 : 0,
			'monster_damage' => $monster_damage,
			'monster_attack' => $monster[0]['attack'],
			'monster_defend' => $monster[0]['defend'],
			'monster_die' => ($monster_life < 0) ? 1 : 0,
			'exp' => $exp
		);	
		
		$data['win'] = ($character_damage > $monster_damage) ? 'character' : 'monster';
		
		if($monster_life < 0)
		{
			$sql = 'SELECT id_item, drop_rate FROM monster_item WHERE id_monster = ' . $id_monster;
			$query = $this->db->query($sql);
			$item = array();
			foreach($query->result() as $row)
			{	
				$quantity = 0;
				$percent = rand(0, 100);
				while($percent <= $row->drop_rate)
				{
					$quantity = (int)($quantity + 1);
					$percent = rand(0, 100);
				}
				if($quantity > 0)
				{
					array_push($item, array($row->id_item, $quantity));
				}
			}
			$data['item'] = $item;
		}
		
		return $data;
	}
	
	function get_character_status($id_character)
	{
		$sql = 'SELECT attack, defend, life_point FROM character_status_general WHERE id_character = ' . $id_character;
		$query = $this->db->query($sql);
		
		return $query->result_array();
	}
	
	function get_monster_status($id_monster)
	{
		$sql = 'SELECT attack, defend, experience, life_point FROM monster_status_general WHERE id_monster = ' . $id_monster;	
		$query = $this->db->query($sql);
		
		return $query->result_array();
	}
}

?>