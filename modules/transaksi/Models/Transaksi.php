<?php

namespace Modules\Transaksi\Models;

class Transaksi extends \App\Core\BaseModel
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
                    array('name' => 'transaksi_nominal_bayar'),
                    array('name' => 'transaksi_nominal_kembali'),
                    array('name' => 'transaksi_meja_no'),
                    array('name' => 'transaksi_notes'),
                )
            ),
            'view' => array(
                'name' => 'v_transaksi',
                'mode' => array(
                    'datatable' => array(
                        'transaksi_id',
                        'transaksi_datetime',
                        'transaksi_user_id',
                        'transaksi_pelanggan_nama',
                        'transaksi_status',
                        'transaksi_total',
                        'transaksi_notes',
                        'user_name',
                        'user_username',
                        'role_kode',
                        'role_nama',
                        'transaksi_meja_id',
                        'master_meja_no',
                        'master_meja_location',
                        'master_meja_available',
                        'transaksi_nominal_bayar',
                        'transaksi_nominal_kembali',
                        'user_email,'
                    )
                )
            )
        );
        parent::__construct($model);
    }
}
