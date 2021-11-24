var btn_delete = $(".btn_delete");
var btn_view = $(".btn_view");
var btn_done = $("#userreposermodal .btn_done");
var data_id = 0;
btn_view.click(function () {
    let id = $(this).parents("tr").attr("id");
    data_id = id;
    $.ajax({
        type: "POST",
        url: "/view-user-report",
        data: {
            _token: _token,
            id: id,
        },
        success: function (response) {
            if (response.success == true) {
                $("#modal-date").text(response.report_time);
                $("#userreposermodal .modal-body").html(`
            <div class="row">
                    <div class="col-md-6 border-right">
                        <div class="d-flex justify-content-center align-items-center">
                            <img src="${response.user.from_user.profile_image}" class="avatar avatar-lg brround" alt="">
                            <div>
                            <h5 class="ml-2">${response.user.from_user.first_name} ${response.user.from_user.last_name}</h5>
                                <span class="ml-2">Username : ${response.user.from_user.username}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center justify-content-center">
                            <img src="${response.user.to_user.profile_image}" class="avatar avatar-lg brround" alt="">
                            <div>
                            <h5 class="ml-2">${response.user.to_user.first_name} ${response.user.from_user.last_name}</h5>
                                <span class="ml-2">Username : ${response.user.to_user.username}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <label for="message" class="font-weight-bold">Message</label>
                <p>${response.user.message}</p>`);
            }
        },
    });
});

btn_delete.click(function () {
    let id = $(this).parents("tr").attr("id");
    $.ajax({
        type: "POST",
        url: "/delete-user-report",
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
btn_done.click(function () {
    $.ajax({
        type: "POST",
        url: "/done-user-report",
        data: {
            _token: _token,
            id: data_id,
        },
        success: function (response) {
            console.log(response);
            if (response.success == true) {
                $("#" + data_id)
                    .find("i")
                    .addClass("text-success")
                    .removeClass("text-danger")
                    .removeClass("fe-user-x")
                    .addClass("fe-user-check");
            }
        },
    });
});
