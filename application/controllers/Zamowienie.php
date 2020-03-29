<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Zamowienie extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('oferta_model');
		$this->controller = 'zamowienie';
	}
	public function index()
	{
		if($this->cart->total_items() <=0)
		{
			redriect('oferta/');
		}

		$custData = $data = array();

		$submit = $this->input->post('placeOrder');
		if(isset($submit))
		{
			$this->form_validation->set_rules('first_name', 'First Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('phone', 'Phone', 'required');
			$this->form_validation->set_rules('academic', 'Academic', 'required');
			$this->form_validation->set_rules('room', 'Room', 'required');

			$custData = array(
				'first_name'=>strip_tags($this->input->post('first_name')),
				'email'=>strip_tags($this->input-post('email')),
				'phone'=>strip_tags($this->input->post('phone')),
				'academic'=>strip_tags($this->input->post('academic')),
				'room'=>strip_tags($this->input->post('room'))
			);

			if($this->form_validation->run()==true)
			{
				$insert = $this->oferta_model->insertCustomer($custData);
				if($insert)
				{
					$order = $this->placeOrder($insert);

					if($order)
					{
						$this->session->set_userdata('success_order_msg','Zamowienie zlozone!');
						redirect($this->controller.'/orderSuccess/'.$order);
					}
					else
					{
						$data['error_order_msg'] = 'Zamowienie nie zostalo zlozone, sprobuj ponownie!';
					}
				}
				else
				{
					$data['error_order_msg'] = 'Wystapil problem, sprobuj ponownie pozniej';
				}
			}
		}
		$data['custData'] = $custData;
		$data['custItems'] = $this->cart->contents();
		$data['logged']=$this->session->userdata('isUserLoggedIn');
		$this->load->view('elements/header',$data);
		$this->load->view($this->controller.'/index',$data);
		$this->load->view('elements/footer');
	}

	public function placeOrder($custID)
	{
		$ordData = array(
			'customer_id'=>$custID,
			'grandTotal'=>$this->cart->total()
		);
		$insertOrder= $this->product_model->insertOrder($ordData);

		if($insertOrder) {
			$cartItems = $this->cart->contents();
			$ordItemData = array();
			$i = 0;

			foreach ($cartItems as $item) {
				$ordItemData[$i]['order_id'] = $insertOrder;
				$ordItemData[$i]['product_id'] = $item['id'];
				$ordItemData[$i]['quantity'] = $item['qty'];
				$ordItemData[$i]['sub_total'] = $item['subtotal'];
				$i++;
		}
			if(!empty($ordItemData))
			{
				$insertOrderItems = $this->product_model->insertOrderItemst($ordItemData);

				if($insertOrderItems)
				{
					$this->cart->destroy();

					return $insertOrder;
				}
			}

		}
		return false;
	}

	public function orderSuccess($ordID)
	{
		$data['order'] = $this->product_model->getOrder($ordID);
		$data['logged']=$this->session->userdata('isUserLoggedIn');
		$this->load->view('elements/header',$data);
		$this->load->view($this->controller.'/order-success',$data);
		$this->load->view('elements/footer');
	}
}
