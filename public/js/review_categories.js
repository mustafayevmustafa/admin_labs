var btn_delete = $(".btn_delete");
var btn_edit = $(".btn_edit");
var id = 0;
function add_edit(id, review_category_name) {
    $.ajax({
        type: "POST",
        url: "/add-edit-review-category",
        data: {
            _token: _token,
            id: id,
            name: review_category_name,
        },
        success: function (response) {
            if (response.success == true) {
                window.location.reload();
            }
        },
    });
}
$("#add_review_category_form").submit(function () {
    var review_category_name = $("#review_category_name");
    if (review_category_name.val() != "") {
        add_edit((id = 0), review_category_name.val());
    } else {
        review_category_name.addClass("is-invalid");
    }
});

btn_edit.click(function () {
    id = $(this).parents("tr").attr("id");
    $.ajax({
        type: "POST",
        url: "/edit-review-category",
        data: {
            _token: _token,
            id: id,
        },
        success: function (response) {
            console.log(response);
            if (response.success == true) {
                $("#modal-review_category-name").val(
                    response.review_category.name
                );
            }
        },
    });
});

btn_delete.click(function () {
    id = $(this).parents("tr").attr("id");
    $.ajax({
        type: "POST",
        url: "/delete-review-category",
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
    if ($("#modal-review_category-name").val() != "") {
        add_edit(id, $("#modal-review_category-name").val());
    } else {
        review_category_name.addClass("is-invalid");
    }
});
