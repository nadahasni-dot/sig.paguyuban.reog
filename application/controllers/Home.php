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

		if ($this->session->userdata('id_user')) {
			$data['user'] = $this->User_model->getUser('id_user', $this->session->userdata('id_user'));
		}

		$this->load->view('template/landing/landing_header_view', $data);
		$this->load->view('landing/landing_view');
		$this->load->view('template/landing/landing_footer_view');
	}

	public function about()
	{
		$data['title'] = 'SIG PAGUYUBAN REOG | ABOUT';
		$data['page'] = 'about';

		if ($this->session->userdata('id_user')) {
			$data['user'] = $this->User_model->getUser('id_user', $this->session->userdata('id_user'));
		}

		$this->load->view('template/landing/landing_header_view', $data);
		$this->load->view('landing/about_view');
		$this->load->view('template/landing/landing_footer_view');
	}

	public function daftarPaguyuban()
	{
		$data['title'] = 'SIG PAGUYUBAN REOG | PAGUYUBAN';
		$data['page'] = 'daftarpaguyuban';

		if ($this->session->userdata('id_user')) {
			$data['user'] = $this->User_model->getUser('id_user', $this->session->userdata('id_user'));
		}

		if (isset($_GET['query'])) {
			$data['paguyuban'] = $this->Paguyuban_model->getPaguyuban('all_home_query', $this->input->get('query'));
		} else {
			$data['paguyuban'] = $this->Paguyuban_model->getPaguyuban('all_home');
		}

		$this->load->view('template/landing/landing_header_view', $data);
		$this->load->view('landing/daftar_paguyuban_view');
		$this->load->view('template/landing/landing_footer_view');
	}

	public function detailPaguyuban($id_paguyuban)
	{
		$data['recomendation'] = $this->Paguyuban_model->getPaguyuban('all_home', NULL, 5);
		$data['paguyuban'] = $this->Paguyuban_model->getPaguyuban('id_paguyuban', $id_paguyuban);
		$data['jasa'] = $this->Jasa_model->getJasa('id_paguyuban', $id_paguyuban);

		$data['title'] = strtoupper($data['paguyuban']['nama_paguyuban']);
		$data['page'] = 'detailpaguyuban';

		if ($this->session->userdata('id_user')) {
			$data['user'] = $this->User_model->getUser('id_user', $this->session->userdata('id_user'));
		}

		$this->load->view('template/landing/landing_header_view', $data);
		$this->load->view('landing/detail_paguyuban_view');
		$this->load->view('template/landing/landing_footer_view');
	}

	public function detailJasa($id_jasa)
	{
		$data['recomendation'] = $this->Paguyuban_model->getPaguyuban('all_home', NULL, 5);
		$data['jasa'] = $this->Jasa_model->getJasa('id_jasa', $id_jasa);

		$data['title'] = strtoupper($data['jasa']['nama_jasa']);
		$data['page'] = 'detailjasa';

		if ($this->session->userdata('id_user')) {
			$data['user'] = $this->User_model->getUser('id_user', $this->session->userdata('id_user'));
		}

		// validation forms                
		$this->form_validation->set_rules('tanggal_reservasi', 'Tanggal', 'required|trim');
		$this->form_validation->set_rules('deskripsi_reservasi', 'Deskripsi', 'required|trim');

		if ($this->form_validation->run() == FALSE) { // * jika belum input form
			$this->load->view('template/landing/landing_header_view', $data);
			$this->load->view('landing/detail_jasa_view');
			$this->load->view('template/landing/landing_footer_view');
		} else {
			$id_user = $this->session->userdata('id_user');
			$id_paguyuban = $data['jasa']['id_paguyuban'];
			$tanggal_reservasi = $this->input->post('tanggal_reservasi');
			$deskripsi_reservasi = $this->input->post('deskripsi_reservasi');

			$data = array(
				'id_user' => $id_user,
				'id_jasa' => $id_jasa,
				'id_paguyuban' => $id_paguyuban,
				'tanggal_reservasi' => $tanggal_reservasi,
				'deskripsi_reservasi' => $deskripsi_reservasi,
				'status_reservasi' => 0,
				'reservasi_created' => time()
			);

			if ($this->Reservasi_model->insertReservasi($data)) { // * jika berhasil input reservasi
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Berhasil mengajukan reservasi. Harap tunggu konfirmasi dari pihak paguyuban. <a href="' . base_url('reservasi') . '">Lihat Reservasi Saya</a></div>');

				redirect(base_url('detailjasa/') . $id_jasa);
			} else { // ! jika gagal input reservasi
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Gagal mengajukan reservasi. Harap coba lagi</div>');

				redirect(base_url('detailjasa/') . $id_jasa);
			}
		}
	}

	public function reservasi()
	{
		$data['title'] = 'Daftar Reservasi';
		$data['page'] = 'reservasi';
		$data['recomendation'] = $this->Paguyuban_model->getPaguyuban('all_home', NULL, 5);

		if ($this->session->userdata('id_user')) {
			$data['user'] = $this->User_model->getUser('id_user', $this->session->userdata('id_user'));
		}

		$data['reservasi'] = $this->Reservasi_model->getReservasi('id_user', $this->session->userdata('id_user'));

		$this->load->view('template/landing/landing_header_view', $data);
		$this->load->view('landing/reservasi_view');
		$this->load->view('template/landing/landing_footer_view');
	}

	public function detailReservasi($id_reservasi)
	{
		$data['recomendation'] = $this->Paguyuban_model->getPaguyuban('all_home', NULL, 5);
		$data['reservasi'] = $this->Reservasi_model->getReservasi('id_reservasi', $id_reservasi);
		$data['transaksi'] = $this->Transaksi_model->getTransaksi('id_reservasi', $id_reservasi);

		$data['title'] = strtoupper($data['reservasi']['nama_jasa']);
		$data['page'] = 'detailreservasi';

		if ($this->session->userdata('id_user')) {
			$data['user'] = $this->User_model->getUser('id_user', $this->session->userdata('id_user'));
		}

		// validation forms                
		$this->form_validation->set_rules('tanggal_reservasi', 'Tanggal', 'required|trim');
		$this->form_validation->set_rules('nominal_transaksi', 'Nominal', 'required|trim');

		if ($this->form_validation->run() == FALSE) { // * jika belum input form
			$this->load->view('template/landing/landing_header_view', $data);
			$this->load->view('landing/detail_reservasi_view');
			$this->load->view('template/landing/landing_footer_view');
		} else {			
			$tanggal_transaksi = $this->input->post('tanggal_transaksi');
			$nominal_transaksi = $this->input->post('nominal_transaksi');

			if ($_FILES['bukti_transaksi']['error'] != 4) {
				$bukti_transaksi = $this->upload_image('bukti_transaksi', './assets/img/transaksi/');
			} else {
				$bukti_transaksi = 'no-image.jpg';
			}

			$data = array(
				'id_reservasi' => $id_reservasi,
				'tanggal_transaksi' => $tanggal_transaksi,
				'nominal_transaksi' => $nominal_transaksi,
				'bukti_transaksi' => $bukti_transaksi,
				'status_transaksi' => 0,
				'transaksi_created' => time()
			);

			if ($this->Transaksi_model->insertTransaksi($data)) { // * jika berhasil input transaksi
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Berhasil melakukan transaksi. Harap tunggu konfirmasi dari pihak paguyuban. </div>');

				redirect(base_url('detailreservasi/') . $id_reservasi);
			} else { // ! jika gagal input reservasi
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Gagal melakukan transaksi. Harap coba lagi</div>');

				redirect(base_url('detailreservasi/') . $id_reservasi);
			}
		}
	}

	public function contact()
	{
		$data['title'] = 'SIG PAGUYUBAN REOG | CONTACT';
		$data['page'] = 'contact';

		if ($this->session->userdata('id_user')) {
			$data['user'] = $this->User_model->getUser('id_user', $this->session->userdata('id_user'));
		}

		$this->load->view('template/landing/landing_header_view', $data);
		$this->load->view('landing/contact_view');
		$this->load->view('template/landing/landing_footer_view');
	}

	public function cetakBukti($id_transaksi) {
		$data['transaksi'] = $this->Transaksi_model->getTransaksi('id_transaksi', $id_transaksi);
		$data['reservasi'] = $this->Reservasi_model->getReservasi('id_reservasi', $data['transaksi']['id_reservasi']);

		$this->load->view('landing/cetak_bukti_view', $data);
	}

	//  *fungsi untuk upload image
	private function upload_image($name, $address)
	{
		$this->load->library('upload');
		$config['upload_path'] = $address; //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
		$config['max_size'] = 10000;

		$this->upload->initialize($config);

		if (!empty($_FILES[$name]['name'])) {

			if ($this->upload->do_upload($name)) {
				$gbr = $this->upload->data();
				//Compress Image
				$config['image_library'] = 'gd2';
				$config['source_image'] = $address . $gbr['file_name'];
				$config['create_thumb'] = TRUE;
				$config['maintain_ratio'] = TRUE;
				$config['quality'] = '80%';
				$config['width'] = 800;
				$config['height'] = 600;
				$config['new_image'] = $address . $gbr['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();

				$gambar = $gbr['file_name'];

				return $gambar;
			} else {
				echo "gagal upload";
			}
		} else {
			return 'no-image.jpg';
		}
	}
}
