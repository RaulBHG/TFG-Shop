<?php

namespace App\Models;

use CodeIgniter\Model;

class BlogModel extends Model{
    
    protected $table      = 'blog';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType    = \App\Entities\Blog::class;
    protected $useSoftDeletes = true;
    protected $createdField  = 'created';
    

    protected $allowedFields = ['title', 'description', 'img1', 'img2', 'img3', 'deleted_at', 'modified', 'created'];
    

}


?>