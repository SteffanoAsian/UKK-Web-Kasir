<?php

namespace Modules\Users\Controllers;

use CodeIgniter\Modules\Modules;
use App\Libraries\Gen;
use Modules\Users\Models\Users as UserModel;
use Modules\Users\Models\Role as RoleModel;

class Users extends \CodeIgniter\Controller
{
    public function index()
    {
        $where = [];
        $data['data'] = (new UserModel())->selectDt('datatable', $where);
        echo json_encode($data);
    }

    public function loadRole()
    {

        $data = (new RoleModel())->select([
            'filter' => ['role_status' => 1]
        ]);

        echo json_encode($data);
    }

    public function store()
    {
        $data = $this->request->getPost();
        $id  = Gen::key();

        $data['user_status'] = 1;
        if (empty($data['user_password'])) {
            $data['user_password'] = md5('password123');
        } else {
            $password = md5($data['user_password']);
            $data['user_password'] = $password;
        }

        $operation = (new UserModel())->store($id, $data);

        echo json_encode($operation);
    }

    public function edit()
    {
        $data = $this->request->getPost();

        $operation = (new UserModel())->read($data['user_id']);

        echo json_encode($operation);
    }

    public function update()
    {
        $data = $this->request->getPost();

        if (empty($data['user_password'])) {
            unset($data['user_password']);
        } else {
            $password = md5($data['user_password']);
            $data['user_password'] = $password;
        }


        $operation = (new UserModel())->updateData($data['user_id'], $data);

        echo json_encode($operation);
    }

    public function destroy()
    {
        $data = $this->request->getPost();

        $operation = (new UserModel())->destroy($data['user_id']);

        echo json_encode($operation);
    }

    public function test()
    {
        echo "Hello lagi";
    }
}
