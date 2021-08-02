<?php

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['username', 'password'];
}
