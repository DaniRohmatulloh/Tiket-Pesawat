<?php

namespace App\Controllers\admin;

use CodeIgniter\Controller;

class Home extends Controller
{
    public function index()
    {
        if (session()->get('logged_in') == true) {
            return view('admin/home');
        } else {
            return redirect()->to('admin/login');
        }
    }
}
