var btn_delete = $(".btn_delete");
var btn_edit = $(".btn_edit");
var id = 0;
function add_edit(id, footer_content) {
    $.ajax({
        type: "POST",
        url: "/add-edit-footer",
        data: {
            _token: _token,
            id: id,
            content: footer_content,
        },
        success: function (response) {
            if (response.success == true) {
                window.location.reload();
            }
        },
    });
}
$("#add_footer_form").submit(function (e) {
    e.preventDefault();
    var footer_content = $("#footer_content");
    if (footer_content.val() != "") {
        add_edit((id = 0), footer_content.val());
    } else {
        footer_content.addClass("is-invalid");
    }
});

btn_edit.click(function () {
    id = $(this).parents(".card").attr("id");
    $.ajax({
        type: "POST",
        url: "/edit-footer",
        data: {
            _token: _token,
            id: id,
        },
        success: function (response) {
            if (response.success == true) {
                $("#modal-footer-content").val(response.footer.content);
            }
        },
    });
});

btn_delete.click(function () {
    id = $(this).parents(".card").attr("id");
    $.ajax({
        type: "POST",
        url: "/delete-footer",
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
    if ($("#modal-footer-content").val() != "") {
        add_edit(id, $("#modal-footer-content").val());
    } else {
        $("#modal-footer-content").addClass("is-invalid");
    }
});
