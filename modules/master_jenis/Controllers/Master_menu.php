<?php namespace Modules\Master_menu\Controllers;

use Modules\Master_menu\Models\Master_menu as menuModel;

class Master_menu extends \CodeIgniter\Controller
{
    public function index()
    {
        // echo "Hello World";
        $data['data'] = (new menuModel())->selectDt('datatable');
        echo json_encode($data);
        // print_r($data);exit;
    }

    public function test()
    {
        echo "Hello lagi";
    }
}
