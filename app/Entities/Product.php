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
        'deleted_at'    => null,
        'modified'      => null,
        'created'       => null,
    ];

    public function insertData($data){
        $product = new Product($data);
        $productModel = new Models\ProductModel();   
        $productModel->insert($product);

        

        return true;
    }


}