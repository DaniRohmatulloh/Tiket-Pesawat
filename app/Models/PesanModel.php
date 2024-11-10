<?php

namespace App\Models;

use CodeIgniter\Model;

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
