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
            echo view('../../modules/main/Views/main.php');
        }
    }

    public function getPage()
    {
        $data                     = $this->request->getPost();
        $module = $this->getRules($data['menu']);
        $fileView 				= (count($module) == 1) ? 'index' : $module[1];
        $viewPath		        = 'Modules\\' . ($module[0]) . '\\Views\\' . $fileView;
        $operation['view'] 	    = base64_encode(view($viewPath));
        $operation['isLogin']   = (session()->get('user_id') != '') ? true : false;

        return json_encode($operation);
    }

    protected function getRules($menu)
    {
        $search = explode('-', $menu);
        return $search;
    }
}
