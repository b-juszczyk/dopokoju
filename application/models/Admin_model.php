<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Admin_model extends CI_Model
{
	public function getUsers()
	{
		$query = $this->db->query('SELECT id, first_name, login, email FROM users');
		return $query->result_array();
	}

}
