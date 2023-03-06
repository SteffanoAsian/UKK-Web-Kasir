<?php

namespace App\Core;

use APP\Libraries\Gen;
use CodeIgniter\Model;


class BaseModel extends Model
{
    protected $Db;
    protected $model;
    protected $primary;
    protected $table;
    protected $viewName;
    protected $viewMode;
    protected $db;
    protected $view;
    protected $fields;
    function __construct(&$model_config = null)
    {
        parent::__construct();
        $this->Db = \Config\Database::connect();
        $this->model = $model_config;
        $this->primary = $this->model['table']['primary'];
        $this->table = $this->model['table']['name'];
        $this->fields = $this->model['table']['fields'];
        $this->viewName = $this->model['view']['name'];
        $this->viewMode = $this->model['view']['mode'];
        $this->db = $this->Db->table($this->table);
        // $this->view = $this->Db->table($this->viewName);
    }

    public function store($id = null, $dataIns = null, $returnLog = true)
    {
        if ($id != null) {
            $dataIns[$this->primary] = $id;
        } else {
            $dataIns[$this->primary] = Gen::key();
        }

        $query =  $this->db->insert($dataIns);

        if ($returnLog) {
            $res = [
                'success' => $query ? true : false,
                'message' => $query ? 'Successfully Saved Data' : 'Failed to Save Data, Please Contact your System Administrator',
                'record' => $this->read($id, true, 'datatable'),
            ];
        } else {
            $res = [
                'success' => $query ? true : false,
                'message' => $query ? 'Successfully Save Data' : 'Failed to Save Data, Please Contact your System Administrator',
            ];
        }

        return $res;
    }

    public function read($id = null, $withView = false, $mode = '')
    {
        if (is_array($id)) {
            $where = $id;
        } else {
            $where = [$this->primary => $id];
        }

        $field = [];
        foreach ($this->fields as $Vfield) {
            $field[] .= $Vfield['name'];
        }
        $fields = implode(", ", $field);

        if ($withView == true) {
            $Viewfields = implode(", ", $this->viewMode[$mode]);
            $query = $this->Db->table($this->viewName)->select($Viewfields)->where($where)->get()->getRowArray();
        } else {
            $query = $this->db->select($fields)->where($where)->get()->getRowArray();
        }
        return $query;
    }

    public function select($Xdata, $withView = false, $mode = '')
    {
        $field = [];
        foreach ($this->fields as $Vfield) {
            $field[] .= $Vfield['name'];
        }
        $fields = implode(", ", $field);

        if ($withView == true) {
            $Viewfields = implode(", ", $this->viewMode[$mode]);
            if (!empty($Xdata['sort'])) {
                $query = $this->Db->table($this->viewName)->orderBy($Xdata['sort'])->select($Viewfields)->where($Xdata['filter'])->get()->getResultArray();
            } else {
                $query = $this->Db->table($this->viewName)->select($Viewfields)->where($Xdata['filter'])->get()->getResultArray();
            }
        } else {
            if (!empty($Xdata['sort'])) {
                $query = $this->db->orderBy($Xdata['sort'])->select($fields)->where($Xdata['filter'])->get()->getResultArray();
            } else {
                $query = $this->db->select($fields)->where($Xdata['filter'])->get()->getResultArray();
            }
        }

        $res = [
            'success' => $query ? true : false,
            'total' => count($query),
            'data' => $query,
        ];

        return $res;
    }

    public function selectDt($mode = null, $where)
    {
        $fields = implode(", ", $this->viewMode[$mode]);
        if (!empty($where)) {
            $query = $this->Db->table($this->viewName)->select($fields)->where($where)->get()->getResultArray();
        } else {
            $query = $this->Db->table($this->viewName)->select($fields)->get()->getResultArray();
        }
        $row = 1;
        $res = [];
        foreach ($query as $k => $v) {
            $query[$k]['row'] = $row;
            $row++;
        }
        return $query;
    }

    public function updateData($id = null, $data = null, $returnLog = true)
    {
        if (is_array($id)) {
            $where = $id;
        } else {
            $where = [$this->primary => $id];
        }
        $query = $this->db->update($data, $where);

        // if ($returnLog) {
        //     $res = [
        //         'success' => $query ? true : false,
        //         'message' => $query ? 'Successfully Updated Data' : 'Failed to Update Data, Please Contact your System Administrator',
        //         'record' => $this->read($id),
        //     ];
        // } else {
        $res = [
            'success' => $query ? true : false,
            'message' => $query ? 'Successfully Updated Data' : 'Failed to Update Data, Please Contact your System Administrator',
        ];
        if (!is_array($id) && $returnLog) {
            $res['record'] = $this->read($id);
        }
        // }

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
