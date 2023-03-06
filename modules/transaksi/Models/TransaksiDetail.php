<?php

namespace Modules\Transaksi\Models;

class TransaksiDetail extends \App\Core\BaseModel
{
    public function __construct()
    {
        $model = array(
            'table' => array(
                'name' => 'transaksi_detail',
                'primary' => 'transaksi_detail_id',
                'fields' => array(
                    array('name' => 'transaksi_detail_id', 'unique' => true),
                    array('name' => 'transaksi_detail_jml_beli'),
                    array('name' => 'transaksi_detail_user_id'),
                    array('name' => 'transaksi_detail_total'),
                    array('name' => 'transaksi_detail_parent_id'),
                )
            ),
            'view' => array(
                'name' => 'v_transaksi_detail',
                'mode' => array(
                    'datatable' => array(
                        'transaksi_detail_id',
                        'transaksi_detail_jml_beli',
                        'transaksi_detail_total',
                        'transaksi_detail_parent_id',
                        'transaksi_detail_user_id',
                        'transaksi_detail_menu_id',
                        'master_menu_nama',
                        'master_menu_deskripsi',
                        'master_menu_gambar',
                        'master_menu_harga',
                        'master_jenis_nama',
                        'user_name',
                        'role_nama',
                    )
                )
            )
        );
        parent::__construct($model);
    }
}
