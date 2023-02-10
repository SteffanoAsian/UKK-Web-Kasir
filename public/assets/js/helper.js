var HELPER = function () {

    var loadBlock = function(message = 'Loading...') {
        $.blockUI({
            message: '<div class="lds-ellipsis" style="z-index: 9999"><div></div><div></div><div></div><div>',
            css: { border: 'none', backgroundColor: 'rgba(47, 53, 59, 0)', 'z-index': 9999 }
        });
    }

    var unblock = function(delay) {
        window.setTimeout(function() {
            $.unblockUI();
        }, delay);
    }

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
            loadBlock();
            var page = $(el).data('menu');
            $.ajax({
                url: BASE_URL + "/main/getPage",
                data:{
                    menu : page
                },
                type: "POST",
                complete: function (pages) {
                    unblock(500)
                    var resp_object = $.parseJSON(pages.responseText);
                    $("#kt_content_container").html(atob(resp_object.view));
                },
                
            }).done(function () {
                $('html,body').animate({
                    scrollTop: 0
                }, 'fast');
            }());

        },
    }
}();