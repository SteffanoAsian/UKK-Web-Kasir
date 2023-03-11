<script type="text/javascript">
    $(() => {
        HELPER.fields = [
            'role_id',
        ];

        HELPER.api = {
            index: BASE_URL + 'hakakses',
            edit: BASE_URL + 'hakakses/edit',
            store: BASE_URL + 'hakakses/store',
            update: BASE_URL + 'hakakses/update',
            destroy: BASE_URL + 'hakakses/destroy',
            loadJenisMenu: BASE_URL + 'hakakses/loadJenis',
        };

        loadTable()
        // loadComboJenis()
    })
    $(document).ready(function() {
        $("#modal-edit").on("hidden.bs.modal", function() {
            $("#form-role")[0].reset();
            $('#role_id').val('')
        });
    });



    loadTable = () => {
        HELPER.initTable({
            el: "table-hak-akses",
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
                        return full['role_kode'];
                    },
                },
                {
                    targets: 2,
                    orderable: true,
                    render: function(data, type, full, meta) {
                        return full['role_nama'];
                    },
                },
                {
                    targets: 3,
                    orderable: false,
                    render: function(data, type, full, meta) {
                        var button = ''
                        var dropdown = ''

                        dropdown += `<button type="button" class="btn btn-sm btn-primary btn-circle btn-icon" data-id="` + full['role_id'] + `" data-nama="` + full['role_nama'] + `" onclick="onTampil(this)"><i class="fas fa-arrow-right"></i></button>
                        <div class="dropdown">
											<a href="javascript:void(0);" class="btn btn-sm btn-info btn-circle btn-icon dropdown-toggle" data-bs-toggle="dropdown">
													<i class="fa fa-cog"></i>
											</a>
											<div class="dropdown-menu dropdown menu-sm dropdown-menu-right">
												<ul class="nav nav-hoverable flex-column">
                                                    <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-hover-primary" onclick="onEdit('` + full['role_id'] + `')"><i class="nav-icon fa fa-pen text-hover-primary mx-3"></i><span class="nav-text text-hover-primary">Edit</span></a></li>
                                                    <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-hover-danger" onclick="onDelete('` + full['role_id'] + `')"><i class="nav-icon fa fa-trash text-hover-danger mx-3"></i><span class="nav-text text-hover-danger">Delete</span></a></li>
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
                role_id: id
            },
            success: function(response) {
                var response = $.parseJSON(response)
                HELPER.populateForm($('#form-role'), response);
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

    function onTampil(el) {
        var data = $(el).data();
        console.log(data);
method: 'POST',
        $.ajax({
            type: "POST",
            url: BASE_URL + 'hakakses/getRoleMenu',
            data: {
                id: data.id
            },
            method: 'POST',
            success: function(response) {
                $('#cari-menu').show()
                $('#role_id').val(data.id);
                $('.hak_akses_nama').html(data.nama);
                $('#hak_akses_tree').jstree('destroy');

                $('#hak_akses_tree').jstree({
                    'plugins': ['checkbox', 'types', 'wholerow', 'search'],
                    'search': {
                        'show_only_matches': true,
                        'show_only_matches_children': true,
                    },
                    "core": {
                        "themes": {
                            "responsive": false
                        },
                        "data": response.menu
                    },
                    "types": {
                        "default": {
                            "icon": "fa fa-folder text-warning"
                        },
                        "file": {
                            "icon": "fa fa-file text-warning"
                        }
                    },
                });

                $('#hak_akses_tree').on("changed.jstree", function(e, data) {
                    if (typeof data.node != 'undefined') {
                        if (data.selected.length == 0) {
                            $("#btnSaveHA").css('display', 'block');
                        } else {
                            $("#btnSaveHA").css('display', 'block');
                        }
                        unique = [];
                        var itemList = data.selected;
                        $.each(itemList, function(i, el) {
                            if (data.instance.is_leaf(el)) {
                                $.each(data.instance.get_node(el).parents, function(i2, el2) {
                                    if ($.inArray(el2, itemList) == -1 && el2 != '#') itemList.push(el2);
                                })
                            }
                        });
                        unique = itemList;
                    }
                });

                $('#cari-menu').donetyping(function() {
                    console.log($(this).val())
                    var v = $(this).val()
                    $('#hak_akses_tree').jstree(true).search(v);
                })

            }
        });
    }
</script>