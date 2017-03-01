<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pengembalian_model extends CI_Model
{

    public $table = 'pengembalian';
    public $id = 'id_pengembalian';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('pinjam','pinjam.id_pinjam = pengembalian.id_pinjam');
        $this->db->join('buku','buku.id_buku = pinjam.id_buku');
        $this->db->join('anggota','anggota.id_anggota = pinjam.id_anggota');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get()->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('pinjam','pinjam.id_pinjam = pengembalian.id_pinjam');
        $this->db->join('buku','buku.id_buku = pinjam.id_buku');
        $this->db->join('anggota','anggota.id_anggota = pinjam.id_anggota');
        $this->db->join('kategori','kategori.id_kategori = buku.id_kategori');
        $this->db->join('pengarang','pengarang.id_pengarang = buku.id_pengarang');
        $this->db->join('penerbit','penerbit.id_penerbit = buku.id_penerbit');
        $this->db->where($this->id, $id);
        return $this->db->get()->row();
    }
    
    // get total rows
    function total_rows() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit
    function index_limit($limit, $start = 0) {
        $this->db->order_by($this->id, $this->order);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }
    
    // get search total rows
    function search_total_rows($keyword = NULL) {
        $this->db->like('id_pengembalian', $keyword);
    	$this->db->or_like('id_pinjam', $keyword);
    	$this->db->or_like('tgl_terima', $keyword);
    	$this->db->or_like('telat', $keyword);
    	$this->db->or_like('denda', $keyword);
    	$this->db->or_like('petugas', $keyword);
    	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get search data with limit
    function search_index_limit($limit, $start = 0, $keyword = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_pengembalian', $keyword);
    	$this->db->or_like('id_pinjam', $keyword);
    	$this->db->or_like('tgl_terima', $keyword);
    	$this->db->or_like('telat', $keyword);
    	$this->db->or_like('denda', $keyword);
    	$this->db->or_like('petugas', $keyword);
    	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file pengembalian_model.php */
/* Location: ./application/models/pengembalian_model.php */