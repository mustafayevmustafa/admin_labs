(function ($) {
    $("#files").FancyFileUpload({
        params: {
            action: "/file-upload",
        },
        fileupload: {
            maxChunkSize: 50000000,
        },
    });

    $(".all_upload").click(function () {
        $("#files")
            .next()
            .find(".ff_fileupload_actions button.ff_fileupload_start_upload")
            .click();
        return false;
    });

    $(".ff_fileupload_remove_file").click(function () {
        var id = $(this).parents("tr").attr("id");
        $.ajax({
            type: "POST",
            url: "/upload-file-delete",
            data: {
                _token: _token,
                id: id,
            },
            success: function (response) {
                if (response.success == true) {
                    $("#" + id).fadeOut();
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: response.message,
                    });
                }
            },
        });
    });

    var category_form = $(".category_form");
    var project_id = 0;
    $("#first_category").change(function () {
        var other_categories = $("select#other_categories");
        var id = $(this).val();
        type = $(this).find("option:selected").attr("data-type");
        if (type == "audio" || type == "video") {
            $(".preview_file_section").removeClass("d-none");
            $(".main_file_row").addClass("d-none");
        }
        if (type == "theme") {
            $(".preview_file_section").addClass("d-none");
            $(".main_file_row").removeClass("d-none");
        }
        if (type == "code") {
            $(".preview_file_section").addClass("d-none");
            $(".main_file_row").removeClass("d-none");
        }
        if (type != "theme") {
            $(".demo_url_row").addClass("d-none");
            $("#layout_row").addClass("d-none");
            $("#columns_row").addClass("d-none");
            $("#documentation_row").addClass("d-none");
            $("#high_resolution_row").addClass("d-none");
            $("#browsers_row").addClass("d-none");
            $("#compatible_with_row").addClass("d-none");
        } else {
            $(".demo_url_row").removeClass("d-none");
            $("#layout_row").removeClass("d-none");
            $("#columns_row").removeClass("d-none");
            $("#documentation_row").removeClass("d-none");
            $("#high_resolution_row").removeClass("d-none");
            $("#browsers_row").removeClass("d-none");
            $("#compatible_with_row").removeClass("d-none");
        }
        if (id == 0) {
            category_form.next().addClass("d-none");
        } else {
            category_form.next().removeClass("d-none");
        }
        if (id == "" || id != 0) {
            $.ajax({
                type: "POST",
                url: "/upload-category",
                data: {
                    _token: _token,
                    id: id,
                },
                success: function (response) {
                    other_categories.html("");
                    response.other_categories.forEach((el) => {
                        var output = `<option value="${el.id}">${el.name}</option>`;
                        other_categories.append(output);
                    });
                },
            });
        }
    });

    $(".btn_send").click(function (e) {
        e.preventDefault();
        var formData = new FormData();
        var tags = $("#tags");
        var first_category = $("#first_category");
        var title = $("#title");
        var description = $("#description");
        var price = $("#pricee");
        var sale_price = $("#sale_price");
        var category_id = first_category.val();

        function getUnique(array) {
            var uniqueArray = [];
            for (i = 0; i < array.length; i++) {
                if (uniqueArray.indexOf(array[i]) === -1) {
                    uniqueArray.push(array[i]);
                }
            }
            return uniqueArray;
        }
        var morefeatures = $("input[name^=morefeatures]")
            .map(function (idx, elem) {
                return $(elem).val();
            })
            .get();
        var project_specials_key = $("input[name^=project_specials_key]")
            .map(function (idx, elem) {
                return $(elem).val();
            })
            .get();
        var project_specials_value = $("input[name^=project_specials_value]")
            .map(function (idx, elem) {
                return $(elem).val();
            })
            .get();
        var features = getUnique(morefeatures);
        var specials_key = getUnique(project_specials_key);
        var specials_value = getUnique(project_specials_value);

        var other_categories = $("select[name^=other_categories]")
            .map(function (idx, elem) {
                return $(elem).val();
            })
            .get();
        var browsers = $("select[name^=browsers]")
            .map(function (idx, elem) {
                return $(elem).val();
            })
            .get();

        var high_resolution = $("input[name='high_resolution']:checked");
        var documentation = $("input[name='documentation']:checked");
        var layout = $("#layout");
        var columns = $("#columns");
        var preview_image = $("#preview_image");
        var preview_file = $("#preview_file");
        var main_file = $("#main_file");
        var demo_url = $("#demo_url");
        var compatible_with = $("select[name^=compatible_with]")
            .map(function (idx, elem) {
                return $(elem).val();
            })
            .get();
        if (type == "audio") {
            if ($("#preview_file").val() == "0") {
                $("#preview_file").addClass("is-invalid");
            }
        }
        if (title.val() == "") {
            title.addClass("is-invalid");
        }
        if (description.val() == "") {
            $("#description").attr("style", "border-color: red !important");
            description.addClass("is-invalid");
        }
        if (sale_price.val() == "") {
            sale_price.addClass("is-invalid");
        }
        if (first_category.val() == "") {
            first_category.addClass("is-invalid");
        }
        if (preview_image.val() == 0) {
            $("#preview_image ").addClass("is-invalid");
        }

        if (tags.val() == "") {
            $(".bootstrap-tagsinput").attr(
                "style",
                "border-color: red !important"
            );
        }
        if (other_categories.length == 0) {
            $("select[name^=other_categories]")
                .next()
                .find(".select2-selection--multiple")
                .attr("style", "border-color: red !important");
        }
        if (type == "audio") {
            if (
                title.val() != "" &&
                sale_price.val() != "" &&
                first_category.val() != "" &&
                tags.tagsinput("items") != [] &&
                other_categories != [] &&
                $("#preview_file").val() != 0 &&
                description.val() != ""
            ) {
                ajax_form();
            }
        }
        if (type == "video") {
            if (
                title.val() != "" &&
                sale_price.val() != "" &&
                first_category.val() != "" &&
                tags.tagsinput("items") != [] &&
                other_categories != [] &&
                $("#preview_file").val() != 0 &&
                description.val() != ""
            ) {
                ajax_form();
            }
        }
        if (type != "audio" && type != "video") {
            if (main_file.val() == 0) {
                $("#main_file ").addClass("is-invalid");
                return false;
            }
            if (
                title.val() != "" &&
                sale_price.val() != "" &&
                first_category.val() != "" &&
                tags.tagsinput("items") != [] &&
                other_categories != [] &&
                main_file.val() != 0 &&
                description.val() != ""
            ) {
                ajax_form();
            }
        }
        function ajax_form() {
            formData.append("_token", _token);
            formData.append("title", title.val());
            formData.append("description", description.val());
            formData.append("price", price.val());
            formData.append("sale_price", sale_price.val());
            formData.append("first_category", first_category.val());
            formData.append("tags", tags.tagsinput("items"));
            formData.append("browsers", browsers);
            formData.append("other_categories", other_categories);
            formData.append("compatible_with", compatible_with);
            formData.append("features", features);
            formData.append("project_specials[]", [
                specials_key,
                specials_value,
            ]);
            formData.append("layout_id", layout.val());
            formData.append("demo_url", demo_url.val());
            formData.append("columns", columns.val());
            formData.append("high_resolution", high_resolution.val());
            formData.append("documentation", documentation.val());

            formData.append(
                "preview_image",
                document.querySelector("#preview_image").files[0]
            );
            formData.append(
                "preview_file",
                document.querySelector("#preview_file").files[0]
            );
            formData.append(
                "main_file",
                document.querySelector("#main_file").files[0]
            );
            // formData.append("preview_image", preview_image[0].files[0]);
            // formData.append("preview_file", preview_file[0].files[0]);
            // formData.append("main_file", main_file[0].files[0]);
            $.ajax({
                type: "POST",
                url: "/store-upload2",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.success == true) {
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Your work has been saved",
                            showConfirmButton: false,
                            timer: 1500,
                        });
                        setTimeout(function () {
                            window.location.href = "/projects";
                        });
                    }
                },
            });
        }
    });
})(jQuery);
