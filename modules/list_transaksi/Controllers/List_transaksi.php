<?php

namespace Modules\List_transaksi\Controllers;

use CodeIgniter\Modules\Modules;
use App\Libraries\Gen;
use Modules\List_transaksi\Models\List_transaksi as transaksiModel;
use Modules\Users\Models\Users as UserModel;

class List_transaksi extends \CodeIgniter\Controller
{
    public function index()
    {
        $post = $this->request->getPost();
        $where = [];
        
        if (session()->get('role_id') == 'cf218a7fcacbc41404e024dba953c38b') {
            $where['transaksi_user_id'] = session()->get('user_id');
        }

        $aArrDate = explode('-', $post['date']);
        $startDate  = date('Y-m-d', strtotime($aArrDate[0]));
        $endDate    = date('Y-m-d', strtotime($aArrDate[1]));

        if (isset($post['date'])) {
            if ($startDate == $endDate) {
                $where['transaksi_date'] = $startDate;
            } else {
                $where['transaksi_date BETWEEN "' . $startDate . '" AND "' . $endDate . '"'] = null;
            }
        }
        if (isset($post['kasir'])) {
            $where['transaksi_user_id'] = $post['kasir'];
        }

        $data['data'] = (new transaksiModel())->selectDt('datatable', $where);

        echo json_encode($data);
    }

    public function loadAdminKasir()
    {

        $data = (new UserModel())->select([
            'filter' => ['user_role_id' => 'cf218a7fcacbc41404e024dba953c38b']
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
