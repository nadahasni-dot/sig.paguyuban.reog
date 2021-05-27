<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Paguyuban_model extends CI_Model
{
    public function insertPaguyuban($data)
    {
        return $this->db->insert('tb_paguyuban', $data);
    }

    public function getPaguyuban($tipe, $param = NULL, $limit = NULL)
    {
        $this->db->order_by('id_paguyuban', 'DESC');

        if ($limit != NULL) {
            $this->db->limit($limit);
        }

        if ($tipe == 'all') {
            return $this->db->get('tb_paguyuban')->result_array();
        }

        if ($tipe == 'id_paguyuban') {
            return $this->db->get_where('tb_paguyuban', ['id_paguyuban' => $param])->row_array();
        }

        if ($tipe == 'owner') {
            return $this->db->get_where('tb_paguyuban', ['id_user' => $param])->row_array();
        }
    }

    public function updatePaguyuban($tipe, $data, $param)
    {
        if ($tipe == 'id_paguyuban') {
            return $this->db->update('tb_paguyuban', $data, ['id_paguyuban' => $param]);
        }
    }

    public function deletePaguyuban($tipe = 'id_paguyuban', $param)
    {
        if ($tipe == 'id_paguyuban') {
            return $this->db->delete('tb_paguyuban', ['id_paguyuban' => $param]);        
        }
    }

    public function countPaguyuban($tipe, $param = NULL) {
        if ($tipe == 'all') {
            return $this->db->count_all_results('tb_paguyuban');
        }
    }

    public function getHasilPaguyuban($list_penyakit) {
        $array_hasil_penyakit = array();

        foreach ($list_penyakit as $id_paguyuban => $nilai) {
            $penyakit_temp = $this->getPaguyuban('id_paguyuban', $id_paguyuban);
            $penyakit = array(
                'id_paguyuban' => $penyakit_temp['id_paguyuban'],
                'nama_penyakit' => $penyakit_temp['nama_penyakit'],
                'deskripsi_penyakit' => $penyakit_temp['deskripsi_penyakit'],
                'saran_penyakit' => $penyakit_temp['saran_penyakit'],
                'penyakit_artikel' => $penyakit_temp['penyakit_artikel'],
                'penyakit_saran_artikel' => $penyakit_temp['penyakit_saran_artikel'],
                'gambar_penyakit' => $penyakit_temp['gambar_penyakit'],
                'nilai_perhitungan' => (float) $nilai,
            );

            // * menambahkan penyakit ke array penyakit
            array_push($array_hasil_penyakit, $penyakit);
        }

        return $array_hasil_penyakit;
    }
}