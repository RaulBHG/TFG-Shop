<?php

namespace App\Models;

use CodeIgniter\Model;

// TABLA RELACIONAL
class Img_productsModel extends Model{
    
    protected $table      = 'images_products';

    protected $allowedFields = ['id_product', 'id_image'];
    

}


?>