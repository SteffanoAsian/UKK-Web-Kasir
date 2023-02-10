<?php

namespace Modules\login\Controllers;

use Modules\Users\Models\Users as UsersModel;

class Login extends \CodeIgniter\Controller
{
    public function index()
    {
        if (!session()->get('user_id')) {
            echo view('../../modules/login/Views/login.php');
        } else {
            return redirect()->route('main');
        }
    }

    // public function getPage()
    // {
    //     $data                     = $this->request->getPost();
    //     print_r($data);
    //     exit;
    //     // $operation 				= (new Menu())->find($data['con']);
    //     // $module 			    = explode('-', $operation['menu_code']);
    //     // $fileView 				= (count($module) == 1) ? 'index' : $module[1];
    //     // $viewPath		        = 'BackEnd\\' . ($module[0]) . '\\Views\\' . $fileView;
    //     // $operation['view'] 	    = base64_encode(view($viewPath));
    //     // $operation['isLogin']   = (session()->UserId != '') ? true : false;

    //     // return $this->respond($operation, 200);
    // }

    public function doLogin()
    {
        $data = $this->request->getPost();
        $where = [
            'user_email ="' . $data['uname'] . '" OR user_username ="' . $data['uname'] . '"' => null,
            'user_status'  => 1
        ];

        $user = (new UsersModel())->read($where);

        if (!empty($user)) {
            if ($data['user_password'] = $user['user_password']) {
                // if (password_verify($data['user_password'], $user['user_password'])) {
                session()->set([
                    'user_id'    => $user['user_id'],
                    'user_name'  => $user['user_name'],
                    'user_username'  => $user['user_username'],
                    'user_email'     => $user['user_email'],
                    'IsLogin'   => true,
                    'role_id'    => $user['user_role_id']
                    // 'Rules'     => $this->getRoles($user['user_id']),
                ]);
                $response = [
                    'success'   => true,
                    'message'   => 'login successfully',
                    'redirectTo' => 'main'
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Wrong password.'
                ];
            }
        } else {
            $response = [
                'success' => false,
                'message' => 'Username or Email not found.'
            ];
        }

        echo json_encode($response);
    }

    public function logout()
    {
        // echo "Hello lagi";
        session()->destroy();
        return redirect()->route('app-login');
    }

    public function test2()
    {
        echo "Hello lagi";
    }
}
