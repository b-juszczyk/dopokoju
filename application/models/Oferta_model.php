<?php


class Oferta_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->proTable = 'oferta';
		$this->custTable = 'users';
		$this->ordTable = 'orders';
		$this->ordItemsTable = 'order_items';
	}

	public function getRows($id='')
	{
		//$this->db->select('*');
		//$this->db->from($this->proTable);
		//$this->db->where('status','1');
		if($id)
		{
			$this->db->where('id',$id);
			$query = $this->db->query('SELECT * FROM '.$this->proTable.' WHERE status = 1 AND id='.$id);
			//$query = $this->db->get();
			$result=$query->row_array();
		}
		else{
			$this->db->order_by('nazwa','asc');
			$query = $this->db->get();
			$result = $query->result_array();
		}

		return !empty($result)?$result:false;
	}

	public function getOrder($id)
	{
		$this->db->select('o.*, c.first_name, c.email, c.phone, c.academic, c.room');
		$this->db->from($this->ordTable.' as o');
		$this->db->join($this->custTable.' as c', 'c.id = o.id', 'left');
		$this->db->where('o.id',$id);
		$query=$this->db->get;
		$result = $query->row_array();

		$this->db->select('i.*, p.name, p.price');
		$this->db->from($this->ordItemsTable.' as i');
		$this->db->join($this->proTable.' as p', 'p.id = i.product_id','left');
		$this->db->where('i.order_id',$id);
		$query2 = $this->db->get();
		$result['items'] = ($query2->num_rows() > 0)?$query2->result_array():array();

		return !empty($result)?$result:false;
	}

	public function insertCustomer($data)
	{
		if(!array_key_exists("created",$data))
		{
			$data['created'] = date("Y-m-d H:i:s");
		}
		if(!array_key_exists("modified",$data))
		{
			$data['modified'] = date("Y-m-d H:i:s");
		}
		$insert = $this->db->insert($this->custTable, $data);

		return $insert?$this->db->insert_id():false;
	}

	public function insertOrder($data)
	{
		if(!array_key_exists("created",$data))
		{
			$data['created'] = date("Y-m-d H:i:s");
		}
		if(!array_key_exists("modified",$data))
		{
			$data['modified'] = date("Y-m-d H:i:s");
		}
		$insert = $this->db->insert($this->ordTable, $data);

		return $insert?$this->db->insert_id():false;
	}

	public function insertOrderItems($data = array())
	{
		$insert = $this->db->insert_batch($this->ordItemsTable, $data);

		return $insert?true:false;
	}
	public function getOferta()
	{
		$query = $this->db->query('SELECT id, nazwa, cena FROM oferta');
		return $query->result_array();
	}

}
