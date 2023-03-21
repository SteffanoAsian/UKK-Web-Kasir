<!-- begin::datatable -->
<div class="table_data p-5" data-role="master_basecamp-Read" data-roleable="true">
    <div class="col-12">
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
                    <span class="card-icon">
                        <i class="fas fa-table text-primary"></i>
                    </span>
                    <h3 class="card-label">Data Menu</h3>
                </div>
                <div class="card-toolbar">
                    <div class="col-md-12">
                        <button class="btn btn-primary btn-sm mx-2" data-role="master_basecamp-Create" data-roleable="true" onclick="onAdd()"><i class="fa fa-plus"></i>Add</button>
                        <button onclick="onRefresh()" type="button" id="btn-filter" class="mx-2 btn btn-outline-primary btn-sm"><i class="fa fa-retweet"></i>Refresh</button>
                    </div>
                </div>
            </div>

            <div class="card-body table-responsive">
                <div class="table-responsive w-100">
                    <table class="table table-head-custom table-head-bg table-borderless table-vertical-center table-hover" id="table-menu">
                        <thead class='bg-secondary text-uppercase'>
                            <tr>
                                <th width="20px" class="text-center">No</th>
                                <th>Nama</th>
                                <th>Jenis</th>
                                <th>Harga</th>
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
<div id="modal-edit" class="modal fade" tabindex="-1" role="dialog" >
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
                    <button type="submit" class="btn btn-primary" id="btn-save" style="width: 100%;"><i class="fa fa-save"></i>Save</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- end::modal form -->
<?php echo view('../../modules/master_menu/Views/javascript') ?>