<?php
namespace App\Controllers;
use CodeIgniter\Controller;

use App\Models\AdminModel;
use App\Entities\UserAdmin;
use App\Entities\Product;

class PayController extends Controller{

    public function index(){
        helper("template");
        
        return view('cest', $data);
    }
    


}