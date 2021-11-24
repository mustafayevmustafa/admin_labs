var cart_number = $(".cart_number");
var cart_lists = $("#mCSB_1_container");

$(document).on("click", ".cart_button", function (e) {
    e.preventDefault();
    var id = $(this).parents(".col-md-4").attr("id");
    $.ajax({
        type: "POST",
        url: "/cart-add",
        data: {
            _token: token,
            id: id,
        },
        success: function (response) {
            if (response.success == false) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: `${response.has_message}`,
                });
            }
            if (response.success == true) {
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: `The product was added to the cart`,
                });
                var sum = parseInt(cart_number.text());
                if (sum == 0) {
                    $(".empty-cart").addClass("d-none");
                }
                sum = sum + 1;
                cart_number.html(sum);

                var output = `<div class="border-bottom" id="${
                    response.cart.id
                }">
                <div class="d-flex pl-3 pr-4 pt-2 pb-3 align-items-center">
                    <a href="/project-detail/${response.cart.slug}" class="">
                        <img src="${
                            response.cart.cover != null
                                ? response.cart.cover
                                : "../assets/images/media/pictures/small/05.jpg"
                        }" class="br-4 mCS_img_loaded" style="object-fit:cover;" alt="${
                    response.cart.name
                }">
                    </a>
                    <div class="d-flex">
                        <div class="pl-3">
                            <span class="fs-16 h4 d-block">${
                                response.cart.name
                            }</span>
                            <div class="fs-13 text-muted">${
                                response.cart.category
                            }</div>
                        </div>
                    </div>
                    <div class="ml-auto text-center">
                        <a href="#" class="text-muted"><i class="fe fe-trash-2 fs-13"></i></a>
                        <div class="h5 text-dark mt-1 mb-0">$${
                            response.cart.sale_price
                        }</div>
                    </div>
                </div>
                </div>`;
                cart_lists.append(output);
            }
        },
    });
});

$(document).on("click", ".cart_remove_btn", function (e) {
    e.preventDefault();
    console.log("cart_remove_btn");
    var id = $(this).parents(".cart-item").attr("id");
    $.ajax({
        type: "POST",
        url: "/cart-remove",
        data: {
            _token: token,
            id: id,
        },
        success: function (response) {
            if (response.success == true) {
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: `${response.message}`,
                });
                var sum = parseInt(cart_number.text());
                sum = sum - 1;
                cart_number.html(sum);
                $("#" + id).fadeOut();
            }
        },
        error: function (req, err, e) {
            if (req.responseJSON.success == false) {
                Swal.fire({
                    icon: "error",
                    title: "Ops...",
                    text: `${req.responseJSON.message}`,
                });
            }
        },
    });
});
