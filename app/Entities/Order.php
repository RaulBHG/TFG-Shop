<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Models;
use App\Entities;

class Order extends Entity{
    
    protected $attributes = [
        'locate_id'     => null,
        'estado'        => null,
        'name'          => null,
        'address'       => null,
        'phone'         => null,
        'price'         => null,
        'products'      => null,
        'cant'          => null,
        'email'         => null
    ];

    public function getData(){        
        $db      = \Config\Database::connect();
        $builder = $db->table('orders');
        $builder->select('*');
        $builder->where('deleted_at', NULL);
        $builder->orderBy('created', 'desc');
        $query = $builder->get();
        $data = []; 
             
        foreach ($query->getResult() as $row) {
              
            $dataNew = [
                'id'=>$row->id,
                'locate_id'=>$row->locate_id,
                'estado'=>$row->estado,
                'name'=>$row->name,
                'address'=>$row->address,
                'phone'=>$row->phone,
                'price'=>$row->price,
                'products'=>[],
                'email'=>""               
            ];
            
            // GETTING PRODUCT INFO
            $productEntitie = new Entities\Product();
            $oProductModel = new Models\OprodModel();            
            $listProd = json_decode(json_encode($oProductModel->where('id_order', $row->id)->findAll()), TRUE);

            foreach ($listProd as $ele) {                  
                // $prodInfo = json_decode(json_encode($productEntitie->getDataById($ele["id_product"])), TRUE)[0];
                $prodInfo = $productEntitie->getDataById($ele["id_product"])[0];
                $prodInfo["cant"] = $ele["cant"];                
                array_push($dataNew["products"], $prodInfo);
            }
            // GETTING EMAIL
            $oEmailModel = new Models\OemailModel();
            $emailModel = new Models\EmailModel();
            $listEmail = json_decode(json_encode($oEmailModel->where('id_order', $row->id)->findAll()), TRUE);
            foreach ($listEmail as $ele) {                
                $emailInfo = json_decode(json_encode($emailModel->find($ele["id_email"])), TRUE);
                $dataNew["email"] = $emailInfo["email"];
            }

            array_push($data, $dataNew);
        }        

        return $data;
    }
    public function updateData($id, $data){
        $order = new Order($data);
        $orderModel = new Models\OrderModel();
        $orderModel->update($id, $order);    
    
        return true;
    }
    public function deleteData($id){
        
        $orderModel = new Models\OrderModel();   
        $orderModel->delete($id);

        return true;
    }


}