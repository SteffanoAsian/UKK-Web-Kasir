var HELPER = function () {
    // var loadBlock = function (message) {
    //     $.blockUI({
    //         message: '<div class="lds-ring" style="z-index: 9999"><div></div><div></div><div></div><div>',
    //         css: { border: 'none', backgroundColor: 'rgba(47, 53, 59, 0)', 'z-index': 9999 }
    //     });
    // }

    // var unblock = function (delay) {
    //     window.setTimeout(function () {
    //         $.unblockUI();
    //     }, delay);
    // }

    return {
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
                    if(res.success){

                    }
                }
            })
        },

        loadPage: function (el) {
            // loadBlock();
            // $(window).unbind('scroll');
            // $('.menu-item-active').removeClass('menu-item-active')
            // $('.menu-item-here').removeClass('menu-item-here')
            // var me = $(el);
            // var page = $(el).data();
            console.log(el);
            $.ajax({
                url: BASE_URL + "/main/getPage",
                data:el,
                type: "POST",
                complete: function (pages) {
                    // var resp_object = $.parseJSON(pages.responseText);
                    // var title = (resp_object.menu_keterangan != null) ? resp_object.menu_keterangan : '';
                    // var role_name = (resp_object.role_name != null) ? resp_object.role_name : '';
                    // $.when(function () {
                    //     $('.tooltip.show').remove()
                    //     $("#kt_content").css('visibility', 'hidden');
                    //     $("#kt_content").html(atob(resp_object.view));
                    //     me.parent().addClass('menu-item-active')
                    //     // me.parents('.menu-item.menu-item-submenu').addClass('menu-item-active')
                    //     me.parents('.menu-item.menu-item-submenu.menu-item-rel').addClass('menu-item-here')
                    // }()).then(function () {
                    //     var container = $("#kt_content");
                    //     $.each($('[data-roleable=true]', container), function (i, v) {
                    //         if ($(v).data('role') != 'undefined' && $(v).data('role') != '') {
                    //             var roles = $(v).data('role').split('|')
                    //             var checkRole = true;
                    //             $.each(roles, function (iR, vR) {
                    //                 if (HELPER.get_role_access(vR)) {
                    //                     checkRole = false;
                    //                 }
                    //             });
                    //             if (checkRole) {
                    //                 if ($(v).data('action') != 'undefined' && $(v).data('action') == 'hide') {
                    //                     $(v).hide()
                    //                 } else {
                    //                     $(v).remove()
                    //                 }
                    //             }
                    //         }
                    //     })
                    // }()).then(function () {
                    //     $('[data-toggleable="tooltip"]').tooltip()
                    //     $("#kt_content").css('visibility', 'visible');
                    //     if ($('body').find('#map_tracking').length) {
                    //         $('#kt_footer').css('cssText', 'display: none!important');
                    //         $('#kt_content').addClass('pb-0')
                    //         $('#kt_content').removeClass('mx-10')
                    //         $('#kt_content').removeClass('mt-5')
                    //     } else {
                    //         $('#kt_footer').css('display', '');
                    //         $('#kt_content').removeClass('pb-0')
                    //         $('#kt_content').addClass('mx-10')
                    //         $('#kt_content').addClass('mt-5')
                    //     }
                    //     // unblock(100);
                    // }())
                },
                // error: function (res, status, errorname) {
                //     var pages = res.responseJSON;
                //     if ((Array.isArray(pages) || typeof pages === 'object') && pages.success == false && pages.hasOwnProperty('code')) {
                //         HELPER.showMessage({
                //             success: false,
                //             message: pages.message,
                //             allowOutsideClick: false,
                //             callback: function () {
                //                 if (pages.code == '401') {
                //                     window.location.reload()
                //                 }
                //             }
                //         })
                //     }
                //     // unblock(100)
                // }
            }).done(function () {
                $('html,body').animate({
                    scrollTop: 0
                }, 'fast');
            }());

        },
    }
}();