<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Principal extends BaseController
{
    public function __construct()
    {
    }

    public function index()
    {
        $data = ['titulo' => 'Proyecto Taller', 'nombre' => 'Moises Mazo', 'tituloPrin' => 'Principal'];
        echo view('/principal/header', $data);
        echo view('/principal/principal');
    }
}