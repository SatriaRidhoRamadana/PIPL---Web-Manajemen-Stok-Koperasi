<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_model extends CI_Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';

    public function get_all()
    {
        return $this->db->order_by('nama_kategori', 'ASC')->get($this->table)->result();
    }

    public function get($id)
    {
        return $this->db->where($this->primaryKey, $id)->get($this->table)->row();
    }

    public function create($data)
    {
        return $this->db->insert($this->table, [
            'nama_kategori' => $data['nama_kategori'],
            'kode_kategori' => isset($data['kode_kategori']) ? $data['kode_kategori'] : '',
        ]);
    }

    public function update($id, $data)
    {
        $payload = [
            'nama_kategori' => $data['nama_kategori'],
            'kode_kategori' => isset($data['kode_kategori']) ? $data['kode_kategori'] : '',
        ];
        return $this->db->where($this->primaryKey, $id)->update($this->table, $payload);
    }

    public function delete($id)
    {
        return $this->db->where($this->primaryKey, $id)->delete($this->table);
    }
}

