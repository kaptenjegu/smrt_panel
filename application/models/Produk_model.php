<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_model extends CI_Model {
	
	public function getData()
	{
		$this->db->select('*');
		$this->db->from($this->db->dbprefix . 'produk');
		$this->db->join($this->db->dbprefix . 'kategori', $this->db->dbprefix . 'produk.id_kategori = ' . $this->db->dbprefix . 'kategori.id_kategori');
		$this->db->where($this->db->dbprefix . 'produk.aktif', 1);
		$result = $this->db->get()->result();
		return $result;
	}
	public function getDataByID($id)
	{
		$this->db->select('*');
		$this->db->from($this->db->dbprefix . 'produk');
		$this->db->join($this->db->dbprefix . 'kategori', $this->db->dbprefix . 'produk.id_kategori = ' . $this->db->dbprefix . 'kategori.id_kategori');
		$this->db->where($this->db->dbprefix . 'produk.aktif', 1);
		$this->db->where($this->db->dbprefix . 'produk.id_produk', (int)$id);
		$result = $this->db->get()->result();
		return $result;
	}
	public function addData($data)
	{
		$q = "INSERT INTO " . $this->db->dbprefix . "produk(id_produk, nama_produk, id_kategori, harga_produk, warna_produk, ukuran_produk, desc_produk, total_view, aktif)";
		$q .= "VALUES('', '" . $this->db->escape_str($data['nama_produk']) . "', '" . (int)$data['kategori'] . "', " . (int)$data['harga_produk'] . ", '" . $this->db->escape_str($data['warna_produk']) . "', ";
		$q .= "'" . $this->db->escape_str($data['ukuran_produk']) . "', '" . $data['desc_produk'] . "', 0, " . $data['aktif'] . ")";
		if ( ! $this->db->simple_query($q))
		{
			$error = $this->db->error(); // Has keys 'code' and 'message'
			$result['status'] = 'gagal';
			$result['pesan'] = $error['message'];
		}else{
			$result['status'] = 'sukses';
			$result['pesan'] = '';
			$this->db->where('aktif', 1);
			$this->db->order_by('id_produk', 'DESC');
			$hasil = $this->db->get($this->db->dbprefix . 'produk')->result();
			$result['id'] = $hasil[0]->id_produk;
		}
		return $result;
	}
	public function editData($data)
	{
		$q = "UPDATE " . $this->db->dbprefix . "produk SET nama_produk = '" . $this->db->escape_str($data['nama_produk']) . "'";
		$q .= ", harga_produk = " . (int)$data['harga_produk'] . ", warna_produk = '" . $this->db->escape_str($data['warna_produk']) . "'";
		$q .= ", ukuran_produk = '" . $this->db->escape_str($data['ukuran_produk']) . "', desc_produk = '" . $data['desc_produk'] . "'";
		$q .= " WHERE id_produk = " . (int)$data['id_produk'];
		if ( ! $this->db->simple_query($q))
		{
			$error = $this->db->error();
			$result['status'] = 'gagal';
			$result['pesan'] = $error['message'];
		}else{
			$result['status'] = 'sukses';
			$result['pesan'] = '';
		}
		
		return $result;
	}
	public function deleteData($data)
	{
		$q = "DELETE FROM " . $this->db->dbprefix . "produk WHERE id_produk = " . (int)$data;
		if ( ! $this->db->simple_query($q))
		{
			$error = $this->db->error();
			$result['status'] = 'gagal';
			$result['pesan'] = $error['message'];
		}else{
			$result['status'] = 'sukses';
			$result['pesan'] = '';
		}
		return $result;
	}
	
}
