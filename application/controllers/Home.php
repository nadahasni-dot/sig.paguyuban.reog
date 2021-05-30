<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('User_model');
		$this->load->model('Paguyuban_model');
		$this->load->model('Jasa_model');
		$this->load->model('Reservasi_model');
		$this->load->model('Transaksi_model');
	}

	public function index()
	{
		$data['title'] = 'SIG PAGUYUBAN REOG';
		$data['paguyuban'] = $this->Paguyuban_model->getPaguyuban('all_home');
		$data['page'] = 'home';

		$this->load->view('template/landing/landing_header_view', $data);
		$this->load->view('landing/landing_view');
		$this->load->view('template/landing/landing_footer_view');
	}

	public function about()
	{
		$data['title'] = 'SIG PAGUYUBAN REOG | ABOUT';
		$data['page'] = 'about';

		$this->load->view('template/landing/landing_header_view', $data);
		$this->load->view('landing/about_view');
		$this->load->view('template/landing/landing_footer_view');
	}

	public function daftarPaguyuban()
	{
		$data['title'] = 'SIG PAGUYUBAN REOG | PAGUYUBAN';
		$data['page'] = 'daftarpaguyuban';

		if (isset($_GET['query'])) {
			$data['paguyuban'] = $this->Paguyuban_model->getPaguyuban('all_home_query', $this->input->get('query'));
		} else {
			$data['paguyuban'] = $this->Paguyuban_model->getPaguyuban('all_home');
		}

		$this->load->view('template/landing/landing_header_view', $data);
		$this->load->view('landing/daftar_paguyuban_view');
		$this->load->view('template/landing/landing_footer_view');
	}

	public function contact()
	{
		$data['title'] = 'SIG PAGUYUBAN REOG | CONTACT';
		$data['page'] = 'contact';

		$this->load->view('template/landing/landing_header_view', $data);
		$this->load->view('landing/contact_view');
		$this->load->view('template/landing/landing_footer_view');
	}
}
