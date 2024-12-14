<?php

namespace App\Controllers;

use App\Models\PesanModel;
use App\Models\PembayaranModel;

class Riwayat extends BaseController
{
    protected $pesanan;
    protected $pembayaranModel;

    public function __construct()
    {
        $this->pesanan = new PesanModel(); // Memanggil model PesanModel
        $this->pembayaranModel = new PembayaranModel(); // Memanggil model PembayaranModel
    }

    // Fungsi untuk menampilkan riwayat pesanan
    public function index()
    {
        $search = $this->request->getGet('search');
        $pesanan = $this->pesanan->searchByEmailOrId($search);
        $pesanModel = new PesanModel();
        $pesanan = $pesanModel->select('*, "00:00" as jam_berangkat')  // Tambahkan default jam
            ->findAll();
        // Debugging: Log or dump the data
        log_message('debug', 'Pesanan data: ' . print_r($pesanan, true));

        return view('riwayat', ['pesanan' => $pesanan, 'search' => $search]);
    }

    // Fungsi untuk mengkonfirmasi pesanan
    public function konfirmasi($id_pesanan)
    {
        if (session()->get('logged_in') == true) {
            // Menemukan pesanan berdasarkan ID
            $pesanan = $this->pesanan->find($id_pesanan);

            // Jika pesanan tidak ditemukan
            if (!$pesanan) {
                session()->setFlashdata('error', 'Pesanan tidak ditemukan.');
                return redirect()->to('/riwayat');
            }

            // Jika status pesanan sudah "Success"
            if ($pesanan->status === 'Success') {
                session()->setFlashdata('error', 'Pesanan ini sudah dikonfirmasi.');
                return redirect()->to('/riwayat');
            }

            // Update data pembayaran
            $dataUpdate = [
                'status' => 'Success',
                'tgl_pembayaran' => date('Y-m-d H:i:s'),
            ];

            // Mengupdate status pesanan
            if ($this->pesanan->update($id_pesanan, $dataUpdate)) {
                // Menyimpan data pembayaran ke model pembayaran
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

            return redirect()->to('/riwayat');
        } else {
            return redirect()->to('/login');
        }
    }
    // Controller Code
    public function riwayat()
    {
        $search = $this->request->getGet('search');

        // Load the model
        $pesanModel = new PesanModel();

        // Paginate results
        $pager = \Config\Services::pager();
        $pesanan = $pesanModel->like('email', $search)
            ->orLike('id_pesanan', $search)
            ->paginate(10); // Assuming 10 records per page

        // Pass data to the view
        return view('riwayat', [
            'pesanan' => $pesanan,
            'pager' => $pager,
            'search' => $search
        ]);
    }
}
