<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Topic extends Controller
{

    public function index()
    {
        echo view('basic/topic');
    }

    public function get($id)
    {
        $data = array('id' => $id);
        echo view('basic/get', $data);
    }
}
