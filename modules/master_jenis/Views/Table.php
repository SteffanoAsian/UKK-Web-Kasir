<div class="table_data p-5" data-role="master_basecamp-Read" data-roleable="true">
    <div class="col-12">
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
                    <span class="card-icon">
                        <i class="fas fa-table text-primary"></i>
                    </span>
                    <h3 class="card-label">Data Jenis Menu</h3>
                </div>
                <div class="card-toolbar">
                    <div class="col-md-12">
                        <button class="btn btn-success btn-sm mx-2" data-role="master_basecamp-Create" data-roleable="true" onclick="onAdd()"><i class="fa fa-plus"></i>Add</button>
                        <button onclick="refresh()" type="button" id="btn-filter" class="mx-2 btn btn-outline-success btn-sm"><i class="flaticon-refresh"></i>Refresh</button>
                    </div>
                </div>
            </div>

            <div class="card-body table-responsive">
                <div class="table-responsive w-100">
                    <table class="table table-head-custom table-head-bg table-borderless table-vertical-center table-hover" id="table-jenis">
                        <thead class='bg-secondary text-uppercase'>
                            <tr>
                                <th width="20px" class="text-center">No</th>
                                <th>Code</th>
                                <th>Nama</th>
                                
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
<div id="modal-edit" class="modal fade" tabindex="-1" role="dialog">
    <form action="javascript:save('form-jenis')" method="post" id="form-jenis" name="form-jenis" autocomplete="off" enctype="multipart/form-data">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Data Jenis Menu</h5>
                    <button type="button" class="btn btn-outline-secondary btn-light btn-hover-danger font-weight-bold" onclick="onClose()"><i class="fa fa-times ml-1 d-flex jusutify-content-center"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mt-5">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label" for="master_jenis_code"> Code </label>
                                <div class="col-lg-8">
                                    <input id="master_jenis_id" type="hidden" name="master_jenis_id">
                                    <input id="master_jenis_code" type="text" class="form-control form-control-sm" name="master_jenis_code" required>
                                </div>
                            </div>
                            <!-- <div class="modal-body"> -->
                            <!-- <div class="row"> -->
                            <!-- <div class="col-md-12 mt-5"> -->
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label" for="master_jenis_nama"> Nama </label>
                                <div class="col-lg-8">
                                    <input id="master_jenis_id" type="hidden" name="master_jenis_id">
                                    <input id="master_jenis_nama" type="text" class="form-control form-control-sm" name="master_jenis_nama" required>
                                </div>
                            </div>
                            <!-- <div class="form-group row fv-plugins-icon-container has-danger">
                                <label class="col-3 col-form-label" for="master_jenis_status">Status</label>
                                <div class="col-lg-8">
                                    <div class="col-form-label">
                                        <div class="radio-inline">
                                            <label class="radio">
                                                <input type="radio" name="master_jenis_status" id="master_jenis_status" value="1" required />
                                                <span></span>Aktif
                                            </label>
                                            <label class="radio">
                                                <input type="radio" name="master_jenis_status" id="master_jenis_status" value="0" required />
                                                <span></span>Tidak Aktif
                                        </div>
                                    </div>
                                </div>
                            </div> -->
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
<?php echo view('../../modules/master_jenis/Views/javascript') ?>