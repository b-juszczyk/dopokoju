<?php


class Oferta_model extends CI_Model
{
	public function getOferta()
	{
		$query = $this->db->query('SELECT * FROM oferta WHERE status="1"');
		return $query->result_array();
	}

	public function getProdukt($id_wariant)
	{
		return $this->db->where('id', $id_wariant)->get('oferta')->row();
	}

}
