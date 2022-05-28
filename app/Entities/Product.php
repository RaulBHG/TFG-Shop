<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Models;

class Product extends Entity{
    
    protected $attributes = [
        'name'          => null,
        'description'   => null,
        'main_img'      => null,
        'price'         => null,
    ];

    public function getData(){
        $db      = \Config\Database::connect();
        $builder = $db->table('products');
        $builder->select('*');
        $builder->join('p_images', 'p_images.id_img = products.main_img', 'left');
        $builder->where('deleted_at', NULL);
        $builder->orderBy('created', 'desc');
        $query = $builder->get();
        $data = [];
        foreach ($query->getResult() as $row) {
            $dataNew = [
                'id'=>$row->id,
                'name'=>$row->name,
                'description'=>$row->description,
                'main_img'=>$row->file_name,
                'price'=>$row->price
            ];
            
            array_push($data, $dataNew);
        }
        // return $listData = $productModel->findAll();        
        return $data;
    }
    public function getDataById($id){
        $db      = \Config\Database::connect();
        $builder = $db->table('products');
        $builder->select('*')->where("id", $id);
        $builder->join('p_images', 'p_images.id_img = products.main_img', 'left');
        $query = $builder->get();
        $data = [];
        foreach ($query->getResult() as $row) {
            $dataNew = [
                'id'=>$row->id,
                'name'=>$row->name,
                'description'=>$row->description,
                'main_img'=>$row->file_name,
                'price'=>$row->price
            ];
            
            array_push($data, $dataNew);
        }
        // return $listData = $productModel->findAll();        
        return $data;
    }
    public function insertData($data){               
        $product = new Product($data);
        $productModel = new Models\ProductModel();   
        $productModel->insert($product);

        $idNewProduct = $productModel->getInsertID();
        $firstImgId = "";
        $firstImgName = "";

        $request = service('request');
        $namesFiles = [];
        if ($request->getFileMultiple('imagenes')) {                
            foreach($request->getFileMultiple('imagenes') as $file){
                if($file->isValid() && !$file->hasMoved()){
                    $newName = $file->getRandomName();     
                    $file->move(FCPATH.'template\img\img_products', $newName);

                    if($firstImgName == ""){
                        $firstImgName = $newName;
                    }

                    array_push($namesFiles, $newName);
                }                    
            }
        }
        
        $pimagesModel = new Models\PimagesModel();          
        $imagesProdModel = new Models\Img_productsModel();   
        foreach ($namesFiles as $name) {
            $pimagesModel->insert(['file_name' => $name]);     
            $imagesProdModel->insert(['id_product' => $idNewProduct, 'id_image' => $pimagesModel->getInsertID()]);

            if($firstImgId == ""){
                $firstImgId = $pimagesModel->getInsertID();
            }
        }

        $productModel->update($idNewProduct, ['main_img'=>$firstImgId]);

        $result = [
            "prodId"=>$idNewProduct,
            "firstImgId"=>$firstImgId,
            "firstImgName"=>$firstImgName
        ];

        return $result;
    }
    public function updateData($id, $data){
        $product = new Product($data);
        $productModel = new Models\ProductModel();
        $productModel->update($id, $product);

        $firstImgId = "";
        $firstImgName = "";

        $request = service('request');
        $namesFiles = [];
        if ($request->getFileMultiple('imagenes') && $_FILES['imagenes']['error'][0] !==4) {                          
            foreach($request->getFileMultiple('imagenes') as $file){    
                    
                $newName = $file->getRandomName();   
                $file->move(FCPATH.'template\img\img_products', $newName);

                if($firstImgName == ""){
                    $firstImgName = $newName;
                }

                array_push($namesFiles, $newName);
            }
                        
            $pimagesModel = new Models\PimagesModel();          
            $imagesProdModel = new Models\Img_productsModel();  
            $imagesProdModel->where('id_product', $id)->delete(); 
            foreach ($namesFiles as $name) {                
                $pimagesModel->insert(['file_name' => $name]);     
                $imagesProdModel->insert(['id_product' => $id, 'id_image' => $pimagesModel->getInsertID()]);
                
                if($firstImgId == ""){
                    $firstImgId = $pimagesModel->getInsertID();
                }
            }
            $productModel->update($id, ['main_img'=>$firstImgId]);
        }
        
        

        return true;
    }
    public function deleteData($id){
        $productModel = new Models\ProductModel();   
        $productModel->delete($id);

        return true;
    }


}