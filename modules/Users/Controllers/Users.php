<?php namespace Modules\Users\Controllers;

use Modules\Users\Models\Users as UsersModel;

class Users extends \CodeIgniter\Controller
{
    public function index()
    {
        echo "Hello World";
    }

    public function login()
    {
        // $db      = \Config\Database::connect();
        // $builder = $db->table('user')->get()->getRowArray();
        // print_r($builder);exit;
        $query = (new UsersModel())->select(['user_name' =>'test User']);
        echo"<pre>";
        print_r($query);exit;
    }

    public function test2()
    {
        echo "Hello lagi";
    }
}
