<?php

namespace App\Controllers;

use App\Models;
use App\Entities;

class Home extends BaseController
{
    public function index()
    {
        helper("template");
        return view('index');
    }

    public function loadView($view, $element = 0){        

        helper('template'); 

        $data = [];

        // SHOP
        switch ($view) {
            case 'shop':
                $entity = new Entities\Product();

                $listElements = $entity->getData();
                $data = ["products" => $listElements];
                break;
            case 'product':
                $entity = new Entities\Product();

                $product = $entity->getDataById($element);
                $data = ["product" => $product[0]];
                break;
            
            default:
                # code...
                break;
        }



        echo view($view, $data);
    }
}
