<script type="text/javascript">
    $(() => {
        HELPER.fields = [
            'user_id',
        ];

        HELPER.api = {
            index: BASE_URL + 'Users',
            edit: BASE_URL + 'Users/edit',
            store: BASE_URL + 'Users/store',
            update: BASE_URL + 'Users/update',
            destroy: BASE_URL + 'Users/destroy',
            loadRole: BASE_URL + 'Users/loadRole',
        };

        loadTable()
        loadComboRole()
    })
    $(document).ready(function() {
        $("#modal-edit").on("hidden.bs.modal", function() {
            $("#form-menu")[0].reset();
            $('#user_id').val('')
        });
    });

    loadTable = () => {
        HELPER.initTable({
            el: "table-user",
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
                        return full['user_name'];
                    },
                },
                {
                    targets: 2,
                    orderable: true,
                    render: function(data, type, full, meta) {
                        return full['user_username'];
                    },
                },
                {
                    targets: 3,
                    orderable: true,
                    render: function(data, type, full, meta) {
                        return (full['user_email']);
                    },
                },
                {
                    targets: 4,
                    orderable: true,
                    render: function(data, type, full, meta) {
                        return (full['role_nama']);
                    },
                },
                {
                    targets: 5,
                    orderable: true,
                    render: function(data, type, full, meta) {
                        return (full['user_status']);
                    },
                },
                {
                    targets: 6,
                    orderable: false,
                    render: function(data, type, full, meta) {
                        var status = ''
                        var act = ''
                        var dropdown = ''

                        if (full['user_status'] == 1) {
                            status = 'Nonaktifkan'
                            act = 'no'
                        } else {
                            status = 'Aktifkan'
                            act = 'yes'
                        }

                        dropdown += `<div class="dropdown">
											<a href="javascript:void(0);" class="btn btn-sm btn-info btn-circle btn-icon dropdown-toggle" data-bs-toggle="dropdown">
													<i class="fa fa-cog"></i>
											</a>
											<div class="dropdown-menu dropdown menu-sm dropdown-menu-right">
												<ul class="nav nav-hoverable flex-column">
                                                    <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-hover-primary" onclick="onEdit('` + full['user_id'] + `')"><i class="nav-icon fa fa-pen text-hover-primary mx-3"></i><span class="nav-text text-hover-primary">Edit</span></a></li>
                                                    <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-hover-primary" onclick="onStatus('` + full['user_id'] + `',${act})"><i class="nav-icon fa fa-eye text-hover-primary mx-3"></i><span class="nav-text text-hover-primary">${status}</span></a></li>
                                                    <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-hover-danger" onclick="onDelete('` + full['user_id'] + `')"><i class="nav-icon fa fa-trash text-hover-danger mx-3"></i><span class="nav-text text-hover-danger">Delete</span></a></li>
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
                user_id: id
            },
            success: function(response) {
                var response = $.parseJSON(response)
                HELPER.populateForm($('#form-user'), response);
                $('#user_password').val('')
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

    loadComboRole = () => {
        HELPER.genCombo({
            el: 'user_role_id',
            valueField: 'role_id',
            displayField: 'role_nama',
            displayField2: 'role_kode',
            grouped: true,
            url: HELPER.api.loadRole,
            placeholder: '-Pilih Role-',
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
                            user_id: id
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
</script>