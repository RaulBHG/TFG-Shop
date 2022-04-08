<?php
namespace App\Controllers\Admins;
use CodeIgniter\Controller;
use App\Models\AdminModel;

class SigninController extends Controller{

    public function index(){

        helper(['form']);
        echo view('private/signinAdmin');

    }

    public function loginAuth(){
        $session = session();
        $adminModel = new AdminModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $data = $adminModel->where('email', $email)->first();

        if($data){            

            $pass = $data['password'];

            $authenticatePassword = password_verify($password, $pass);
            if($authenticatePassword){
                $ses_data = [
                    'id' => $data['id'],
                    'email' => $data['email'],                    
                    'isLoggedIn' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/adminPage');
            }

        }
        $session = session();
        $session->setFlashdata('msg', 'Contraseña o email incorrectos.');
        return redirect()->to(base_url('/admin'));
    }


}