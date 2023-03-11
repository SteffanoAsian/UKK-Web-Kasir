<!-- begin::datatable -->
<div class="table_data p-5" data-role="master_basecamp-Read" data-roleable="true">
    <div class="col-12">
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
                    <span class="card-icon">
                        <i class="fas fa-table text-primary"></i>
                    </span>
                    <h3 class="card-label">Data Transaksi</h3>
                </div>
                <div class="card-toolbar">
                    <div class="col-md-12">
                        <button onclick="onRefresh()" type="button" id="btn-filter" class="mx-2 btn btn-outline-primary btn-sm"><i class="fa fa-retweet"></i>Refresh</button>
                        <button onclick="$('.filterVendor').toggle(150)" type="button" id="btn-filter" class="mx-2 btn btn-primary btn-sm"><i class="fa fa-filter"></i>Filter</button>
                    </div>
                </div>
            </div>

            <div class="card-body table-responsive">
                <div class="row ml-6 filterVendor" style="display: none;">
                    <div class="col-md-3">
                        <label for="">Tanggal Transaksi</label>
                        <input class="form-control form-control-sm" id="filter_tanggal" readonly="readonly" placeholder="Select time" type="text">
                    </div>
                    <div class="col-md-3">
                        <label for="">Admin Kasir</label>
                        <select name="kasir" required id="kasir" class="form-control select2" required=""></select>
                    </div>
                    <div class="col-md-3 my-5">
                        <!-- <label for="" style="opacity:0">Vendor</label> -->
                        <button type="button" onclick='filterData()' class="btn btn-sm btn-success mx-2"><i class="fa fa-filter"></i>Filter</button>
                    </div>
                </div>
                <div class="table-responsive w-100">
                    <table class="table table-head-custom table-head-bg table-borderless table-vertical-center table-hover" id="table-transaksi">
                        <thead class='bg-secondary text-uppercase'>
                            <tr>
                                <th width="20px" class="text-center">No</th>
                                <th>Nama Pelanggan</th>
                                <th>Waktu</th>
                                <th>Total</th>
                                <th>Admin Kasir</th>
                                <th>Actions</th>
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
<!-- end::datatable -->
<!-- begin::modal form -->
<div id="modal-edit" class="modal fade" tabindex="-1" role="dialog">
    <form action="javascript:save('form-menu')" method="post" id="form-menu" name="form-menu" autocomplete="off" enctype="multipart/form-data">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Data Menu</h5>
                    <button type="button" class="btn btn-outline-secondary btn-light btn-hover-danger font-weight-bold" onclick="onClose()"><i class="fa fa-times ml-1 d-flex jusutify-content-center"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mt-5">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label" for="master_menu_nama"> Nama </label>
                                <div class="col-lg-8">
                                    <input id="master_menu_id" type="hidden" name="master_menu_id">
                                    <input id="master_menu_nama" type="text" class="form-control form-control-sm" name="master_menu_nama" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label" for="master_menu_jenis_id"> Jenis </label>
                                <div class="col-lg-8">
                                    <select class="form-control select2" name="master_menu_jenis_id" id="master_menu_jenis_id" required>
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row fv-plugins-icon-container has-danger">
                                <label class="col-3 col-form-label" for="master_menu_harga">Harga</label>
                                <div class="col-lg-8">
                                    <input id="master_menu_harga" type="number" class="form-control form-control-sm" name="master_menu_harga" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="btn-save" style="width: 100%;"><i class="fa fa-save"></i>Save</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- end::modal form -->
<?php echo view('../../modules/list_transaksi/Views/javascript') ?>