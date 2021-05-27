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
        // $this->load->model('Penyakit_model');
        // $this->load->model('Hasil_model');
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
        // $data['count_paguyuban'] = $this->Penyakit_model->countPenyakit('all');
        // $data['count_jasa'] = $this->Jasa_model->countJasa('all');
        // $data['count_reservasi'] = $this->Reservasi_model->countReservasi('all');
        // $data['count_pakar'] = $this->User_model->countUser('all');

        // $data['hasil_paguyuban'] = $this->Hasil_model->getHasil('chart_paguyuban');
        // $data['hasil_usia'] = $this->Hasil_model->getHasil('chart_usia');
        // $data['hasil_jenis_kelamin'] = $this->Hasil_model->getHasil('chart_jenis_kelamin');

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

    // * halaman hasil diagnosa
    public function hasildiagnosa()
    {
        $data['title'] = "Hasil Diagnosa";
        $data['menu'] = "hasildiagnosa";
        $data['sub_menu'] = null;
        $data['sub_menu_action'] = null;
        // user data        
        $data['user'] = $this->User_model->getUser('id_user', $this->session->userdata('id_user'));
        $data['hasil'] = $this->Hasil_model->getHasil('all');

        $this->load->view('template/panel/header_view', $data);
        $this->load->view('template/panel/sidebar_admin_view');
        $this->load->view('admin/hasil_diagnosa_admin_view');
        $this->load->view('template/panel/control_view');
        $this->load->view('template/panel/footer_view');
    }

    // * untuk menghapus hasil
    public function deleteHasil($id_hasil)
    {
        if ($this->Hasil_model->deleteHasil('id_hasil', $id_hasil)) { // * jika berhasil menghapus
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Berhasil menghapus hasil diagnosa</div>');

            redirect('admin/hasildiagnosa');
        } else { // ! jika gagal menghapus
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Gagal menghapus hasil diagnosa</div>');

            redirect('admin/hasildiagnosa');
        }
    }

    // * halaman kondisi ===================================================================================
    public function kondisi()
    {
        $data['title'] = "Kondisi";
        $data['menu'] = "kondisi";
        $data['sub_menu'] = null;
        $data['sub_menu_action'] = null;
        // user data        
        $data['user'] = $this->User_model->getUser('id_user', $this->session->userdata('id_user'));

        $data['kondisi'] = $this->Kondisi_model->getKondisi('all');

        // validation forms                
        $this->form_validation->set_rules('nama_kondisi', 'Nama Kondisi', 'required|trim');
        $this->form_validation->set_rules('cf_kondisi', 'CF KONDISI', 'required|trim|decimal');

        if ($this->form_validation->run() == FALSE) { // * jika belum input form
            $this->load->view('template/panel/header_view', $data);
            $this->load->view('template/panel/sidebar_admin_view');
            $this->load->view('admin/kondisi_admin_view');
            $this->load->view('template/panel/control_view');
            $this->load->view('template/panel/footer_view');
        } else { // * jika sudah input
            $submitType = $this->input->post('submit-type');
            $nama_kondisi = $this->input->post('nama_kondisi');
            $bobot = $this->input->post('cf_kondisi');

            if ($submitType == 'Tambah') { // * jika tambah data

                // * data kondisi yang akan diinput
                $data_kondisi = array(
                    'id_user' => $this->session->userdata('id_user'),
                    'nama_kondisi' => $nama_kondisi,
                    'cf_kondisi' => $bobot,
                );

                if ($this->Kondisi_model->insertKondisi($data_kondisi)) { // * jika berhasil input kondisi
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Berhasil menambahkan kondisi</div>');

                    redirect('admin/kondisi');
                } else { // ! jika gagal input kondisi
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Gagal menambahkan kondisi</div>');

                    redirect('admin/kondisi');
                }
            } else { // * jika edit data
                $id_kondisi = $this->input->post('id_kondisi');

                $data_update_kondisi = array(
                    'nama_kondisi' => $nama_kondisi,
                    'cf_kondisi' => $bobot,
                );

                if ($this->Kondisi_model->updateKondisi('id_kondisi', $data_update_kondisi, $id_kondisi)) { // * jika berhasil update kondisi
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Berhasil merubah kondisi</div>');

                    redirect('admin/kondisi');
                } else { // ! jika gagal update kondisi
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Gagal merubah kondisi</div>');

                    redirect('admin/kondisi');
                }
            }
        }
    }

    // * untuk menampilkan detail kondisi
    public function editKondisi($id_kondisi)
    {
        $data['kondisi'] = $this->Kondisi_model->getKondisi('id_kondisi', $id_kondisi);

        $this->load->view('admin/ajax/edit_kondisi_form', $data);
    }

    // * untuk menghapus kondisi
    public function deleteKondisi($id_kondisi)
    {
        if ($this->Kondisi_model->deleteKondisi('id_kondisi', $id_kondisi)) { // * jika berhasil menghapus
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Berhasil menghapus kondisi</div>');

            redirect('admin/kondisi');
        } else { // ! jika gagal menghapus
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Gagal menghapus kondisi</div>');

            redirect('admin/kondisi');
        }
    }
    // * halaman kondisi ===================================================================================

    // * halaman password ===================================================================================
    public function password()
    {
        $data['title'] = "Ubah Password";
        $data['menu'] = "password";
        $data['sub_menu'] = null;
        $data['sub_menu_action'] = null;
        // user data        
        $data['user'] = $this->User_model->getUser('id_user', $this->session->userdata('id_user'));

        // validation forms                
        $this->form_validation->set_rules('password_lama', 'Password Lama', 'required|trim');
        $this->form_validation->set_rules('password_baru', 'Password Baru', 'required|trim');
        $this->form_validation->set_rules('password_baru_konfirmasi', 'Password Konfirmasi', 'required|trim|matches[password_baru]');

        if ($this->form_validation->run() == FALSE) { // * jika belum input form
            $this->load->view('template/panel/header_view', $data);
            $this->load->view('template/panel/sidebar_admin_view');
            $this->load->view('admin/password_admin_view');
            $this->load->view('template/panel/control_view');
            $this->load->view('template/panel/footer_view');
        } else { // * jika sudah input            
            $password_lama = $this->input->post('password_lama');
            $password_baru = $this->input->post('password_baru');

            // * jika password lama salah
            if (!password_verify($password_lama, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Password lama tidak sesuai</div>');

                redirect('admin/password');
            }

            $data_password_update = array(
                'password' => password_hash($password_baru, PASSWORD_DEFAULT),
            );

            if ($this->User_model->updateUser('id_user', $data_password_update, $this->session->userdata('id_user'))) { // * jika berhasil rubah password
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Password berhasil dirubah</div>');

                redirect('admin/password');
            } else { // ! jika gagal rubah password
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Password gagal dirubah</div>');

                redirect('admin/password');
            }
        }
    }
    // * halaman password ===================================================================================

    // * halaman tentang ===================================================================================
    public function tentang()
    {
        $data['title'] = "Tentang";
        $data['menu'] = "tentang";
        $data['sub_menu'] = null;
        $data['sub_menu_action'] = null;
        // user data        
        $data['user'] = $this->User_model->getUser('id_user', $this->session->userdata('id_user'));

        $this->load->view('template/panel/header_view', $data);
        $this->load->view('template/panel/sidebar_admin_view');
        $this->load->view('admin/tentang_admin_view');
        $this->load->view('template/panel/control_view');
        $this->load->view('template/panel/footer_view');
    }
    // * halaman tentang ===================================================================================

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
