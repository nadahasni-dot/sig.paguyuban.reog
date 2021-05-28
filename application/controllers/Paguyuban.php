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

        // validation forms                        
        $this->form_validation->set_rules('nama_paguyuban', 'Nama Paguyuban', 'required|trim');
        $this->form_validation->set_rules('deskripsi_paguyuban', 'Deskripsi', 'required|trim');
        $this->form_validation->set_rules('alamat_paguyuban', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('telepon_paguyuban', 'Telepon', 'required|trim');
        $this->form_validation->set_rules('lat_paguyuban', 'Latitude', 'required|trim|numeric');
        $this->form_validation->set_rules('lng_paguyuban', 'Longitude', 'required|trim|numeric');

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
                    'paguyuban_created' => time(),
                );

                if ($this->Paguyuban_model->insertPaguyuban($data)) { // * jika berhasil input
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Berhasil menambahkan paguyuban</div>');

                    redirect('paguyuban/paguyuban');
                } else { // ! jika gagal input
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Gagal menambahkan paguyuban</div>');

                    redirect('paguyuban/paguyuban');
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

                        redirect('paguyuban/paguyuban');
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

                    redirect('paguyuban/paguyuban');
                } else { // ! jika gagal update paguyuban
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Gagal merubah paguyuban</div>');

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

        // validation forms                        
        $this->form_validation->set_rules('nama_paguyuban', 'Nama Paguyuban', 'required|trim');
        $this->form_validation->set_rules('deskripsi_paguyuban', 'Deskripsi', 'required|trim');
        $this->form_validation->set_rules('alamat_paguyuban', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('telepon_paguyuban', 'Telepon', 'required|trim');
        $this->form_validation->set_rules('lat_paguyuban', 'Latitude', 'required|trim|numeric');
        $this->form_validation->set_rules('lng_paguyuban', 'Longitude', 'required|trim|numeric');

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

    // * untuk menghapus paguyuban
    public function deletePaguyuban($id_paguyuban)
    {
        if ($this->Paguyuban_model->deletePaguyuban('id_paguyuban', $id_paguyuban)) { // * jika berhasil menghapus
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Berhasil menghapus paguyuban</div>');

            redirect('paguyuban/paguyuban');
        } else { // ! jika gagal menghapus
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Gagal menghapus paguyuban</div>');

            redirect('paguyuban/paguyuban');
        }
    }

    // * halaman paguyuban ===================================================================================

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
