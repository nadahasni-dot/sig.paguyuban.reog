<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Paguyuban extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('role') != 2) {
            verifyAccess();
        }

        $this->load->model('User_model');
        $this->load->model('Paguyuban_model');
        $this->load->model('Jasa_model');
        $this->load->model('Reservasi_model');
        $this->load->model('Transaksi_model');
    }

    // * halaman beranda
    public function index()
    {
        $data['title'] = "Beranda";
        $data['menu'] = "beranda_paguyuban";
        $data['sub_menu'] = null;
        $data['sub_menu_action'] = null;

        // user data
        $data['user'] = $this->User_model->getUser('id_user', $this->session->userdata('id_user'));

        $data['all_paguyuban'] = $this->Paguyuban_model->getPaguyuban('all');
        $data['paguyuban'] = $this->Paguyuban_model->getPaguyuban('id_user', $this->session->userdata('id_user'));

        $data['count_unconfirmed_reservasi'] = 0;
        $data['count_unconfirmed_transaksi'] = 0;

        if ($data['paguyuban']) {
            $data['count_unconfirmed_reservasi'] = $this->Reservasi_model->countReservasi('unconfirmed_paguyuban', $data['paguyuban']['id_paguyuban']);
            $data['count_unconfirmed_transaksi'] = $this->Transaksi_model->countTransaksi('unconfirmed_paguyuban', $data['paguyuban']['id_paguyuban']);
        }

        if (!$data['paguyuban']) { // jika data paguyuban belum diisi
            $data['count_jasa'] = 0;
            $data['count_reservasi'] = 0;
            $data['count_transaksi'] = 0;
            $data['count_sum_transaksi'] = array('sum_transaksi' => null);
        } else {
            $data['count_jasa'] = $this->Jasa_model->countJasa('all_paguyuban', $data['paguyuban']['id_paguyuban']);
            $data['count_reservasi'] = $this->Reservasi_model->countReservasi('all_paguyuban', $data['paguyuban']['id_paguyuban']);
            $data['count_transaksi'] = $this->Transaksi_model->countTransaksi('confirmed_paguyuban', $data['paguyuban']['id_paguyuban']);
            $data['count_sum_transaksi'] = $this->Transaksi_model->countTransaksi('sum_paguyuban', $data['paguyuban']['id_paguyuban']);
        }


        $this->load->view('template/panel/header_view', $data);
        $this->load->view('template/panel/sidebar_paguyuban_view');
        $this->load->view('paguyuban/home_paguyuban_view');
        $this->load->view('template/panel/control_view');
        $this->load->view('template/panel/footer_view');
    }

    // * halaman paguyuban ===================================================================================
    public function paguyuban()
    {
        $data['title'] = "Paguyuban";
        $data['menu'] = "paguyuban_paguyuban";
        $data['sub_menu'] = "paguyuban_add";
        $data['sub_menu_action'] = null;
        // user data        
        $data['user'] = $this->User_model->getUser('id_user', $this->session->userdata('id_user'));
        $data['paguyuban'] = $this->Paguyuban_model->getPaguyuban('id_user', $this->session->userdata('id_user'));

        $data['count_unconfirmed_reservasi'] = 0;
        $data['count_unconfirmed_transaksi'] = 0;

        if ($data['paguyuban']) {
            $data['count_unconfirmed_reservasi'] = $this->Reservasi_model->countReservasi('unconfirmed_paguyuban', $data['paguyuban']['id_paguyuban']);
            $data['count_unconfirmed_transaksi'] = $this->Transaksi_model->countTransaksi('unconfirmed_paguyuban', $data['paguyuban']['id_paguyuban']);
        }

        // validation forms                        
        $this->form_validation->set_rules('nama_paguyuban', 'Nama Paguyuban', 'required|trim');
        $this->form_validation->set_rules('deskripsi_paguyuban', 'Deskripsi', 'required|trim');
        $this->form_validation->set_rules('alamat_paguyuban', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('telepon_paguyuban', 'Telepon', 'required|trim');
        $this->form_validation->set_rules('lat_paguyuban', 'Latitude', 'required|trim|numeric');
        $this->form_validation->set_rules('lng_paguyuban', 'Longitude', 'required|trim|numeric');
        $this->form_validation->set_rules('no_rekening', 'No REKENING', 'required|trim|numeric');
        $this->form_validation->set_rules('pemilik_rekening', 'Pemilik Rekening', 'required|trim');

        if ($this->form_validation->run() == FALSE) { // * jika belum input form
            $this->load->view('template/panel/header_view', $data);
            $this->load->view('template/panel/sidebar_paguyuban_view');
            $this->load->view('paguyuban/paguyuban_paguyuban_view');
            $this->load->view('template/panel/control_view');
            $this->load->view('template/panel/footer_view');
        } else { // * jika sudah input
            $submitType = $this->input->post('submit-type');
            $id_user = $this->session->userdata('id_user');
            $nama_paguyuban = $this->input->post('nama_paguyuban');
            $deskripsi_paguyuban = $this->input->post('deskripsi_paguyuban');
            $alamat_paguyuban = $this->input->post('alamat_paguyuban');
            $telepon_paguyuban = $this->input->post('telepon_paguyuban');
            $lat_paguyuban = $this->input->post('lat_paguyuban');
            $lng_paguyuban = $this->input->post('lng_paguyuban');
            $no_rekening = $this->input->post('no_rekening');
            $pemilik_rekening = $this->input->post('pemilik_rekening');

            if ($submitType == 'Simpan') { // * jika simpan data
                $paguyuban = $this->Paguyuban_model->getPaguyuban('owner', $id_user);
                $user = $this->User_model->getUser('id_user', $id_user);
                if ($paguyuban) { // jika user telah memiliki paguyuban maka tidak boleh buat
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . $user['username'] . ' telah terdaftar pada paguyuban ' . $paguyuban['nama_paguyuban'] . '</div>');

                    redirect('paguyuban/paguyuban');
                }

                if ($_FILES['foto_paguyuban']['error'] != 4) {
                    $foto_paguyuban = $this->upload_image('foto_paguyuban', './assets/img/paguyuban/');
                } else {
                    $foto_paguyuban = 'no-image.jpg';
                }

                // * data paguyuban yang akan diinput
                $data = array(
                    'id_user' => $id_user,
                    'nama_paguyuban' => $nama_paguyuban,
                    'deskripsi_paguyuban' => $deskripsi_paguyuban,
                    'alamat_paguyuban' => $alamat_paguyuban,
                    'foto_paguyuban' => $foto_paguyuban,
                    'telepon_paguyuban' => $telepon_paguyuban,
                    'lat_paguyuban' => $lat_paguyuban,
                    'lng_paguyuban' => $lng_paguyuban,
                    'no_rekening' => $no_rekening,
                    'pemilik_rekening' => $pemilik_rekening,
                    'paguyuban_created' => time(),
                );

                if ($this->Paguyuban_model->insertPaguyuban($data)) { // * jika berhasil input
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Berhasil menambahkan paguyuban</div>');

                    redirect('paguyuban/paguyuban');
                } else { // ! jika gagal input
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Gagal menambahkan paguyuban</div>');

                    redirect('paguyuban/paguyuban');
                }
            }
        }
    }

    public function editPaguyuban($id_paguyuban)
    {
        $data['title'] = "Paguyuban";
        $data['menu'] = "paguyuban_paguyuban";
        $data['sub_menu'] = "paguyuban_edit";
        $data['sub_menu_action'] = null;
        // user data        
        $data['user'] = $this->User_model->getUser('id_user', $this->session->userdata('id_user'));
        $data['paguyuban'] = $this->Paguyuban_model->getPaguyuban('id_paguyuban', $id_paguyuban);
        $data['count_unconfirmed_reservasi'] = $this->Reservasi_model->countReservasi('unconfirmed_paguyuban', $data['paguyuban']['id_paguyuban']);
        $data['count_unconfirmed_transaksi'] = $this->Transaksi_model->countTransaksi('unconfirmed_paguyuban', $data['paguyuban']['id_paguyuban']);

        // validation forms                        
        $this->form_validation->set_rules('nama_paguyuban', 'Nama Paguyuban', 'required|trim');
        $this->form_validation->set_rules('deskripsi_paguyuban', 'Deskripsi', 'required|trim');
        $this->form_validation->set_rules('alamat_paguyuban', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('telepon_paguyuban', 'Telepon', 'required|trim');
        $this->form_validation->set_rules('lat_paguyuban', 'Latitude', 'required|trim|numeric');
        $this->form_validation->set_rules('lng_paguyuban', 'Longitude', 'required|trim|numeric');
        $this->form_validation->set_rules('no_rekening', 'No REKENING', 'required|trim|numeric');
        $this->form_validation->set_rules('pemilik_rekening', 'Pemilik Rekening', 'required|trim');

        if ($this->form_validation->run() == FALSE) { // * jika belum input form
            $this->load->view('template/panel/header_view', $data);
            $this->load->view('template/panel/sidebar_paguyuban_view');
            $this->load->view('paguyuban/edit_paguyuban_view');
            $this->load->view('template/panel/control_view');
            $this->load->view('template/panel/footer_view');
        } else { // * jika sudah input
            $submitType = $this->input->post('submit-type');

            $id_user = $this->session->userdata('id_user');
            $nama_paguyuban = $this->input->post('nama_paguyuban');
            $deskripsi_paguyuban = $this->input->post('deskripsi_paguyuban');
            $alamat_paguyuban = $this->input->post('alamat_paguyuban');
            $telepon_paguyuban = $this->input->post('telepon_paguyuban');
            $lat_paguyuban = $this->input->post('lat_paguyuban');
            $lng_paguyuban = $this->input->post('lng_paguyuban');
            $no_rekening = $this->input->post('no_rekening');
            $pemilik_rekening = $this->input->post('pemilik_rekening');

            if ($submitType == 'Simpan') { // * jika simpan data
                $paguyuban = $this->Paguyuban_model->getPaguyuban('id_paguyuban', $id_paguyuban);

                if ($_FILES['foto_paguyuban']['error'] != 4) {
                    $foto_paguyuban = $this->upload_image('foto_paguyuban', './assets/img/paguyuban/');
                } else {
                    $foto_paguyuban = $paguyuban['foto_paguyuban'];
                }

                // * data paguyuban yang akan diinput
                $data = array(
                    'id_user' => $id_user,
                    'nama_paguyuban' => $nama_paguyuban,
                    'deskripsi_paguyuban' => $deskripsi_paguyuban,
                    'alamat_paguyuban' => $alamat_paguyuban,
                    'foto_paguyuban' => $foto_paguyuban,
                    'telepon_paguyuban' => $telepon_paguyuban,
                    'lat_paguyuban' => $lat_paguyuban,
                    'lng_paguyuban' => $lng_paguyuban,
                    'no_rekening' => $no_rekening,
                    'pemilik_rekening' => $pemilik_rekening,
                    'paguyuban_updated' => time(),
                );

                if ($this->Paguyuban_model->updatePaguyuban('id_paguyuban', $data, $id_paguyuban)) { // * jika berhasil update
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Berhasil merubah paguyuban</div>');

                    redirect('paguyuban/paguyuban');
                } else { // ! jika gagal input
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Gagal merubah paguyuban</div>');

                    redirect('paguyuban/paguyuban');
                }
            }
        }
    }

    // * halaman paguyuban ===================================================================================

    // * halaman jasa ===================================================================================
    public function jasa()
    {
        $data['title'] = "Jasa";
        $data['menu'] = "jasa_paguyuban";
        $data['sub_menu'] = null;
        $data['sub_menu_action'] = null;
        // user data        
        $data['user'] = $this->User_model->getUser('id_user', $this->session->userdata('id_user'));
        $data['paguyuban'] = $this->Paguyuban_model->getPaguyuban('id_user', $this->session->userdata('id_user'));
        $data['count_unconfirmed_reservasi'] = 0;
        $data['count_unconfirmed_transaksi'] = 0;

        if ($data['paguyuban']) {
            $data['jasa'] = $this->Jasa_model->getJasa('all_paguyuban', $data['paguyuban']['id_paguyuban']);
            $data['count_unconfirmed_reservasi'] = $this->Reservasi_model->countReservasi('unconfirmed_paguyuban', $data['paguyuban']['id_paguyuban']);
            $data['count_unconfirmed_transaksi'] = $this->Transaksi_model->countTransaksi('unconfirmed_paguyuban', $data['paguyuban']['id_paguyuban']);
        }

        // validation forms                
        $this->form_validation->set_rules('id_paguyuban', 'Paguyuban', 'required|trim');
        $this->form_validation->set_rules('nama_jasa', 'Jasa', 'required|trim');
        $this->form_validation->set_rules('deskripsi_jasa', 'Deskripsi', 'required|trim');
        $this->form_validation->set_rules('harga_jasa', 'Harga', 'required|trim');

        if ($this->form_validation->run() == FALSE) { // * jika belum input form
            $this->load->view('template/panel/header_view', $data);
            $this->load->view('template/panel/sidebar_paguyuban_view');
            $this->load->view('paguyuban/jasa_paguyuban_view');
            $this->load->view('template/panel/control_view');
            $this->load->view('template/panel/footer_view');
        } else { // * jika sudah input
            $submitType = $this->input->post('submit-type');

            $id_paguyuban = $this->input->post('id_paguyuban');
            $nama_jasa = $this->input->post('nama_jasa');
            $deskripsi_jasa = $this->input->post('deskripsi_jasa');
            $harga_jasa = $this->input->post('harga_jasa');

            if ($submitType == 'Tambah') { // * jika tambah data

                if ($_FILES['foto_jasa']['error'] != 4) {
                    $foto_jasa = $this->upload_image('foto_jasa', './assets/img/jasa/');
                } else {
                    $foto_jasa = 'no-image.jpg';
                }

                // * data jasa yang akan diinput
                $data = array(
                    'id_paguyuban' => $id_paguyuban,
                    'nama_jasa' => $nama_jasa,
                    'deskripsi_jasa' => $deskripsi_jasa,
                    'harga_jasa' => $harga_jasa,
                    'foto_jasa' => $foto_jasa,
                    'jasa_created' => time(),
                );

                if ($this->Jasa_model->insertJasa($data)) { // * jika berhasil input jasa
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Berhasil menambahkan jasa</div>');

                    redirect('paguyuban/jasa');
                } else { // ! jika gagal input jasa
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Gagal menambahkan jasa</div>');

                    redirect('paguyuban/jasa');
                }
            } else { // * jika edit data
                $id_jasa = $this->input->post('id_jasa');
                $jasa = $this->Jasa_model->getJasa('id_jasa', $id_jasa);

                if ($_FILES['foto_jasa']['error'] != 4) {
                    $foto_jasa = $this->upload_image('foto_jasa', './assets/img/jasa/');
                } else {
                    $foto_jasa = $jasa['foto_jasa'];
                }

                $data = array(
                    'id_paguyuban' => $id_paguyuban,
                    'nama_jasa' => $nama_jasa,
                    'deskripsi_jasa' => $deskripsi_jasa,
                    'harga_jasa' => $harga_jasa,
                    'foto_jasa' => $foto_jasa,
                    'jasa_updated' => time(),
                );

                if ($this->Jasa_model->updateJasa('id_jasa', $data, $id_jasa)) { // * jika berhasil update jasa
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Berhasil merubah jasa</div>');

                    redirect('paguyuban/jasa');
                } else { // ! jika gagal update jasa
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Gagal merubah jasa</div>');

                    redirect('paguyuban/jasa');
                }
            }
        }
    }

    // * untuk menampilkan detail jasa
    public function editJasa($id_jasa)
    {
        $data['jasa'] = $this->Jasa_model->getJasa('id_jasa', $id_jasa);
        $data['paguyuban'] = $this->Paguyuban_model->getPaguyuban('id_user', $this->session->userdata('id_user'));

        $this->load->view('paguyuban/ajax/edit_jasa_form', $data);
    }

    // * untuk menghapus jasa
    public function deleteJasa($id_jasa)
    {
        if ($this->Jasa_model->deleteJasa('id_jasa', $id_jasa)) { // * jika berhasil menghapus
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Berhasil menghapus jasa</div>');

            redirect('paguyuban/jasa');
        } else { // ! jika gagal menghapus
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Gagal menghapus jasa</div>');

            redirect('paguyuban/jasa');
        }
    }
    // * halaman jasa ===================================================================================

    // * halaman reservasi ===================================================================================
    public function reservasi()
    {
        $data['title'] = "Reservasi";
        $data['menu'] = "reservasi_paguyuban";
        $data['sub_menu'] = null;
        $data['sub_menu_action'] = null;
        // user data        
        $data['user'] = $this->User_model->getUser('id_user', $this->session->userdata('id_user'));
        $data['paguyuban'] = $this->Paguyuban_model->getPaguyuban('id_user', $this->session->userdata('id_user'));
        $data['count_unconfirmed_reservasi'] = 0;
        $data['count_unconfirmed_transaksi'] = 0;

        if ($data['paguyuban']) {
            $data['reservasi'] = $this->Reservasi_model->getReservasi('all_paguyuban', $data['paguyuban']['id_paguyuban']);
            $data['count_unconfirmed_reservasi'] = $this->Reservasi_model->countReservasi('unconfirmed_paguyuban', $data['paguyuban']['id_paguyuban']);
            $data['count_unconfirmed_transaksi'] = $this->Transaksi_model->countTransaksi('unconfirmed_paguyuban', $data['paguyuban']['id_paguyuban']);
            $data['jasa'] = $this->Jasa_model->getJasa('all_paguyuban', $data['paguyuban']['id_paguyuban']);
        }

        // validation forms                                
        $this->form_validation->set_rules('status_reservasi', 'Status Reservasi', 'required|trim|numeric');

        if ($this->form_validation->run() == FALSE) { // * jika belum input form
            $this->load->view('template/panel/header_view', $data);
            $this->load->view('template/panel/sidebar_paguyuban_view');
            $this->load->view('paguyuban/reservasi_paguyuban_view');
            $this->load->view('template/panel/control_view');
            $this->load->view('template/panel/footer_view');
        } else { // * jika sudah input            
            $id_reservasi = $this->input->post('id_reservasi');
            $status_reservasi = $this->input->post('status_reservasi');

            $data = array(
                'status_reservasi' => $status_reservasi,
                'reservasi_updated' => time(),
            );

            if ($this->Reservasi_model->updateReservasi('id_reservasi', $data, $id_reservasi)) { // * jika berhasil update reservasi
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Berhasil merubah reservasi</div>');

                redirect('paguyuban/reservasi');
            } else { // ! jika gagal update reservasi
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Gagal merubah reservasi</div>');

                redirect('paguyuban/reservasi');
            }
        }
    }

    // * untuk menampilkan detail reservasi
    public function editReservasi($id_reservasi)
    {
        $data['reservasi'] = $this->Reservasi_model->getReservasi('id_reservasi', $id_reservasi);

        $this->load->view('paguyuban/ajax/edit_reservasi_form', $data);
    }

    // * untuk menghapus reservasi
    public function deleteReservasi($id_reservasi)
    {
        if ($this->Reservasi_model->deleteReservasi('id_reservasi', $id_reservasi)) { // * jika berhasil menghapus
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Berhasil menghapus reservasi</div>');

            redirect('paguyuban/reservasi');
        } else { // ! jika gagal menghapus
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Gagal menghapus reservasi</div>');

            redirect('paguyuban/reservasi');
        }
    }
    // * halaman reservasi ===================================================================================

    // * halaman transaksi ===================================================================================
    public function transaksi()
    {
        $data['title'] = "Transaksi";
        $data['menu'] = "transaksi_paguyuban";
        $data['sub_menu'] = null;
        $data['sub_menu_action'] = null;
        // user data        
        $data['user'] = $this->User_model->getUser('id_user', $this->session->userdata('id_user'));
        $data['paguyuban'] = $this->Paguyuban_model->getPaguyuban('id_user', $this->session->userdata('id_user'));
        $data['count_unconfirmed_reservasi'] = 0;
        $data['count_unconfirmed_transaksi'] = 0;

        if ($data['paguyuban']) {
            $data['transaksi'] = $this->Transaksi_model->getTransaksi('all_paguyuban', $data['paguyuban']['id_paguyuban']);
            $data['count_unconfirmed_reservasi'] = $this->Reservasi_model->countReservasi('unconfirmed_paguyuban', $data['paguyuban']['id_paguyuban']);
            $data['count_unconfirmed_transaksi'] = $this->Transaksi_model->countTransaksi('unconfirmed_paguyuban', $data['paguyuban']['id_paguyuban']);
        }

        // validation forms                        
        $this->form_validation->set_rules('status_transaksi', 'Status', 'required|trim');

        if ($this->form_validation->run() == FALSE) { // * jika belum input form
            $this->load->view('template/panel/header_view', $data);
            $this->load->view('template/panel/sidebar_paguyuban_view');
            $this->load->view('paguyuban/transaksi_paguyuban_view');
            $this->load->view('template/panel/control_view');
            $this->load->view('template/panel/footer_view');
        } else { // * jika sudah input        
            $id_transaksi = $this->input->post('id_transaksi');
            $status_transaksi = $this->input->post('status_transaksi');

            $data = array(
                'status_transaksi' => $status_transaksi,
                'transaksi_updated' => time(),
            );

            if ($this->Transaksi_model->updateTransaksi('id_transaksi', $data, $id_transaksi)) { // * jika berhasil update transaksi
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Berhasil merubah transaksi</div>');

                redirect('paguyuban/transaksi');
            } else { // ! jika gagal update transaksi
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Gagal merubah transaksi</div>');

                redirect('paguyuban/transaksi');
            }
        }
    }

    // * untuk menampilkan detail transaksi
    public function editTransaksi($id_transaksi)
    {
        $data['transaksi'] = $this->Transaksi_model->getTransaksi('id_transaksi', $id_transaksi);

        $this->load->view('paguyuban/ajax/edit_transaksi_form', $data);
    }

    // * untuk menghapus transaksi
    public function deleteTransaksi($id_transaksi)
    {
        if ($this->Transaksi_model->deleteTransaksi('id_transaksi', $id_transaksi)) { // * jika berhasil menghapus
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Berhasil menghapus transaksi</div>');

            redirect('paguyuban/transaksi');
        } else { // ! jika gagal menghapus
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Gagal menghapus transaksi</div>');

            redirect('paguyuban/transaksi');
        }
    }
    // * halaman transaksi ===================================================================================f

    // * halaman settings ===================================================================================
    public function settings()
    {
        $data['title'] = "Settings";
        $data['menu'] = "settings";
        $data['sub_menu'] = null;
        $data['sub_menu_action'] = null;
        // user data        
        $data['user'] = $this->User_model->getUser('id_user', $this->session->userdata('id_user'));
        $data['paguyuban'] = $this->Paguyuban_model->getPaguyuban('id_user', $this->session->userdata('id_user'));
        $data['count_unconfirmed_reservasi'] = 0;
        $data['count_unconfirmed_transaksi'] = 0;

        if ($data['paguyuban']) {
            $data['reservasi'] = $this->Reservasi_model->getReservasi('all_paguyuban', $data['paguyuban']['id_paguyuban']);
            $data['count_unconfirmed_reservasi'] = $this->Reservasi_model->countReservasi('unconfirmed_paguyuban', $data['paguyuban']['id_paguyuban']);
            $data['count_unconfirmed_transaksi'] = $this->Transaksi_model->countTransaksi('unconfirmed_paguyuban', $data['paguyuban']['id_paguyuban']);
            $data['jasa'] = $this->Jasa_model->getJasa('all_paguyuban', $data['paguyuban']['id_paguyuban']);
        }

        if ($this->input->post('update_action') == 'profile') {
            // config edit profil
            $this->form_validation->set_rules('username', 'Username', 'required|trim|max_length[50]');
            $this->form_validation->set_rules('telepon_user', 'Telepon', 'required|trim|max_length[16]|numeric');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|max_length[50]');
        } else {
            $this->form_validation->set_rules('password_lama', 'Password', 'required|trim|max_length[20]|min_length[6]');
            $this->form_validation->set_rules('password_baru', 'Password', 'required|trim|max_length[20]|min_length[6]');
            $this->form_validation->set_rules('password_baru_ver', 'Password verifikasi', 'required|trim|max_length[20]|min_length[6]|matches[password_baru]');
        }

        if ($this->form_validation->run() == FALSE) { // * jika belum input form
            $this->load->view('template/panel/header_view', $data);
            $this->load->view('template/panel/sidebar_paguyuban_view');
            $this->load->view('paguyuban/settings_paguyuban_view');
            $this->load->view('template/panel/control_view');
            $this->load->view('template/panel/footer_view');
        } else { // * jika sudah input            
            $user = $this->User_model->getUser('id_user', $this->session->userdata('id_user'));

            // cek apakah ada aksi rubah profil
            if ($this->input->post('update_action') == 'profile') { // ? edit profile
                // update thumbnail atatu tidak
                if ($_FILES['foto_user']['error'] != 4) {
                    $foto_user = $this->upload_image('foto_user', './assets/img/');
                } else {
                    $foto_user = $user['foto_user'];
                }

                $data = [
                    'username' => htmlspecialchars($this->input->post('username', true)),
                    'email' => strtoupper(htmlspecialchars($this->input->post('email', true))),
                    'telepon_user' => htmlspecialchars($this->input->post('telepon_user', true)),
                    'foto_user' => $foto_user,
                    'user_updated' => time(),
                ];

                if ($this->User_model->updateUser('id_user', $data, $this->session->userdata('id_user'))) { // * jika berhasil rubah
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Profile berhasil dirubah</div>');

                    redirect('paguyuban/settings');
                } else { // ! jika gagal rubah
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Profile gagal dirubah</div>');

                    redirect('paguyuban/settings');
                }
            } else { // ? edit password
                $password_lama = $this->input->post('password_lama');
                $password_baru = $this->input->post('password_baru');

                // * jika password lama salah
                if (!password_verify($password_lama, $user['password'])) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Password lama tidak sesuai</div>');

                    redirect('paguyuban/settings');
                }

                $data = array(
                    'password' => password_hash($password_baru, PASSWORD_DEFAULT),
                );

                if ($this->User_model->updateUser('id_user', $data, $this->session->userdata('id_user'))) { // * jika berhasil rubah password
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Password berhasil dirubah</div>');

                    redirect('paguyuban/settings');
                } else { // ! jika gagal rubah
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Password gagal dirubah</div>');

                    redirect('paguyuban/settings');
                }
            }
        }
    }
    // * halaman setting ===================================================================================

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
