<?php
namespace App\Controllers;
use CodeIgniter\Controller;

use App\Models\AdminModel;
use App\Models;
use App\Entities\UserAdmin;
use App\Entities\Product;
use Stripe;

class PayController extends Controller{

    public function stripe(){       
        helper("template");
        return view("stripe");
    }

    public function payment(){
        Stripe\Stripe::setApiKey(STRIPE_SECRET);

        $this->addOrder();             

        $stripe = Stripe\Charge::create ([
                "amount" => $this->request->getVar('amount'),
                "currency" => "eur",
                "source" => $this->request->getVar('tokenId'),
                "description" => "Test payment from tutsmake.com." 
        ]);
        
            
       // after successfull payment, you can store payment related information into your database
             
        $data = array('success' => true, 'data'=> $stripe);
        echo json_encode($data);
    }
    
    public function addOrder(){        
        $order = new Models\OrderModel();
        $emailClients = new Models\EmailModel();
        $orderEmail = new Models\OemailModel();        

        // EMAIL
        Stripe\Stripe::setApiKey(STRIPE_SECRET);
        $stripeinfo = Stripe\Token::retrieve($this->request->getVar('tokenId'));
        $email = $stripeinfo->email;
        $emailExist = $emailClients->where("email", $email)->first();

        $locateId = $this->request->getPost('locateId');
        $orderId = $order->where("locate_id", $locateId)->first()["id"];

        if(!$emailExist){
            $emailClients->insert(["email" => $email]);
            $data = [
                'id_order'  => $orderId,
                'id_email'  => $emailClients->getInsertID()
            ];
            $orderEmail->insert($data);
        }else{
            $idEmail = $emailExist["id"];
            $data = [
                'id_order'  => $orderId,
                'id_email'  => $idEmail
            ];
            $orderEmail->insert($data);
        } 


    }


}