<?php

namespace Modules\Dashboard\Models;

class RekapSales extends \App\Core\BaseModel
{
    public function __construct()
    {
        $model = array(
            'table' => array(
                'name' => 'v_chart_rekap_sales',
                'primary' => 'transaksi_date',
                'fields' => array(
                    array('name' => 'transaksi_date', 'unique' => true),
                    array('name' => 'Total'),
                    array('name' => 'jumlah'),
                )
            ),
        );
        parent::__construct($model);
    }
    
}
