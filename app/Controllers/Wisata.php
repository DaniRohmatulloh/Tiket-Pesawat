<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PesanModel;
use App\Models\WisataModel;

class Wisata extends BaseController
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
        $data['wisata'] = $this->wisata->findAll();
        return view('wisataa/index', $data);
    }

    public function proses()
    {
        $asal = $this->request->getPost('asal');
        $tujuan = $this->request->getPost('tujuan');
        $tanggal_pergi = $this->request->getPost('tanggal_pergi');
        $tgl_pulang = $this->request->getPost('tgl_pulang');
        $class = $this->request->getPost('selected_flight');
        $penumpang = $this->request->getPost('passenger_quantity');
        $total = $this->calculateTotal($asal, $tujuan, $class, $penumpang);
        $nama_pesawat = "";
        switch ($class) {
            case 'economy':
                # code...
                $nama_pesawat = "Lion Air";
                break;
            case "business":
                # code...
                $nama_pesawat = "Garuda Indonesia";
                break;
            case "firstClass":
                # code...
                $nama_pesawat = "Emirates";
                break;

            default:
                # code...
                $nama_pesawat = null;
                break;
        }

        // Retrieve the wisata data and handle the case where it might not exist
        $wisataData = $this->wisata->where('asal', $asal)
            ->where('nama_wisata', $tujuan)
            ->first();

        if (!$wisataData) {
            return redirect()->back()->with('error', 'Data wisata tidak ditemukan.');
        }


        $data = [
            'asal' => $asal,
            'tujuan' => $tujuan,
            'tanggal_pergi' => $tanggal_pergi,
            'tgl_pulang' => $tgl_pulang,
            'penumpang' => $penumpang,
            'harga' => $total,
            'total' => $total * $penumpang,
            'metode_pembayaran' => $this->request->getPost('metode_pembayaran'),
            'nama_pesawat' => $nama_pesawat,
        ];

        $this->pesanan->insert($data);
        $id_pesanan = $this->pesanan->getInsertID();

        return redirect()->to('/Wisata/konfirmasi/' . $id_pesanan);
    }

    public function konfirmasi($id)
    {
        $data['pesanan'] = $this->pesanan->find($id);
        if ($id === null) {
            session()->setFlashdata('error', 'ID Pesanan tidak ditemukan.');
            return redirect()->back();
        }

        // Define payment instructions
        $instructions = [
            'DANA' => [
                'Step 1: Open the DANA app.',
                'Step 2: Go to "Send Money" option.',
                'Step 3: Enter the recipient\'s details.',
                'Step 4: Complete the transaction.'
            ],
            'OVO' => [
                'Step 1: Open the OVO app.',
                'Step 2: Select "Pay".',
                'Step 3: Enter the recipient\'s number.',
                'Step 4: Complete the payment.'
            ],
            'GOPAY' => [
                'Step 1: Open the GoPay app.',
                'Step 2: Choose "Send Money".',
                'Step 3: Enter the payment details.',
                'Step 4: Complete the transaction.'
            ],
            'Transfer Bank' => [
                'Step 1: Go to your bank\'s mobile app or website.',
                'Step 2: Transfer the specified amount to the given account.',
                'Step 3: Add the transaction ID and other details if required.',
                'Step 4: Confirm the payment.'
            ]
        ];

        // Pass instructions along with pesanan data to the view
        return view('wisataa/konfirmasi', [
            'pesanan' => $data['pesanan'],
            'instructions' => $instructions
        ]);
    }


    public function showBookingPage()
    {
        // Define payment instructions
        $instructions = [
            'DANA' => [
                'Step 1: Open the DANA app.',
                'Step 2: Go to "Send Money" option.',
                'Step 3: Enter the recipient\'s details.',
                'Step 4: Complete the transaction.'
            ],
            'OVO' => [
                'Step 1: Open the OVO app.',
                'Step 2: Select "Pay".',
                'Step 3: Enter the recipient\'s number.',
                'Step 4: Complete the payment.'
            ],
            'GOPAY' => [
                'Step 1: Open the GoPay app.',
                'Step 2: Choose "Send Money".',
                'Step 3: Enter the payment details.',
                'Step 4: Complete the transaction.'
            ],
            'Transfer Bank' => [
                'Step 1: Go to your bank\'s mobile app or website.',
                'Step 2: Transfer the specified amount to the given account.',
                'Step 3: Add the transaction ID and other details if required.',
                'Step 4: Confirm the payment.'
            ]
        ];

        // Define other data you might need, e.g., payment methods, order data, etc.
        $pesanan = [
            'metode_pembayaran' => 'DANA' // Example of selected payment method
        ];

        // Pass instructions and other data to the view
        return view('wisataa/payment_instructions', [
            'instructions' => $instructions,
            'pesanan' => $pesanan
        ]);
    }

    // Menambahkan fungsi detailTiket untuk menampilkan detail pesanan berdasarkan ID
    public function detailTiket($id)
    {
        $pesanan = $this->pesanan->find($id); // Ambil data pesanan berdasarkan ID

        // Debugging: Pastikan data pesanan ada dan 'nama_pesawat' tersedia
        if (!$pesanan) {
            return redirect()->to('/Wisata')->with('error', 'Pesanan tidak ditemukan.');
        }

        // Debugging: Tampilkan data pesanan di log
        log_message('debug', 'Pesanan: ' . print_r($pesanan, true));

        $data['pesanan'] = $pesanan; // Kirim data pesanan ke view
        return view('wisataa/detail', $data); // Ganti 'wisataa/detail' sesuai dengan nama view yang sesuai
    }

    private function calculateTotal($asal, $tujuan, $class, $penumpang)
    {
        $wisata = $this->wisata->where('asal', $asal)
            ->where('nama_wisata', $tujuan)
            ->first();

        if (!$wisata) {
            return 0;
        }

        // Access harga as an object property
        $basePrice = $wisata->harga ?? 0;

        switch ($class) {
            case 'business':
                return ($basePrice * 1.5) * $penumpang;
            case 'firstClass':
                return ($basePrice * 2) * $penumpang;
            case 'economy':
            default:
                return $basePrice * $penumpang;
        }
    }
}
