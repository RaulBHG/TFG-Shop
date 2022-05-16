<?php
namespace App\Controllers;
use CodeIgniter\Controller;

use App\Models\AdminModel;
use App\Entities\UserAdmin;
use App\Entities\Product;
use App\Models;

class CestController extends Controller{

    public function index(){
        helper("template");
        $session = session();   
        $cesta = $session->get('cest');
        $products = [];
        foreach ($cesta as $prod) {
            $entity = new Product();
            $product = $entity->getDataById($prod["productId"])[0];
            $product["priceTotal"] = $product["price"]*$prod["cantProd"];
            $product["cant"] = $prod["cantProd"];
            array_push($products, $product);
        }        
        $data = [
            "products" => $products
        ];
        return view('cest', $data);
    }

    public function addToCest(){
        if ($this->request->isAJAX()) {

        $productId = $this->request->getPost("idProd");
        $cantProd = $this->request->getPost("cantProd");

        if($cantProd > 0 && $cantProd < 50){
            $result = [
                "result" => "ok"
            ];
            $session = session();
        
            $productSession = [
                'productId' => $productId,
                'cantProd' => $cantProd,                    
            ];
            if (!session()->get('cest')){
                $cesta = [$productSession];
            }else{
                $existeProd = false;
                $cesta = session()->get('cest');
                foreach ($cesta as $key => $producto) {
                    if($productId == $producto["productId"]){
                        $existeProd = true;
                        $cesta[$key]["cantProd"] += $cantProd;
                        if($cesta[$key]["cantProd"] > 50 || $cesta[$key]["cantProd"] < 0){
                            $result["result"] = "nok";
                            return json_encode($result);
                        }
                    }
                }
                if(!$existeProd){
                    array_push($cesta, $productSession);
                }
            }
            $session->set("cest", $cesta);
            
        }else{
            $result = [
                "result" => "nok"
            ];
        }
        
        return json_encode($result);
        }
    }

    public function updateCant(){
        if ($this->request->isAJAX()) {

        $productId = $this->request->getPost("idProd");
        $cantProd = $this->request->getPost("cantProd");

        if($cantProd > 0 && $cantProd < 50){
            $result = [
                "result" => "ok"
            ];
            $session = session();
        
            $productSession = [
                'productId' => $productId,
                'cantProd' => $cantProd,                    
            ];

            $cesta = session()->get('cest');
            foreach ($cesta as $key => $producto) {
                if($productId == $producto["productId"]){
                    $existeProd = true;
                    $cesta[$key]["cantProd"] = $cantProd;
                    if($cesta[$key]["cantProd"] > 50 || $cesta[$key]["cantProd"] < 0){
                        $result["result"] = "nok";
                        return json_encode($result);
                    }
                }
            }

            $session->set("cest", $cesta);
            
        }else{
            $result = [
                "result" => "nok"
            ];
        }
        
        return json_encode($result);
        }
    }

    public function removeFromCest(){
        $productId = $this->request->getPost("idProd");
        $session = session();
        $cesta = session()->get('cest');
        foreach ($cesta as $key => $producto) {
            if($cesta[$key]["productId"] == $productId)
            unset($cesta[$key]);
        }
        $session->set("cest", $cesta);
        $result = [
            "result" => "ok"
        ];
        return json_encode($result);
    }

    public function addOrder(){
        $order = new Models\OrderModel();
        $orderProducts = new Models\OprodModel();
        $orderEmail = new Models\OemailModel();
        $priceTotal = 0;
        $session = session();   
        $cesta = $session->get('cest');
        $products = [];
        foreach ($cesta as $prod) {
            $entity = new Product();
            $product = $entity->getDataById($prod["productId"])[0];
            $priceTotal += $product["price"]*$prod["cantProd"];
        }
        $locateId = rand();
        $data = [
            'locate_id'   => $locateId,
            'estado'      => 0,
            'name'        => $this->request->getPost('name'),
            'address'     => $this->request->getPost('address'),
            'phone'       => $this->request->getPost('phone'),
            'price'       => $priceTotal,
        ];

        $order->insert($data);

        foreach ($cesta as $prod) {
            $data = [
                'id_order'    => $order->getInsertID(),
                'id_product'  => $prod["productId"],
                'cant'        => $prod["cantProd"]
            ];
            $orderProducts->insert($data);
        }
        $result = [
            "locateId"  => $locateId            
        ];
        
        echo($locateId);
    }


}