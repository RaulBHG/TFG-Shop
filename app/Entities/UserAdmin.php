<?php

namespace App\Entities;
use App\Models\AdminModel;
use CodeIgniter\Entity\Entity;

class UserAdmin extends Entity{   
    
    protected $attributes = [
        'email'      => null,
        'password'   => null,
    ];

}