<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Order_model extends CI_Model
{
	public function insertOrder($data)
	{
		if (!empty($data)) {
			$insert = $this->db->insert('zamowienia', $data);

		}
		return $insert ? $this->db->insert_id() : false;
	}

	public function insertFood($data, $id_zamowienia)
	{
		if (!empty($data)) {
			$food = unserialize($data);
			foreach ($food as $items) {
				$insert = $this->db->insert('oferta_zamowienia', array(
					'id_oferta' => $items['id'],
					'id_zamowienia' => $id_zamowienia
				));
			}
		}
		return $insert ? $this->db->insert_id() : false;
	}
}
