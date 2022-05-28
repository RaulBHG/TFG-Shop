<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactModel extends Model{
    
    protected $table      = 'contacts';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType    = \App\Entities\Contact::class;
    protected $useSoftDeletes = true;
    protected $createdField  = 'created';
    

    protected $allowedFields = ['sender', 'phone', 'message', 'id_buy', 'deleted_at', 'modified', 'created'];
    

}


?>