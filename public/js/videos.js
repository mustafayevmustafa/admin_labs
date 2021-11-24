var btn_delete = $(".btn_delete");
var btn_edit = $(".btn_edit");
var id = 0;
function add_edit(id, plugin_name) {
    $.ajax({
        type: "POST",
        url: "/add-edit-video",
        data: {
            _token: _token,
            id: id,
            name: plugin_name,
        },
        success: function (response) {
            if (response.success == true) {
                window.location.reload();
            }
        },
    });
}
$("#add_plugin_form").submit(function () {
    var plugin_name = $("#plugin_name");
    if (plugin_name.val() != "") {
        add_edit((id = 0), plugin_name.val());
    } else {
        plugin_name.addClass("is-invalid");
    }
});

btn_edit.click(function () {
    id = $(this).parents("tr").attr("id");
    $.ajax({
        type: "POST",
        url: "/edit-video",
        data: {
            _token: _token,
            id: id,
        },
        success: function (response) {
            console.log(response);
            if (response.success == true) {
                $("#modal-plugin-name").val(response.video.name);
            }
        },
    });
});

btn_delete.click(function () {
    id = $(this).parents("tr").attr("id");
    $.ajax({
        type: "POST",
        url: "/delete-video",
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
    if ($("#modal-plugin-name").val() != "") {
        add_edit(id, $("#modal-plugin-name").val());
    } else {
        plugin_name.addClass("is-invalid");
    }
});
