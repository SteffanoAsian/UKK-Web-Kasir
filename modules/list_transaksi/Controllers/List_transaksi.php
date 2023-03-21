<?php

namespace Modules\List_transaksi\Controllers;

use CodeIgniter\Modules\Modules;
use App\Libraries\Gen;
use Modules\List_transaksi\Models\List_transaksi as transaksiModel;
use Modules\Transaksi\Models\TransaksiDetail as Detail;
use Modules\Users\Models\Users as UserModel;
use Modules\Master_meja\Models\Master_meja as Meja;

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

    public function loadMeja()
    {
        $data = (new Meja())->select([
            'filter' => [
                'master_meja_available' => 1,
            ]
        ]);

        echo json_encode($data);
    }

    public function edit()
    {
        $data = $this->request->getPost();

        $operation = (new transaksiModel())->read($data['transaksi_id'], true, 'datatable');

        echo json_encode($operation);
    }

    public function update()
    {
        //ambil data post dari form
        $data = $this->request->getPost();
        //simpan data meja baru untuk parameter update
        $mejaBaru = $data['transaksi_meja_id'];
        //ambil data meja lama dari DB untuk mengganti status meja
        $dataLama = (new transaksiModel())->read($data['transaksi_id'], true, 'datatable');
        $mejaLama = $dataLama['transaksi_meja_id'];
        //update transaksi dengan ID meja Baru
        $operation = (new transaksiModel())->updateData($data['transaksi_id'], ['transaksi_meja_id' => $mejaBaru]);
        //update meja baru dengan status 0
        (new Meja())->updateData($mejaBaru, ['master_meja_available' => 0]);
        //update meja lama dengan status 1
        (new Meja())->updateData($mejaLama, ['master_meja_available' => 1]);

        echo json_encode($operation);
    }

    public function loadDetail()
    {
        $data = $this->request->getPost();

        $where = [
            'transaksi_detail_parent_id' => $data['transaksi_id']
        ];
        $data['data'] = (new Detail())->selectDt('datatable', $where);

        echo json_encode($data);
    }

    public function test()
    {
        echo "Hello lagi";
    }
}
