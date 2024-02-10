var notification_audio = new Audio("/js/plucky.mp3");
var login_notification_audio = new Audio("/js/consequence.mp3");
$(document).ready(function ($) {
    function reloadFunctions() {
        if ($(".sortable").length) {
            $(".sortable").sortable({
                handle: ".determiner",
            });
        }
        $.each($("[data-table]"), function (index, val) {
            var tableId = $(this).attr("id");
            var tableStatus = $(this).data("active");
            var el = $("#" + tableId);
            if (tableStatus !== "active") {
                el.DataTable({
                    displayLength: 100,
                    sDom: '<"top"i>rt<"bottom"flp><"clear">',
                    dom: "Blpftrip",
                    buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
                    stateSave: true,
                });
                el.attr("data-active", "active");
            }
        });
        $(".mce-widget , .mce-container").remove();
        var tinymceId = 1;
        if ($("#image").length) {
            cropImage();
        }
        if ($(".tinymce").length) {
            tinymce.remove();
            $.each($(".tinymce"), function (index, val) {
                var newTinymceId = "tinymce-" + tinymceId;
                $(this).attr("id", newTinymceId);
                tinymce.init({
                    selector: "#" + newTinymceId,
                    theme: "modern",
                    height: 300,
                    language: "ar",
                    language_url: "/plugins/bower_components/tinymce/langs/ar.js",
                    plugins: ["advlist autolink textpattern link image lists inline charmap print preview hr anchor pagebreak spellchecker", "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking", "save table contextmenu directionality emoticons template paste textcolor"],
                    toolbar: "insertfile undo redo | styleselect | bold italic | ltr rtl | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
                });
                ++tinymceId;
            });
        }
        if ($(".image-popup").length) {
            $(".image-popup").magnificPopup({
                type: "image",
            });
        }
        if ($("[data-mask]").length) {
            $.each($("[data-mask]"), function (index, val) {
                var el = $(this);
                el.inputmask(el.data("mask"));
            });
        }
        if ($("[data-only-arabic]").length) {
            $("[data-only-arabic]").inputmask({
                mask: "*{1,100}",
                greedy: false,
                definitions: {
                    "*": {
                        validator: "[{ }ء-ي]",
                        casing: "lower",
                    },
                },
            });
        }
        if ($("[data-only-turkish]").length) {
            $("[data-only-turkish]").inputmask({
                mask: "*{1,100}",
                greedy: false,
                definitions: {
                    "*": {
                        validator: "[a-zA-Z{ çğıöşüÇĞİÖŞÜ}]",
                        casing: "upper",
                    },
                },
            });
        }
        // Start map
        if ($("#detecting-map").length) {
            var map,
                pos = {},
                centerOfMap;
            var map_lat = $("#map_lat");
            var map_lng = $("#map_lng");
            function initialize() {
                var mapOptions = {
                    zoom: 8,
                    center: new google.maps.LatLng(map_lat.val(), map_lng.val()),
                };
                infoWindow = new google.maps.InfoWindow();
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        function (position) {
                            if (map_lng.val() && map_lat.val()) {
                                pos = {
                                    lat: map_lat.val(),
                                    lng: map_lng.val(),
                                    zoom: 20,
                                };
                            } else {
                                pos = {
                                    lat: position.coords.latitude,
                                    lng: position.coords.longitude,
                                    zoom: 20,
                                };
                            }
                            map_lat.val(pos.lat.toFixed(6));
                            map_lng.val(pos.lng.toFixed(6));
                            infoWindow.setPosition(pos);
                            map.setCenter(pos);
                        },
                        function () {
                            handleLocationError(true, infoWindow, map.getCenter());
                        },
                    );
                } else {
                    // Browser doesn't support Geolocation
                    handleLocationError(false, infoWindow, map.getCenter());
                }
                map = new google.maps.Map(document.getElementById("detecting-map"), mapOptions);
                google.maps.event.addListener(map, "center_changed", function (event) {
                    centerOfMap = map.getCenter().toJSON();
                    map_lat.val(centerOfMap.lat.toFixed(6));
                    map_lng.val(centerOfMap.lng.toFixed(6));
                    $.each($(".map_lat"), function (index, val) {
                        $(this).val(centerOfMap.lat.toFixed(6));
                    });
                    $.each($(".map_lng"), function (index, val) {
                        $(this).val(centerOfMap.lng.toFixed(6));
                    });
                });
            }
            initialize();
        }
        $("body").on("change", ".map_lng, .map_lat", function (event) {
            pos = {
                lat: $(".map_lat").val(),
                lng: $(".map_lng").val(),
            };
            var mapOptions = {
                zoom: 14,
                center: new google.maps.LatLng($(".map_lat").val(), $(".map_lng").val()),
            };
            map = new google.maps.Map(document.getElementById("detecting-map"), mapOptions);
            google.maps.event.addListener(map, "center_changed", function (event) {
                centerOfMap = map.getCenter().toJSON();
                map_lat.val(centerOfMap.lat.toFixed(6));
                map_lng.val(centerOfMap.lng.toFixed(6));
                $.each($(".map_lat"), function (index, val) {
                    $(this).val(centerOfMap.lat.toFixed(6));
                });
                $.each($(".map_lng"), function (index, val) {
                    $(this).val(centerOfMap.lng.toFixed(6));
                });
            });
            event.preventDefault();
            /* Act on the event */
        });
        $("body").on("change", ".location_url", function (event) {
            var text = $(this).val();
            text = text.split("@");
            coordinate = text[1].split(",");
            var lat = coordinate[0];
            var lng = coordinate[1];
            $(".map_lat").val(lat);
            $(".map_lng").val(lng);
            $(".map_lat, .map_lng").change();
        });
        // End map
        $('[data-toggle="tooltip"]').tooltip();
        if ($(".dropify").length) {
            $(".dropify").dropify();
        }
        if ($(".select2").length) {
            $(".select2").select2();
        }
        if ($(".js-switch").length) {
            $(".js-switch").each(function () {
                new Switchery($(this)[0], $(this).data());
            });
        }
        if ($(".input-timepicker").length) {
            $.each($(".input-timepicker"), function (index, val) {
                var el = $(this);
                var mindate = el.data("mindate") ? el.data("mindate") : "";
                var maxdate = el.data("maxdate") ? el.data("maxdate") : "";
                $(el).daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    timePicker: false,
                    minDate: mindate,
                    maxDate: maxdate,
                    locale: {
                        format: "YYYY-MM-DD",
                    },
                    autoUpdateInput: true,
                });
            });
        }
        if ($(".input-daterange-timepicker").length) {
            $.each($(".input-daterange-timepicker"), function (index, val) {
                var el = $(this);
                var mindate = el.data("mindate") ? el.data("mindate") : "";
                var maxdate = el.data("maxdate") ? el.data("maxdate") : "";
                $(el).daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    timePicker: true,
                    timePickerIncrement: 10,
                    timePicker24Hour: false,
                    timePickerSeconds: false,
                    minDate: mindate,
                    maxDate: maxdate,
                    locale: {
                        format: "YYYY-MM-DD H:mm",
                    },
                    autoUpdateInput: true,
                });
            });
        }
    }
    function formReact(json, theElement) {
        var e = json;
        $.each(e, function (index, json) {
            x = json.type;
            switch (x) {
                case "notify":
                    $.notify(json.message, {
                        position: json.position + " top",
                        className: json.notify,
                    });
                    break;
                case "elementNotify":
                    $(json.element).notify(json.message, json.notify);
                    break;
                case "alert":
                    swal.fire({
                        title: json.alert_title,
                        text: json.alert_text,
                        type: json.alert_type,
                    });
                    break;
                case "func":
                    switch (json.func) {
                        case "signinSuccess":
                        case "reload":
                            window.location.reload();
                            break;
                        case "signinSuccessModal":
                            $("#signInModal").modal("close");
                            $("#signInModal .username , #signInModal .password").val("");
                            break;
                        case "relogin":
                            $("#signInModal").modal("show");
                            break;
                        case "deleteCompleted":
                            var item = $("[data-item-id=" + json.selector.id + "][data-action=" + json.selector.at + "]").parents(".item");
                            item.slideDown("500", function () {
                                item.remove();
                                swal.fire("Deleted!", "Your file has been deleted.", "success");
                            });
                            break;
                        case "CONFIRMED":
                            swal.fire("Confirmed!", "Your request has been confirmed.", "success");
                            break;
                        case "deleteFailed":
                            swal.fire("Deleting Error!", "Your file has not been deleted, Please try again later.", "error");
                            break;
                        case "resetSwitch":
                            theElement.prop("checked", false);
                            break;
                        case "backButton":
                            backButtonCount = -1;
                            $.each($(".backButton"), function (index, val) {
                                ++backButtonCount;
                            });
                            $(".backButton").eq(backButtonCount).click();
                            break;
                        case "setOptions":
                            theElement.find("option").remove();
                            $.each(e.options, function (index, option) {
                                theElement.append('<option value="' + option.value + '" extra="' + option.extra + '" >' + option.name + "</option>");
                            });
                            theElement.material_select();
                            break;
                        case "materialAdded":
                            $(".modal .type:checked").prop("checked", false);
                            $(".modal select.model").attr("disabled", "").material_select();
                            $(".modal .quantity").attr("disabled", "").val(0);
                            $(".modal .unit_price").attr("disabled", "").val(0);
                            $(".modal .total_price").val(0);
                            break;
                        case "closeModal":
                            $(json.selector.modal).modal("hide");
                            break;
                        case "closeModals":
                            $.each($(".modal"), function (index, val) {
                                $(this).modal("hide");
                            });
                            break;
                        case "disableRequestButton":
                            $("body .sendRequest[action='" + json.selector.action + "'][item-id='" + json.selector.itemId + "']")
                                .addClass("disabled")
                                .removeClass("sendRequest waves-effect light-waves")
                                .removeAttr("action")
                                .removeAttr("item-id")
                                .attr("data-tooltip", json.selector.title);
                            break;
                        case "uploadDone":
                            var el = json.selector.container + " " + json.selector.element;
                            $(el).removeClass("uploading");
                            $(el).find("img").attr("src", json.selector.icon);
                            $(el).find("a.image-popup").attr("href", json.selector.url);
                            $(el).find(".fileUrl").attr("href", json.selector.url);
                            $(el).find(".CPDB").attr("item-id", json.selector.id);
                            break;
                        case "uploadError":
                            var el = ".filesDiv " + json.selector.element;
                            $(el).remove();
                            break;
                        case "click":
                            $(json.selector.button).click();
                            break;
                        case "DIM":
                            var actionName = json.selector.actionName;
                            var actionItem = json.selector.actionItem;
                            $.ajax({
                                url: "/ajax/modal/" + actionName + "/" + actionItem,
                                type: "POST",
                                data: {x: 0},
                                success: function (e) {
                                    $("#dim-modal").modal("show");
                                    $("#dim-modal").find(".modal-content").html(e);
                                    reloadFunctions();
                                },
                            });
                            return false;
                            break;
                        case "show":
                            var el = json.selector.element;
                            $(el).removeClass("hide");
                            return false;
                            break;
                        case "hide":
                            var el = json.selector.element;
                            $(el).addClass("hide");
                            return false;
                            break;
                        case "setValue":
                            var el = json.selector.element;
                            var val = json.selector.val;
                            $(el).value(val);
                            return false;
                            break;
                        case "notifications":
                            if (json.selector.is_notifications == true) {
                                $(".heartbitEL").addClass("heartbit");
                                $.each(json.selector.notifications, function (index, val) {
                                    if (!$("#notify_" + val.id).length) {
                                        $(".dropdown-notifications").prepend('<li id="notify_' + val.id + '" ><a href="' + val.url + '" class="notify_element CPB" data-id="' + val.id + '" ><div><p><strong>' + val.details + '</strong></p></div></a><button type="button" class="notification_close btn btn-danger pull-right" >Hide</button></li>');
                                        notification_audio.play();
                                    }
                                });
                            } else {
                                $(".heartbitEL").removeClass("heartbit");
                            }
                            break;
                        case "circulations-notify":
                            if (json.selector.circulations > 0) {
                                $(".circulations-alert").removeClass("hide").html(json.selector.circulations);
                            } else {
                                $(".circulations-alert").addClass("hide").html(0);
                            }
                            break;
                        case "alert":
                            alert(json.selector.alert);
                            break;
                        case "online_users":
                            $(".online_users_item").remove();
                            $.each(json.selector.users, function (index, status) {
                                $(".online_users_list").append('<li class="online_users_item" ><div class="message-center"><a href="#"><div class="user-img"><div class="img" style="background-image: url(' + status.avatar + ');" ></div><span class="profile-status ' + status.status + ' pull-right"></span></div><div class="mail-contnet"><h5>' + status.name + '</h5><span class="mail-desc">' + status.status + "</span></div></a></div></li>");
                            });
                            break;
                        case "formReset":
                            var el = $(json.selector.element);
                            el[0].reset();
                            return false;
                            break;
                        case "redirect":
                            window.location = json.selector.url;
                            break;
                        case "checkURL":
                            checkURL();
                            break;
                    }
                    break;
            }
        });
    }
    function isJSON(something) {
        if (typeof something != "string") something = JSON.stringify(something);
        try {
            JSON.parse(something);
            return true;
        } catch (e) {
            return false;
        }
    }
    window.checkURL = function () {
        var thisHref = window.location.pathname;
        if (window.location.pathname == "/") {
            thisHref = "/home";
        }
        $.ajax({
            url: "/ajax" + thisHref,
            type: "POST",
            data: {x: 0},
            success: function (e) {
                if (isJSON(e)) {
                    formReact(e);
                } else {
                    $("main").html(e);
                    reloadFunctions();
                }
                $("header").removeClass("opened");
            },
        });
        return false;
    };
    $(".login-form").submit(function (event) {
        var details = new FormData($(this)[0]);
        $.ajax({
            url: "/ajax/login",
            type: "POST",
            data: details,
            cache: false,
            contentType: false,
            processData: false,
            success: function (e) {
                formReact(e);
            },
        });

        return false;
    });
    $("body").on("keyup", "input.text-count, textrea.text-count", function () {
        let maxLenght = $(this).data("length");
        let textLength = $(this).val();
        if (textLength.length > maxLenght) {
            $(this).css("color", "red");
        } else {
            $(this).css("color", "");
        }
    });
    $("body").on("click", ".make-default-photo", function () {
        var el = $(this);
        var button_content = el.html();
        el.attr("disabled", "disabled").html('<i class="fa fa-gear fa-spin" ></i>');
        var details = new FormData();
        details.append("actionName", "MAKE_DEFAULT_IMAGE");
        details.append("id", el.data("id"));
        $.ajax({
            url: "/ajax/actions",
            type: "POST",
            data: details,
            cache: false,
            contentType: false,
            processData: false,
            success: function (e) {
                if (e != "") {
                    formReact(e);
                }
                el.removeAttr("disabled").html(button_content);
            },
        });
    });
    $("body").on("submit", ".form", function (event) {
        var form = $(this);
        var submit_button_content = form.find("input[type=submit], button[type=submit]").html();
        form.find("input[type=submit], button[type=submit]").attr("disabled", "disabled").html('<i class="fa fa-gear fa-spin" ></i>');
        var details = new FormData($(this)[0]);
        if ($("input, textarea").inputmask("isComplete")) {
            $.ajax({
                url: "/ajax/actions",
                type: "POST",
                data: details,
                cache: false,
                contentType: false,
                processData: false,
                success: function (e) {
                    //$('#page-wrapper').append(e);
                    //$('body').html(e);
                    //alert(e);
                    if (e != "") {
                        formReact(e);
                    }
                    form.find("input[type=submit], button[type=submit]").removeAttr("disabled").html(submit_button_content);
                },
            });
        }
        return false;
        /* Act on the event */
    });
    var $image_crop_modal = $("#image-crop-modal");

    var image_crop = document.getElementById("image-crop");
    var image_crop_j = $("#image-crop");

    var cropper;

    $("body").on("click", "#crop-photo", function () {
        let url = $(this).data("photo");
        let id = $(this).data("id");
        let complex = $(this).data("complex");
        //var files = event.target.files;
        //files = files[0].toDataURL('image/jpeg', 0.7);

        var done = function (url, id, complex) {
            image_crop.src = url;
            image_crop_j.data("id", id);
            image_crop_j.data("is-new", "no");
            image_crop_j.data("complex", complex);
            $image_crop_modal.modal("show");
        };

        var request = new XMLHttpRequest();
        request.open("GET", url, true);
        request.responseType = "blob";
        request.onload = function () {
            var reader = new FileReader();
            reader.readAsDataURL(request.response);
            reader.onload = function (e) {
                done(url, id, complex);
            };
        };
        request.send();
    });

    $("body").on("change", "#image-crop-input", function (event) {
        var files = event.target.files;
        let complex = $(this).data("complex");
        let photoType = $("#photo-type").val();
        //files = files[0].toDataURL('image/jpeg', 0.7);

        var done = function (url, complex) {
            alert(url);
            image_crop.src = url;
            image_crop_j.data("is-new", "yes");
            image_crop_j.data("complex", complex);
            image_crop_j.data("photo-type", photoType);
            $image_crop_modal.modal("show");
            $image_crop_modal.modal("show");
        };

        if (files && files.length > 0) {
            reader = new FileReader();
            reader.onload = function (event) {
                done(reader.result, complex);
            };
            reader.readAsDataURL(files[0]);
        }
    });

    $image_crop_modal
        .on("shown.bs.modal", function () {
            //		var jpg = image_crop[0].toDataURL('image/jpeg', 0.7);
            cropper = new Cropper(image_crop, {
                aspectRatio: 16 / 9,
                fillColor: "#fff",
                //viewMode: 1,
            });
        })
        .on("hidden.bs.modal", function () {
            $("body").addClass("modal-open");
            cropper.destroy();
            cropper = null;
        });

    $("body").on("click", "#crop", function () {
        canvas = cropper.getCroppedCanvas({
            width: 1200,
            height: 675,
            fillColor: "#ffffff",
        });

        canvas.toBlob(function (blob) {
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function () {
                var base64data = reader.result;
                $.ajax({
                    url: "/ajax/actions",
                    method: "POST",
                    data: {image: base64data, id: image_crop_j.data("id"), complex: image_crop_j.data("complex"), is_new: image_crop_j.data("is-new"), photoType: image_crop_j.data("photo-type"), type: image_crop_j.data("type"), actionName: "UPLOAD_CROPPED_IMAGE"},
                    success: function (data) {
                        $image_crop_modal.modal("hide");
                        formReact(data);
                    },
                });
            };
        });
    });
    $("body").on("click", ".post-freelance-invoice", function () {
        var invoice_details = $(".invoice-container").html(),
            settled_amount = $(this).data("settled-amount"),
            carried_foraward = $(this).data("carried-forward"),
            employee = $(this).data("employee"),
            invoice_year = $(this).data("year"),
            invoice_month = $(this).data("month");
        swal.fire({
            title: "Are you sure?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Post",
            closeOnConfirm: false,
            input: "checkbox",
            inputPlaceholder: "Move To Cash",
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url: "/ajax/actions",
                    type: "POST",
                    data: {actionName: "POST_FREELANCE_INVOICE", employee: employee, settled_amount: settled_amount, carried_forward: carried_foraward, bill: invoice_details, year: invoice_year, month: invoice_month, cash_flow: 1},
                    success: function (e) {
                        formReact(e);
                    },
                });
            } else if (result.value === 0) {
                $.ajax({
                    url: "/ajax/actions",
                    type: "POST",
                    data: {actionName: "POST_FREELANCE_INVOICE", employee: employee, settled_amount: settled_amount, carried_forward: carried_foraward, bill: invoice_details, year: invoice_year, month: invoice_month},
                    success: function (e) {
                        formReact(e);
                    },
                });
            } else {
                console.log(`modal was dismissed by ${result.dismiss}`);
            }
        });
    });
    $("body").on("click", ".post-regular-invoice", function () {
        var invoice_details = $(".invoice-container").html(),
            settled_amount = $(this).data("settled-amount"),
            carried_foraward = $(this).data("carried-forward"),
            employee = $(this).data("employee"),
            invoice_year = $(this).data("year"),
            invoice_month = $(this).data("month");
        swal.fire({
            title: "Are you sure?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Post",
            closeOnConfirm: false,
            input: "checkbox",
            inputPlaceholder: "Move To Cash",
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url: "/ajax/actions",
                    type: "POST",
                    data: {actionName: "POST_REGULAR_INVOICE", employee: employee, settled_amount: settled_amount, carried_forward: carried_foraward, bill: invoice_details, year: invoice_year, month: invoice_month, cash_flow: 1},
                    success: function (e) {
                        formReact(e);
                    },
                });
            } else if (result.value === 0) {
                $.ajax({
                    url: "/ajax/actions",
                    type: "POST",
                    data: {actionName: "POST_REGULAR_INVOICE", employee: employee, settled_amount: settled_amount, carried_forward: carried_foraward, bill: invoice_details, year: invoice_year, month: invoice_month},
                    success: function (e) {
                        formReact(e);
                    },
                });
            } else {
                console.log(`modal was dismissed by ${result.dismiss}`);
            }
        });
    });
    $("body").on("submit", ".modalForm", function (event) {
        var details = new FormData($(this)[0]);
        $.ajax({
            url: "/ajax/modal/" + $(this).attr("action"),
            type: "POST",
            data: details,
            cache: false,
            contentType: false,
            processData: false,
            success: function (e) {
                $("#DimModal").modal("show");
                $("#DimModal").find(".modal-content").html(e);
                reloadFunctions();
            },
        });
        return false;
        /* Act on the event */
    });
    $("body").on("change", "[change-properity]", function (event) {
        var cid = $(this).data("item-id");
        var caction = $(this).data("action");
        var thisSwitch = $(this);
        var propVal = 0;
        if ($(this).prop("checked")) {
            propVal = 1;
        } else {
            propVal = 0;
        }
        $.ajax({
            url: "/ajax/actions",
            type: "POST",
            data: {actionName: "CHANGE_STATUS_X001", actionType: caction, id: cid, value: propVal},
            success: function (e) {
                formReact(e, thisSwitch);
            },
        });
        return false;
        /* Act on the event */
    });
    $("body").on("change", "#is_ls, .price_val, .quantity_val, .vat_val, .discount_val", function () {
        var price = $(".price_val").val() * 1;
        var quantity = $(".quantity_val").val() * 1;
        var vat = $(".vat_val").val() / 100 + 1;
        var discount = $(".discount_val").val() * 1;
        var grand_total = price;
        if ($("#is_ls").prop("checked")) {
            grand_total = price;
        } else {
            grand_total = price * quantity;
        }
        $("#grand_total").html(grand_total);
        $("#vat_text").html($(".vat_val").val());
        $("#discount_text").html(discount * 1);
        $("#net_amount").html((grand_total - discount) * vat);
    });
    $("body").on("click", "[print]", function () {
        var toPrint = $(this).attr("print");
        var dir = $(this).attr("print-dir");
        $(toPrint).print({
            doctype: "<!doctype html>",
        });
    });
    $("body").on("click", ".CPB", function (event) {
        var thisHref = $(this).attr("href");
        history.pushState("", "", thisHref);
        $.ajax({
            url: "/ajax" + thisHref,
            type: "POST",
            data: {x: 0},
            success: function (e) {
                if (isJSON(e)) {
                    formReact(e);
                } else {
                    $("main").html(e);
                    reloadFunctions();
                }
                $("body").removeClass("opened");
            },
        });
        event.preventDefault();
        /* Act on the event */
    });
    if (window.history && window.history.pushState) {
        $(window).on("popstate", function () {
            $.ajax({
                url: "/ajax" + window.location.pathname,
                type: "POST",
                data: {x: 0},
                success: function (e) {
                    if (isJSON(e)) {
                        formReact(e);
                    } else {
                        $("main").html(e);
                        reloadFunctions();
                    }
                    $("body").removeClass("opened");
                },
            });
        });
    }
    $("body").on("click", ".DIM", function (event) {
        var actionName = $(this).attr("actionName");
        var actionItem = $(this).attr("actionItem");
        $.ajax({
            url: "/ajax/modal/" + actionName + "/" + actionItem,
            type: "POST",
            data: {x: 0},
            success: function (e) {
                $("#dim-modal").modal("show");
                $("#dim-modal").find(".modal-content").html(e);
                reloadFunctions();
            },
        });
        event.preventDefault();
        /* Act on the event */
    });
    $("body").on("click", ".CONF", function (event) {
        var el = $(this);
        swal.fire({
            title: "Are you sure?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            closeOnConfirm: false,
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url: "/ajax/actions",
                    type: "POST",
                    data: {actionName: "CONF_X001", actionType: el.data("action"), id: el.data("item-id")},
                    success: function (e) {
                        formReact(e);
                    },
                });
            }
        });
        return false;
        /* Act on the event */
    });
    $("body").on("click", "[request]", function (event) {
        var el = $(this);
        var actionName = el.data("action-name");
        var actionItem = el.data("action-item");
        var message = el.data("message");
        swal.fire({
            title: "تأكيد طلب",
            text: message,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "موافق",
            cancelButtonText: "غير موافق",
            closeOnConfirm: false,
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url: "/ajax/actions",
                    type: "POST",
                    data: {actionName: "REQUEST", actionType: actionName, id: actionItem},
                    success: function (e) {
                        formReact(e);
                    },
                });
            }
        });
        return false;
        /* Act on the event */
    });
    $("body").on("click", ".CPDB", function (event) {
        var el = $(this);
        swal.fire({
            title: "Are you sure?",
            text: "You will not be able to recover this file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false,
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url: "/ajax/actions",
                    type: "POST",
                    data: {actionName: "DELETE_X001", actionType: el.data("action"), id: el.data("item-id")},
                    success: function (e) {
                        formReact(e);
                    },
                });
            }
        });
        return false;
        /* Act on the event */
    });
    $("body").on("click", ".changeLang", function (event) {
        var thisHref = $(this).attr("href");
        $.ajax({
            url: thisHref,
            type: "POST",
            data: {x: 0},
            success: function (e) {
                formReact(e);
            },
        });
        return false;
        /* Act on the event */
    });
    //alert(window.location.pathname);
    $("body").on("click", ".navbar-open", function (event) {
        $("body").addClass("opened");
        return false;
        /* Act on the event */
    });
    $("body").on("click", "header .nav-cover", function (event) {
        $("body").removeClass("opened");
        return false;
        /* Act on the event */
    });
    $("body.ar.opened").on("swiperight", function () {
        $("body").removeClass("opened");
    });
    $("body.en.opened").on("swipeleft", function () {
        $("body").removeClass("opened");
    });
    $("body").on("click", ".side-nav li.hasChild", function (event) {
        if ($(this).hasClass("opened")) {
            $(this).removeClass("opened");
        } else {
            $(this).addClass("opened");
        }

        /* Act on the event */
    });
    $("body").on("click", "[element-for-copy]", function (event) {
        var elementForCopy = $($(this).attr("element-for-copy"));
        var copyTo = $($(this).attr("copy-to"));
        elementForCopy.clone().appendTo(copyTo);
        return false;
        /* Act on the event */
    });
    $("body").on("click", "[delete-this]", function (event) {
        var elementForDelete = $(this).parents($(this).attr("delete-this")).remove();
        return false;
        /* Act on the event */
    });
    $("body").on("change", "[set-options]", function (event) {
        var id = $(this).val();
        var caction = $(this).attr("action");
        var celement = $(this).attr("set-for");
        celement = $("select" + celement);
        $.ajax({
            url: "/ajax/getOptionsData",
            type: "POST",
            data: {actionType: caction, determiner: id},
            success: function (e) {
                formReact(e, $(celement));
            },
        });
        return false;
        /* Act on the event */
    });
    $("body").on("keyup", "[comparison]", function (event) {
        var thisValue = $(this).val();
        var comparisonValue = $(this).attr("comparison");
        if (comparisonValue - thisValue < 0) {
            $(this).addClass("red-text");
        } else {
            $(this).removeClass("red-text");
        }
        return false;
        /* Act on the event */
    });

    $("body").on("keydown", ".onlyNumber", function (e) {
        var unicode = e.keyCode ? e.keyCode : e.charCode;
        if ((unicode >= 48 && unicode <= 57) || unicode == 8 || unicode == 190 || $.inArray(unicode, [46, 8, 9, 27, 13, 110, 190]) !== -1 || unicode == 190 || (e.keyCode >= 35 && e.keyCode <= 40)) {
        } else {
            e.preventDefault();
        }
        /* Act on the event */
    });
    $("body").on("click", "[modal]", function (event) {
        var modal = $(this).attr("modal");
        $(modal).modal("show");
        event.preventDefault();
        /* Act on the event */
    });
    $("body").on("change", "[offer-active]", function (event) {
        $(".category").attr("disabled", "");
        $(this).parents(".categoryP.active").find(".category").removeAttr("disabled");
        var inputToBeDisabled = ".quantity, .unit_price";
        var selectToBeDisabled = "select.model, select.unit";
        $(".modal .total_price").attr("disabled", "").val(0);
        $(".modal " + inputToBeDisabled)
            .attr("disabled", "")
            .val(0);
        $(".modal " + selectToBeDisabled)
            .attr("disabled", "")
            .material_select();
        $(this).parents(".item").find(inputToBeDisabled).removeAttr("disabled").val("");
        $(this).parents(".item").find(selectToBeDisabled).removeAttr("disabled").material_select();
        event.preventDefault();
        /* Act on the event */
    });
    var action;
    var itemId;
    $("body").on("click", ".sendRequest", function (event) {
        $(".confirmRequestModal").modal("show");
        action = $(this).attr("action");
        itemId = $(this).attr("item-id");
        /* Act on the event */
    });
    $("body").on("click", ".confirmRequestModal .confirm", function (event) {
        $.ajax({
            url: "/ajax/actions",
            type: "POST",
            data: {actionName: "SEND_REQUEST_001", actionType: action, id: itemId},
            success: function (e) {
                formReact(e);
                action = "";
                itemId = 0;
            },
        });
    });
    $("body").on("click", ".confirmRequestModal .disconfirm", function (event) {
        action = "";
        itemId = 0;
        $(".confirmRequestModal").modal("close");
    });
    var fileNum = 1;
    $("body").on("change", ".files", function (event) {
        $(this).each(function (index, el) {
            jQuery.each(this.files, function (i, file) {
                var data = new FormData();
                var newClass = "file" + fileNum;
                data.append("actionName", "UPLOAD_CENTER_X001");
                data.append("actionType", "1");
                data.append("file", file);
                data.append("element", "." + newClass);
                $.ajax({
                    url: "/ajax/actions",
                    type: "POST",
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (e) {
                        formReact(e);
                    },
                });
                $(".uploadModal .filesDiv").prepend(
                    '<div class="file item uploading ' +
                        newClass +
                        ' tooltipped" data-position="top" data-delay="50" data-tooltip="' +
                        file.name +
                        '" ><div class="display center-align" ><h4></h4></div><div class="options"><a class="btn cpanel-color waves-effect waves-light fileUrl" target="_blank"><i class="fa fa-link" aria-hidden="true"></i></a><a class="btn cpanel-color waves-effect waves-light CPDB fileDelete" action="UPLOAD_CENTER_X001" ><i class="fa fa-close" aria-hidden="true"></i></a></div></div>',
                );
                $(".material-tooltip").remove();
                $(".tooltipped").tooltip({delay: 50});
                ++fileNum;
            });
        });
        $(this).val("");
        /* Act on the event */
    });
    /*$('body').on('focus', '.getFile', function(event) {
		if(!$(this).val()){
			$(this).addClass('inputToAddFile');
			$('.uploadModal').addClass('timeToSelectFile').openModal({
				complete : function(){
					$('.uploadModal').removeClass('timeToSelectFile');
					$('.inputToAddFile').removeClass('inputToAddFile');
				}
			});
		}
		event.preventDefault();
	}); */
    $("body").on("dblclick", ".getFile", function (event) {
        $(this).addClass("inputToAddFile");
        $(".uploadModal")
            .addClass("timeToSelectFile")
            .modal({
                complete: function () {
                    $(".uploadModal").removeClass("timeToSelectFile");
                    $(".inputToAddFile").removeClass("inputToAddFile");
                },
            })
            .modal("show");
        event.preventDefault();
        /* Act on the event */
    });
    $("body").on("click", ".upload", function (event) {
        $(".uploadModal").modal("show");
        /* Act on the event */
    });
    $("body").on("click", ".uploadModal.timeToSelectFile .file", function (event) {
        var url = $(this).find(".fileUrl").attr("href");
        $(".inputToAddFile").val(url).removeClass("inputToAddFile").focus();
        $(".uploadModal.timeToSelectFile").removeClass("timeToSelectFile").modal("close");
        event.preventDefault();
        /* Act on the event */
    });
    $("body").on("click", "[show]", function (event) {
        var el = $(this).attr("show");
        $(el).removeClass("hide");
        event.preventDefault();
        /* Act on the event */
    });
    $("body").on("click", "[hide]", function (event) {
        var el = $(this).attr("hide");
        $(el).addClass("hide");
        event.preventDefault();
        /* Act on the event */
    });
    $("body").on("click", "[disable]", function (event) {
        var el = $(this).attr("disable");
        $(el).attr("disabled", "");
        event.preventDefault();
        /* Act on the event */
    });
    $("body").on("click", "[enable]", function (event) {
        var el = $(this).attr("enable");
        $(el).removeAttr("disabled");
        event.preventDefault();
        /* Act on the event */
    });
    $("body").on("click", "[reloadFunctions]", function (event) {
        reloadFunctions();
    });
    $("body").on("keyup", "input, textarea", function (event) {
        var isArabic = /^([\u0600-\u06ff]|[\u0750-\u077f]|[\ufb50-\ufbc1]|[\ufbd3-\ufd3f]|[\ufd50-\ufd8f]|[\ufd92-\ufdc7]|[\ufe70-\ufefc]|[\ufdf0-\ufdfd]|[ ])*$/g;
        var firstChart = $(this).val().charAt(0);
        var el = $(this);
        if (isArabic.test($.trim(firstChart))) {
            el.attr("dir", "rtl");
        } else {
            el.attr("dir", "ltr");
        }
        /* Act on the event */
    });
    $("body").on("click", ".uploadPagination", function (event) {
        var button = $(this);
        var pageNum = $(this).data("page");
        $.ajax({
            url: "/ajax/loadFiles",
            type: "POST",
            data: {page: pageNum},
            success: function (e) {
                $(".filesDiv").html(e);
                $(".material-tooltip").remove();
                $(".tooltipped").tooltip({delay: 50});
                $(".uploadPagination").removeClass("cpanel-color").addClass("grey");
                button.removeClass("grey").addClass("cpanel-color");
            },
        });
        event.preventDefault();
        /* Act on the event */
    });
    $("body").on("change", "#confirm-realestate-user", function (event) {
        var input = $(this);
        $.ajax({
            url: "/ajax/actions",
            type: "POST",
            data: {actionName: "REALESTATE_X317", actionType: "confirm", properity: input.data("realestate"), user: input.val()},
            success: function (e) {
                formReact(e);
            },
        });
        event.preventDefault();
        /* Act on the event */
    });
    $("body").on("click", ".upload-photo", function () {
        var action = $(this).data("action");
        var item = $(this).data("item");
        var container = $(this).data("container");
        $("form.upload-photo-form input.actionType").val(action);
        $("form.upload-photo-form input.id").val(item);
        $("form.upload-photo-form input.container").val(container);
        $("form.upload-photo-form input.photos").click();
    });
    $("body").on("change", "form.upload-photo-form .photos", function (event) {
        var action = $(this).siblings(".actionType").val();
        var item = $(this).siblings(".id").val();
        var container = $(this).siblings(".container").val();
        $(this).each(function (index, el) {
            jQuery.each(this.files, function (i, file) {
                var data = new FormData();
                var newId = "file-" + fileNum;
                data.append("actionName", "UPLOAD_PHOTO");
                data.append("actionType", action);
                data.append("file", file);
                data.append("id", item);
                data.append("container", container);
                data.append("element", "#" + newId);
                $.ajax({
                    url: "/ajax/actions",
                    type: "POST",
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (e) {
                        formReact(e);
                    },
                });
                $(container).prepend(
                    '<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">\n' +
                        '            <div class="white-box">\n' +
                        '                <div class="el-card-item">\n' +
                        '                    <div class="el-card-avatar el-overlay-1" id="' +
                        newId +
                        '">\n' +
                        '                        <img src="/css/lg.cloudy-sky-preloader.gif">\n' +
                        '                        <div class="el-overlay">\n' +
                        '                            <ul class="el-info">\n' +
                        '                                <li><a class="btn default btn-outline image-popup" href=""><i class="icon-magnifier"></i></a></li>\n' +
                        "                            </ul>\n" +
                        "                        </div>\n" +
                        "                    </div>\n" +
                        "                </div>\n" +
                        "            </div>\n" +
                        "        </div>",
                );
                ++fileNum;
            });
        });
        $(".image-popup").magnificPopup({
            type: "image",
        });
        $(this).val("");
        /* Act on the event */
    });
    $("body").on("mouseover", ".item .fa-image", function (event) {
        $(this).append('<div class="image" ></div>');
        var input = $(this).parents(".item");
        var image = input.find("input[type=text]").val();
        $(this)
            .find(".image")
            .css("background-image", "url(" + image + ")");
        event.preventDefault();
        /* Act on the event */
    });
    $("body").on("click", "[data-file]", function (event) {
        var dummy = document.createElement("input");
        document.body.appendChild(dummy);
        dummy.setAttribute("id", "dummy_id");
        document.getElementById("dummy_id").value = $(this).data("file");
        dummy.select();
        document.execCommand("copy");
        document.body.removeChild(dummy);
        swal.fire({
            title: "File Name Copied to Clipboard",
            type: "success",
            showConfirmButton: false,
            timer: 1000,
        });
        event.preventDefault();
        /* Act on the event */
    });
    $("body").on("click", "[message-present]", function (event) {
        var el = $(this);
        swal.fire({
            type: el.data("type"),
            title: el.data("message"),
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Done",
            closeOnConfirm: false,
        });
        event.preventDefault();
        /* Act on the event */
    });
    $("body").on("click", "[data-download-file]", function (event) {
        var file = $(this).data("download-file");
        var downloadType = $(this).data("type");
        $.ajax({
            url: "/ajax/actions/download-files",
            type: "POST",
            data: {file_id: file, download_type: downloadType},
            success: function (e) {
                if (e != "") {
                    formReact(e);
                }
            },
        });
        event.preventDefault();
        /* Act on the event */
    });
    $("body").on("click", "[data-download-item]", function (event) {
        var file = $(this).data("download-item");
        $.ajax({
            url: "/ajax/actions/download",
            type: "POST",
            data: {file_name: file},
            success: function (e) {
                if (e != "") {
                    formReact(e);
                }
            },
        });
        event.preventDefault();
        /* Act on the event */
    });
    $("body").on("click", "[data-download-tanslated-item]", function (event) {
        var file = $(this).data("download-tanslated-item");
        alert(file);
        $.ajax({
            url: "/ajax/actions/download_translated_file",
            type: "POST",
            data: {file_name: file},
            success: function (e) {
                if (e != "") {
                    formReact(e);
                }
            },
        });
        event.preventDefault();
        /* Act on the event */
    });
    $("body").on("click", "[data-download-translate-item]", function (event) {
        var file = $(this).data("download-translate-item");
        $.ajax({
            url: "/ajax/actions/download_translate_file",
            type: "POST",
            data: {file_name: file},
            success: function (e) {
                if (e != "") {
                    formReact(e);
                }
            },
        });
        event.preventDefault();
        /* Act on the event */
    });
    $("body").on("click", "[data-file-upload]", function (event) {
        var file_name = $(this).data("file-upload");
        $("#upload-tarnslated-file-modal").modal("show");
        $("#file-code").val(file_name);
        event.preventDefault();
        /* Act on the event */
    });
    $("body").on("click", ".notify_element", function (event) {
        var notification_id = $(this).data("id");
        $.ajax({
            url: "/ajax/actions",
            type: "POST",
            data: {actionName: "viewNotification", id: notification_id},
            success: function (e) {
                if (e != "") {
                    formReact(e);
                }
            },
        });
        /* Act on the event */
    });
    var donate_counter = function () {
        $.ajax({
            url: "/ajax/actions",
            type: "POST",
            data: {actionName: "SEND_REQUEST_001", actionType: "REFRESH_COUNTER_STATUS"},
            success: function (e) {
                if (e > 0) {
                    $(".donate_counter").removeClass("hide").html(e);
                } else {
                    $(".donate_counter").addClass("hide").html("0");
                }
            },
        });
        setTimeout(donate_counter, 5000);
    };
    var update_login_status = function () {
        $.ajax({
            url: "/ajax/actions",
            type: "POST",
            data: {actionName: "USERS_STATUS", actionType: "UPDATE_MY_STATUS"},
            success: function (e) {},
        });
        setTimeout(update_login_status, 20000);
    };
    //update_login_status();
    //donate_counter();
    reloadFunctions();
    var login_counter2 = 1500;
    var alertViewed = false;
    var allowUpdateSession = true;
    // if($('#signing-out-modal').length){
    //     var login_counter_process2 = setInterval(function () {
    //         if(login_counter2 >= 0) {
    //             login_counter2--;
    //             $('.counter-b').html(login_counter2);
    //             alertViewed = false;
    //         }else{
    //             if(!alertViewed) {
    //                 alertViewed = true;
    //                 allowUpdateSession = false;
    //                 swal.fire({
    //                     title: "Login warning!",
    //                     html: 'Session will end in <strong></strong> minutes.',
    //                     type: "warning",
    //                     timer: 300 * 1000,
    //                     confirmButtonColor: "#DD6B55",
    //                     confirmButtonText: "Cancel",
    //                     closeOnConfirm: false,
    //                     allowOutsideClick: false,
    //                     onBeforeOpen: () => {
    //                         timerInterval = setInterval(() => {
    //                             seconds = Math.round(Swal.getTimerLeft() / 1000);
    //                             Swal.getContent().querySelector('strong').textContent = Math.floor(seconds / 60) + ":" + (seconds % 60);
    //                              if(Swal.getTimerLeft() <= 1000){
    //                                  window.location = '/logout';
    //                                  Swal.stopTimer();
    //                              }
    //                         }, 100)
    //                     },
    //                     onClose: () => {
    //                         clearInterval(timerInterval);
    //                     }
    //                 }).then(function (result) {
    //                     if (result.value) {
    //                         allowUpdateSession = true;
    //                     }
    //                 });
    //             }
    //             login_notification_audio.play();
    //         }
    //     }, 1000);
    // }
    // $("body").on("click keypress", function (event) {
    //     if (allowUpdateSession) {
    //         $.ajax({
    //             url: "/ajax/actions",
    //             type: "POST",
    //             data: {actionName: "UPDATE_SESSION"},
    //             success: function (e) {
    //                 formReact(e);
    //             },
    //         });
    //         allowUpdateSession = false;
    //         setTimeout(function () {
    //             allowUpdateSession = true;
    //         }, 5000);
    //         if (login_counter2 >= 0) {
    //             login_counter2 = 1500;
    //         } else {
    //             login_counter2 = 1500;
    //         }
    //     }
    //     /* Act on the event */
    // });
    $.ajax({
        url: "/ajax/actions",
        type: "POST",
        data: {actionName: "UPDATE_SESSION"},
        success: function (e) {
            formReact(e);
        },
    });
    var notifications_checker = function () {
        $.ajax({
            url: "/ajax/actions",
            type: "POST",
            data: {actionName: "getNotifications"},
            success: function (e) {
                formReact(e);
            },
        });
        setTimeout(notifications_checker, 5000);
    };
    //notifications_checker();
    var online_users_checker = function () {
        $.ajax({
            url: "/ajax/actions",
            type: "POST",
            data: {actionName: "USERS_STATUS", actionType: "ONLINE_USERS"},
            success: function (e) {
                $(".online_users_item").remove();
                var json = JSON.parse(e);
                $.each(json, function (index, status) {
                    $(".online_users_list").append('<li class="online_users_item" ><div class="message-center"><a href="#"><div class="user-img"><img src="' + status.avatar + '" alt="user" class="img-circle"><span class="profile-status ' + status.status + ' pull-right"></span></div><div class="mail-contnet"><h5>' + status.name + '</h5><span class="mail-desc">' + status.email + '</span><span class="time">' + status.status + "</span></div></a></div></li>");
                });
            },
        });
        setTimeout(online_users_checker, 20000);
    };
    //online_users_checker();
    var get_updates = function () {
        $.ajax({
            url: "/ajax/actions",
            type: "POST",
            data: {actionName: "GET_UPDATES"},
            success: function (e) {
                if (e !== "") {
                    formReact(e);
                }
            },
        });
        setTimeout(get_updates, 20000);
    };
    // get_updates();
    $("body").on("change", "#profile_pic", function (event) {
        $(this).parents("form").submit();
        /* Act on the event */
    });
    $("body").on("change", ".upload-translated-file", function (event) {
        $(this).parents("form").submit();
    });
    $("body").on("change", "[data-translator-checkbox]", function (event) {
        var messageID = "#" + $(this).data("translator-checkbox");
        if ($(this).prop("checked") == true) {
            $(messageID).slideDown();
        } else {
            $(messageID).slideUp();
        }
        event.preventDefault();
        /* Act on the event */
    });
    $("body").on("change", ".job_quotation", function () {
        if ($(this).prop("checked") == true) {
            $(".hidden_job_quotation_ls").removeClass("hidden");
            $(".hidden_quotation_quantity").removeClass("hidden");
            $(".hidden_quotation_unit_price").removeClass("hidden");
        } else {
            $(".hidden_job_quotation_ls").addClass("hidden");
            $(".hidden_quotation_ls").addClass("hidden");
            $(".job_quotation_ls").removeAttr("checked");
            $(".hidden_quotation_quantity").addClass("hidden");
            $(".hidden_quotation_unit_price").addClass("hidden");
        }
    });
    $("body").on("change", ".job_quotation_ls", function () {
        if ($(this).prop("checked") == true) {
            $(".hidden_quotation_ls").removeClass("hidden");
            $(".hidden_quotation_quantity").addClass("hidden");
            $(".hidden_quotation_unit_price").addClass("hidden");
        } else {
            $(".hidden_quotation_ls").addClass("hidden");
            $(".hidden_quotation_quantity").removeClass("hidden");
            $(".hidden_quotation_unit_price").removeClass("hidden");
        }
    });
    $("body").on("click", "[accept-deny]", function (event) {
        $("#acceptDenyTitle").html($(this).data("title"));
        $("#acceptDenyId").val($(this).data("id"));
        $("#acceptDenyView").val($(this).data("value"));
        /* Act on the event */
    });
    $("body").on("click", ".notification_close", function () {
        $(this).parents("li").find(".notify_element").click();
        $(this).parents("li").remove();
        return false;
    });
    $("body").on("click", ".hide-all-notifications", function () {
        $.ajax({
            url: "/ajax/actions",
            type: "POST",
            data: {actionName: "viewAllNotifications"},
            success: function (e) {
                $(".dropdown-notifications").find("li").remove();
            },
        });
    });
    $("body").on("focus", ".app-search input[type=text]", function () {
        $("#search-modal").modal("show");
    });
    $("body").on("click", "#print, .print", function () {
        var areaToCopy = $(this).data("area");
        var mode = "iframe"; //popup
        var close = mode == "popup";
        var options = {
            mode: mode,
            popClose: close,
        };
        $(areaToCopy).printArea(options);
    });
    $("body").on("change", "#accounting_type", function () {
        if ($(this).val() == "translate" || $(this).val() == "review") {
            $("#price").attr("disabled", "");
        } else {
            $("#price").removeAttr("disabled");
        }
        var price = $(this).find("option:selected").data("price");
        $("#price, #price_value").val(price);
    });
    $("body").on("change", "#price", function () {
        $("#price_value").val($(this).val());
    });
});
