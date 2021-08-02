<?php

use CodeIgniter\Model;

class BoardModel extends Model
{
    protected $table = 'boards';
    protected $allowedFields = ['title', 'contents', 'writer'];

    public function getBoard()
    {
    }

    public function create()
    {
        $this->db->insert();
    }
}
