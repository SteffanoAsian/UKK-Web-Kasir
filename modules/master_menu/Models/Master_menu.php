<?php

namespace Modules\master_menu\Models;

class Master_menu extends \App\Core\BaseModel
{
    public function __construct()
    {
        $model = array(
            'table' => array(
                'name' => 'master_menu',
                'primary' => 'master_menu_id',
                'fields' => array(
                    array('name' => 'master_menu_id', 'unique' => true),
                    array('name' => 'master_menu_nama'),
                    array('name' => 'master_menu_jenis_id'),
                    array('name' => 'master_menu_gambar'),
                    array('name' => 'master_menu_harga'),
                    array('name' => 'master_menu_created_at'),
                    array('name' => 'master_menu_deleted_at'),
                    array('name' => 'master_menu_status'),
                )
            ),
            'view' => array(
                'name' => 'v_master_menu',
                'mode' => array(
                    'datatable' => array(
                        'master_menu_id',
                        'master_menu_nama',
                        'master_jenis_nama',
                        'master_menu_harga',
                        'master_menu_status',
                        'master_menu_deleted_at',
                    )
                )
            )
        );
        parent::__construct($model);
    }
}
