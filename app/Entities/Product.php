<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Models;

class Product extends Entity{
    
    protected $attributes = [
        'name'          => null,
        'description'   => null,
        'main_img'      => null,
        'price'         => null,
    ];

    public function getData(){
        $productModel = new Models\ProductModel();
        return $listData = $productModel->findAll();
    }
    public function insertData($data){
        $product = new Product($data);
        $productModel = new Models\ProductModel();   
        $productModel->insert($product);

        return $productModel->getInsertID();
    }
    public function updateData($id, $data){
        $product = new Product($data);
        $productModel = new Models\ProductModel();   
        $productModel->update($id, $product);

        return true;
    }
    public function deleteData($id){
        $productModel = new Models\ProductModel();   
        $productModel->delete($id);

        return true;
    }


}