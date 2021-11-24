var btn_delete = $(".btn_delete");
var btn_edit = $(".btn_edit");
var id = 0;
function add_edit(id, parent_id, category_name, category_type) {
    $.ajax({
        type: "POST",
        url: "/add-edit-category",
        data: {
            _token: _token,
            id: id,
            parent_id: parent_id,
            name: category_name,
            type: category_type,
        },
        success: function (response) {
            console.log(response);
            if (response.success == true) {
                window.location.reload();
            }
        },
    });
}
$("#add_category_form").submit(function (e) {
    e.preventDefault();
    var parent = $("#parent");
    var category_name = $("#category_name");
    var category_type = $("#category_type");
    if (category_name.val() != "") {
        add_edit(
            (id = 0),
            parent.val(),
            category_name.val(),
            category_type.val()
        );
    } else {
        category_name.addClass("is-invalid");
    }
});

btn_edit.click(function () {
    id = $(this).parents("tr").attr("id");
    $.ajax({
        type: "POST",
        url: "/edit-category",
        data: {
            _token: _token,
            id: id,
        },
        success: function (response) {
            console.log(response);
            if (response.success == true) {
                $("#modal-parent").val(response.category.parent_id);
                $("#modal-category-name").val(response.category.name);
                $("#modal-type").val(response.category.type);
            }
        },
    });
});

btn_delete.click(function () {
    id = $(this).parents("tr").attr("id");
    $.ajax({
        type: "POST",
        url: "/delete-category",
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
    if ($("#modal-category-name").val() != "") {
        add_edit(
            id,
            $("#modal-parent").val(),
            $("#modal-category-name").val(),
            $("#modal-type").val()
        );
    } else {
        category_name.addClass("is-invalid");
    }
});
