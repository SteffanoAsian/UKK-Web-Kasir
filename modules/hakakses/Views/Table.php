<!-- begin::datatable -->
<div class="row table_data p-5">
	<div class="col-12 col-md-6 mt-4">
		<div class="card card-custom">
			<div class="card-header p-3">
				<div class="card-title">
					<span class="card-icon">
						<i class="fas fa-table text-primary"></i>
					</span>
					<h3 class="card-label">Hak Akses</h3>
				</div>
				<div class="card-toolbar">
					<div class="example-tools justify-content-center">
						<button class="btn btn-primary btn-sm mx-2" onclick="onAdd()"><i class="fas fa-file-medical"></i> Tambah Baru</button>
						<button class="btn btn-outline-primary btn-sm mx-2" onclick="onRefresh()"><i class="flaticon-refresh"></i>Refresh</button>
					</div>
				</div>
			</div>
			<div class="card-body p-2 table-responsive">
				<table class="table table-striped table-hover" id="table-hak-akses">
					<thead class='bg-secondary text-uppercase'>
						<tr>
							<th>No</th>
							<th>Kode</th>
							<th>Nama</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col mt-4">
		<div class="card card-custom">
			<div class="card-header p-3">
				<div class="card-title">
					<span class="card-icon">
						<i class="fas fa-clipboard-list text-primary"></i>
					</span>
					<h3 class="card-label">Menu Data</h3>
				</div>
				<div class="card-toolbar">
					<div class="example-tools justify-content-center">
						<button type="button" class="btn btn-primary btn-sm" id="btnSaveHA" onclick="onSave()"><i class="far fa-save"></i> Simpan</button>
						<!-- <button class="btn btn-warning btn-sm" onclick="onRefresh()"><i class="flaticon-refresh"></i> Muat Ulang</button> -->
					</div>
				</div>
			</div>
			<div class="card-body p-2">
				<input type="hidden" name="role_id" id="role_id">
				<div class="col-12 px-5 mb-5">
					<h3 class="hak_akses_nama"></h3>
				</div>
				<div class="col-12 mb-3">
					<input type="text" name="cari" placeholder="Search Menu" id="cari-menu" class="form-control" style="display: none;">
				</div>
				<div class="col-12" style="overflow-y: auto;max-height:350px" id="hak_akses_tree">

				</div>
			</div>
		</div>
	</div>
</div>
<!-- end::datatable -->
<!-- begin::modal form -->
<div id="modal-edit" class="modal fade" tabindex="-1" role="dialog" >
    <form action="javascript:save('form-role')" method="post" id="form-role" name="form-role" autocomplete="off" enctype="multipart/form-data">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Data Role</h5>
                    <button type="button" class="btn btn-outline-secondary btn-light btn-hover-danger font-weight-bold" onclick="onClose()"><i class="fa fa-times ml-1 d-flex jusutify-content-center"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mt-5">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label" for="role_kode"> Kode </label>
                                <div class="col-lg-8">
                                    <input id="role_id" type="hidden" name="role_id">
                                    <input id="role_kode" type="text" class="form-control form-control-sm" name="role_kode" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label" for="role_nama"> Nama </label>
                                <div class="col-lg-8">
                                <input id="role_nama" type="text" class="form-control form-control-sm" name="role_nama" required>
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
<?php echo view('../../modules/hakakses/Views/javascript') ?>