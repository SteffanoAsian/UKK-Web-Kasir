<script type="text/javascript">
    $(() => {
        HELPER.fields = [
            'master_menu_id',
        ];

        HELPER.api = {
            index: BASE_URL + 'master_menu',
            edit: BASE_URL + 'master_menu/edit',
            store: BASE_URL + 'master_menu/store',
            update: BASE_URL + 'master_menu/update',
            destroy: BASE_URL + 'master_menu/destroy',
            loadJenisMenu: BASE_URL + 'master_menu/loadJenis',
        };

        loadTable()
        loadComboJenis()
    })
    $(document).ready(function() {
        $("#modal-edit").on("hidden.bs.modal", function() {
            $("#form-menu")[0].reset();
            $('#menu_id').val('')
            $('#master_menu_jenis_id').val('').trigger('change');
        });
    });

    loadTable = () => {
        HELPER.initTable({
            el: "table-menu",
            url: HELPER.api.index,
            searchAble: true,
            destroyAble: true,
            responsive: true,
            autoWidth: true,
            index: 1,
            sorting: 'asc',
            columnDefs: [{
                    targets: 1,
                    orderable: true,
                    render: function(data, type, full, meta) {
                        return full['master_menu_nama'];
                    },
                },
                {
                    targets: 2,
                    orderable: true,
                    render: function(data, type, full, meta) {
                        return full['master_jenis_nama'];
                    },
                },
                {
                    targets: 3,
                    orderable: true,
                    render: function(data, type, full, meta) {
                        let number = new Intl.NumberFormat('en-ID', {
                            style: 'currency',
                            currency: 'IDR',
                        });
                        return number.format(full['master_menu_harga']);
                    },
                },
                {
                    targets: 4,
                    orderable: false,
                    render: function(data, type, full, meta) {
                        var button = ''
                        var dropdown = ''

                        dropdown += `<div class="dropdown">
											<a href="javascript:void(0);" class="btn btn-sm btn-info btn-circle btn-icon dropdown-toggle" data-bs-toggle="dropdown">
													<i class="fa fa-cog"></i>
											</a>
											<div class="dropdown-menu dropdown menu-sm dropdown-menu-right">
												<ul class="nav nav-hoverable flex-column">
                                                    <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-hover-primary" onclick="onEdit('` + full['master_menu_id'] + `')"><i class="nav-icon fa fa-pen text-hover-primary mx-3"></i><span class="nav-text text-hover-primary">Edit</span></a></li>
                                                    <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-hover-danger" onclick="onDelete('` + full['master_menu_id'] + `')"><i class="nav-icon fa fa-trash text-hover-danger mx-3"></i><span class="nav-text text-hover-danger">Delete</span></a></li>
												</ul>
											</div>
										</div>`
                        return dropdown
                    },
                },
            ],
        });
    }

    onAdd = () => {
        $('#modal-edit').modal('show')
    }

    onEdit = (id) => {
        HELPER.block();
        $.ajax({
            url: HELPER.api.edit,
            method: 'POST',
            data: {
                master_menu_id: id
            },
            success: function(response) {
                var response = $.parseJSON(response)
                HELPER.populateForm($('#form-menu'), response);
            },
            complete: function(response) {
                setTimeout(function() {
                    onAdd()
                }, 200);
                HELPER.unblock(500);
            },
            error: (xhr, status, error) => {
                HELPER.unblock()
                HELPER.showMessage({
                    message: 'Kesalahan tidak diketahui. Hubungi Administrator Anda !!',
                })
            },
        });
    }

    onClose = () => {
        $('#modal-edit').modal('hide')
    }

    loadComboJenis = () => {
        HELPER.genCombo({
            el: 'master_menu_jenis_id',
            valueField: 'master_jenis_id',
            displayField: 'master_jenis_nama',
            displayField2: 'master_jenis_code',
            grouped: true,
            url: HELPER.api.loadJenisMenu,
            placeholder: '-Pilih Jenis Menu-',
        })
    }

    save = (name) => {
        var formData = new FormData($('[name="' + name + '"]')[0]);
        HELPER.save({
            cache: false,
            data: formData,
            form: name,
            confirm: true,
            callback: function(success, record, message) {
                if (success) {
                    HELPER.showMessage({
                        success: true,
                        title: 'Success',
                        message: 'Successfully saved data',
                        callback: function() {
                            loadTable()
                            $('#modal-edit').modal('hide')
                        }
                    });
                } else {
                    HELPER.showMessage({
                        success: false
                    })
                }
                HELPER.unblock(100);
            },
            oncancel: function(result) {
                HELPER.unblock(100);
            }
        });
    }

    onRefresh = () => {
        loadTable()
    }

    onDelete = (id) => {
        HELPER.confirm({
            message: 'Are you sure to delete this data ?',
            callback: function(r) {
                if (r) {
                    HELPER.block();
                    $.ajax({
                        url: HELPER.api.destroy,
                        method: 'POST',
                        data: {
                            master_menu_id: id
                        },
                        success: function(response) {
                            var response = $.parseJSON(response);
                            HELPER.unblock(500);
                            HELPER.showMessage({
                                message: response.message,
                                success: response.success,
                                title: response.success ? 'Successfully delete data' : 'Failed to delete data',
                                callback: function() {
                                    loadTable()
                                }
                            })
                        },
                        error: (xhr, status, error) => {
                            HELPER.unblock()
                            HELPER.showMessage({
                                message: 'Kesalahan tidak diketahui. Hubungi Administrator Anda !!',
                            })
                        },
                    })
                }
            }
        })

    }
</script>