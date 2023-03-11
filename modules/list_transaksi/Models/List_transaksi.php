<?php

namespace Modules\List_transaksi\Models;

class List_transaksi extends \App\Core\BaseModel
{
    public function __construct()
    {
        $model = array(
            'table' => array(
                'name' => 'transaksi',
                'primary' => 'transaksi_id',
                'fields' => array(
                    array('name' => 'transaksi_id', 'unique' => true),
                    array('name' => 'transaksi_datetime'),
                    array('name' => 'transaksi_user_id'),
                    array('name' => 'transaksi_pelanggan_nama'),
                    array('name' => 'transaksi_status'),
                    array('name' => 'transaksi_total'),
                )
            ),
            'view' => array(
                'name' => 'v_transaksi',
                'mode' => array(
                    'datatable' => array(
                        'transaksi_id',
                        'transaksi_datetime',
                        'transaksi_date',
                        'transaksi_user_id',
                        'transaksi_pelanggan_nama',
                        'transaksi_status',
                        'transaksi_total',
                        'user_name',
                        'master_meja_no',
                        'master_meja_location',
                        'transaksi_nominal_bayar',
                        'transaksi_nominal_kembali',
                    )
                )
            )

        );
        parent::__construct($model);
    }
}
