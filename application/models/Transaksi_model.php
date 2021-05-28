<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{
    public function insertTransaksi($data)
    {
        return $this->db->insert('tb_transaksi', $data);
    }

    public function getTransaksi($tipe, $param = NULL, $limit = NULL)
    {
        $this->db->order_by('id_transaksi', 'ASC');

        if ($limit != NULL) {
            $this->db->limit($limit);
        }

        if ($tipe == 'all') {
            $this->db->join('tb_reservasi', 'tb_reservasi.id_reservasi = tb_transaksi.id_reservasi');
            $this->db->join('tb_user', 'tb_user.id_user = tb_reservasi.id_user');
            $this->db->join('tb_jasa', 'tb_jasa.id_jasa = tb_reservasi.id_jasa');
            $this->db->join('tb_paguyuban', 'tb_paguyuban.id_paguyuban = tb_reservasi.id_paguyuban');
            return $this->db->get('tb_transaksi')->result_array();
        }

        if ($tipe == 'id_transaksi') {
            return $this->db->get_where('tb_transaksi', ['id_transaksi' => $param])->row_array();
        }
    }

    public function updateTransaksi($tipe, $data, $param)
    {
        if ($tipe == 'id_transaksi') {
            return $this->db->update('tb_transaksi', $data, ['id_transaksi' => $param]);
        }
    }

    public function deleteTransaksi($tipe, $param = 'id_transaksi')
    {
        if ($tipe == 'id_transaksi') {
            return $this->db->delete('tb_transaksi', ['id_transaksi' => $param]);
        }
    }

    public function countTransaksi($tipe, $param = NULL) {
        if ($tipe == 'confirmed') {
            $this->db->where('status_transaksi', 1);
            return $this->db->count_all_results('tb_transaksi');
        }

        if ($tipe == 'confirmed_paguyuban') {
            $this->db->join('tb_reservasi', 'tb_reservasi.id_reservasi = tb_transaksi.id_reservasi');
            $this->db->where('tb_reservasi.id_paguyuban', $param);
            $this->db->where('tb_transaksi.status_transaksi', 1);
            return $this->db->count_all_results('tb_transaksi');
        }

        if ($tipe == 'sum_paguyuban') {
            $this->db->select('SUM(tb_transaksi.nominal_transaksi) AS sum_transaksi');
            $this->db->from('tb_transaksi');
            $this->db->join('tb_reservasi', 'tb_reservasi.id_reservasi = tb_transaksi.id_reservasi');
            $this->db->where('tb_reservasi.id_paguyuban', $param);
            $this->db->where('tb_transaksi.status_transaksi', 1);
            return $this->db->get()->row_array();
        }
    }
}
