<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PesanModel;
use App\Models\WisataModel;
use App\Models\TransaksiModel;
use App\Models\PembayaranModel;

class Transaksi extends BaseController
{
    protected $wisata;
    protected $pesanan;
    protected $transaksiModel;
    protected $pembayaranModel;

    public function __construct()
    {
        $this->pesanan = new PesanModel();
        $this->wisata = new WisataModel();
        $this->transaksiModel = new TransaksiModel();
        $this->pembayaranModel = new PembayaranModel();
        helper(['form', 'url']);
    }

    public function index()
    {
        if (session()->get('logged_in') == true) {
            $search = $this->request->getGet('search');

            $query = $this->pesanan
                ->select("tb_pesanan.*, tb_pembayaran.tgl_pembayaran, user.email")
                ->join("tb_pembayaran", "tb_pembayaran.pesanan_id = tb_pesanan.id_pesanan", "left")
                ->join("user", "user.id_user = tb_pesanan.user_id", "left")
                ->where('tb_pesanan.deleted_at', null);

            if ($search) {
                $query->groupStart()
                    ->where('user.email', $search)
                    ->orLike('tb_pesanan.id_pesanan', $search)
                ->groupEnd();
                
                $data['search'] = $search;
            }

            $data["pesanan"] = $query->findAll();

            return view('admin/transaksi/index', $data);
        } else {
            return redirect()->to('admin/login');
        }
    }

    public function batalkan($id_pesanan)
    {
        if (session()->get('logged_in') == true) {
            $pesanan = $this->pesanan->find($id_pesanan);

            if (!$pesanan) {
                session()->setFlashdata('error', 'Pesanan tidak ditemukan.');
                return redirect()->to('admin/transaksi');
            }

            $this->pesanan->update($id_pesanan, ['deleted_at' => date('Y-m-d H:i:s')]);

            session()->setFlashdata('success', 'Pesanan berhasil dibatalkan.');
            return redirect()->to('admin/transaksi');
        } else {
            return redirect()->to('admin/login');
        }
    }

    public function konfirmasi($id_pesanan)
    {
        if (session()->get('logged_in') == true) {
            $pesanan = $this->pesanan->find($id_pesanan);

            if (!$pesanan) {
                session()->setFlashdata('error', 'Pesanan tidak ditemukan.');
                return redirect()->to('/admin/transaksi');
            }

            if ($pesanan->status === 'Success') {
                session()->setFlashdata('error', 'Pesanan ini sudah dikonfirmasi.');
                return redirect()->to('/admin/transaksi');
            }

            $dataUpdate = [
                'tgl_pembayaran' => date('Y-m-d H:i:s'),
            ];
            
            if ($this->pesanan->update($id_pesanan, $dataUpdate)) {
                $this->pembayaranModel->save([
                    'pesanan_id' => $id_pesanan,
                    'metode_pembayaran' => $pesanan->metode_pembayaran,
                    'total' => $pesanan->total,
                    'tgl_pembayaran' => date('Y-m-d H:i:s'),
                ]);

                session()->setFlashdata('success', 'Pesanan berhasil dikonfirmasi.');
            } else {
                session()->setFlashdata('error', 'Gagal mengkonfirmasi pesanan.');
            }

            return redirect()->to('/admin/transaksi');
        } else {
            return redirect()->to('admin/login');
        }
    }
}