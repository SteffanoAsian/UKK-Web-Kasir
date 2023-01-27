<?php

namespace App\Core;

use CodeIgniter\Model;


class BaseModel extends Model
{
    protected $Db;
    protected $model;
    protected $primary;
    protected $table;
    protected $db;
    function __construct(&$model_config = null)
    {
        parent::__construct();
        $this->Db = \Config\Database::connect();
        $this->model = $model_config;
        $this->primary = $this->model['table']['primary'];
        $this->table = $this->model['table']['name'];
        $this->db = $this->Db->table($this->table);
    }

    public function store($id = null, $dataIns = null, $returnLog = true)
    {
        if ($id != null) {
            $dataIns[$this->primary] = $id;
        }

        $query =  $this->db->insert($dataIns);
        if ($returnLog) {
            $res = [
                'success' => $query ? true : false,
                'message' => $query ? 'Successfully Saved Data' : 'Failed to Save Data, Please Contact your System Administrator',
                'record' => $this->read($id),
            ];
        } else {
            $res = [
                'success' => $query ? true : false,
                'message' => $query ? 'Successfully Save Data' : 'Failed to Save Data, Please Contact your System Administrator',
            ];
        }

        return $res;
    }

    public function read($id = null)
    {
        if (is_array($id)) {
            $where = $id;
        } else {
            $where = [$this->primary => $id];
        }

        $query = $this->db->select()
            ->where($where)
            ->get()->getRowArray();

        return $query;
    }

    public function select($where = null)
    {
        $query = $this->db->select()->where($where)->get()->getResultArray();

        $res = [
            'success' => $query ? true : false,
            'total' => count($query),
            'data' => $query,
        ];

        return $res;
    }

    public function updateData($id = null, $data = null, $returnLog = true)
    {
        if (is_array($id)) {
            $where = $id;
        } else {
            $where = [$this->primary => $id];
        }
        $query = $this->db->update($data, $where);
        if ($returnLog) {
            $res = [
                'success' => $query ? true : false,
                'message' => $query ? 'Successfully Updated Data' : 'Failed to Update Data, Please Contact your System Administrator',
                'record' => $this->read($id),
            ];
        } else {
            $res = [
                'success' => $query ? true : false,
                'message' => $query ? 'Successfully Updated Data' : 'Failed to Update Data, Please Contact your System Administrator',
            ];
        }

        return $res;
    }

    public function destroy($id = null)
    {
        if (is_array($id)) {
            $where = $id;
        } else {
            $where = [$this->primary => $id];
        }
        $findFirst = $this->read($id);
        if ($findFirst) {
            $query = $this->db->delete($where);

            $res = [
                'success' => $query ? true : false,
                'message' => $query ? 'Successfully Deleted Data' : 'Failed to Delete Data, Please Contact your System Administrator',
            ];
        } else {
            $res = [
                'success' => false,
                'message' => 'Unable to Delete Data, Data Not Found',
            ];
        }
        return $res;
    }
}
