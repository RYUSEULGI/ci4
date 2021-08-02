<?php

namespace App\Controllers;

use BoardModel;
use CodeIgniter\Controller;

class Board extends Controller
{
    // public function index()
    // {
    //     echo "연결완료";

    //     $model = new BoardModel();

    //     $data = ['res' => $model->getBoard()];

    //     echo view('header', $data);
    //     echo view('board/boardList', $data);
    //     echo view('footer', $data);
    // }

    public function test()
    {
        echo "test";
    }

    public function insert()
    {
        $username = "peter";
        $password = "1234";

        $model = new BoardModel();

        $model->create([
            'username' => $username,
            'password' => $password
        ]);
    }
}
