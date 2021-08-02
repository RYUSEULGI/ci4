<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Home extends Controller
{
	public function index()
	{
		echo view('header');
		echo view("footer");
	}
}
