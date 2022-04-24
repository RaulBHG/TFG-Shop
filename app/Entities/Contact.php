<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Models;

class Contact extends Entity{
    
    protected $attributes = [
        'sender'         => null,
        'phone'          => null,
        'message'        => null,
        'id_buy'         => null
    ];

    public function getData(){
        $contactModel = new Models\ContactModel();
        return $contactModel->orderBy('created', 'desc')->findAll();
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