<?php

namespace App\Models;

use CodeIgniter\Model;

class OprodModel extends Model{
    
    protected $table      = 'orders_products';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $allowedFields = ['id_order', 'id_product', 'cant'];
    

}


?>