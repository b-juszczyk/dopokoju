<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->table = 'users';
	}

	function getRows($params = array())
	{
		$this->db->select('*');
		$this->db->from($this->table);

		if(array_key_exists("conditions",$params))
		{
			foreach ($params['conditions'] as $key => $val)
			{
				$this->db->where($key,$val);
			}
		}

		if(array_key_exists("returnType",$params) && $params['returnType']=='count')
		{
			$result = $this->db->count_all_results();
		}
		else
		{
			if(array_key_exists("id",$params) || $params['returnType']=='single')
			{
				if(!empty($params['id']))
				{
					$this->db->where('id',$params['id']);
				}

				$query = $this->db->get();
				$result = $query->row_array();
			}
			else
			{
				$this->db->order_by('id','desc');
				if(array_key_exists("start",$params) && array_key_exists("limit",$params))
				{
					$this->db->limit($params['limit'],$params['start']);
				}elseif(!array_key_exists("start".$params)&&array_key_exists("limit",$params))
				{
					$this->db->limit($params['limit']);
				}
				$query = $this->db->get();
				$result = ($query->num_rows() > 0)?$query->result_array():FALSE;
			}
		}

		return $result;
	}

	public function insert($data = array())
	{
		if(!empty($data))
		{
			if(!array_key_exists("created",$data))
			{
				$data['created'] = date("Y-m-d H:i:s");
			}

			$insert = $this->db->insert($this->table, $data);

			return $insert?$this->db->insert_id():false;
		}
		return false;
	}
}
