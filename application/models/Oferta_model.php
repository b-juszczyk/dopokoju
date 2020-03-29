<?php


class Oferta_model extends CI_Model
{
	function getOferta()
	{
		$query = $this->db->query('SELECT nazwa, cena FROM oferta');
		return $query->result();
	}
}
