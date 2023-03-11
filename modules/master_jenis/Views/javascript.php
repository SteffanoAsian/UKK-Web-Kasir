<script type="text/javascript">
   $(() => {
        HELPER.fields = [
            'master_jenis_id',
        ];

        HELPER.api = {
            index: BASE_URL + 'master_jenis',
            edit: BASE_URL + 'master_jenis/edit',
            store: BASE_URL + 'master_jenis/store',
            update: BASE_URL + 'master_jenis/update',
            destroy: BASE_URL + 'master_jenis/destroy',
        };
        loadTable()
    })
    $(document).ready(function() {
        $("#modal-edit").on("hidden.bs.modal", function() {
            $("#form-jenis")[0].reset();
            $('#jenis_id').val('')
        });
    });
    loadTable = () => {
        HELPER.initTable({
            el: "table-jenis",
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
                        return full['master_jenis_code'];
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
                                                    <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-hover-primary" onclick="onEdit('` + full['master_jenis_id'] + `')"><i class="nav-icon fa fa-pen text-hover-primary mx-3"></i><span class="nav-text text-hover-primary">Edit</span></a></li>
                                                    <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-hover-danger" onclick="onDelete('` + full['master_jenis_id'] + `')"><i class="nav-icon fa fa-trash text-hover-danger mx-3"></i><span class="nav-text text-hover-danger">Delete</span></a></li>
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

    onEdit = (id) => {
        HELPER.block();
        $.ajax({
            url: HELPER.api.edit,
            method: 'POST',
            data: {
                master_jenis_id: id
            },
            success: function(response) {
                var response = $.parseJSON(response)
                HELPER.populateForm($('#form-jenis'), response);
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
                            master_jenis_id: id
                        },
                        success: function(response) {
                            var response = $.parseJSON(response);
                            HELPER.unblock(500);
                            HELPER.showMessage({
                                message: response.message, 
                                success: response.success,
                                title: response.success ? 'Success' : 'Failed',
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

    onClose = () => {
        $('#modal-edit').modal('hide')
    }
</script>