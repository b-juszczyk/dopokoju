<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Order_model extends CI_Model
{
	public function insert($data = array())
	{
		if (!empty($data)) {
			if (!array_key_exists('data_zamowienia', $data)) {
				$data['data_zamowienia'] = date("Y-m-d H:i:s");

			}
			$insert = $this->db->insert('orders', $data);

			return $insert ? $this->db->insert_id() : false;
		}
		return false;
	}

	public function insertFood($data)
	{
		if (!empty($data)) {
			$insert = $this->db->insert('orders_menu', array(serialize($data[1])));

			return $insert ? $this->db->insert_id() : false;
		}
	}
}
