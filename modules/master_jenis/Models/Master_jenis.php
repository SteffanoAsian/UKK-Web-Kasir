<?php

namespace Modules\Master_jenis\Models;

class Master_jenis extends \App\Core\BaseModel
{
    public function __construct()
    {
        $model = array(
            'table' => array(
                'name' => 'master_jenis',
                'primary' => 'master_jenis_id',
                'fields' => array(
                    array('name' => 'master_jenis_id', 'unique' => true),
                    array('name' => 'master_jenis_nama'),
                    array('name' => 'master_jenis_code'),
                    array('name' => 'master_jenis_status'),
                )
            ),
            'view' => array(
                'name' => 'master_jenis',
                'mode' => array(
                    'datatable' => array(
                        'master_jenis_id',
                        'master_jenis_nama',
                        'master_jenis_code',
                        'master_jenis_status'
                    )
                )
            )
        );
        parent::__construct($model);
    }
}
