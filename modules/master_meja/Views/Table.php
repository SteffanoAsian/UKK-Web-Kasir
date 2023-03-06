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
                        <button class="btn btn-success btn-sm mx-2" data-role="master_basecamp-Create" data-roleable="true" onclick="onAdd()"><i class="fa fa-plus"></i>Add</button>
                        <button onclick="refresh()" type="button" id="btn-filter" class="mx-2 btn btn-outline-success btn-sm"><i class="flaticon-refresh"></i>Refresh</button>
                    </div>
                </div>
            </div>

            <div class="card-body table-responsive">
                <div class="table-responsive w-100">
                    <table class="table table-head-custom table-head-bg table-borderless table-vertical-center table-hover" id="table-menu">
                        <thead class='bg-secondary text-uppercase'>
                            <tr>
                                <th width="20px" class="text-center" >No</th>
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
<?php echo view('../../modules/master_menu/Views/javascript') ?>