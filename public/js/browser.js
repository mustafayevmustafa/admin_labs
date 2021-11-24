var btn_delete = $(".btn_delete");
var btn_edit = $(".btn_edit");
var id = 0;
function add_edit(id, browser_name) {
    $.ajax({
        type: "POST",
        url: "/add-edit-browser",
        data: {
            _token: _token,
            id: id,
            name: browser_name,
        },
        success: function (response) {
            if (response.success == true) {
                window.location.reload();
            }
        },
    });
}
$("#add_browser_form").submit(function () {
    var browser_name = $("#browser_name");
    if (browser_name.val() != "") {
        add_edit((id = 0), browser_name.val());
    } else {
        browser_name.addClass("is-invalid");
    }
});

btn_edit.click(function () {
    id = $(this).parents("tr").attr("id");
    $.ajax({
        type: "POST",
        url: "/edit-browser",
        data: {
            _token: _token,
            id: id,
        },
        success: function (response) {
            console.log(response);
            if (response.success == true) {
                $("#modal-browser-name").val(response.browser.name);
            }
        },
    });
});

btn_delete.click(function () {
    id = $(this).parents("tr").attr("id");
    $.ajax({
        type: "POST",
        url: "/delete-browser",
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
    if ($("#modal-browser-name").val() != "") {
        add_edit(id, $("#modal-browser-name").val());
    } else {
        browser_name.addClass("is-invalid");
    }
});
