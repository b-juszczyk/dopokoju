<?php


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

}
