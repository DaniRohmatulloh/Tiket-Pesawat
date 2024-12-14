<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table = 'transaksi'; // Change this to your actual table name
    protected $primaryKey = 'id_pesanan'; // Change this to your primary key
    protected $allowedFields = ['user_id', 'nama_pesawat', 'asal', 'tujuan', 'tanggal_pergi', 'total', 'metode_pembayaran', 'tgl_pembayaran', 'deleted_at', 'penumpang']; // Add your fields here
}
class PembayaranModel extends Model
{
    protected $table = 'tb_pembayaran';
    protected $primaryKey = 'id_pembayaran';
    protected $allowedFields = ['pesanan_id', 'metode_pembayaran', 'total', 'tgl_pembayaran'];
    protected $useTimestamps = true;
}
class PesanModel extends Model
{
    protected $table            = 'tb_pesanan';
    protected $primaryKey       = 'id_pesanan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $protectFields    = false;
    protected $allowedFields    = ['nama_wisata', 'tanggal_pergi', 'tgl_pulang', 'harga', 'total', 'asal', 'tujuan', 'metode_pembayaran'];
    public function getPesananById($id)
    {
        return $this->select('pesanan.*, pesawat.nama_pesawat')
            ->join('pesawat', 'pesanan.id_pesawat = pesawat.id', 'left')
            ->where('pesanan.id', $id)
            ->first();
    }
    public function searchByEmailOrId($search)
    {
        if ($search) {
            return $this->like('email', $search)
                ->orLike('id_pesanan', $search)
                ->findAll();
        } else {
            return $this->findAll();
        }
    }
    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
