<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\WisataModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

class Responser extends BaseController
{
    protected $wisata;
    public function __construct()
    {
        helper(['form', 'url']);
        $this->wisata = new WisataModel();
    }
    use ResponseTrait;
    public function index()
    {
        //
    }

    function searchFlight()
    {

        $asal = $this->request->getGet("asal");
        $tujuan = $this->request->getGet("tujuan");

        // Retrieve the wisata data and handle the case where it might not exist
        $wisataData = $this->wisata->where('asal', $asal)
            ->where('nama_wisata', $tujuan)
            ->first();

        return $this->respond($wisataData, 200);
    }
}
