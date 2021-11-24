var btn_delete = $(".btn_delete");

btn_delete.click(function () {
    id = $(this).parents("tr").attr("id");
    $.ajax({
        type: "POST",
        url: "/delete-user",
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
