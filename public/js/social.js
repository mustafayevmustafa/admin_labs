var btn_delete = $(".btn_delete");
var btn_edit = $(".btn_edit");
var id = 0;
function add_edit(id, social_link, icon) {
    $.ajax({
        type: "POST",
        url: "/add-edit-social",
        data: {
            _token: _token,
            id: id,
            link: social_link,
            icon: icon,
        },
        success: function (response) {
            if (response.success == true) {
                window.location.reload();
            }
        },
    });
}
$("#add_social_form").submit(function (e) {
    e.preventDefault();
    var social_link = $("#social_link");
    var icon = $("#icon");
    if (social_link.val() == "") {
        social_link.addClass("is-invalid");
    }
    if (icon.val() == "") {
        icon.addClass("is-invalid");
    }

    if (social_link.val() != "" && icon.val()) {
        add_edit((id = 0), social_link.val(), icon.val());
    }
});

btn_edit.click(function () {
    id = $(this).parents("tr").attr("id");
    console.log(id);
    $.ajax({
        type: "POST",
        url: "/edit-social",
        data: {
            _token: _token,
            id: id,
        },
        success: function (response) {
            console.log(response);
            if (response.success == true) {
                $("#modal-social-link").val(response.social.link);
                $("#modal-social-icon").val(response.social.icon);
            }
        },
    });
});

btn_delete.click(function () {
    id = $(this).parents("tr").attr("id");
    $.ajax({
        type: "POST",
        url: "/delete-social",
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
    if ($("#modal-social-link").val() == "") {
        $("#modal-social-link").addClass("is-invalid");
    }
    if ($("#modal-social-icon").val() == "") {
        $("#modal-social-icon").addClass("is-invalid");
    }
    if ($("#modal-social-link").val() != "" && $("#modal-social-icon").val()) {
        add_edit(
            (id = id),
            $("#modal-social-link").val(),
            $("#modal-social-icon").val()
        );
    }
});
