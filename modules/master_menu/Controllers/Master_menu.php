<?php

namespace Modules\Master_menu\Controllers;

use CodeIgniter\Modules\Modules;
use App\Libraries\Gen;
use Modules\Master_menu\Models\Master_menu as menuModel;
use Modules\Master_jenis\Models\Master_jenis as jenisModel;

class Master_menu extends \CodeIgniter\Controller
{
    public function index()
    {
        $where = ['master_menu_status' => 1];
        $data['data'] = (new menuModel())->selectDt('datatable', $where);
        echo json_encode($data);
    }

    public function loadJenis()
    {

        $data = (new jenisModel())->select([
            'filter' => ['master_jenis_status' => 1]
        ]);

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

        $operation = (new menuModel())->read($data['master_menu_id']);

        echo json_encode($operation);
    }

    public function update()
    {
        $data = $this->request->getPost();

        $operation = (new menuModel())->updateData($data['master_menu_id'], $data);

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
        echo "Hello lagi";
    }
}
