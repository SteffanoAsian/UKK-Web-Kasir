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
            // console.log(role_access);
        },

        populateForm: function (frm, data) {
            $.each(data, function (key, value) {
                var $ctrl = $('[name="' + key + '"]', frm);
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
                valueField: null,
                selectedField: null,
                displayField: null,
                displayField2: null,
                displayField3: null,
                url: null,
                placeholder: '-Choose-',
                grouped: false,
                withNull: true,
                data: {},
                elClass: false,
                type: 'GET',
                callback: function () { }
            }, config);

            $.ajax({
                url: config.url,
                type: config.type,
                complete: function (res) {
                    var res = JSON.parse(res);
                    var html = (config.withNull === true) ? "<option value>" + config.placeholder + "</option>" : "";
                    console.log(res);
                    if (res.success) {

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
            console.log(config);
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
                        console.log(full);
                        return full['row'];
                    },
                });

            var xDefault = {
                lengthMenu: [5, 10, 25, 50, 100],

                pageLength: config.pageLength,

                language: {
                    'lengthMenu': 'Tampil _MENU_ &nbsp;data per halaman',
                    "emptyTable": "Tidak ada data yang dapat ditampilkan",
                    "info": "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
                    "infoEmpty": "Tidak ada data yang dapat ditampilkan",
                    "infoFiltered": "(Ditemukan dari  total _MAX_ data)",
                    "search": "Pencarian:",
                    "zeroRecords": "Tidak ada data yang dapat ditampilkan",
                    "processing": "Memuat data...",
                },

                searchDelay: 500,
                processing: true,
                ajax: {
                    url: config.url,
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
            var dt = $(el).KTDatatable(config);
            return dt;
        }
    }
}();