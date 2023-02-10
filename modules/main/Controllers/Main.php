<?php

namespace Modules\main\Controllers;

use Modules\Users\Models\Users as UsersModel;

class Main extends \CodeIgniter\Controller
{
    public function index()
    {
        if (!session()->get('user_id')) {
            return redirect()->route('app-login');
        } else {
            // return redirect()->route('main');
            echo view('../../modules/main/Views/main.php');
        }
    }

    public function getPage()
	{
		$data 					= $this->request->getPost();
        print_r($data);exit;
		// $operation 				= (new Menu())->find($data['con']);
		// $module 			    = explode('-', $operation['menu_code']);
		// $fileView 				= (count($module) == 1) ? 'index' : $module[1];
		// $viewPath		        = 'BackEnd\\' . ($module[0]) . '\\Views\\' . $fileView;
		// $operation['view'] 	    = base64_encode(view($viewPath));
		// $operation['isLogin']   = (session()->UserId != '') ? true : false;

		// return $this->respond($operation, 200);
	}

    public function login()
    {
        $query = (new UsersModel())->select(['user_name' => 'test User']);
        echo "<pre>";
        print_r($query);
        exit;
    }

    public function test2()
    {
        echo "Hello lagi";
    }
}
