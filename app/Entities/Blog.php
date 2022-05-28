<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Models;

class Blog extends Entity{
    
    protected $attributes = [
        'title'       => null,
        'description' => null,
        'img1'        => null,
        'img2'        => null,
        'img3'        => null,
    ];

    public function getData(){
        $blogModel = new Models\BlogModel();
        return $blogModel->orderBy('created', 'desc')->findAll();
    }
    public function insertData($data){                       
        $blog = new Blog($data);
        $blogModel = new Models\BlogModel();           
                
        $request = service('request');

        $img1Name = "";
        if(!empty($request->getFile('img1')->getName())){ 
        
            $img1 = $request->getFile("img1");        
            $img1Name = $img1->getRandomName();     
            $img1->move(FCPATH.'template\img\img_blog', $img1Name);
            $blog->img1 = $img1Name;
        }        

        $img2Name = "";
        if(!empty($request->getFile('img2')->getName())){ 
        
            $img2 = $request->getFile("img2");
            $img2Name = $img2->getRandomName();           
            $img2->move(FCPATH.'template\img\img_blog', $img2Name);
            $blog->img2 = $img2Name;
        }

        $img3Name = "";
        if(!empty($request->getFile('img3')->getName())){ 
        
            $img3 = $request->getFile("img3");
            $img3Name = $img3->getRandomName();     
            $img3->move(FCPATH.'template\img\img_blog', $img3Name);
            $blog->img3 = $img3Name;
        }

        $blogModel->insert($blog);        

        $idNewBlog = $blogModel->getInsertID(); 
        
        $result = [
            "blogId"=>$idNewBlog,
            "img1Name"=>$img1Name,
            "img2Name"=>$img2Name,
            "img3Name"=>$img3Name
        ];

        return $result;
    }
    public function updateData($id, $data){
        $blog = new Blog($data);
        $blogModel = new Models\BlogModel();           
                
        $request = service('request');

        $img1Name = "";
        if(!empty($request->getFile('img1')->getName())){ 
        
            $img1 = $request->getFile("img1");        
            $img1Name = $img1->getRandomName();     
            $img1->move(FCPATH.'template\img\img_blog', $img1Name);
            $blog->img1 = $img1Name;
        }        

        $img2Name = "";
        if(!empty($request->getFile('img2')->getName())){ 
        
            $img2 = $request->getFile("img2");
            $img2Name = $img2->getRandomName();           
            $img2->move(FCPATH.'template\img\img_blog', $img2Name);
            $blog->img2 = $img2Name;
        }

        $img3Name = "";
        if(!empty($request->getFile('img3')->getName())){ 
        
            $img3 = $request->getFile("img3");
            $img3Name = $img3->getRandomName();     
            $img3->move(FCPATH.'template\img\img_blog', $img3Name);
            $blog->img3 = $img3Name;
        }

        $blogModel->update($id, $blog);      
        
        return true;
    }
    public function deleteData($id){
        $blogModel = new Models\BlogModel();   
        $blogModel->delete($id);

        return true;
    }


}