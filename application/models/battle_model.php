<?php
class Battle_model extends CI_Model {
	
	// ------------------------------------------------------------------------
	
	/**
	  * Get battel result
	  *
	  * @access	public
	  * @param 	int		$id_character	map status (enable, disable, all)
	  * @param 	int		$id_monster		map type (normal, city, all)
	  * @return	array	$data			id_map, name, type
	  */
	  
	function get_battle_result($id_character, $id_monster)
	{
		$character = $this->get_character_status($id_character);
		$monster = $this->get_monster_status($id_monster);
		$character_damage = ($character['atk'] > $monster['def']) ? $character['atk'] - $monster['def'] : 0;
		$monster_damage = ($monster['atk'] > $character['def']) ? $monster['atk'] - $character['def'] : 0;
		$character_life = $character['lp'] - $monster_damage;
		$monster_life = $monster['lp'] - $character_damage;	
		
		// If monster die get EXP * 3
		$exp = ($monster_life < 0) ? round($monster['exp'] * 3) : $monster['exp'];
		
		$data = array(
						'character_damage' => $character_damage,
						'character_attack' => $character['atk'],
						'character_defend' => $character['def'],
						'character_die' => ($character_life < 0) ? 1 : 0,
						'monster_damage' => $monster_damage,
						'monster_attack' => $monster['atk'],
						'monster_defend' => $monster['def'],
						'monster_die' => ($monster_life < 0) ? 1 : 0,
						'battle_exp' => $exp
					);	
		
		$data['win'] = ($character_damage > $monster_damage) ? 'character' : 'monster';
		
		// Check if monster die, get item from monster
		//if($monster_life < 0)
		//{
			$sql =	'SELECT monster_item.id_item as id_item, language_item.name as name, drop_rate, drop_max 
					 FROM monster_item
					 LEFT JOIN language_item
					 ON monster_item.id_item = language_item.id_item 
					 WHERE id_monster = ' . $id_monster . ' 
					 AND language_item.id_language = 1';
			$query = $this->db->query($sql);
			$item = array();
			
			foreach($query->result() as $row)
			{	
				$quantity = 0;
				$percent = rand(0, 100);
				
				while($percent <= $row->drop_rate && $quantity < $row->drop_max)
				{
					$quantity = (int)($quantity + 1);
					$percent = rand(0, 100);
				}
				
				if($quantity > 0)
				{
					array_push($item, array(
											'id_item' => $row->id_item, 
											'name' => $row->name, 
											'quantity' => $quantity
											));
				}
			}
			$data['item'] = $item;
		//}
		
		/*--------------------------------------------------*/
		/* Update character data */
		/*--------------------------------------------------*/
		
		$this->load->model('character_model');
		
		// Iitem
		if(count($item) > 0)
		{
			$this->character_model->set_character_item($item);
		}
		
		// EXP
		if(count($item) > 0)
		{
			$status = array('exp' => $this->session->userdata('exp') + $exp);
			$this->character_model->set_character_status($status);
		}
		
		
		return $data;
	}
	
	// ------------------------------------------------------------------------
	
	/**
	  * Get battel result
	  *
	  * @access	public
	  * @param 	int		$id_character	map status (enable, disable, all)
	  * @param 	int		$id_monster		map type (normal, city, all)
	  * @return	array	$data			id_map, name, type
	  */
	  
	function get_character_status($id_character)
	{
		$sql = 'SELECT atk, def, lp 
				FROM lifecycle.character 
				WHERE id_character = ' . $id_character;
		$query = $this->db->query($sql);
		
		return $query->row_array();
	}
	
	// ------------------------------------------------------------------------
	
	/**
	  * Get monster status
	  *
	  * @access	public
	  * @param 	int		$id_monster		id of monster
	  * @return	array	-				{ atk, def, exp, lp }
	  */
	
	function get_monster_status($id_monster)
	{
		$sql = 'SELECT 
						ROUND(creature.atk * monster.status_rate / 100) AS "atk", 
						ROUND(creature.def * monster.status_rate / 100) AS "def", 
						ROUND(creature.exp * monster.status_rate / 100) AS "exp", 
						ROUND(creature.lp * monster.status_rate / 100) AS "lp" 
				FROM monster
				
				LEFT JOIN creature
				ON monster.id_creature = creature.id_creature
				
				WHERE monster.id_monster = ' . $id_monster;	
				
		$query = $this->db->query($sql);
		
		return $query->row_array();
	}
}

/* End of file battle_model.php */
/* Location: ./application/models/battle_model.php */