<?php
namespace App\Controllers;
use CodeIgniter\Controller;

use App\Models\AdminModel;
use App\Entities\UserAdmin;
use App\Entities\Product;

class PayController extends Controller{

    public function stripe(){
        return view("stripe");
    }

    public function payment(){

        Stripe\Stripe::setApiKey(STRIPE_SECRET);
      
        $stripe = Stripe\Charge::create ([
                "amount" => 70 * 100,
                "currency" => "usd",
                "source" => $_REQUEST["stripeToken"],
                "description" => "Test payment via Stripe From onlinewebtutorblog.com" 
        ]);

        // after successfull payment, you can store payment related information into 
        // your database

        //$data = array('success' => true, 'data' => $stripe);
        //echo json_encode($data);
        
        session()->setFlashdata("message", "Payment done successfully");

        return redirect('stripe');
    }
    


}