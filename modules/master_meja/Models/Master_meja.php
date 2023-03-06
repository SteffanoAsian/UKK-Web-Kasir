<?php

namespace Modules\Master_meja\Models;

class Master_meja extends \App\Core\BaseModel
{
    public function __construct()
    {
        $model = array(
            'table' => array(
                'name' => 'master_meja',
                'primary' => 'master_meja_id',
                'fields' => array(
                    array('name' => 'master_meja_id', 'unique' => true),
                    array('name' => 'master_meja_no'),
                    array('name' => 'master_meja_location'),
                    array('name' => 'master_meja_available'),
                )
            ),
            'view' => array(
                'name' => 'master_meja',
                'mode' => array(
                    'datatable' => array(
                        'master_meja_id',
                        'master_meja_no',
                        'master_meja_location',
                        'master_meja_available',
                    )
                )
            )
        );
        parent::__construct($model);
    }
}
