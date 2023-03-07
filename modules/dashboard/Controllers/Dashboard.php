<?php

namespace Modules\Dashboard\Controllers;

use Modules\Users\Models\Users as UsersModel;
use Modules\Transaksi\Models\Transaksi as Trans;
use Modules\Dashboard\Models\RekapSales as RekapSales;


class Dashboard extends \CodeIgniter\Controller
{
    public function index()
    {
        $data = $this->request->getPost();
        // print_r($data);exit;
        if (!empty($data['date'])) {
            // $where='filter';
            $aArrDate = explode('-', $data['date']);
            $startDate  = date('Y-m-d', strtotime($aArrDate[0]));
            $endDate    = date('Y-m-d', strtotime($aArrDate[1]));
            if ($startDate == $endDate) {
                $where['transaksi_date'] = $startDate;
            } else {
                $where['transaksi_date BETWEEN "' . $startDate . '" AND "' . $endDate . '"'] = null;
            }
            // print_r($where);
            // exit;
            $operation = (new RekapSales())->select([
                'filter' => $where
            ]);
            $res = $operation['data'];
        } else {
            // $where = 'kosongan';
            $db      = \Config\Database::connect();
            $res = $db->table('v_chart_rekap_sales')->select()->get()->getResultArray();
            //'(SELECT SUM(payments.amount) FROM payments WHERE payments.invoice_id=4) AS amount_paid'
        }


        echo json_encode($res);
    }

    public function test()
    {
        echo "Hello lagi";
    }
}
