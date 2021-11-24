var btn_delete = $(".btn_delete");
var btn_edit = $(".btn_edit");
var id = 0;
function add_edit(id, header_title, header_text, header_image) {
    var formData = new FormData();
    formData.append("_token", _token);
    formData.append("id", id);
    formData.append("title", header_title.val());
    formData.append("text", header_text.val());
    if (header_image[0].files.length > 0) {
        formData.append("image", header_image[0].files[0]);
    }
    $.ajax({
        type: "POST",
        url: "/add-edit-header",
        data: formData,
        type: "POST",
        contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
        processData: false,
        success: function (response) {
            if (response.success == true) {
                window.location.reload();
            }
        },
        error: function (err) {
            $("#header_image").addClass("is-invalid");
            $(".header_image_error").text(err.responseJSON.errors.image[0]);
        },
    });
}
$("#add_header_form").submit(function (e) {
    e.preventDefault();
    var header_text = $("#header_text");
    var header_title = $("#header_title");
    var header_image = $("#header_image");
    if (header_text.val() != "") {
        add_edit((id = 0), header_title, header_text, header_image);
    } else {
        header_text.addClass("is-invalid");
        header_title.addClass("is-invalid");
        header_image.addClass("is-invalid");
    }
});

btn_edit.click(function () {
    id = $(this).parents(".card").attr("id");
    $.ajax({
        type: "POST",
        url: "/edit-header",
        data: {
            _token: _token,
            id: id,
        },
        success: function (response) {
            console.log(response);
            if (response.success == true) {
                $("#modal_header_title").val(response.header.title);
                $("#modal_header_text").val(response.header.text);
            }
        },
    });
});

btn_delete.click(function () {
    id = $(this).parents(".card").attr("id");
    $.ajax({
        type: "POST",
        url: "/delete-header",
        data: {
            _token: _token,
            id: id,
        },
        success: function (response) {
            console.log(response);
            if (response.success == true) {
                $("#" + id).remove();
            }
        },
    });
});
$(".modal_edit").click(function () {
    console.log(id);
    if (
        $("#modal_header_title").val() != "" &&
        $("#modal_header_text").val() != ""
    ) {
        add_edit(
            id,
            $("#modal_header_title"),
            $("#modal_header_text"),
            $("#modal_header_image")
        );
    } else {
        $("#modal_header_title").addClass("is-invalid");
        $("#modal_header_text").addClass("is-invalid");
    }
});
