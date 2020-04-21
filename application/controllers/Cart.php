<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Cart extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('oferta_model');
		$this->load->model('order_model');
		$this->load->model('user_model');
		$this->load->library('form_validation');
	}

	public function index()
	{

		if ($this->session->has_userdata('cart')) {
			$data['items'] = array_values(unserialize($this->session->userdata('cart')));
		}
		$data['total'] = $this->total();
		$data['logged'] = $this->session->userdata('isUserLoggedIn');
		$data['loggedAdmin'] = $this->session->userdata('isAdminLoggedIn');

		$this->load->view('elements/header', $data);
		$this->load->view('cart/index', $data);
		$this->load->view('elements/footer');
	}

	public function buy($id)
	{

		if ($this->input->post('addToCart')) {
			$this->session->set_flashdata('rozmiar', $this->input->post('rozmiar'));
			$this->session->set_flashdata('mieso', $this->input->post('mieso'));
			$this->session->set_flashdata('sosy', $this->input->post('sosy'));
		}
		if ($this->session->flashdata('rozmiar') || $this->session->flashdata('mieso') || $this->session->flashdata('sosy')) {
			$id_wariant = $id . $this->session->flashdata('rozmiar') . $this->session->flashdata('mieso') . $this->session->flashdata('sosy');
			$product = $this->oferta_model->getProdukt($id_wariant);
		} else {
			$product = $this->oferta_model->getProdukt($id);
		}
		$item = array(
			'id' => $product->id_oferta,
			'nazwa' => $product->nazwa,
			'cena' => $product->cena,
			'zdjecie' => $product->zdjecie,
			'ilosc' => 1,
			'kategoria' => $product->kategoria
		);
		if (!$this->session->has_userdata('cart')) {
			$cart = array($item);
			$this->session->set_userdata('cart', serialize($cart));
		} else {
			$index = $this->exists($id);
			$cart = array_values(unserialize($this->session->userdata('cart')));
			if ($index == -1) {
				array_push($cart, $item);
				$this->session->set_userdata('cart', serialize($cart));
			} else {
				$cart[$index]['ilosc']++;
				$this->session->set_userdata('cart', serialize($cart));
			}
		}
		redirect('cart');

	}

	public function remove($id)
	{
		if ($this->session->has_userdata('cart')) {
			$index = $this->exists($id);
			$cart = array_values(unserialize($this->session->userdata('cart')));
			unset($cart[$index]);
			$this->session->set_userdata('cart', serialize($cart));
			redirect('cart');
		}
	}

	private function exists($id)
	{
		if ($this->session->has_userdata('cart')) {
			$cart = array_values(unserialize($this->session->userdata('cart')));
			$counts = count($cart);
			for ($i = 0; $i < $counts; $i++) {
				if ($cart[$i]['id'] == $id) {
					return $i;
				}
			}
		}
		return -1;
	}

	private function total()
	{
		if ($this->session->has_userdata('cart')) {
			$items = array_values(unserialize($this->session->userdata('cart')));
			$koszt = 0;
			foreach ($items as $item) {
				$koszt += (int)$item['cena'] * $item['ilosc'];
			}
			return $koszt;
		}
	}

	public function checkout()
	{
		if ($this->input->post('summarySubmit')) {
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('phone', 'Phone', 'required');
			$this->form_validation->set_rules('mail', 'Mail', 'required|valid_email');

			if ($this->form_validation->run() == true) {
				$this->session->set_userdata('name', $this->input->post('name'));
				$this->session->set_userdata('mail', $this->input->post('mail'));
				$this->session->set_userdata('phone', $this->input->post('phone'));
				$this->session->set_userdata('uwagi', $this->input->post('uwagi'));
				$this->session->set_userdata('akademik', $this->input->post('academic'));
				$this->session->set_userdata('nr_pokoju', $this->input->post('room'));
				redirect('cart/summary');
			} else {
				$this->session->set_userdata('error_msg', 'Wszystkie pola są wymagane!');
			}
		}
		if ($this->session->userdata('isUserLoggedIn') || $this->session->userdata('isAdminLoggedIn')) {
			$con = array(
				'id' => $this->session->userdata('userId')
			);
			$data['user'] = $this->user_model->getRows($con);
		}
		if ($this->session->has_userdata('cart')) {
			$data['items'] = array_values(unserialize($this->session->userdata('cart')));
		}
		$data['total'] = $this->total();
		$data['logged'] = $this->session->userdata('isUserLoggedIn');
		$data['loggedAdmin'] = $this->session->userdata('isAdminLoggedIn');

		$this->load->view('elements/header', $data);
		$this->load->view('cart/checkout', $data);
		$this->load->view('elements/footer');
	}

	public function summary()
	{

		if ($this->session->has_userdata('cart')) {
			$data['items'] = array_values(unserialize($this->session->userdata('cart')));
		}
		$data['total'] = $this->total();

		$data['logged'] = $this->session->userdata('isUserLoggedIn');
		$data['loggedAdmin'] = $this->session->userdata('isAdminLoggedIn');

		$this->load->view('elements/header', $data);
		$this->load->view('cart/summary', $data);
		$this->load->view('elements/footer');
	}

	public function confirm()
	{
		$userData = array(
			'name' => strip_tags($this->session->userdata('name')),
			'mail' => strip_tags($this->session->userdata('mail')),
			'phone' => strip_tags($this->session->userdata('phone'))
		);
		if (!($this->session->has_userdata('isUserLoggedIn') || $this->session->has_userdata('isAdminLoggedIn'))) {
			$insertNewCustomer = $this->user_model->insertNewCustomer($userData);
		}
		if ($this->session->has_userdata('isUserLoggedIn') || $this->session->has_userdata('isAdminLoggedIn')) {
			$orderData = array(
				'czas' => $this->session->flashdata('czas'),
				'data_zamowienia' => date('Y-m-d H:i:s'),
				'dostawa' => $this->session->flashdata('dostawa'),
				'uwagi' => $this->session->flashdata('uwagi'),
				'kod_odbioru' => rand(100000, 999999),
				'na_wynos' => $this->session->flashdata('na_wynos'),
				'users_id' => strip_tags($this->session->userdata('userId'))
			);
		} else {
			$orderData = array(
				'czas' => $this->session->flashdata('czas'),
				'data_zamowienia' => date('Y-m-d H:i:s'),
				'dostawa' => $this->session->flashdata('dostawa'),
				'uwagi' => $this->session->flashdata('uwagi'),
				'kod_odbioru' => rand(100000, 9999999),
				'na_wynos' => $this->session->flashdata('na_wynos'),
				'niezalogowani_id' => $insertNewCustomer
			);
		}

		$insertOrder = $this->order_model->insertOrder($orderData);
		$insertFood = $this->order_model->insertFood($this->session->userdata('cart'), $insertOrder);


		if ($insertFood && $insertOrder) {
			$this->session->set_userdata('success_msg', 'Zamówienie złożone poprawnie!');
			$this->session->unset_userdata('cart');
			$this->session->unset_userdata('name');
			$this->session->unset_userdata('mail');
			$this->session->unset_userdata('phone');
			redirect('cart/');
		} else {
			$this->session->set_userdata('error_msg', 'Wystąpił błąd podczas składania zamówienia, spróbuj ponownie później!');
		}
	}

}
