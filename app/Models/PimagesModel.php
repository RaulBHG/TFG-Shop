<?php

namespace App\Models;

use CodeIgniter\Model;

class PimagesModel extends Model{
    
    protected $table      = 'p_images';
    protected $primaryKey = 'id_img';

    protected $useAutoIncrement = true;

    protected $returnType    = \App\Entities\Product::class;    

    protected $allowedFields = ['file_name'];
    

}


?>