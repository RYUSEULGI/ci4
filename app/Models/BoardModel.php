<?php

namespace App\Models;

use CodeIgniter\Model;

class BoardModel extends Model
{

    // 생성자
    function __construct()
    {
        parent::__construct();
    }

    public function getList()
    {
        return $this->db->query('SELECT * FROM topic')->getResult();
    }

    public function getDetail($boardId)
    {
        return $this->db->query('SELECT * FROM topic WHERE id=' . $boardId)->getRow();
    }
}
