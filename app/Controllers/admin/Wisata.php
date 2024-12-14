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
        helper('form');
    }

    public function index()
    {
        if (session()->get('logged_in') == true) {
            $search = $this->request->getGet('search');

            if ($search) {
                $data['wisata'] = $this->wisata->like('asal', $search)
                    ->orLike('nama_wisata', $search)
                    ->findAll();
                $data['search'] = $search;
            } else {
                $data['wisata'] = $this->wisata->findAll();
            }

            return view('Wisata/index', $data);
        } else {
            return redirect()->to('admin/login');
        }
    }

    public function add()
    {
        if (session()->get('logged_in') == true) {
            helper('form');
            $validation = \Config\Services::validation(); 
            return view('Wisata/add', ['validation' => $validation]); 
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
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'Harga Tidak Boleh kosong',
                        'numeric' => 'Harga harus berupa angka'
                    ]
                ]
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator; 
                $data['old_input'] = $this->request->getPost();
                return view('Wisata/add', $data);
            }
            $foto = $this->request->getFile('foto');
            $fotoName = $foto->getRandomName();
            $foto->move(WRITEPATH . '../public/foto', $fotoName);

            $data = [
                'asal' => $this->request->getVar('asal'),
                'nama_wisata' => $this->request->getVar('nama_wisata'),
                'jumlah_kursi' => $this->request->getVar('jumlah_kursi'),
                'deskripsi' => $this->request->getVar('des'),
                'harga' => $this->request->getVar('harga'),
                'foto' => $fotoName
            ];

            if ($this->wisata->save($data)) {
                return redirect()->to('admin/Wisata')->with('success', 'Data berhasil ditambahkan.');
            } else {
                return redirect()->back()->with('error', 'Gagal menambahkan data.');
            }
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
            $id = $this->request->getVar('kode'); // Ambil ID dari input
            $asal = $this->request->getVar('asal');
            $nama_wisata = $this->request->getVar('nama_wisata');
            $class = $this->request->getVar('class');
            $jumlah_kursi = $this->request->getVar('jumlah_kursi');
            $des = $this->request->getVar('des');
            $harga = $this->request->getVar('harga');
            $foto = $this->request->getFile('foto');

            $data = [
                'id_wisata' => $id,
                'asal' => $asal,
                'nama_wisata' => $nama_wisata,
                'jumlah_kursi' => $jumlah_kursi,
                'deskripsi' => $des,
                'harga' => $harga,
            ];
            if ($foto && $foto->isValid() && !$foto->hasMoved()) {
                $fotoName = $foto->getRandomName();
                $foto->move(WRITEPATH . '../public/foto', $fotoName);
                $data['foto'] = $fotoName;
            } else {
                $data['foto'] = $this->wisata->find($id)->foto;
            }
            if ($this->wisata->save($data)) {
                return redirect()->to('admin/Wisata')->with('success', 'Data berhasil diperbarui.');
            } else {
                return redirect()->back()->with('error', 'Gagal memperbarui data.');
            }
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
