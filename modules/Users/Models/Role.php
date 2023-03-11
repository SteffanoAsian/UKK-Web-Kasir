<?php

namespace Modules\Users\Models;

class Role extends \App\Core\BaseModel
{
    public function __construct()
    {
        $model = array(
            'table' => array(
                'name' => 'roles',
                'primary' => 'role_id',
                'fields' => array(
                    array('name' => 'role_id'),
                    array('name' => 'role_nama'),
                    array('name' => 'role_status'),
                    array('name' => 'role_kode'),
                )
            ),'view' => array(
                'name' => 'roles',
                'mode' => array(
                    'datatable' => array(
                        'role_id',
                        'role_nama',
                        'role_status',
                        'role_kode',
                    )
                )
            )
        );
        parent::__construct($model);
    }
}
