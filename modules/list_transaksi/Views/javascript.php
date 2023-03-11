<script type="text/javascript">
    $(() => {
        HELPER.fields = [
            'transaksi_id',
        ];

        HELPER.api = {
            index: BASE_URL + 'list_transaksi',
            edit: BASE_URL + 'list_transaksi/edit',
            store: BASE_URL + 'list_transaksi/store',
            update: BASE_URL + 'list_transaksi/update',
            destroy: BASE_URL + 'list_transaksi/destroy',
            loadAdminKasir : BASE_URL + 'list_transaksi/loadAdminKasir'

        };

        $('#filter_tanggal').daterangepicker({
            buttonClasses: ' btn',
            applyClass: 'btn-sm btn-primary',
            autoUpdateInput: false,
            cancelClass: 'btn-sm btn-secondary'
        });

        loadTable()
        loadComboAdmin()
    })
    $('#filter_tanggal').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'));
    });
    $(document).ready(function() {
        $("#modal-edit").on("hidden.bs.modal", function() {
            $("#form-menu")[0].reset();
            $('#menu_id').val('')
            $('#master_menu_jenis_id').val('').trigger('change');
        });
    });

    loadTable = (data = null) => {
        HELPER.initTable({
            el: "table-transaksi",
            url: HELPER.api.index,
            data : data,
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
                        return full['transaksi_pelanggan_nama'];
                    },
                },
                {
                    targets: 2,
                    orderable: true,
                    render: function(data, type, full, meta) {
                        return full['transaksi_datetime'];
                    },
                },
                {
                    targets: 3,
                    orderable: true,
                    render: function(data, type, full, meta) {
                        var price = new Intl.NumberFormat('en-ID', {
                            style: 'currency',
                            currency: 'IDR'
                        }).format(full['transaksi_total']);
                        return price;
                    },
                },
                {
                    targets: 4,
                    orderable: true,
                    render: function(data, type, full, meta) {
                        return full['user_name'];
                    },
                },


                {
                    targets: 5,
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
                                                    <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-hover-primary" onclick="onEdit('` + full['transaksi_id'] + `')"><i class="nav-icon fa fa-pen text-hover-primary mx-3"></i><span class="nav-text text-hover-primary">Edit</span></a></li>
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

    loadComboAdmin = () => {
        HELPER.genCombo({
            el: 'kasir',
            valueField: 'user_id',
            displayField: 'user_name',
            url: HELPER.api.loadAdminKasir,
            placeholder: '-Pilih Admin Kasir-',
        })
    }

    function filterData() {
        if ($('#kasir').val() == '' && $('#filter_tanggal').val() == '') {
            HELPER.showMessage({
                title: 'Failed',
                message: 'Pilihlah Tanggal atau Admin Kasir sebelum menjalankan filter',
                success: false
            });
        }
        if ($('#kasir').val() == '') {
            data = {
                date: $('#filter_tanggal').val()
            };
        }
        if ($('#filter_tanggal').val() == '') {
            data = {
                kasir: $('#kasir').val(),
            };
        }
        if ($('#filter_tanggal').val() != '' && $('#kasir').val() != '') {
            data = {
                kasir: $('#kasir').val(),
                date: $('#filter_tanggal').val()
            };
        }

        loadTable(data)

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