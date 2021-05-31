<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jasa_model extends CI_Model
{
    public function insertJasa($data)
    {
        return $this->db->insert('tb_jasa', $data);
    }

    public function getJasa($tipe, $param = NULL, $limit = NULL)
    {
        $this->db->order_by('id_jasa', 'DESC');

        if ($limit != NULL) {
            $this->db->limit($limit);
        }

        if ($tipe == 'all') {
            $this->db->join('tb_paguyuban', 'tb_paguyuban.id_paguyuban = tb_jasa.id_paguyuban');
            return $this->db->get('tb_jasa')->result_array();
        }

        if ($tipe == 'all_paguyuban') {
            $this->db->where('tb_jasa.id_paguyuban', $param);
            $this->db->join('tb_paguyuban', 'tb_paguyuban.id_paguyuban = tb_jasa.id_paguyuban');
            return $this->db->get('tb_jasa')->result_array();
        }

        if ($tipe == 'id_jasa') {
            $this->db->join('tb_paguyuban', 'tb_paguyuban.id_paguyuban = tb_jasa.id_paguyuban');
            return $this->db->get_where('tb_jasa', ['id_jasa' => $param])->row_array();
        }

        if ($tipe == 'id_paguyuban') {
            return $this->db->get_where('tb_jasa', ['id_paguyuban' => $param])->result_array();
        }
    }

    public function updateJasa($tipe, $data, $param)
    {
        if ($tipe == 'id_jasa') {
            return $this->db->update('tb_jasa', $data, ['id_jasa' => $param]);
        }
    }

    public function deleteJasa($tipe, $param = 'id_jasa')
    {
        if ($tipe == 'id_jasa') {
            return $this->db->delete('tb_jasa', ['id_jasa' => $param]);
        }
    }

    public function countJasa($tipe, $param = NULL)
    {
        if ($tipe == 'all') {
            return $this->db->count_all_results('tb_jasa');
        }

        if ($tipe == 'all_paguyuban') {
            $this->db->where('id_paguyuban', $param);
            return $this->db->count_all_results('tb_jasa');
        }
    }
}
