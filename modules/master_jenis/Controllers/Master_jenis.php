<?php

namespace Modules\Master_jenis\Controllers;

use Modules\Master_jenis\Models\Master_jenis as jenis;
use Modules\Master_menu\Models\Master_menu as menu;
use App\Libraries\Gen;

class Master_jenis extends \CodeIgniter\Controller
{
    public function index()
    {
        $where = ['master_jenis_status' => 1];
        $data['data'] = (new jenis())->selectDt('datatable', $where);
        echo json_encode($data);
    }
    public function edit()
    {
        $data = $this->request->getPost();

        $operation = (new jenis())->read($data['master_jenis_id']);

        echo json_encode($operation);
    }
    public function update()
    {
        $data = $this->request->getPost();

        $operation = (new jenis())->updateData($data['master_jenis_id'], $data);

        echo json_encode($operation);
    }
    public function destroy()
    {
        $data = $this->request->getPost();
        $cekData = (new menu())->read([
            'master_menu_jenis_id' => $data['master_jenis_id'], 'master_menu_status' => 0,
        ]);

        if (empty($cekData)) {
            $datains = [
                'master_jenis_status' => 0
            ];
            $response = (new jenis())->updateData($data['master_jenis_id'], $datains);
            $response['message'] = $response['success'] ? 'Successfully Deleted Data' : 'Failed to Delete Data, Please Contact your System Administrator';
        } else {
            $response = [
                'success' => false,
                'message' => 'tidak dapat menghapus data, karena data ini masih terhubung dengan menu yang aktif'
            ];
        }
        echo json_encode($response);
    }
    public function store()
    {
        $data = $this->request->getPost();
        $id  = Gen::key();
        $data['master_jenis_status'] = 1;
        $operation = (new jenis())->store($id, $data);

        echo json_encode($operation);
    }
}
