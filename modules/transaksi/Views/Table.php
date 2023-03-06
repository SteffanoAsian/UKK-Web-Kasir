<!-- begin::datatable -->
<div class="table_data p-5" data-role="master_basecamp-Read" data-roleable="true">
    <div class="col-12">
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
                    <span class="card-icon">
                        <i class="fa fa-cash-register text-primary"></i>
                    </span>
                    <span class="fs-1">Sales</span>
                </div>
                <!-- <div class="card-toolbar">
                    <div class="col-md-12">
                        <button class="btn btn-primary btn-sm mx-2" data-role="master_basecamp-Create" data-roleable="true" onclick="onAdd()"><i class="fa fa-plus"></i>Add</button>
                        <button onclick="onRefresh()" type="button" id="btn-filter" class="mx-2 btn btn-outline-primary btn-sm"><i class="fa fa-retweet"></i>Refresh</button>
                    </div>
                </div> -->
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <form action="javascript:addMenu('form-transaksi')" name="form-transaksi" id="form-transaksi" method="POST">
                            <div class="row mx-3 border border-2 rounded-1 p-3 my-5">
                                <div class="col-md-12 mt-5">
                                    <div class="form-group row">
                                        <div class="col-md-8">
                                            <label class="col-form-label" for="keranjang_menu_id">Pilih Item</label>
                                            <div class="col-lg-8">
                                                <input type="hidden" name="keranjang_id" id="keranjang_id">
                                                <input type="hidden" name="keranjang_harga" id="keranjang_harga">
                                                <select class="form-control form-control" name="keranjang_menu_id" onchange="showDetail(this)" id="keranjang_menu_id" required>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-10">
                                            <h6>Harga : <span id="showHarga"></span></h6>
                                            <h6>Jenis : <span id="showKategori"></span></h6>

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-8">
                                            <label class="col-form-label" for="keranjang_jml_beli">Jumlah Item</label>
                                            <div class="col-lg-8">
                                                <input type="number" name="keranjang_jml_beli" id="keranjang_jml_beli" class="form-control form-control-sm" placeholder="Input Jumlah" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row d-flex justify-content-center">
                                        <!-- <label for="showKembali">Uang Kembalian</label> -->
                                        <div class="col-lg-10">
                                            <button class="btn btn-success btn-sm my-5 btn-block" type="submit">Tambah</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-6">
                        <form action="javascript:prosesTransaksi('form-proses')" method="POST" id="form-proses" name="form-proses">
                            <div class="row mx-3 border border-2 rounded-1 p-3 my-5">
                                <div class="col-md-12 mt-5">
                                    <div class="form-group row">
                                        <label for="Total">Nama Pelanggan</label>
                                        <div class="col-lg-8">
                                            <input type="text" id="transaksi_pelanggan_nama" name="transaksi_pelanggan_nama" class="form-control form-control-sm" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="transaksi_meja_id">Nomor Meja</label> <br>
                                        <div class="col-lg-8">
                                            <select class="form-control form-control" name="transaksi_meja_id" id="transaksi_meja_id" required>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mx-3 border border-2 rounded-1 p-3 my-5">
                                <div class="col-md-12 mt-5">
                                    <div class="form-group row">
                                        <label for="Total">Total</label>
                                        <div class="col-lg-8">
                                            <input type="hidden" name="transaksi_total" id="transaksi_total" class="form-control" readonly>
                                            <input type="text" id="showTotal" class="form-control form-control-sm" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="Jumlah">Jumlah Pembayaran</label> <br>
                                        <div class="col-lg-8">
                                            <input type="number" required name="transaksi_nominal_bayar" id="transaksi_nominal_bayar" class="form-control form-control-sm" onkeyup="balek(this)" placeholder="Ketik Uang Pembayaran Disini...">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="showKembali">Uang Kembalian</label> <br>
                                        <div class="col-lg-8">
                                            <input type="text" id="showKembali" class="form-control form-control-sm" readonly>
                                            <input type="hidden" name="transaksi_nominal_kembali" id="transaksi_nominal_kembali" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row d-flex justify-content-center">
                                        <div class="col-lg-10 ">
                                            <button class="btn btn-success btn-sm btn-block my-5 " type="submit">Proses</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mx-3 border border-2 rounded-1 p-3">
                    <div class="table-responsive w-100">
                        <table class="table table-head-custom table-head-bg table-borderless table-vertical-center table-hover" id="table-temp">
                            <thead class='bg-secondary text-uppercase'>
                                <tr>
                                    <th width="20px" class="text-center">No</th>
                                    <th>Item</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end::datatable -->
<!-- begin::modal form -->

<!-- end::modal form -->
<?php echo view('../../modules/transaksi/Views/javascript') ?>