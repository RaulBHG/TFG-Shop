<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model{
    
    protected $table      = 'products';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType    = \App\Entities\Product::class;
    protected $useSoftDeletes = true;
    protected $createdField  = 'created';
    

    protected $allowedFields = ['name', 'description', 'main_img', 'price', 'deleted_at', 'modified', 'created'];
    

}


?>