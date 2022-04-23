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

    public function getElements($entity){
        if ($this->request->isAJAX()) {

            $entity = $this->entityReturn($entity);

            $listElements = $entity->getData();

            return json_encode($listElements);

        }

    }

    public function insertElement($entity){
        if ($this->request->isAJAX()) {
            
            $entity = $this->entityReturn($entity);

            $data = $this->request->getPost();            
            // $data = [
            //     'name'=>'raul',
            //     'description'=>'raul',
            //     'main_img'=>01,
            //     'price'=>12
            // ];
            // $this->db->table($table)->insert($data);
            $data = $entity->insertData($data);
            
            $result = [
                "code"  => "ok",
                "data"    => $data
            ];
            return json_encode($result);
        }
    }

    public function updateElement($entity, $id){
        if ($this->request->isAJAX()) {
            
            $entity = $this->entityReturn($entity);

            $data = $this->request->getPost();
        
            $entity->updateData($id, $data);

            return true;
        }
    }

    public function removeElement($entity, $id){
        if ($this->request->isAJAX()) {

            $entity = $this->entityReturn($entity);

            $removedElement = $entity->deleteData($id);

            return true;

        }

    }

    public function entityReturn($entity){
        switch ($entity) {
            case 'product':
                $entity = new Entities\Product();
                break;
            case 'contact':
                $entity = new Entities\Contact();
                break;
            case 'order':
                $entity = new Entities\Order();
                break;
            
            default:
                # code...
                break;
        }
        return $entity;
    }

}