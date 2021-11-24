var btn_delete = $(".btn_delete");
var btn_edit = $(".btn_edit");
var id = 0;
function add_edit(id, key_name, key) {
    $.ajax({
        type: "POST",
        url: "/add-edit-apikey",
        data: {
            _token: _token,
            id: id,
            key_name: key_name,
            key: key,
        },
        success: function (response) {
            if (response.success == true) {
                window.location.reload();
            }
        },
    });
}
$("#add_apikey_form").submit(function (e) {
    e.preventDefault();
    var key_name = $("#key_name");
    var key = $("#key");
    if (key_name.val() != "" && key.val() != "") {
        add_edit((id = 0), key_name.val(), key.val());
    } else {
        key_name.addClass("is-invalid");
        key.addClass("is-invalid");
    }
});

btn_edit.click(function () {
    id = $(this).parents("tr").attr("id");
    $.ajax({
        type: "POST",
        url: "/edit-apikey",
        data: {
            _token: _token,
            id: id,
        },
        success: function (response) {
            console.log(response);
            if (response.success == true) {
                $("#modal_key_name").val(response.apikey.key_name);
                $("#modal_key").val(response.apikey.key);
            }
        },
    });
});

btn_delete.click(function () {
    id = $(this).parents("tr").attr("id");
    $.ajax({
        type: "POST",
        url: "/delete-apikey",
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
    if ($("#modal_key_name").val() != "" && $("#modal_key").val() != "") {
        add_edit(id, $("#modal_key_name").val(), $("#modal_key").val());
    } else {
        $("#modal_key").addClass("is-invalid");
        $("#modal_key_name").addClass("is-invalid");
    }
});
