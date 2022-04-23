<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Models;

class Order extends Entity{
    
    protected $attributes = [
        'locate_id'     => null,
        'estado'        => null,
        'name'          => null,
        'address'       => null,
        'phone'         => null,
        'price'         => null,
        'product_list'  => null,
        'email'         => null
    ];

    public function getData(){
        $db      = \Config\Database::connect();
        $builder = $db->table('orders');
        $builder->select('*');
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
                'cant'=>0,
                'email'=>""               
            ];
            
            // GETTING PRODUCT INFO
            $productEntitie = new Entities\Product();
            $oProductModel = new Models\OprodModel();
            $listProd = json_decode(json_encode($oProductModel->where('id_order', $row->id)->findAll()), TRUE);
            foreach ($listProd as $ele) {                
                $prodInfo = json_decode(json_encode($productEntitie->getDataById($ele["id_product"])), TRUE);
                $dataNew["cant"] = $ele["cant"];                
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
    public function insertData($data){                       
        $contact = new Contact($data);
        $contactModel = new Models\ContactModel();   
        $contactModel->insert($contact);

        $idNewContact = $contactModel->getInsertID();        

        return $idNewContact;
    }
    public function updateData($id, $data){
        $contact = new Contact($data);
        $contactModel = new Models\ContactModel();
        $contactModel->update($id, $contact);    
        

        return true;
    }
    public function deleteData($id){
        $contactModel = new Models\ContactModel();   
        $contactModel->delete($id);

        return true;
    }


}