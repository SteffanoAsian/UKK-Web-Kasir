<?php

namespace Modules\Hakakses\Models;

class Roles extends \App\Core\BaseModel
{
    public function __construct()
    {
        $model = array(
            'table' => array(
                'name' => 'roles',
                'primary' => 'role_id',
                'fields' => array(
                    array('name' => 'role_id', 'unique' => true),
                    array('name' => 'role_kode'),
                    array('name' => 'role_nama'),
                    array('name' => 'role_status'),
                )
            ),
            'view' => array(
                'name' => 'roles',
                'mode' => array(
                    'datatable' => array(
                        'role_id',
                        'role_kode',
                        'role_nama',
                        'role_status'
                    )
                )
            )
        );
        parent::__construct($model);
    }
}
