var btn_delete = $(".btn_delete");
var btn_edit = $(".btn_edit");
var id = 0;
function add_edit(id, compatible_name) {
    $.ajax({
        type: "POST",
        url: "/add-edit-compatible",
        data: {
            _token: _token,
            id: id,
            name: compatible_name,
        },
        success: function (response) {
            if (response.success == true) {
                window.location.reload();
            }
        },
    });
}
$("#add_compatible_form").submit(function () {
    var compatible_name = $("#compatible_name");
    if (compatible_name.val() != "") {
        add_edit((id = 0), compatible_name.val());
    } else {
        compatible_name.addClass("is-invalid");
    }
});

btn_edit.click(function () {
    id = $(this).parents("tr").attr("id");
    $.ajax({
        type: "POST",
        url: "/edit-compatible",
        data: {
            _token: _token,
            id: id,
        },
        success: function (response) {
            console.log(response);
            if (response.success == true) {
                $("#modal-compatible-name").val(response.compatible.name);
            }
        },
    });
});

btn_delete.click(function () {
    id = $(this).parents("tr").attr("id");
    $.ajax({
        type: "POST",
        url: "/delete-compatible",
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
    if ($("#modal-compatible-name").val() != "") {
        add_edit(id, $("#modal-compatible-name").val());
    } else {
        compatible_name.addClass("is-invalid");
    }
});
