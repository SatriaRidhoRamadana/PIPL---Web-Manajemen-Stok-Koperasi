<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DetailPenjualan_model extends CI_Model
{
    protected $table = 'detail_penjualan';

    public function get_by_penjualan($penjualan_id)
    {
        return $this->db->select('detail_penjualan.*, barang.nama_barang, barang.satuan')
                        ->join('barang', 'barang.id_barang = detail_penjualan.id_barang', 'left')
                        ->where('id_penjualan', $penjualan_id)
                        ->get($this->table)
                        ->result();
    }
}

