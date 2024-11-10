<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\WisataModel;
use CodeIgniter\HTTP\ResponseInterface;

class Wisata extends BaseController
{
    protected $wisata;
    public function __construct()
    {
        $this->wisata = new WisataModel();
    }

    public function index()
    {
        if (session()->get('logged_in') == true) {
            $data['wisata'] = $this->wisata->findAll();
            return view('Wisata/index', $data);
        } else {
            return redirect()->to('admin/login');
        }
    }

    public function add()
    {
        if (session()->get('logged_in') == true) {
            return view('Wisata/add');
        } else {
            return redirect()->to('admin/login');
        }
    }

    public function save()
    {
        if (session()->get('logged_in') == true) {
            $rules = [
                'foto' => [
                    'rules' => 'uploaded[foto]|mime_in[foto,image/jpeg,image/jpg,image/png,image/gif]',
                    'errors' => [
                        'uploaded' => 'Belum Upload',
                        'mime_in' => 'Tipe File Ditolak'
                    ]
                ],
                'nama_wisata' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tujuan Tidak boleh kosong'
                    ]
                ],
                'asal' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Asal Tidak boleh kosong'
                    ]
                ],
                'class' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kelas Tidak boleh kosong'
                    ]
                ],
                'jumlah_kursi' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'Jumlah Kursi Tidak boleh kosong',
                        'numeric' => 'Jumlah Kursi harus berupa angka'
                    ]
                ],
                'des' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Deskripsi Tidak boleh kosong'
                    ]
                ],
                'harga' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Harga Tidak Boleh kosong'
                    ]
                ]
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator->getErrors();
                return view('Wisata/add', $data);
            }

            $asal = $this->request->getVar('asal');
            $nama_wisata = $this->request->getVar('nama_wisata');
            $class = $this->request->getVar('class');
            $jumlah_kursi = $this->request->getVar('jumlah_kursi');
            $des = $this->request->getVar('des');
            $harga = $this->request->getVar('harga');
            $foto = $this->request->getFile('foto');

            if ($foto && $foto->isValid() && !$foto->hasMoved()) {
                $foto->move(WRITEPATH . '../public/foto');
            } else {
                return redirect()->back()->with('error', 'File foto tidak valid atau belum di-upload.');
            }

            $data = [
                'asal' => $asal,
                'nama_wisata' => $nama_wisata,
                'class' => $class,
                'jumlah_kursi' => $jumlah_kursi,
                'deskripsi' => $des,
                'harga' => $harga,
                'foto' => $foto->getClientName()
            ];

            $this->wisata->save($data);

            return redirect()->to('admin/Wisata');
        } else {
            return redirect()->to('admin/login');
        }
    }

    public function edit($id)
    {
        if (session()->get('logged_in') == true) {
            $data['cari'] = $this->wisata->where(['id_wisata' => $id])->first();
            return view('Wisata/edit', $data);
        } else {
            return redirect()->to('admin/login');
        }
    }

    public function update()
    {
        if (session()->get('logged_in') == true) {
            $id = $this->request->getVar('kode');
            $asal = $this->request->getVar('asal');
            $nama_wisata = $this->request->getVar('nama_wisata');
            $class = $this->request->getVar('class');
            $jumlah_kursi = $this->request->getVar('jumlah_kursi');
            $des = $this->request->getVar('des');
            $harga = $this->request->getVar('harga');
            $foto = $this->request->getFile('foto');

            if ($foto->isValid() && !$foto->hasMoved()) {
                $fotoName = $foto->getRandomName();
                $foto->move(WRITEPATH . '../public/foto', $fotoName);
            } else {
                $fotoName = $this->wisata->find($id)->foto;
            }

            $data = [
                'id_wisata' => $id,
                'asal' => $asal,
                'nama_wisata' => $nama_wisata,
                'class' => $class,
                'jumlah_kursi' => $jumlah_kursi,
                'deskripsi' => $des,
                'harga' => $harga,
                'foto' => $fotoName
            ];

            $this->wisata->save($data);

            return redirect()->to('admin/Wisata');
        } else {
            return redirect()->to('admin/login');
        }
    }

    public function delete($id)
    {
        $this->wisata->delete($id);
        return redirect()->to('admin/Wisata');
    }
}
