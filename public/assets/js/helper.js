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
                    $("#kt_content_container").html(atob(resp_object.view));
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
    }
}();