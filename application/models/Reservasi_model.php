<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reservasi_model extends CI_Model
{
    public function insertReservasi($data)
    {
        return $this->db->insert('tb_reservasi', $data);
    }

    public function getReservasi($tipe, $param = NULL, $limit = NULL)
    {
        $this->db->order_by('id_reservasi', 'DESC');

        if ($limit != NULL) {
            $this->db->limit($limit);
        }

        if ($tipe == 'all') {
            $this->db->join('tb_user', 'tb_reservasi.id_user = tb_user.id_user');
            $this->db->join('tb_paguyuban', 'tb_reservasi.id_paguyuban = tb_paguyuban.id_paguyuban');
            $this->db->join('tb_jasa', 'tb_reservasi.id_jasa = tb_jasa.id_jasa');
            return $this->db->get('tb_reservasi')->result_array();
        }

        if ($tipe == 'id_reservasi') {
            return $this->db->get_where('tb_reservasi', ['id_reservasi' => $param])->row_array();
        }

        if ($tipe == 'id_penyakit') {
            return $this->db->get_where('tb_reservasi', ['id_penyakit' => $param])->result_array();
        }
    }

    public function updateReservasi($tipe, $data, $param)
    {
        if ($tipe == 'id_reservasi') {
            return $this->db->update('tb_reservasi', $data, ['id_reservasi' => $param]);
        }
    }

    public function deleteReservasi($tipe, $param = 'id_reservasi')
    {
        if ($tipe == 'id_reservasi') {
            return $this->db->delete('tb_reservasi', ['id_reservasi' => $param]);        
        }
    }

    public function countReservasi($tipe, $param = NULL) {
        if ($tipe == 'all') {
            return $this->db->count_all_results('tb_reservasi');
        }
    }
}