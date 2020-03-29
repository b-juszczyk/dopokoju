<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Oferta extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('oferta_model');
	}

	public function index()
	{
		$data['oferta']=$this->oferta_model->getOferta();
		$data['logged']=$this->session->userdata('isUserLoggedIn');
		$this->load->view('elements/header',$data);
		$this->load->view('oferta',$data);
		$this->load->view('elements/footer');
	}
	public function addToCart($productId)
	{
		$product = $this->oferta_model->getRows($productId);

		$data = array(
			'id'=>$product['id'],
			'ilosc'=>1,
			'cena'=>$product['cena'],
			'nazwa'=>$product['nazwa']
		);
		$this->cart->insert($data);

		redirect('koszyk/');
	}

}
