<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model{
    
    protected $table      = 'orders';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $useSoftDeletes = true;
    protected $createdField  = 'created';
    

    protected $allowedFields = ['locate_id', 'estado', 'name', 'estado', 'address', 'phone', 'price', 'deleted_at', 'modified', 'created'];
    

}


?>