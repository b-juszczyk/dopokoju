<?php


class Oferta_model extends CI_Model
{
	public function getOferta()
	{
		$query = $this->db->query('SELECT id, nazwa, cena FROM oferta');
		return $query->result_array();
	}

}
