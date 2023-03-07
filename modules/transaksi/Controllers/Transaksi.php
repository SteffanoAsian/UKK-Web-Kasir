<?php

namespace Modules\Transaksi\Controllers;

use CodeIgniter\Modules\Modules;
use App\Libraries\Gen;
use Modules\Master_menu\Models\Master_menu as menuModel;
use Modules\Transaksi\Models\Keranjang as Keranjang;
use Modules\Transaksi\Models\Transaksi as TransaksiModel;
use Modules\Transaksi\Models\TransaksiDetail as Detail;
use Modules\Master_meja\Models\Master_meja as Meja;

class Transaksi extends \CodeIgniter\Controller
{
    public function index()
    {
        $where = ['keranjang_user_id' => session()->get('user_id')];
        $data['data'] = (new Keranjang())->selectDt('datatable', $where);
        echo json_encode($data);
    }

    public function loadMenu()
    {
        $data = (new menuModel())->select([
            'filter' => [
                'master_menu_status' => 1,
                'master_menu_deleted_at' => null,
            ]
        ], true, 'datatable');

        echo json_encode($data);
    }

    public function loadMeja()
    {
        $data = (new Meja())->select([
            'filter' => [
                'master_meja_available' => 1,
            ]
        ]);

        echo json_encode($data);
    }

    public function addMenu()
    {
        $data = $this->request->getPost();
        $id = Gen::key();

        $cekItem = (new Keranjang())->read(
            [
                'keranjang_menu_id' => $data['keranjang_menu_id'],
                'keranjang_user_id' => session()->get('user_id'),
            ],
            true,
            'datatable'
        );

        if (!$cekItem) {
            $dataIns = array(
                "keranjang_menu_id" => $data['keranjang_menu_id'],
                "keranjang_jml_beli" => $data['keranjang_jml_beli'],
                "keranjang_user_id" => session()->get('user_id'),
            );
            $operation = (new Keranjang())->store($id, $dataIns);
        } else {
            if (!empty($data['keranjang_id'])) {
                $dataupKeranjang = array(
                    "keranjang_jml_beli" => $data['keranjang_jml_beli']
                );
            } else {
                $dataupKeranjang = array(
                    "keranjang_jml_beli" => (float)$cekItem['keranjang_jml_beli']  + $data['keranjang_jml_beli']
                );
            }

            $operation = (new Keranjang())->updateData(
                [
                    'keranjang_menu_id' => $data['keranjang_menu_id'],
                    "keranjang_user_id" => session()->get('user_id'),
                ],
                $dataupKeranjang
            );
        }

        echo json_encode($operation);
    }

    public function countTotalPrice()
    {
        $db      = \Config\Database::connect();
        $countTotal = $db->table('v_keranjang')->select('(SELECT SUM((master_menu_harga * keranjang_jml_beli)) FROM v_keranjang WHERE keranjang_user_id="' . session()->get('user_id') . '") AS total')->get()->getRowArray();
        //'(SELECT SUM(payments.amount) FROM payments WHERE payments.invoice_id=4) AS amount_paid'
        echo json_encode($countTotal);
    }

    public function edit()
    {
        $data = $this->request->getPost();

        $operation = (new Keranjang())->read($data['keranjang_id']);

        echo json_encode($operation);
    }

    public function prosesTransaksi()
    {
        $data = $this->request->getPost();

        $data["transaksi_user_id"] = session()->get('user_id');
        $data["transaksi_datetime"] = date('Y-m-d H:i:s');
        $data["transaksi_date"] = date('Y-m-d');
        $data["transaksi_status"] = 1;

        $parent_id = Gen::key();

        //masukkan data POST Transaksi kedalam tabel transaksi
        $transaksiParent = (new TransaksiModel())->store($parent_id, $data);

        //masukkan data dari tabel temporary keranjang ke dalam detail transaksi
        $keranjang = (new Keranjang())->select([
            'filter' => [
                'keranjang_user_id' => session()->get('user_id'),
            ]
        ], true, 'datatable');
        foreach ($keranjang['data'] as $vKeranjang) {
            $dataupDetail = [
                "transaksi_detail_parent_id" => $parent_id,
                "transaksi_detail_menu_id" => $vKeranjang['keranjang_menu_id'],
                "transaksi_detail_jml_beli" => $vKeranjang['keranjang_jml_beli'],
                "transaksi_detail_total" => $vKeranjang['keranjang_jml_beli'] * $vKeranjang['master_menu_harga'],
                "transaksi_detail_user_id" => session()->get('user_id'),
            ];
            (new Detail())->store(Gen::key(), $dataupDetail);
        }

        //hapus data yg ada di tabel temporary keranjang
        (new Keranjang())->destroy(['keranjang_user_id' => session()->get('user_id')]);

        //update data meja (tidak available karena telah dipesan)
        (new Meja())->updateData(
            [
                'master_meja_id' => $data['transaksi_meja_id'],
            ],
            [
                'master_meja_available' => 0,
            ]
        );

        echo json_encode($transaksiParent);
    }

    public function destroy()
    {
        $data = $this->request->getPost();
        $datains = [
            'master_menu_deleted_at' => date('Y-m-d H:i:s'),
            'master_menu_status' => 0
        ];
        $operation = (new menuModel())->updateData($data['master_menu_id'], $datains);

        echo json_encode($operation);
    }

    public function test()
    {
        echo "Hello lagi";
    }
}
