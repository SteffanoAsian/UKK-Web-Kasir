var HELPER = function () {
    var role_access = [];

    var loadBlock = function () {
        $.blockUI({
            message: '<div class="lds-ellipsis" style="z-index: 9999"><div></div><div></div><div></div><div>',
            css: { border: 'none', backgroundColor: 'rgba(47, 53, 59, 0)', 'z-index': 9999 }
        });
    }

    var unblock = function (delay) {
        window.setTimeout(function () {
            $.unblockUI();
        }, delay);
    }

    return {
        block: function () {
            loadBlock()
        },

        unblock: function (delay = null) {
            unblock(delay)
        },

        get_role_access: function (name = null) {
            if (name) {
                if (role_access) {
                    return role_access.includes(name);
                }
                return false;
            }
            return role_access;
        },

        set_role_access: function (data = []) {
            role_access = data;
        },

        populateForm: function (frm, data) {
            $.each(data, function (key, value) {
                var $ctrl = $('[id="' + key + '"]', frm);
                if ($ctrl.is('select')) {
                    if ($ctrl.data().hasOwnProperty('select2')) {
                        $ctrl.val(value).trigger('change');
                    } else {
                        $("option", $ctrl).each(function () {
                            if (this.value == value) {
                                this.selected = true;
                            }
                        });
                    }
                } else {
                    switch ($ctrl.attr("type")) {
                        case "text":
                        case "email":
                        case "number":
                        case "hidden":
                        case "textarea":
                            $ctrl.val(value);
                            break;
                        case "radio":
                        case "checkbox":
                            $ctrl.each(function () {
                                if ($(this).attr('value') == value) {
                                    $(this).prop('checked', true)
                                }
                            });
                            break;
                    }
                }
            });
        },

        genCombo: function (config) {
            config = $.extend(true, {
                el: null,
                isSelect2: true,
                valueField: null,
                selectedField: null,
                displayField: null,
                displayField2: null,
                displayField3: null,
                url: null,
                placeholder: '-Choose-',
                grouped: false,
                withNull: true,
                // data: {},
                allowClear: true,
                dropdownParent: '',
                elClass: false,
                type: 'GET',
                callback: function () { }
            }, config);

            $.ajax({
                url: config.url,
                type: config.type,
                success: function (res) {
                    var res = JSON.parse(res);
                    var html = (config.withNull === true) ? "<option value>" + config.placeholder + "</option>" : "";
                    $.each(res.data, function (key, value) {
                        if (config.grouped) {
                            html += `<option value="${value[config.valueField]}">${value[config.displayField]} - ${value[config.displayField2]}</option>`
                        } else {
                            html += `<option value="${value[config.valueField]}">${value[config.displayField]}</option>`
                        }
                    })
                    if (config.elClass) {
                        $('.' + config.el).html('')
                        $('.' + config.el).html(html)
                    } else {
                        $('#' + config.el).html('')
                        $('#' + config.el).html(html)
                    }

                    if (config.isSelect2 == true) {
                        if (config.elClass) {
                            $('.' + config.el).select2({
                                allowClear: config.allowClear,
                                dropdownAutoWidth: true,
                                width: '100%',
                                placeholder: config.placeholder,
                            });
                        } else {
                            $('#' + config.el).select2({
                                allowClear: config.allowClear,
                                dropdownAutoWidth: true,
                                width: '100%',
                                placeholder: config.placeholder,
                            });
                        }
                    }
                }
            })
        },

        loadPage: function (el) {
            loadBlock();
            var page = $(el).data('menu');
            $.ajax({
                url: BASE_URL + "/main/getPage",
                data: {
                    menu: page
                },
                type: "POST",
                complete: function () {
                    unblock()
                },
                success: function (pages) {
                    var resp_object = $.parseJSON(pages);
                    $(".menu-icon").removeClass('text-primary')
                    $(".menu-title").removeClass('text-primary')
                    $("#menu-icon_" + page).addClass('text-primary')
                    if ($(el).data('ischild')) {
                        var parent = $(el).data('parent')
                        $("#menu-icon_" + parent).addClass('text-primary')
                    }
                    $("#kt_content").html(atob(resp_object.view));
                },
                error: function () {
                    Swal.fire({
                        title: "Error",
                        html: 'Kesalahan Tidak Diketahui, Harap Hubungi Administrator Anda !!!',
                        icon: "error",
                        allowOutsideClick: false,
                    })
                }

            }).done(function () {
                $('html,body').animate({
                    scrollTop: 0
                }, 'fast');
            }());

        },

        initTable: function (config = null) {
            config.columnDefs.push(
                {
                    defaultContent: "-",
                    targets: "_all"
                },
                {
                    targets: 0,
                    searchable: false,
                    orderable: false,
                    render: function (data, type, full, meta) {
                        return full['row'];
                    },
                });

            var xDefault = {
                lengthMenu: [5, 10, 25, 50, 100],
                bDestroy: true,
                pageLength: config.pageLength,
                // sPaginationType: "full_numbers",
                language: {
                    'lengthMenu': 'Tampil _MENU_ &nbsp;data per halaman',
                    "emptyTable": "Tidak ada data yang dapat ditampilkan",
                    "info": "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
                    "infoEmpty": "Tidak ada data yang dapat ditampilkan",
                    "infoFiltered": "(Ditemukan dari  total _MAX_ data)",
                    "search": "Pencarian:",
                    "zeroRecords": "Tidak ada data yang dapat ditampilkan",
                    "processing": "Memuat data...",
                    oPaginate: {
                        sNext: '<span>Next</span>',
                        sPrevious: '<span>Prev</span>',
                    }
                },

                searchDelay: 500,
                processing: true,
                ajax: {
                    url: config.url,
                    data: config.data,
                    type: 'POST',
                },

                order: [
                    [config.index, config.sorting]
                ],
                fnRowCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    $('td:eq(0)', nRow).html(iDisplayIndexFull + 1);
                },
            };
            var el = $("#" + config.el);
            var dt = $(el).DataTable($.extend(config, xDefault));
            return dt;
        },

        showMessage: function (config) {
            config = $.extend(true, {
                success: false,
                message: 'System error, please contact the Administrator',
                title: 'Failed',
                time: 5000,
                sticky: false,
                allowOutsideClick: true,
                callback: function () { },
            }, config);

            if (config.success == true) {
                Swal.fire({
                    title: config.title,
                    text: config.message,
                    icon: "success",
                    allowOutsideClick: config.allowOutsideClick,
                }).then(function (result) {
                    config.callback(result);
                });
            } else {
                if (config.success == false) {
                    Swal.fire({
                        title: config.title,
                        text: config.message,
                        icon: "error",
                        allowOutsideClick: config.allowOutsideClick,
                    }).then(function (result) {
                        config.callback(result);
                    });
                } else {
                    Swal.fire({
                        title: config.title,
                        text: config.message,
                        icon: config.success,
                        allowOutsideClick: config.allowOutsideClick,
                    }).then(function (result) {
                        config.callback(result);
                    });
                }
            }
        },

        confirm: function (config) {
            config = $.extend(true, {
                title: 'Information',
                message: null,
                size: 'small',
                type: 'warning',
                confirmLabel: '<i class="fa fa-check"></i> Yes',
                confirmClassName: 'btn btn-focus btn-success m-btn m-btn--pill m-btn--air',
                cancelLabel: '<i class="fa fa-times"></i> No',
                cancelClassName: 'btn btn-focus btn-danger m-btn m-btn--pill m-btn--air',
                showLoaderOnConfirm: false,
                allowOutsideClick: true,
                callback: function () { }
            }, config);
            Swal.fire({
                title: config.title,
                text: config.message,
                icon: config.type,
                confirmButtonText: config.confirmLabel,
                confirmButtonClass: config.confirmClassName,
                reverseButtons: true,
                showCancelButton: true,
                cancelButtonText: config.cancelLabel,
                cancelButtonClass: config.cancelClassName,
                allowOutsideClick: config.allowOutsideClick
            }).then(function (result) {
                config.callback(result.value);
            });
        },

        save: function (config = null) {
            var xurl;
            xurl = ($("[name=" + HELPER.fields[0] + "]").val() === "") ? HELPER.api.store : HELPER.api.update;
            config = $.extend(true, {
                contentType: false,
                processData: false,
                form: null,
                confirm: true,
                confirmMessage: null,
                // data: $.extend($('[name=' + config.form + ']').serializeObject(), {
                // }),
                method: 'POST',
                url: xurl,
                callback: function (arg) { },
                oncancel: function (arg) { }
            }, config);

            var do_save = function (_config) {
                loadBlock();
                $.ajax({
                    url: _config.url,
                    data: _config.data,
                    type: _config.method,
                    cache: _config.cache,
                    contentType: _config.contentType,
                    processData: _config.processData,
                    success: function (response) {
                        var response = $.parseJSON(response);
                        HELPER.showMessage({
                            success: response.success,
                            message: response.message,
                            title: ((response.success) ? 'Success' : 'Failed')
                        });
                        unblock(100);
                    },
                    error: function () {
                        HELPER.showMessage({
                            success: false,
                            title: errorname,
                            message: 'System error, please contact the Administrator'
                        });
                        unblock(100);
                    },
                    complete: function (response) {
                        var response = $.parseJSON(response.responseText);
                        config.callback(response.success, response.record, response.message, response);
                    },
                });
            }

            if (config.confirm) {
                Swal.fire({
                    title: 'Information',
                    text: ((config.confirmMessage != null) ? config.confirmMessage : "Apakah Anda yakin ingin menyimpannya ?"),
                    icon: 'info',
                    confirmButtonText: '<i class="fa fa-check"></i> Yes',
                    confirmButtonClass: 'btn btn-focus btn-success m-btn m-btn--pill m-btn--air',
                    reverseButtons: true,
                    showCancelButton: true,
                    cancelButtonText: '<i class="fa fa-times"></i> No',
                    cancelButtonClass: 'btn btn-focus btn-danger m-btn m-btn--pill m-btn--air'
                }).then(function (result) {
                    if (result.value) {
                        do_save(config);
                    } else {
                        config.oncancel(result)
                    }
                });
            } else {
                do_save(config);
            }
        }
    }
}();

$.fn.serializeObject = function () {
    var o = {};
    var a = this.serializeArray();
    $.each(a, function () {
        if (o[this.name]) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};