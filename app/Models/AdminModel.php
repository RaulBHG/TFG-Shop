<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class AdminModel extends Model{
    protected $table = 'users_admin';
    protected $useSoftDeletes = true;
    protected $useTimestamps = false;
    protected $createdField  = 'created';
    protected $updatedField  = 'modified';
    protected $deletedField  = 'deleted_at';

    
    protected $allowedFields = [
        'email',
        'password'
    ];
}