var btn_delete = $(".btn_delete");
var btn_edit = $(".btn_edit");
var id = 0;
function add_edit(id, layout_name) {
    $.ajax({
        type: "POST",
        url: "/add-edit-layout",
        data: {
            _token: _token,
            id: id,
            name: layout_name,
        },
        success: function (response) {
            if (response.success == true) {
                window.location.reload();
            }
        },
    });
}
$("#add_layout_form").submit(function () {
    var layout_name = $("#layout_name");
    if (layout_name.val() != "") {
        add_edit((id = 0), layout_name.val());
    } else {
        layout_name.addClass("is-invalid");
    }
});

btn_edit.click(function () {
    id = $(this).parents("tr").attr("id");
    $.ajax({
        type: "POST",
        url: "/edit-layout",
        data: {
            _token: _token,
            id: id,
        },
        success: function (response) {
            console.log(response);
            if (response.success == true) {
                $("#modal-layout-name").val(response.layout.name);
            }
        },
    });
});

btn_delete.click(function () {
    id = $(this).parents("tr").attr("id");
    $.ajax({
        type: "POST",
        url: "/delete-layout",
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
    if ($("#modal-layout-name").val() != "") {
        add_edit(id, $("#modal-layout-name").val());
    } else {
        $("#modal-layout-name").addClass("is-invalid");
    }
});
