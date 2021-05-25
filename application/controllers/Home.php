<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function index()
	{
		$data['title'] = 'SIG PAGUYUBAN REOG';

		$this->load->view('template/landing/landing_header_view', $data);
		$this->load->view('landing/landing_view');
		$this->load->view('template/landing/landing_footer_view');
	}

	public function about()
	{
		$data['title'] = 'SIG PAGUYUBAN REOG | ABOUT';

		$this->load->view('template/landing/landing_header_view', $data);
		$this->load->view('landing/about_view');
		$this->load->view('template/landing/landing_footer_view');
	}

	public function paguyuban()
	{
		$data['title'] = 'SIG PAGUYUBAN REOG | PAGUYUBAN';

		$this->load->view('template/landing/landing_header_view', $data);
		$this->load->view('landing/paguyuban_view');
		$this->load->view('template/landing/landing_footer_view');
	}

	public function contact()
	{
		$data['title'] = 'SIG PAGUYUBAN REOG | CONTACT';

		$this->load->view('template/landing/landing_header_view', $data);
		$this->load->view('landing/contact_view');
		$this->load->view('template/landing/landing_footer_view');
	}
}
