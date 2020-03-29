<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Koszyk extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('oferta_model');
	}
	public function index()
	{
		$data=array();
		$data['cartItems']=$this->cart->contents();
		$data['logged']=$this->session->userdata('isUserLoggedIn');
		$this->load->view('elements/header',$data);
		$this->load->view('cart/index',$data);
		$this->load->view('elements/header');
	}
	public function updateItemQty()
	{
		$update=0;

		$rowId = $this->input->get('rowId');
		$qty = $this->input->get('qty');

		if(!empty($rowId) && !empty($qty))
		{
			$data = array(
				'rowId'=>$rowId,
				'qty'=>$qty
			);
			$update = $this->cart->update($data);
		}
		echo $update?'ok':'error';
	}
	function removeItem($rowId)
	{
		$delete = $this->cart->remove($rowId);

		redirect('cart/');
	}

}
