<?php

namespace Modules\Transaksi\Models;

class Keranjang extends \App\Core\BaseModel
{
    public function __construct()
    {
        $model = array(
            'table' => array(
                'name' => 'temp_keranjang',
                'primary' => 'keranjang_id',
                'fields' => array(
                    array('name' => 'keranjang_id', 'unique' => true),
                    array('name' => 'keranjang_jml_beli'),
                    array('name' => 'keranjang_user_id'),
                    array('name' => 'keranjang_menu_id'),
                )
            ),
            'view' => array(
                'name' => 'v_keranjang',
                'mode' => array(
                    'datatable' => array(
                        'keranjang_id',
                        'keranjang_menu_id',
                        'keranjang_jml_beli',
                        'keranjang_user_id',
                        'master_menu_nama',
                        'master_menu_harga',
                        'master_jenis_nama',
                        'master_jenis_code',
                    )
                )
            )
        );
        parent::__construct($model);
    }
}
