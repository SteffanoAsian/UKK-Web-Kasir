<?php

namespace Modules\Hakakses\Controllers;

use CodeIgniter\Modules\Modules;
use App\Libraries\Gen;
use Modules\Hakakses\Models\Hakakses as Access;
use Modules\Hakakses\Models\Roles as Role;

class Hakakses extends \CodeIgniter\Controller
{
    public function index()
    {
        $where = ['role_status' => 1];
        $data['data'] = (new Role())->selectDt('datatable', $where);
        echo json_encode($data);
    }

    public function store()
    {
        $data = $this->request->getPost();
        $id  = Gen::key();

        $data['master_menu_created_at'] = date('Y-m-d H:i:s');
        $data['master_menu_status'] = 1;

        $operation = (new menuModel())->store($id, $data);

        echo json_encode($operation);
    }

    public function edit()
    {
        $data = $this->request->getPost();

        $operation = (new Role())->read($data['role_id']);

        echo json_encode($operation);
    }

    public function update()
    {
        $data = $this->request->getPost();

        $operation = (new Role())->updateData($data['role_id'], $data);

        echo json_encode($operation);
    }

    public function destroy()
    {
        $data = $this->request->getPost();
        $datains = [
            'master_menu_deleted_at' => date('Y-m-d H:i:s'),
            'master_menu_status' => 0
        ];
        $operation = (new menuModel())->updateData($data['master_menu_id'], $datains);

        echo json_encode($operation);
    }

    public function test()
    {
        // echo "Hello lagi";
        // $cekData = (new Menu())->read([
            // 'master_menu_jenis_id' => $data['master_jenis_id'],
            // 'master_menu_status'=> 0,
        // ]);

        // if(empty($cekData)){
            // proses hapus
        // }else{
            // pesan gagal
        // }
    }
}
