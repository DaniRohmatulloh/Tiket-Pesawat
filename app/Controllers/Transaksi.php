<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PesanModel;
use App\Models\WisataModel;
use CodeIgniter\HTTP\ResponseInterface;

class Transaksi extends BaseController
{
    protected $wisata;
    protected $pesanan;

    public function __construct()
    {
        $this->pesanan = new PesanModel();
        helper(['form', 'url']);
        $this->wisata = new WisataModel();
    }
    public function index()
    {
        $data["pesanan"] = $this->pesanan->select("tb_pesanan.*,tb_pembayaran.tgl_pembayaran")->join("tb_pembayaran", "tb_pembayaran.pesanan_id = tb_pesanan.id_pesanan", "left")->where("user_id", session()->get("id_user"))->findAll();
        // var_dump($data);
        return view('Transaksi/index', $data);
    }
}
