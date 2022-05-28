<?php
namespace App\Controllers;
use CodeIgniter\Controller;

use App\Models\AdminModel;
use App\Models;
use App\Entities\UserAdmin;
use App\Entities\Product;
use Stripe;

use App\Libraries\libMail;

class PayController extends Controller{

    public function stripe(){       
        helper("template");
        return view("stripe");
    }

    public function payment(){
        if ($this->request->isAJAX()) {
            Stripe\Stripe::setApiKey(STRIPE_SECRET);
            
            $this->addOrder();

            $priceTotal = 0;
            $session = session();   
            $cesta = $session->get('cest');
            $products = [];
            foreach ($cesta as $prod) {
                $entity = new Product();
                $product = $entity->getDataById($prod["productId"])[0];
                $priceTotal += $product["price"]*$prod["cantProd"];
            }

            $priceTotal *= 100;

            $stripe = Stripe\Charge::create ([
                    "amount" => $priceTotal,
                    "currency" => "eur",
                    "source" => $this->request->getVar('tokenId'),
                    "description" => "Test payment from tutsmake.com." 
            ]);
            
                
        // after successfull payment, you can store payment related information into your database
                
            $data = array('success' => true, 'data'=> $stripe);
            echo json_encode($data);
        }
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

        libMail::sendMail("Su pedido con número <br> <b>".$locateId."</b> ha sido procesado correctamente. <br> Pronto lo recibirá.", $email);


    }


}