<?php

namespace Modules\Users\Models;

class UserRole extends \App\Core\BaseModel
{
    public function __construct()
    {
        $model = array(
            'table' => array(
                'name' => 'v_user_role',
                'primary' => 'user_role_id',
                'fields' => array(
                    array('name' => 'user_role_id'),
                    array('name' => 'user_role_role_id'),
                    array('name' => 'user_role_menu_id'),
                    array('name' => 'menu_code'),
                )
            ),
        );
        parent::__construct($model);
    }

    public function getRoleAccess($roleId)
    {
        $where =[
            'user_role_role_id'=>$roleId
        ];
        $rules = [];

        $menus = $this->db->select('menu_code')->where($where)->get()->getResultArray();
        foreach($menus as $key => $val){
            foreach($val as $kVal => $Vval){
                array_push($rules, $Vval);
            }
        }
        return $rules;
    }
}
