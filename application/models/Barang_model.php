<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_model extends CI_Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id_barang';

    public function get_all($with_kategori = TRUE)
    {
        if ($with_kategori) {
            $this->db->select('barang.*, kategori.nama_kategori');
            $this->db->join('kategori', 'kategori.id_kategori = barang.id_kategori', 'left');
        }
        return $this->db->order_by('barang.nama_barang', 'ASC')->get($this->table)->result();
    }

    public function get($id)
    {
        return $this->db->where($this->primaryKey, $id)->get($this->table)->row();
    }

    public function create($data)
    {
        $payload = array(
            'sku' => $data['sku'],
            'nama_barang' => $data['nama_barang'],
            'id_kategori' => $data['id_kategori'],
            'satuan' => $data['satuan'],
            'stok' => $data['stok'],
            'harga' => $data['harga'],
        );
        return $this->db->insert($this->table, $payload);
    }

    public function update($id, $data)
    {
        $payload = array(
            'sku' => $data['sku'],
            'nama_barang' => $data['nama_barang'],
            'id_kategori' => $data['id_kategori'],
            'satuan' => $data['satuan'],
            'stok' => $data['stok'],
            'harga' => $data['harga'],
        );
        return $this->db->where($this->primaryKey, $id)->update($this->table, $payload);
    }

    public function delete($id)
    {
        return $this->db->where($this->primaryKey, $id)->delete($this->table);
    }

    public function increase_stock($id, $qty)
    {
        return $this->db->set('stok', 'stok + '.(int) $qty, FALSE)
                        ->where($this->primaryKey, $id)
                        ->update($this->table);
    }

    public function decrease_stock($id, $qty)
    {
        $barang = $this->get($id);
        if (!$barang || $barang->stok < $qty) {
            throw new Exception('Stok barang tidak mencukupi');
        }

        return $this->db->set('stok', 'stok - '.(int) $qty, FALSE)
                        ->where($this->primaryKey, $id)
                        ->update($this->table);
    }

    public function get_low_stock($limit = 5)
    {
        return $this->db->where('stok <=', 5)
                        ->order_by('stok', 'ASC')
                        ->limit($limit)
                        ->get($this->table)
                        ->result();
    }

    public function get_dropdown_list()
    {
        $result = $this->get_all(FALSE);
        $dropdown = [];
        foreach ($result as $row) {
            $dropdown[$row->id_barang] = $row->nama_barang;
        }
        return $dropdown;
    }
}
