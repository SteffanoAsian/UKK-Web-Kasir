<?php

namespace Modules\login\Controllers;

use Modules\Users\Models\Users as UsersModel;
use Modules\Users\Models\UserRole as UserRole;

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
                    'role_id'    => $user['user_role_id'],
                    'rules'     => $this->getRoles($user['user_role_id']),
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

    protected function getRoles($roleId)
    {
        $rule = (new UserRole())->getRoleAccess($roleId);
        return $rule;
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->route('app-login');
    }

    public function test2()
    {
        echo "Hello lagi";
    }
}
