(function ($) {
    var type = category_type;
    // console.log($("#tags").val());
    defaultField(type);
    categoryField(category_id);
    function defaultField(type) {
        if (type == "audio" || type == "video") {
            $("#pre_image").removeClass("d-none");
            $("#upload_image_container").removeClass("d-flex");
            $("#upload_image_container").addClass("d-none");
            $(".preview_file_section").removeClass("d-none");
            $(".main_file_row").addClass("d-none");
            $(".images_row").addClass("d-none");
            $("#famous_man_row").addClass("d-none");
            $("#pbr_row").addClass("d-none");
            $("#uv_layers_row").addClass("d-none");
            $("#vertex_color_row").addClass("d-none");
            $("#rigged_geometries_row").addClass("d-none");
            $("#scale_transformations_row").addClass("d-none");
            $("#geometry_row").addClass("d-none");
            $("#animation_textures_row").addClass("d-none");
            $("#vertices_materials_row").addClass("d-none");
            $("#morph_geometry_row").addClass("d-none");

        }
        if (type == "theme") {
            $("#pre_image").removeClass("d-none");
            $("#upload_image_container").removeClass("d-flex");
            $("#upload_image_container").addClass("d-none");
            $(".preview_file_section").addClass("d-none");
            $(".main_file_row").removeClass("d-none");
            $(".images_row").removeClass("d-none");
            $("#layout_row").addClass("d-none");
            $("#columns_row").addClass("d-none");
            $("#documentation_row").addClass("d-none");
            $("#high_resolution_row").addClass("d-none");
            $("#browsers_row").addClass("d-none");
            $("#compatible_with_row").removeClass("d-none");
            $("#famous_man_row").addClass("d-none");
            $("#pbr_row").addClass("d-none");
            $("#uv_layers_row").addClass("d-none");
            $("#vertex_color_row").addClass("d-none");
            $("#rigged_geometries_row").addClass("d-none");
            $("#scale_transformations_row").addClass("d-none");
            $("#geometry_row").addClass("d-none");
            $("#animation_textures_row").addClass("d-none");
            $("#vertices_materials_row").addClass("d-none");
            $("#morph_geometry_row").addClass("d-none");

        }
        if (type == "3D") {
            $("#pre_image").removeClass("d-none");
            $("#upload_image_container").removeClass("d-flex");
            $("#upload_image_container").addClass("d-none");
            $(".preview_file_section").addClass("d-none");
            $(".main_file_row").removeClass("d-none");
            $(".images_row").removeClass("d-none");
            $("#layout_row").addClass("d-none");
            $("#columns_row").addClass("d-none");
            $("#documentation_row").addClass("d-none");
            $("#high_resolution_row").addClass("d-none");
            $("#browsers_row").addClass("d-none");
            $("#compatible_with_row").addClass("d-none")
            $("#famous_man_row").addClass("d-none");
            $("#pbr_row").removeClass("d-none");
            $("#uv_layers_row").removeClass("d-none");
            $("#vertex_color_row").removeClass("d-none");
            $("#rigged_geometries_row").removeClass("d-none");
            $("#scale_transformations_row").removeClass("d-none");
            $("#geometry_row").removeClass("d-none");
            $("#animation_textures_row").removeClass("d-none");
            $("#vertices_materials_row").removeClass("d-none");
            $("#morph_geometry_row").removeClass("d-none");

        }
        if (type == "photo") {
            $("#pre_image").removeClass("d-none");
            $("#upload_image_container").removeClass("d-flex");
            $("#upload_image_container").addClass("d-none");
            $(".preview_file_section").addClass("d-none");
            $(".main_file_row").addClass("d-none");
            $(".images_row").addClass("d-none");
            $("#layout_row").addClass("d-none");
            $("#columns_row").addClass("d-none");
            $("#documentation_row").addClass("d-none");
            $("#high_resolution_row").addClass("d-none");
            $("#browsers_row").addClass("d-none");
            $("#compatible_with_row").addClass("d-none")
            $("#famous_man_row").removeClass("d-none");
            $("#pbr_row").addClass("d-none");
            $("#uv_layers_row").addClass("d-none");
            $("#vertex_color_row").addClass("d-none");
            $("#rigged_geometries_row").addClass("d-none");
            $("#scale_transformations_row").addClass("d-none");
            $("#geometry_row").addClass("d-none");
            $("#animation_textures_row").addClass("d-none");
            $("#vertices_materials_row").addClass("d-none");
            $("#morph_geometry_row").addClass("d-none");
        }
        if (type == "icon") {
            $(".preview_file_section").addClass("d-none");
            $("#pre_image").addClass("d-none");
            $("#upload_image_container").addClass("d-flex");
            $("#upload_image_container").removeClass("d-none");
            $(".preview").addClass("d-none");
            $(".main_file_row").addClass("d-none");
            $(".images_row").addClass("d-none");
            $("#layout_row").addClass("d-none");
            $("#columns_row").addClass("d-none");
            $("#documentation_row").addClass("d-none");
            $("#high_resolution_row").addClass("d-none");
            $("#browsers_row").addClass("d-none");
            $("#compatible_with_row").addClass("d-none")
            $("#famous_man_row").addClass("d-none");
            $("#pbr_row").addClass("d-none");
            $("#uv_layers_row").addClass("d-none");
            $("#vertex_color_row").addClass("d-none");
            $("#rigged_geometries_row").addClass("d-none");
            $("#scale_transformations_row").addClass("d-none");
            $("#geometry_row").addClass("d-none");
            $("#animation_textures_row").addClass("d-none");
            $("#vertices_materials_row").addClass("d-none");
            $("#morph_geometry_row").addClass("d-none");
        }

        if (type == "code") {
            $("#pre_image").removeClass("d-none");
            $("#upload_image_container").removeClass("d-flex");
            $("#upload_image_container").addClass("d-none");
            $(".preview_file_section").addClass("d-none");
            $(".main_file_row").removeClass("d-none");
            $(".images_row").removeClass("d-none");
            $(".demo_url_row").removeClass("d-none");
            $("#layout_row").removeClass("d-none");
            $("#columns_row").removeClass("d-none");
            $("#documentation_row").removeClass("d-none");
            $("#high_resolution_row").removeClass("d-none");
            $("#browsers_row").removeClass("d-none");
            $("#compatible_with_row").removeClass("d-none");
            $("#famous_man_row").addClass("d-none");
            $("#pbr_row").addClass("d-none");
            $("#uv_layers_row").addClass("d-none");
            $("#vertex_color_row").addClass("d-none");
            $("#rigged_geometries_row").addClass("d-none");
            $("#scale_transformations_row").addClass("d-none");
            $("#geometry_row").addClass("d-none");
            $("#animation_textures_row").addClass("d-none");
            $("#vertices_materials_row").addClass("d-none");
            $("#morph_geometry_row").addClass("d-none");

        }
        if (type != "code") {
            $(".demo_url_row").addClass("d-none");
            $("#layout_row").addClass("d-none");
            $("#columns_row").addClass("d-none");
            $("#documentation_row").addClass("d-none");
            $("#high_resolution_row").addClass("d-none");
            $("#browsers_row").addClass("d-none");
            // $("#compatible_with_row").removeClass("d-none");

        }
        else {
            $(".demo_url_row").removeClass("d-none");
            $("#layout_row").removeClass("d-none");
            $("#columns_row").removeClass("d-none");
            $("#documentation_row").removeClass("d-none");
            $("#high_resolution_row").removeClass("d-none");
            $("#browsers_row").removeClass("d-none");
            $("#compatible_with_row").removeClass("d-none");
            $("#famous_man_row").addClass("d-none");
            $("#pbr_row").addClass("d-none");
            $("#uv_layers_row").addClass("d-none");
            $("#vertex_color_row").addClass("d-none");
            $("#rigged_geometries_row").addClass("d-none");
            $("#scale_transformations_row").addClass("d-none");
            $("#geometry_row").addClass("d-none");
            $("#animation_textures_row").addClass("d-none");
            $("#vertices_materials_row").addClass("d-none");
            $("#morph_geometry_row").addClass("d-none");

        }
    }
    function categoryField(id) {
        var result = other_categories_id.split(",");
        var other_categories = $("select#other_categories");
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
                    var output = "";
                    result.forEach((sub) => {
                        output += `<option value="${el.id}"  ${
                            el.id == sub ? "selected" : ""
                        }>${el.name}</option>`;
                    });
                    other_categories.append(output);
                });
            },
        });
    }
    var category_form = $(".category_form");
    $("#first_category").change(function () {
        var id = $(this).val();
        type = $(this).find("option:selected").attr("data-type");
        defaultField(type);
        if (id == 0) {
            category_form.next().addClass("d-none");
        } else {
            category_form.next().removeClass("d-none");
        }
        if (id == "" || id != 0) {
            categoryField(id);
        }
    });

    $(".btn_send").click(function (e) {
        e.preventDefault();
        $(this).prop("disabled", true);
        var tags = $("#tags");
        var first_category = $("#first_category");
        var title = $("#title");
        var description = $("#description");
        var price = $("#pricee");
        var sale_price = $("#sale_price");
        btnLoading(1, $(".btn_send"));
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
            btnLoading(0, $(".btn_send"));
            $(this).prop("disabled", false);
        }
        if (description.summernote("code") == "") {
            $("#description").attr("style", "border-color: red !important");
            description.addClass("is-invalid");
            btnLoading(0, $(".btn_send"));
            $(this).prop("disabled", false);
        }
        if (sale_price.val() == "") {
            sale_price.addClass("is-invalid");
            btnLoading(0, $(".btn_send"));
            $(this).prop("disabled", false);
        }
        if (first_category.val() == "") {
            first_category.addClass("is-invalid");
            btnLoading(0, $(".btn_send"));
            $(this).prop("disabled", false);
        }
        if (preview_image.val() == 0) {
            $("#preview_image ").addClass("is-invalid");
            btnLoading(0, $(".btn_send"));
            $(this).prop("disabled", false);
        }

        if (tags.val() == "") {
            $(".bootstrap-tagsinput").attr(
                "style",
                "border-color: red !important"
            );
            btnLoading(0, $(".btn_send"));
            $(this).prop("disabled", false);
        }
        if (other_categories.length == 0) {
            $("select[name^=other_categories]")
                .next()
                .find(".select2-selection--multiple")
                .attr("style", "border-color: red !important");
            btnLoading(0, $(".btn_send"));
            $(this).prop("disabled", false);
        }
        if (type == "audio") {
            if (
                title.val() != "" &&
                sale_price.val() != "" &&
                first_category.val() != "" &&
                tags.tagsinput("items") != [] &&
                other_categories != [] &&
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
                description.val() != ""
            ) {
                ajax_form();
            }
        }
        if (type != "audio" && type != "video") {
            if (
                title.val() != "" &&
                sale_price.val() != "" &&
                first_category.val() != "" &&
                tags.tagsinput("items") != [] &&
                other_categories != [] &&
                description.val() != ""
            ) {
                ajax_form();
            }
        }
        function ajax_form() {
            var formData = new FormData();
            console.log(description.summernote("code"));
            formData.append("_token", _token);
            formData.append("id", project_id);
            formData.append("title", title.val());
            formData.append("description", description.summernote("code"));
            formData.append("price", price.val());
            formData.append("sale_price", sale_price.val());
            formData.append("first_category", first_category.val());
            formData.append("tags", tags.tagsinput("items"));
            formData.append("layout_id", layout.val());
            formData.append("demo_url", demo_url.val());
            formData.append("columns", columns.val());
            formData.append("high_resolution", high_resolution.val());
            formData.append("documentation", documentation.val());
            formData.append("preview_image", $("#preview_image")[0].files[0]);
            formData.append("preview_file", $("#preview_file")[0].files[0]);
            formData.append("main_file", $("#main_file")[0].files[0]);
                for (var i = 0; i < specials_key.length; i++) {
                    formData.append("specials_key[]", specials_key[i]);
                }
                for (var i = 0; i < tags.tagsinput("items").length; i++) {
                    formData.append("tags[]", tags.tagsinput("items")[i]);
                }
                for (var i = 0; i < specials_value.length; i++) {
                    formData.append("specials_value[]", specials_value[i]);
                }
            for (var i = 0; i < browsers.length; i++) {
                formData.append("browsers[]", browsers[i]);
            }
            for (var i = 0; i < other_categories.length; i++) {
                formData.append("other_categories[]", other_categories[i]);
            }
            for (var i = 0; i < compatible_with.length; i++) {
                formData.append("compatible_with[]", compatible_with[i]);
            }
            for (var i = 0; i < features.length; i++) {
                formData.append("features[]", features[i]);
            }
            $.ajax({
                type: "POST",
                url: "/store-upload",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.success == true) {
                        btnLoading(0, $(".btn_send"));
                        $(this).prop("disabled", false);
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
