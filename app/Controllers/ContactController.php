<?php
namespace App\Controllers;
use CodeIgniter\Controller;

use App\Entities\Contact;

use App\Libraries\libMail;

class ContactController extends Controller{

    public function index(){       
        helper("template");
        return view("contact");
    }

    public function sendMessage(){
        if($this->request->isAJAX()) {
            $contactEntity = new Contact();
            $contactEntity->insertData($this->request->getPost());

            $nombre = $this->request->getPost('nombre');
            $id_buy = $this->request->getPost('id_buy');
            $sender = $this->request->getPost('sender');
            $phone = $this->request->getPost('phone');
            $message = $this->request->getPost('message');

            libMail::sendMail("Su mensaje ha sido procesado correctamente. <br> Pronto lo recibirá una respuesta.", $sender);

            libMail::sendMail("<h1>NUEVO MENSAJE</h1> <br> <b>Nombre:</b>".$nombre." <br> <b>ID COMPRA:</b> ".$id_buy." <br> <b>Email:</b> ".$sender." <br> <b>Teléfono:</b> ".$phone." <br> <b>Texto:</b> ".$message);
        }
    }

    
}