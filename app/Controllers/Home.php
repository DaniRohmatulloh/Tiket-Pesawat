<?php

namespace App\Controllers;

use App\Models\WisataModel;

class Home extends BaseController
{
    protected $wisata;
    public function __construct()
    {
        $this->wisata = new WisataModel();
    }
    public function index()
    {
        $data['wisata'] = $this->wisata->limit(3)->findAll(); 
        return view('Home', $data);
    }
}
