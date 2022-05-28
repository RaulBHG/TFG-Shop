<?php

namespace App\Models;

use CodeIgniter\Model;

class EmailModel extends Model{
    
    protected $table      = 'email_clients';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $allowedFields = ['email'];
    

}


?>