<?php

namespace Modules\Playground\Controllers;

use Modules\Users\Models\Users as UsersModel;

class Playground extends \CodeIgniter\Controller
{
    public function index()
    {
        echo "Hello World";
    }

    public function create()
    {
        $data = [
            'user_name' => 'test update',
            'user_username' => 'add1',
            'user_status' => 1
        ];
        $query = (new UsersModel())->destroy('9503496edf2b13dec525e54222f8b4d3');
        echo "<pre>";
        print_r($query);
        exit;
    }

    public function read()
    {
        $query = (new UsersModel())->select(['user_name' => 'test User']);
        echo "<pre>";
        print_r($query);
        exit;
    }
}
