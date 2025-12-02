<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DetailPembelian_model extends CI_Model
{
    protected $table = 'detail_pembelian';

    public function get_by_pembelian($pembelian_id)
    {
        return $this->db->select('detail_pembelian.*, barang.nama_barang, barang.satuan')
                        ->join('barang', 'barang.id_barang = detail_pembelian.id_barang', 'left')
                        ->where('id_pembelian', $pembelian_id)
                        ->get($this->table)
                        ->result();
    }
}

