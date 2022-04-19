<?php
namespace App\Controllers\Admins;
use CodeIgniter\Controller;
use CodeIgniter\Config\Database;

use App\Models;
use App\Entities;

class AdminController extends Controller{
    // private $db = null;
    // public function __construct()
    // {
    //     $this->db = \Config\Database::connect();
    // }
    public function index(){
        echo view("private/adminPage");
    }

    public function loadView($view){
        helper('template'); 
        echo view("private/".$view);
    }

    public function insertElement($entity){
        if ($this->request->isAJAX()) {
            switch ($entity) {
                case 'product':
                    $entity = new Entities\Product();
                    break;
                
                default:
                    # code...
                    break;
            }
            $data = $this->request->getPost();
        
            // $data = [
            //     'name'=>'raul',
            //     'description'=>'raul',
            //     'main_img'=>01,
            //     'price'=>12
            // ];
            // $this->db->table($table)->insert($data);
            $entity->insertData($data);
        }
    }

}