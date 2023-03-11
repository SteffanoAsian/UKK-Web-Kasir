<?php

namespace Modules\Master_meja\Controllers;

use Modules\Master_meja\Models\Master_meja as meja;
use App\Libraries\Gen;
class Master_meja extends \CodeIgniter\Controller
{
    public function index()
    {
        $where = [];
        $data['data'] = (new meja())->selectDt('datatable', $where);
        echo json_encode($data);
    }
    public function edit()
    {
        $data = $this->request->getPost();

        $operation = (new meja())->read($data['master_meja_id']);

        echo json_encode($operation);
    }
    public function update()
    {
        $data = $this->request->getPost();

        $operation = (new meja())->updateData($data['master_meja_id'], $data);

        echo json_encode($operation);
    }
    public function destroy()
    {
        $data = $this->request->getPost();
        
        $operation = (new meja())->destroy($data['master_meja_id']);

        echo json_encode($operation);
    }
    public function store()
    {
        $data = $this->request->getPost();
        $id  = Gen::key();

        $operation = (new meja())->store($id, $data);

        echo json_encode($operation);
    }
}
