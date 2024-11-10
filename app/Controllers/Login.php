<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use CodeIgniter\HTTP\ResponseInterface;

class Login extends BaseController
{
    protected $user;
    public function __construct()
    {
        $this->user = new UsersModel();
        helper(['form', 'url']);
    }
    public function index()
    {
        return view('login/index');
    }
    public function register()
    {
        return view('register/index');
    }
    public function save()
    {
        $rules = [
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Lengkap Harus di isi'
                ]
            ],
            'kelamin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis Kelamin Tidak boleh kosong'
                ]
            ],
            'ponsel' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nomer Ponsel Tidak Boleh kosong'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email Tidak Boleh kosong',
                    'valid_email' => 'Format Email Belum benar'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password Tidak Boleh Kosong'
                ]
            ]
        ];
        if (!$this->validate($rules)) {
            $data['validation'] = $this->validator->getErrors();
            return view('register/index', $data);
        }
        $nama = $this->request->getVar('nama');
        $kelamin = $this->request->getVar('kelamin');
        $email = $this->request->getVar('email');
        $ponsel = $this->request->getVar('ponsel');
        $password = password_hash($this->request->getVar('password'), PASSWORD_BCRYPT);
        $data = [
            'id_user' => time(),
            'username' => $nama,
            'kelamin' => $kelamin,
            'password' => $password,
            'email' => $email,
            'ponsel' => $ponsel
        ];
        $this->user->save($data);
        session()->setFlashdata('success', 'Registrasi berhasil. Silakan login.');
        return redirect()->to('login');
    }
    public function proses()
    {
        $rules = [
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email Tidak Boleh kosong',
                    'valid_email' => 'Format Email Belum benar'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password Tidak Boleh Kosong'
                ]
            ]
        ];
        if (!$this->validate($rules)) {
            $data['validation'] = $this->validator->getErrors();
            return view('login/index', $data);
        }
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $login = $this->user->where(['email' => $email])->first();
        if ($login) {
            if (password_verify($password, $login->password)) {
                session()->set(
                    [
                        'id_user' => $login->id_user,
                        'nama' => $login->username,
                        'email' => $login->email,
                        'logged_in' => true

                    ]
                );
                return redirect()->to('');
            } else {
                session()->setFlashdata('error', 'Password Masih salah');
                return redirect()->to('login');
            }
        } else {
            session()->setFlashdata('error', 'Email Tidak Ditemukan');
            return redirect()->to('login');
        }
    }
    public function keluar()
    {
        session()->destroy();
        return redirect()->to('');
    }
}
