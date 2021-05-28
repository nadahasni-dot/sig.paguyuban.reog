<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('role') != 1) {
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
        $data['menu'] = "beranda";
        $data['sub_menu'] = null;
        $data['sub_menu_action'] = null;
        // user data
        $data['user'] = $this->User_model->getUser('id_user', $this->session->userdata('id_user'));
        $data['count_user'] = $this->User_model->countUser('role', 3);
        $data['count_paguyuban'] = $this->Paguyuban_model->countPaguyuban('all');
        $data['count_jasa'] = $this->Jasa_model->countJasa('all');
        $data['count_transaksi'] = $this->Transaksi_model->countTransaksi('confirmed');

        $data['paguyuban'] = $this->Paguyuban_model->getPaguyuban('all');

        $this->load->view('template/panel/header_view', $data);
        $this->load->view('template/panel/sidebar_admin_view');
        $this->load->view('admin/home_admin_view');
        $this->load->view('template/panel/control_view');
        $this->load->view('template/panel/footer_view');
    }

    // * halaman pengguna ===================================================================================
    public function pengguna()
    {
        $data['title'] = "Pengguna";
        $data['menu'] = "pengguna";
        $data['sub_menu'] = null;
        $data['sub_menu_action'] = null;
        // user data
        switch ($this->input->get('category')) {
            case 'all':
                $data['pengguna'] = $this->User_model->getUser('all');
                break;
            case 'admin':
                $data['pengguna'] = $this->User_model->getUser('role', 1);
                break;
            case 'paguyuban':
                $data['pengguna'] = $this->User_model->getUser('role', 2);
                break;
            case 'umum':
                $data['pengguna'] = $this->User_model->getUser('role', 3);
                break;
            case 'notverified':
                $data['pengguna'] = $this->User_model->getUser('notverified');
                break;
            default:
                $data['pengguna'] = $this->User_model->getUser('all');
        }

        $data['user'] = $this->User_model->getUser('id_user', $this->session->userdata('id_user'));
        $data['allUsers'] = $this->User_model->getUser('all');
        $data['notVerifiedUsers'] = $this->User_model->getUser('notverified');
        $data['adminUsers'] = $this->User_model->getUser('role', 1);
        $data['paguyubanUsers'] = $this->User_model->getUser('role', 2);
        $data['umumUsers'] = $this->User_model->getUser('role', 3);

        // validation forms                
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('role', 'Role', 'required|trim');

        if ($this->form_validation->run() == FALSE) { // * jika belum input form
            $this->load->view('template/panel/header_view', $data);
            $this->load->view('template/panel/sidebar_admin_view');
            $this->load->view('admin/pengguna_admin_view');
            $this->load->view('template/panel/control_view');
            $this->load->view('template/panel/footer_view');
        } else { // * jika sudah input
            $submitType = $this->input->post('submit-type');
            $username = $this->input->post('username');
            $email = $this->input->post('email');
            $telepon_user = $this->input->post('telepon_user');
            $status_user = $this->input->post('status_user');
            $role = $this->input->post('role');
            $password = $this->input->post('password');

            if ($submitType == 'Tambah') { // * jika tambah data

                // * data pengguna yang akan diinput
                $data_user = array(
                    'username' => $username,
                    'telepon_user' => $telepon_user,
                    'status_user' => $status_user,
                    'email' => $email,
                    'foto_user' => 'user-no-image.jpg',
                    'role' => $role,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'user_created' => time(),
                );

                if ($this->User_model->insertUser($data_user)) { // * jika berhasil input user
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Berhasil menambahkan pengguna</div>');

                    redirect('admin/pengguna');
                } else { // ! jika gagal input user
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Gagal menambahkan pengguna</div>');

                    redirect('admin/pengguna');
                }
            } else { // * jika edit data
                $id_user = $this->input->post('id_user');

                if ($password == '' || $password == NULL) { // * jika tidak rubah password
                    $data_update_user = array(
                        'username' => $username,
                        'email' => $email,
                        'role' => $role,
                        'status_user' => $status_user,
                        'telepon_user' => $telepon_user,
                        'user_updated' => time(),
                    );
                } else { // * jika rubah password
                    $data_update_user = array(
                        'username' => $username,
                        'email' => $email,
                        'telepon_user' => $telepon_user,
                        'status_user' => $status_user,
                        'role' => $role,
                        'password' => password_hash($password, PASSWORD_DEFAULT),
                        'user_updated' => time(),
                    );
                }

                if ($this->User_model->updateUser('id_user', $data_update_user, $id_user)) { // * jika berhasil update pengguna
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Berhasil merubah pengguna</div>');

                    redirect('admin/pengguna');
                } else { // ! jika gagal update pengguna
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Gagal merubah pengguna</div>');

                    redirect('admin/pengguna');
                }
            }
        }
    }

    // * untuk menampilkan detail pengguna
    public function editPengguna($id_user)
    {
        $data['user'] = $this->User_model->getUser('id_user', $id_user);

        $this->load->view('admin/ajax/edit_pengguna_form', $data);
    }

    // * untuk menghapus pengguna
    public function deletePengguna($id_pengguna)
    {
        if ($this->User_model->deleteUser('id_user', $id_pengguna)) { // * jika berhasil menghapus
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Berhasil menghapus pengguna</div>');

            redirect('admin/pengguna');
        } else { // ! jika gagal menghapus
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Gagal menghapus pengguna</div>');

            redirect('admin/pengguna');
        }
    }
    // * halaman pengguna ===================================================================================

    // * halaman paguyuban ===================================================================================
    public function paguyuban()
    {
        $data['title'] = "Paguyuban";
        $data['menu'] = "paguyuban";
        $data['sub_menu'] = null;
        $data['sub_menu_action'] = null;
        // user data        
        $data['user'] = $this->User_model->getUser('id_user', $this->session->userdata('id_user'));
        $data['owner'] = $this->User_model->getUser('role', 2);
        $data['paguyuban'] = $this->Paguyuban_model->getPaguyuban('all');

        // validation forms                
        $this->form_validation->set_rules('id_user', 'Pemilik Paguyuban', 'required|trim');
        $this->form_validation->set_rules('nama_paguyuban', 'Nama Paguyuban', 'required|trim');
        $this->form_validation->set_rules('deskripsi_paguyuban', 'Deskripsi', 'required|trim');
        $this->form_validation->set_rules('alamat_paguyuban', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('telepon_paguyuban', 'Telepon', 'required|trim');
        $this->form_validation->set_rules('lat_paguyuban', 'Latitude', 'required|trim|numeric');
        $this->form_validation->set_rules('lng_paguyuban', 'Longitude', 'required|trim|numeric');

        if ($this->form_validation->run() == FALSE) { // * jika belum input form
            $this->load->view('template/panel/header_view', $data);
            $this->load->view('template/panel/sidebar_admin_view');
            $this->load->view('admin/paguyuban_admin_view');
            $this->load->view('template/panel/control_view');
            $this->load->view('template/panel/footer_view');
        } else { // * jika sudah input
            $submitType = $this->input->post('submit-type');
            $id_user = $this->input->post('id_user');
            $nama_paguyuban = $this->input->post('nama_paguyuban');
            $deskripsi_paguyuban = $this->input->post('deskripsi_paguyuban');
            $alamat_paguyuban = $this->input->post('alamat_paguyuban');
            $telepon_paguyuban = $this->input->post('telepon_paguyuban');
            $lat_paguyuban = $this->input->post('lat_paguyuban');
            $lng_paguyuban = $this->input->post('lng_paguyuban');

            if ($submitType == 'Tambah') { // * jika tambah data
                $paguyuban = $this->Paguyuban_model->getPaguyuban('owner', $id_user);
                $user = $this->User_model->getUser('id_user', $id_user);
                if ($paguyuban) { // jika user telah memiliki paguyuban maka tidak boleh buat
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . $user['username'] . ' telah terdaftar pada paguyuban ' . $paguyuban['nama_paguyuban'] . '</div>');

                    redirect('admin/paguyuban');
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
                    'paguyuban_created' => time(),
                );

                if ($this->Paguyuban_model->insertPaguyuban($data)) { // * jika berhasil input
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Berhasil menambahkan paguyuban</div>');

                    redirect('admin/paguyuban');
                } else { // ! jika gagal input
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Gagal menambahkan paguyuban</div>');

                    redirect('admin/paguyuban');
                }
            } else { // * jika edit data                
                $id_paguyuban = $this->input->post('id_paguyuban');
                $owner = $this->input->post('owner');
                $paguyuban = $this->Paguyuban_model->getPaguyuban('id_paguyuban', $id_paguyuban);

                if ($owner != $id_user) { // jika owner dirubah
                    $paguyuban = $this->Paguyuban_model->getPaguyuban('owner', $id_user);
                    $user = $this->User_model->getUser('id_user', $id_user);
                    if ($paguyuban) { // jika user telah memiliki paguyuban maka tidak boleh buat
                        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . $user['username'] . ' telah terdaftar pada paguyuban ' . $paguyuban['nama_paguyuban'] . '</div>');

                        redirect('admin/paguyuban');
                    }
                }

                if ($_FILES['foto_paguyuban']['error'] != 4) {
                    $foto_paguyuban = $this->upload_image('foto_paguyuban', './assets/img/paguyuban/');
                } else {
                    $foto_paguyuban = $paguyuban['foto_paguyuban'];
                }

                $data = array(
                    'id_user' => $id_user,
                    'nama_paguyuban' => $nama_paguyuban,
                    'deskripsi_paguyuban' => $deskripsi_paguyuban,
                    'alamat_paguyuban' => $alamat_paguyuban,
                    'foto_paguyuban' => $foto_paguyuban,
                    'telepon_paguyuban' => $telepon_paguyuban,
                    'lat_paguyuban' => $lat_paguyuban,
                    'lng_paguyuban' => $lng_paguyuban,
                    'paguyuban_updated' => time(),
                );

                if ($this->Paguyuban_model->updatePaguyuban('id_paguyuban', $data, $id_paguyuban)) { // * jika berhasil update
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Berhasil merubah paguyuban</div>');

                    redirect('admin/paguyuban');
                } else { // ! jika gagal update paguyuban
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Gagal merubah paguyuban</div>');

                    redirect('admin/paguyuban');
                }
            }
        }
    }

    // * untuk menampilkan artikel dari paguyuban
    public function detailPaguyuban($id_paguyuban)
    {
        $data['title'] = "Detail Paguyuban";
        $data['menu'] = "paguyuban";
        $data['sub_menu'] = "detail_paguyuban";
        $data['sub_menu_action'] = null;
        // user data        
        $data['user'] = $this->User_model->getUser('id_user', $this->session->userdata('id_user'));
        $data['paguyuban'] = $this->Paguyuban_model->getPaguyuban('id_paguyuban', $id_paguyuban);
        $data['count_jasa'] = $this->Jasa_model->countJasa('all_paguyuban', $id_paguyuban);
        $data['count_reservasi'] = $this->Reservasi_model->countReservasi('all_paguyuban', $id_paguyuban);
        $data['count_transaksi'] = $this->Transaksi_model->countTransaksi('confirmed_paguyuban', $id_paguyuban);

        $this->load->view('template/panel/header_view', $data);
        $this->load->view('template/panel/sidebar_admin_view');
        $this->load->view('admin/paguyuban_detail_admin_view');
        $this->load->view('template/panel/control_view');
        $this->load->view('template/panel/footer_view');
    }

    public function editPaguyuban($id_paguyuban)
    {
        $data['paguyuban'] = $this->Paguyuban_model->getPaguyuban('id_paguyuban', $id_paguyuban);
        $data['owner'] = $this->User_model->getUser('role', 2);

        $this->load->view('admin/ajax/edit_paguyuban_form', $data);
    }

    // * untuk menghapus paguyuban
    public function deletePaguyuban($id_paguyuban)
    {
        if ($this->Paguyuban_model->deletePaguyuban('id_paguyuban', $id_paguyuban)) { // * jika berhasil menghapus
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Berhasil menghapus paguyuban</div>');

            redirect('admin/paguyuban');
        } else { // ! jika gagal menghapus
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Gagal menghapus paguyuban</div>');

            redirect('admin/paguyuban');
        }
    }
    // * halaman pengguna ===================================================================================

    // * halaman jasa ===================================================================================
    public function jasa()
    {
        $data['title'] = "Jasa";
        $data['menu'] = "jasa";
        $data['sub_menu'] = null;
        $data['sub_menu_action'] = null;
        // user data        
        $data['user'] = $this->User_model->getUser('id_user', $this->session->userdata('id_user'));

        $data['jasa'] = $this->Jasa_model->getJasa('all');
        $data['paguyuban'] = $this->Paguyuban_model->getPaguyuban('all');

        // validation forms                
        $this->form_validation->set_rules('id_paguyuban', 'Paguyuban', 'required|trim');
        $this->form_validation->set_rules('nama_jasa', 'Jasa', 'required|trim');
        $this->form_validation->set_rules('deskripsi_jasa', 'Deskripsi', 'required|trim');
        $this->form_validation->set_rules('harga_jasa', 'Harga', 'required|trim');

        if ($this->form_validation->run() == FALSE) { // * jika belum input form
            $this->load->view('template/panel/header_view', $data);
            $this->load->view('template/panel/sidebar_admin_view');
            $this->load->view('admin/jasa_admin_view');
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

                    redirect('admin/jasa');
                } else { // ! jika gagal input jasa
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Gagal menambahkan jasa</div>');

                    redirect('admin/jasa');
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

                    redirect('admin/jasa');
                } else { // ! jika gagal update jasa
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Gagal merubah jasa</div>');

                    redirect('admin/jasa');
                }
            }
        }
    }

    // * untuk menampilkan detail jasa
    public function editJasa($id_jasa)
    {
        $data['jasa'] = $this->Jasa_model->getJasa('id_jasa', $id_jasa);
        $data['paguyuban'] = $this->Paguyuban_model->getPaguyuban('all');

        $this->load->view('admin/ajax/edit_jasa_form', $data);
    }

    // * untuk menghapus jasa
    public function deleteJasa($id_jasa)
    {
        if ($this->Jasa_model->deleteJasa('id_jasa', $id_jasa)) { // * jika berhasil menghapus
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Berhasil menghapus jasa</div>');

            redirect('admin/jasa');
        } else { // ! jika gagal menghapus
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Gagal menghapus jasa</div>');

            redirect('admin/jasa');
        }
    }
    // * halaman jasa ===================================================================================

    // * halaman reservasi ===================================================================================
    public function reservasi()
    {
        $data['title'] = "Reservasi";
        $data['menu'] = "reservasi";
        $data['sub_menu'] = null;
        $data['sub_menu_action'] = null;
        // user data        
        $data['user'] = $this->User_model->getUser('id_user', $this->session->userdata('id_user'));
        $data['umum'] = $this->User_model->getUser('role', 3);

        $data['reservasi'] = $this->Reservasi_model->getReservasi('all');
        $data['jasa'] = $this->Jasa_model->getJasa('all');

        // validation forms
        $this->form_validation->set_rules('id_user', 'Pemesan', 'required|trim');
        $this->form_validation->set_rules('jasa_paguyuban', 'Jasa', 'required|trim');
        $this->form_validation->set_rules('tanggal_reservasi', 'Tanggal Reservasi', 'required|trim');
        $this->form_validation->set_rules('deskripsi_reservasi', 'Deskripsi Reservasi', 'required|trim');
        $this->form_validation->set_rules('status_reservasi', 'Status Reservasi', 'required|trim|numeric');

        if ($this->form_validation->run() == FALSE) { // * jika belum input form
            $this->load->view('template/panel/header_view', $data);
            $this->load->view('template/panel/sidebar_admin_view');
            $this->load->view('admin/reservasi_admin_view');
            $this->load->view('template/panel/control_view');
            $this->load->view('template/panel/footer_view');
        } else { // * jika sudah input
            $submitType = $this->input->post('submit-type');
            $id_user = $this->input->post('id_user');
            $tanggal_reservasi = $this->input->post('tanggal_reservasi');
            $deskripsi_reservasi = $this->input->post('deskripsi_reservasi');
            $status_reservasi = $this->input->post('status_reservasi');
            $jasa_paguyuban = explode('.', $this->input->post('jasa_paguyuban'));
            $id_jasa = $jasa_paguyuban[0];
            $id_paguyuban = $jasa_paguyuban[1];

            if ($submitType == 'Tambah') { // * jika tambah data

                // * data jasa yang akan diinput
                $data = array(
                    'id_user' => $id_user,
                    'id_jasa' => $id_jasa,
                    'id_paguyuban' => $id_paguyuban,
                    'tanggal_reservasi' => $tanggal_reservasi,
                    'deskripsi_reservasi' => $deskripsi_reservasi,
                    'status_reservasi' => $status_reservasi,
                    'reservasi_created' => time(),
                );

                if ($this->Reservasi_model->insertReservasi($data)) { // * jika berhasil input reservasi
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Berhasil menambahkan reservasi</div>');

                    redirect('admin/reservasi');
                } else { // ! jika gagal input reservasi
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Gagal menambahkan reservasi</div>');

                    redirect('admin/reservasi');
                }
            } else { // * jika edit data
                $id_reservasi = $this->input->post('id_reservasi');

                $data = array(
                    'id_user' => $id_user,
                    'id_jasa' => $id_jasa,
                    'id_paguyuban' => $id_paguyuban,
                    'tanggal_reservasi' => $tanggal_reservasi,
                    'deskripsi_reservasi' => $deskripsi_reservasi,
                    'status_reservasi' => $status_reservasi,
                    'reservasi_updated' => time(),
                );

                if ($this->Reservasi_model->updateReservasi('id_reservasi', $data, $id_reservasi)) { // * jika berhasil update reservasi
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Berhasil merubah reservasi</div>');

                    redirect('admin/reservasi');
                } else { // ! jika gagal update reservasi
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Gagal merubah reservasi</div>');

                    redirect('admin/reservasi');
                }
            }
        }
    }

    // * untuk menampilkan detail reservasi
    public function editReservasi($id_reservasi)
    {
        $data['reservasi'] = $this->Reservasi_model->getReservasi('id_reservasi', $id_reservasi);
        $data['jasa'] = $this->Jasa_model->getJasa('all');
        $data['umum'] = $this->User_model->getUser('role', 3);

        $this->load->view('admin/ajax/edit_reservasi_form', $data);
    }

    // * untuk menghapus reservasi
    public function deleteReservasi($id_reservasi)
    {
        if ($this->Reservasi_model->deleteReservasi('id_reservasi', $id_reservasi)) { // * jika berhasil menghapus
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Berhasil menghapus reservasi</div>');

            redirect('admin/reservasi');
        } else { // ! jika gagal menghapus
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Gagal menghapus reservasi</div>');

            redirect('admin/reservasi');
        }
    }
    // * halaman reservasi ===================================================================================

    // * halaman transaksi ===================================================================================
    public function transaksi()
    {
        $data['title'] = "Transaksi";
        $data['menu'] = "transaksi";
        $data['sub_menu'] = null;
        $data['sub_menu_action'] = null;
        // user data        
        $data['user'] = $this->User_model->getUser('id_user', $this->session->userdata('id_user'));

        $data['transaksi'] = $this->Transaksi_model->getTransaksi('all');
        $data['reservasi'] = $this->Reservasi_model->getReservasi('all');

        // validation forms                
        $this->form_validation->set_rules('id_reservasi', 'Reservasi', 'required|trim');
        $this->form_validation->set_rules('tanggal_transaksi', 'Tanggal', 'required|trim');
        $this->form_validation->set_rules('nominal_transaksi', 'Nominal', 'required|trim');
        $this->form_validation->set_rules('status_transaksi', 'Status', 'required|trim');

        if ($this->form_validation->run() == FALSE) { // * jika belum input form
            $this->load->view('template/panel/header_view', $data);
            $this->load->view('template/panel/sidebar_admin_view');
            $this->load->view('admin/transaksi_admin_view');
            $this->load->view('template/panel/control_view');
            $this->load->view('template/panel/footer_view');
        } else { // * jika sudah input
            $submitType = $this->input->post('submit-type');
            $id_reservasi = $this->input->post('id_reservasi');
            $tanggal_transaksi = $this->input->post('tanggal_transaksi');
            $nominal_transaksi = $this->input->post('nominal_transaksi');
            $status_transaksi = $this->input->post('status_transaksi');

            if ($submitType == 'Tambah') { // * jika tambah data
                if ($_FILES['bukti_transaksi']['error'] != 4) {
                    $bukti_transaksi = $this->upload_image('bukti_transaksi', './assets/img/transaksi/');
                } else {
                    $bukti_transaksi = 'no-image.jpg';
                }

                // * data transaksi yang akan diinput
                $data = array(
                    'id_reservasi' => $id_reservasi,
                    'tanggal_transaksi' => $tanggal_transaksi,
                    'nominal_transaksi' => $nominal_transaksi,
                    'status_transaksi' => $status_transaksi,
                    'bukti_transaksi' => $bukti_transaksi,
                    'transaksi_created' => time(),
                );

                if ($this->Transaksi_model->insertTransaksi($data)) { // * jika berhasil input transaksi
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Berhasil menambahkan transaksi</div>');

                    redirect('admin/transaksi');
                } else { // ! jika gagal input transaksi
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Gagal menambahkan transaksi</div>');

                    redirect('admin/transaksi');
                }
            } else { // * jika edit data
                $id_transaksi = $this->input->post('id_transaksi');
                $transaksi = $this->Transaksi_model->getTransaksi('id_transaksi', $id_transaksi);

                if ($_FILES['bukti_transaksi']['error'] != 4) {
                    $bukti_transaksi = $this->upload_image('bukti_transaksi', './assets/img/transaksi/');
                } else {
                    $bukti_transaksi = $transaksi['bukti_transaksi'];
                }

                $data = array(
                    'id_reservasi' => $id_reservasi,
                    'tanggal_transaksi' => $tanggal_transaksi,
                    'nominal_transaksi' => $nominal_transaksi,
                    'status_transaksi' => $status_transaksi,
                    'bukti_transaksi' => $bukti_transaksi,
                    'transaksi_updated' => time(),
                );

                if ($this->Transaksi_model->updateTransaksi('id_transaksi', $data, $id_transaksi)) { // * jika berhasil update transaksi
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Berhasil merubah transaksi</div>');

                    redirect('admin/transaksi');
                } else { // ! jika gagal update transaksi
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Gagal merubah transaksi</div>');

                    redirect('admin/transaksi');
                }
            }
        }
    }

    // * untuk menampilkan detail transaksi
    public function editTransaksi($id_transaksi)
    {
        $data['transaksi'] = $this->Transaksi_model->getTransaksi('id_transaksi', $id_transaksi);
        $data['reservasi'] = $this->Reservasi_model->getReservasi('all');

        $this->load->view('admin/ajax/edit_transaksi_form', $data);
    }

    // * untuk menghapus transaksi
    public function deleteTransaksi($id_transaksi)
    {
        if ($this->Transaksi_model->deleteTransaksi('id_transaksi', $id_transaksi)) { // * jika berhasil menghapus
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Berhasil menghapus transaksi</div>');

            redirect('admin/transaksi');
        } else { // ! jika gagal menghapus
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Gagal menghapus transaksi</div>');

            redirect('admin/transaksi');
        }
    }
    // * halaman transaksi ===================================================================================

    // * halaman settings ===================================================================================
    public function settings()
    {
        $data['title'] = "Settings";
        $data['menu'] = "settings";
        $data['sub_menu'] = null;
        $data['sub_menu_action'] = null;
        // user data        
        $data['user'] = $this->User_model->getUser('id_user', $this->session->userdata('id_user'));

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
            $this->load->view('template/panel/sidebar_admin_view');
            $this->load->view('admin/settings_admin_view');
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

                    redirect('admin/settings');
                } else { // ! jika gagal rubah
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Profile gagal dirubah</div>');

                    redirect('admin/settings');
                }
            } else { // ? edit password
                $password_lama = $this->input->post('password_lama');
                $password_baru = $this->input->post('password_baru');

                // * jika password lama salah
                if (!password_verify($password_lama, $user['password'])) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Password lama tidak sesuai</div>');

                    redirect('admin/settings');
                }

                $data = array(
                    'password' => password_hash($password_baru, PASSWORD_DEFAULT),
                );

                if ($this->User_model->updateUser('id_user', $data, $this->session->userdata('id_user'))) { // * jika berhasil rubah password
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Password berhasil dirubah</div>');

                    redirect('admin/settings');
                } else { // ! jika gagal rubah
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Password gagal dirubah</div>');

                    redirect('admin/settings');
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
