<?php
namespace App\Controllers\Admins;
use CodeIgniter\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $session = session();
        echo view("private/adminPage");
    }
}