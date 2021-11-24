var avatar = document.getElementById("avatar");
var image = document.getElementById("image");
var input = document.getElementById("upload_image");
var $modal = $("#cropmodal");
var image_list = $("#image-list");
var cropper;

$('[data-toggle="tooltip"]').tooltip();

input.addEventListener("change", function (e) {
    var files = e.target.files;
    var done = function (url) {
        input.value = "";
        image.src = url;
        $modal.modal("show");
    };
    var reader;
    var file;

    if (files && files.length > 0) {
        file = files[0];

        if (URL) {
            done(URL.createObjectURL(file));
        } else if (FileReader) {
            reader = new FileReader();
            reader.onload = function (e) {
                done(reader.result);
            };
            reader.readAsDataURL(file);
        }
    }
});

$modal
    .on("shown.bs.modal", function () {
        cropper = new Cropper(image, {
            aspectRatio: 1,
            viewMode: 3,
            quality: 1,
        });
    })
    .on("hidden.bs.modal", function () {
        cropper.destroy();
        cropper = null;
    });

document.getElementById("crop").addEventListener("click", function () {
    var canvas;
    $modal.modal("hide");

    if (cropper) {
        canvas = cropper.getCroppedCanvas({
            width: 1024,
            height: 1024,
        });
        var image = canvas.toDataURL();
        var type = image.split(";")[0].split("/")[1];

        $.ajax({
            type: "POST",
            url: "/image-upload",
            data: {
                _token: _token,
                image: image,
                type: type,
            },
            success: function (data) {
                if (data.success == true) {
                    $(".image-list").append(
                        ` <div class="col-md-2 mb-1"  id="${data.id}">
                        <div class="card">
                            <img src="${image}" alt="" class="rounded shadow-sm">
                            <button class="btn btn-danger btn-sm btn-block mt-1" style="opacity: .8;">Delete</button>
                        </div>
                    </div>`
                    );
                }
            },
        });
    }
});

$(document).on("click", ".btn-danger", function () {
    var id = $(this).parents(".col-md-2").attr("id");
    $.ajax({
        type: "POST",
        url: "/upload-file-delete",
        data: {
            _token: _token,
            id: id,
        },
        success: function (data) {
            if (data.success == true) {
                $("#" + id).remove();
            }
        },
    });
});
$(".preview_image").dropify({
    messages: {
        default: "Drag and drop a file here or click",
        replace: "Drag and drop or click to replace",
        remove: "Remove",
        error: "Ooops, something wrong happended.",
    },
});
