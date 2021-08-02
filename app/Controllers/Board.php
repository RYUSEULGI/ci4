<?php

namespace App\Controllers;

use App\Models\BoardModel;
use CodeIgniter\Controller;

class Board extends Controller
{

    public function index()
    {
        $db = \Config\Database::connect();

        $boardModel = new BoardModel();
        $data = ['boardList' => $boardModel->getList()];

        echo view('header');
        echo view('board/boardList', $data);
        echo view('footer');
    }

    public function get($id)
    {
        $db = \Config\Database::connect();

        $boardModel = new BoardModel();
        $data = ['boardId' => $boardModel->getDetail($id)];

        echo view('header');
        echo view('board/boardDetail', $data);
        echo view('footer');
    }
}
