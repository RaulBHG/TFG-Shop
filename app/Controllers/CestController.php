<?php
namespace App\Controllers;
use CodeIgniter\Controller;

use App\Models\AdminModel;
use App\Entities\UserAdmin;

class CestController extends Controller{

    public function index(){

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
            print_r ($session->get('cest'));            
            
        }else{
            $result = [
                "result" => "nok"
            ];
        }
        
        return json_encode($result);
        }
    }


}