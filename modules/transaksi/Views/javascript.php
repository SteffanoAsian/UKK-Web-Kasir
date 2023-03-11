<script type="text/javascript">
    $(() => {
        HELPER.fields = [
            'transaksi_id',
        ];

        HELPER.api = {
            index: BASE_URL + 'transaksi',
            edit: BASE_URL + 'transaksi/edit',
            // store: BASE_URL + 'transaksi/store',
            prosesTransaksi: BASE_URL + 'transaksi/prosesTransaksi',
            destroy: BASE_URL + 'transaksi/destroy',
            loadMenu: BASE_URL + 'transaksi/loadMenu',
            loadMeja: BASE_URL + 'transaksi/loadMeja',
            addMenu: BASE_URL + 'transaksi/addMenu',
            countTotal: BASE_URL + 'transaksi/countTotalPrice',
        };

        loadTable()
        loadMeja()
        loadComboItem()
    })

    function showDetail(el) {
        var data = $(el).find('option:selected').data();
        var hargashow = new Intl.NumberFormat('en-ID', {
            style: 'currency',
            currency: 'IDR'
        }).format(data.harga);

        $('#keranjang_harga').val(data.harga)
        $('#showHarga').html(hargashow)
        $('#showKategori').html(data.jenis)
        // $('[name=keranjang_id]').val("")
    }

    function balek(el) {
        var uang = $(el).val()
        var total = $('#transaksi_total').val()
        var kembali = uang - total
        var kembalian = new Intl.NumberFormat('en-ID', {
            style: 'currency',
            currency: 'IDR'
        }).format(kembali);
        if (kembali < 0) {
            $('#showKembali').val("0")
        } else {
            $('#showKembali').val(kembalian)
            $('#transaksi_nominal_kembali').val(kembali)
        }

    }

    loadTable = () => {
        HELPER.initTable({
            el: "table-temp",
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
                        return full['master_menu_nama'] + ' - ' + full['master_jenis_nama'];
                    },
                },
                {
                    targets: 2,
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
                    targets: 3,
                    orderable: true,
                    render: function(data, type, full, meta) {
                        return full['keranjang_jml_beli'];
                    },
                },
                {
                    targets: 4,
                    orderable: false,
                    render: function(data, type, full, meta) {
                        var price = full['master_menu_harga'] * full['keranjang_jml_beli'];
                        let number = new Intl.NumberFormat('en-ID', {
                            style: 'currency',
                            currency: 'IDR',
                        });
                        return number.format(price);
                    },
                },
                {
                    targets: 5,
                    orderable: false,
                    render: function(data, type, full, meta) {
                        var dropdown = ''

                        dropdown += `<div class="dropdown">
    										<a href="javascript:void(0);" class="btn btn-sm btn-info btn-circle btn-icon dropdown-toggle" data-bs-toggle="dropdown">
    												<i class="fa fa-cog"></i>
    										</a>
    										<div class="dropdown-menu dropdown menu-sm dropdown-menu-right">
    											<ul class="nav nav-hoverable flex-column">
                                                    <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-hover-primary" onclick="onEdit('` + full['keranjang_id'] + `')"><i class="nav-icon fa fa-pen text-hover-primary mx-3"></i><span class="nav-text text-hover-primary">Edit</span></a></li>
                                                    <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-hover-danger" onclick="onDelete('` + full['keranjang_id'] + `')"><i class="nav-icon fa fa-trash text-hover-danger mx-3"></i><span class="nav-text text-hover-danger">Delete</span></a></li>
    											</ul>
    										</div>
    									</div>`
                        return dropdown
                    },
                },
            ],
        });

        $.ajax({
            url: HELPER.api.countTotal,
            type: 'POST',
            complete: function(response) {
                var response = $.parseJSON(response.responseText)

                var price = new Intl.NumberFormat('en-ID', {
                    style: 'currency',
                    currency: 'IDR'
                }).format(response.total);
                $('#transaksi_total').val(response.total)
                $('#showTotal').val(price)
            },
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
                keranjang_id: id
            },
            success: function(response) {
                var response = $.parseJSON(response)
                // console.log(response);
                HELPER.populateForm($(`[id="form-transaksi"]`), response);
            },
            complete: function(response) {

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

    loadComboItem = () => {
        $.ajax({
            url: HELPER.api.loadMenu,
            method: 'POST',
            success: function(response) {
                var response = $.parseJSON(response);
                var html = "<option value> -- Pilih Menu -- </option>"
                $.each(response.data, function(i, v) {
                    html += `<option value="${v.master_menu_id}" data-harga="${v.master_menu_harga}" data-jenis="${v.master_jenis_nama}">${v.master_menu_nama +' - '+v.master_jenis_nama}</option>`
                });
                $('#keranjang_menu_id').html(html);

                $('#keranjang_menu_id').select2({
                    dropdownAutoWidth: true,
                    width: '100%',
                });
            },
        })
    }

    loadMeja = () => {
        HELPER.genCombo({
            el: 'transaksi_meja_id',
            valueField: 'master_meja_id',
            displayField: 'master_meja_no',
            displayField2: 'master_meja_location',
            grouped: true,
            url: HELPER.api.loadMeja,
            placeholder: '-Pilih Lokasi Meja-',
        })
    }

    addMenu = (form) => {
        HELPER.confirm({
            message: 'Apakah anda yakin untuk menyimpan Data ini  ?',
            callback: function(r) {
                if (r) {
                    HELPER.block()
                    var formData = new FormData($('[name="' + form + '"]')[0]);
                    $.ajax({
                        url: HELPER.api.addMenu,
                        data: formData,
                        type: 'POST',
                        contentType: false,
                        processData: false,
                        complete: function(response) {
                            var response = $.parseJSON(response.responseText)
                            HELPER.showMessage({
                                success: response.success,
                                message: response.success ? 'Berhasil Memperbarui Pesanan' : 'Gagal Memperbarui Pesanan',
                                title: ((response.success) ? 'Success' : 'Failed'),
                                callback: function() {
                                    var price = new Intl.NumberFormat('en-ID', {
                                        style: 'currency',
                                        currency: 'IDR'
                                    }).format(response.totalPrice);
                                    // $("#form-transaksi")[0].reset();
                                    $('#keranjang_jml_beli').val('')
                                    $('#keranjang_menu_id').val('').trigger('change');
                                    $('#transaksi_total').val(response.totalPrice)
                                    $('#showHarga').html('')
                                    $('#showKategori').html('')
                                    $('#showTotal').val(price)
                                    loadTable()
                                    loadMeja()
                                }
                            });
                            HELPER.unblock(500);
                        },
                    });
                }
            }
        })
    }

    prosesTransaksi = (form) => {
        HELPER.confirm({
            message: 'Apakah anda yakin untuk memproses Transaksi ini  ?',
            callback: function(r) {
                if (r) {
                    HELPER.block()
                    var formData = new FormData($('[name="' + form + '"]')[0]);
                    $.ajax({
                        url: HELPER.api.prosesTransaksi,
                        data: formData,
                        type: 'POST',
                        contentType: false,
                        processData: false,
                        complete: function(response) {
                            var response = $.parseJSON(response.responseText)
                            HELPER.showMessage({
                                success: response.success,
                                message: response.success ? 'Berhasil Memproses Transaksi' : 'Gagal Memproses Transaksi',
                                title: ((response.success) ? 'Success' : 'Failed'),
                                callback: function() {
                                    // var price = new Intl.NumberFormat('en-ID', {
                                    //     style: 'currency',
                                    //     currency: 'IDR'
                                    // }).format(response.totalPrice);
                                    $("#transaksi_pelanggan_nama").val('');
                                    $('#transaksi_total').val('')
                                    $('#transaksi_meja_id').val('').trigger('change');
                                    $('#transaksi_nominal_bayar').val('')
                                    $('#showKembali').val('')
                                    $('#transaksi_nominal_kembali').val('')
                                    $('#showTotal').val('')
                                    loadTable()
                                }
                            });
                            HELPER.unblock(500);
                        },
                    });
                }
            }
        })
    }

    // save = (name) => {
    //     var formData = new FormData($('[name="' + name + '"]')[0]);
    //     HELPER.save({
    //         cache: false,
    //         data: formData,
    //         form: name,
    //         confirm: true,
    //         callback: function(success, record, message) {
    //             if (success) {
    //                 HELPER.showMessage({
    //                     success: true,
    //                     title: 'Success',
    //                     message: 'Successfully saved data',
    //                     callback: function() {
    //                         loadTable()
    //                         $('#modal-edit').modal('hide')
    //                     }
    //                 });
    //             } else {
    //                 HELPER.showMessage({
    //                     success: false
    //                 })
    //             }
    //             HELPER.unblock(100);
    //         },
    //         oncancel: function(result) {
    //             HELPER.unblock(100);
    //         }
    //     });
    // }

    // onRefresh = () => {
    //     loadTable()
    // }

    // onDelete = (id) => {
    //     HELPER.confirm({
    //         message: 'Are you sure to delete this data ?',
    //         callback: function(r) {
    //             if (r) {
    //                 HELPER.block();
    //                 $.ajax({
    //                     url: HELPER.api.destroy,
    //                     method: 'POST',
    //                     data: {
    //                         master_menu_id: id
    //                     },
    //                     success: function(response) {
    //                         var response = $.parseJSON(response);
    //                         HELPER.unblock(500);
    //                         HELPER.showMessage({
    //                             message: response.message,
    //                             success: response.success,
    //                             title: response.success ? 'Successfully delete data' : 'Failed to delete data',
    //                             callback: function() {
    //                                 loadTable()
    //                             }
    //                         })
    //                     },
    //                     error: (xhr, status, error) => {
    //                         HELPER.unblock()
    //                         HELPER.showMessage({
    //                             message: 'Kesalahan tidak diketahui. Hubungi Administrator Anda !!',
    //                         })
    //                     },
    //                 })
    //             }
    //         }
    //     })

    // }
</script>