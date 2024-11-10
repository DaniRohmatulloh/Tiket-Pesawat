<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use CodeIgniter\HTTP\ResponseInterface;

class Login extends BaseController
{
    protected $login;
    public function __construct()
    {
        $this->login = new AdminModel();
        helper(['form', 'url']);
    }
    public function index()
    {

        return view('admin/login/index');
    }
    public function cek()
    {
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required'
        ];
        $pesan = [
            'email' => [
                'required' => 'Email Tidak Boleh Kosong!',
                'valid_email' => 'Format Email Salah!'
            ],
            'password' => [
                'required' => 'Password Tidak Boleh Kosong!',
            ]
        ];

        if (!$this->validate($rules, $pesan)) {
            $data['validation'] = $this->validator;
            return view('admin/Login/index', $data);
        }
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $dataLogin = $this->login->where(['email' => $email])->first();
        if ($dataLogin) {
            if (password_verify($password, $dataLogin->password)) {
                session()->set([
                    'id_admin' => $dataLogin->id_admin,
                    'logged_in' => true,
                    'nama' => $dataLogin->nama
                ]);
                return redirect()->to('admin/home');
            } else {
                session()->setFlashdata('error', 'Password Masih Salah');
                return redirect()->to('admin/login');
            }
        } else {
            session()->setFlashdata('error', 'Email Tidak ditemukan');
            return redirect()->to('admin/login');
        }
    }
    public function keluar()
    {
        session()->destroy();

        return redirect('admin');
    }
}
