<?php

namespace App\Models;

use CodeIgniter\Model;

class OemailModel extends Model{
    
    protected $table      = 'orders_emails';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;   

    protected $allowedFields = ['id_order', 'id_email'];
    

}


?>