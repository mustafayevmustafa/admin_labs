let name = document.getElementById("name");
let cardnumber = document.getElementById("cardnumber");
let expirationdate = document.getElementById("expirationdate");
let securitycode = document.getElementById("securitycode");
const output = document.getElementById("output");
const ccicon = document.getElementById("ccicon");
const ccsingle = document.getElementById("ccsingle");
let cctype = null;

var cardnumber_mask = new IMask(cardnumber, {
    mask: [
        {
            mask: "0000 000000 00000",
            regex: "^3[47]\\d{0,13}",
            cardtype: "american express",
        },
        {
            mask: "0000 0000 0000 0000",
            regex: "^(?:6011|65\\d{0,2}|64[4-9]\\d?)\\d{0,12}",
            cardtype: "discover",
        },
        {
            mask: "0000 000000 0000",
            regex: "^3(?:0([0-5]|9)|[689]\\d?)\\d{0,11}",
            cardtype: "diners",
        },
        {
            mask: "0000 0000 0000 0000",
            regex: "^(5[1-5]\\d{0,2}|22[2-9]\\d{0,1}|2[3-7]\\d{0,2})\\d{0,12}",
            cardtype: "mastercard",
        },
        // {
        //     mask: '0000-0000-0000-0000',
        //     regex: '^(5019|4175|4571)\\d{0,12}',
        //     cardtype: 'dankort'
        // },
        // {
        //     mask: '0000-0000-0000-0000',
        //     regex: '^63[7-9]\\d{0,13}',
        //     cardtype: 'instapayment'
        // },
        {
            mask: "0000 000000 00000",
            regex: "^(?:2131|1800)\\d{0,11}",
            cardtype: "jcb15",
        },
        {
            mask: "0000 0000 0000 0000",
            regex: "^(?:35\\d{0,2})\\d{0,12}",
            cardtype: "jcb",
        },
        {
            mask: "0000 0000 0000 0000",
            regex: "^(?:5[0678]\\d{0,2}|6304|67\\d{0,2})\\d{0,12}",
            cardtype: "maestro",
        },
        // {
        //     mask: '0000-0000-0000-0000',
        //     regex: '^220[0-4]\\d{0,12}',
        //     cardtype: 'mir'
        // },
        {
            mask: "0000 0000 0000 0000",
            regex: "^4\\d{0,15}",
            cardtype: "visa",
        },
        {
            mask: "0000 0000 0000 0000",
            regex: "^62\\d{0,14}",
            cardtype: "unionpay",
        },
        {
            mask: "0000 0000 0000 0000",
            cardtype: "Unknown",
        },
    ],
    dispatch: function (appended, dynamicMasked) {
        var number = (dynamicMasked.value + appended).replace(/\D/g, "");
        for (var i = 0; i < dynamicMasked.compiledMasks.length; i++) {
            let re = new RegExp(dynamicMasked.compiledMasks[i].regex);
            if (number.match(re) != null) {
                return dynamicMasked.compiledMasks[i];
            }
        }
    },
});

//Mask the Expiration Date
var expirationdate_mask = new IMask(expirationdate, {
    mask: "MM{/}YY",
    groups: {
        YY: new IMask.MaskedPattern.Group.Range([0, 99]),
        MM: new IMask.MaskedPattern.Group.Range([1, 12]),
    },
});

//Mask the security code
var securitycode_mask = new IMask(securitycode, {
    mask: "0000",
});

var cardTrue = false;

//pop in the appropriate card icon when detected
cardnumber_mask.on("accept", function () {
    switch (cardnumber_mask.masked.currentMask.cardtype) {
        case "american express":
            cardTrue = true;
            break;
        case "visa":
            cardTrue = true;
            break;
        case "diners":
            cardTrue = true;
            break;
        case "discover":
            cardTrue = true;
            break;
        case "jcb" || "jcb15":
            cardTrue = true;
            break;
        case "maestro":
            cardTrue = true;
            break;
        case "mastercard":
            cardTrue = true;

            break;
        case "unionpay":
            cardTrue = true;
            break;
        default:
            cardTrue = false;
            break;
    }
});

var payment_btn = $(".payment_btn");
name.addEventListener("keyup", function () {
    if (name.value != "") {
        payment_btn.removeClass("disabled");
        name.classList.remove("is-invalid");
    } else {
        payment_btn.addClass("disabled");
        name.classList.add("is-invalid");
    }
});
cardnumber.addEventListener("keyup", function () {
    if (cardnumber.value != "") {
        payment_btn.removeClass("disabled");
        cardnumber.classList.remove("is-invalid");
    } else {
        payment_btn.addClass("disabled");
        cardnumber.classList.add("is-invalid");
    }
});
expirationdate.addEventListener("keyup", function () {
    if (expirationdate.value != "") {
        payment_btn.removeClass("disabled");
        expirationdate.classList.remove("is-invalid");
    } else {
        payment_btn.addClass("disabled");
        expirationdate.classList.add("is-invalid");
    }
});
securitycode.addEventListener("keyup", function () {
    if (securitycode.value != "") {
        payment_btn.removeClass("disabled");
        securitycode.classList.remove("is-invalid");
    } else {
        payment_btn.addClass("disabled");
        securitycode.classList.add("is-invalid");
    }
});
payment_btn.click(function () {
    loading(1, $(".tab-content"));
    if (name.value == "") {
        name.classList.add("is-invalid");
        loading(0, $(".tab-content"));
    }
    if (cardnumber.value == "") {
        cardnumber.classList.add("is-invalid");
        loading(0, $(".tab-content"));
    }
    if (expirationdate.value == "") {
        expirationdate.classList.add("is-invalid");
        loading(0, $(".tab-content"));
    }
    if (securitycode.value == "") {
        securitycode.classList.add("is-invalid");
        loading(0, $(".tab-content"));
    }
    if (
        name.value != "" &&
        cardnumber.value != "" &&
        expirationdate.value != "" &&
        securitycode.value != ""
    ) {
        loading(1, $(".tab-content"));
        $.ajax({
            type: "POST",
            url: "/user-payment",
            data: {
                _token: token,
                name: name.value,
                number: cardnumber.value,
                date: expirationdate.value,
                cvc: securitycode.value,
            },
            success: function (response) {
                if (response.status == true) {
                    loading(0, $(".tab-content"));
                }
                if (response.update == true) {
                    loading(0, $(".tab-content"));
                }
            },
            error: function (request, error, str) {
                console.log(
                    request.responseJSON.errors[
                        Object.keys(request.responseJSON.errors)[0]
                    ]
                );
                loading(0, $(".tab-content"));
            },
        });
    }
    name.addEventListener("keyup", function () {
        name.classList.remove("is-invalid");
        name.classList.add("is-valid");
    });
    cardnumber.addEventListener("keyup", function () {
        cardnumber.classList.remove("is-invalid");
        cardnumber.classList.add("is-valid");
    });
    expirationdate.addEventListener("keyup", function () {
        expirationdate.classList.remove("is-invalid");
        expirationdate.classList.add("is-valid");
    });
    securitycode.addEventListener("keyup", function () {
        securitycode.classList.remove("is-invalid");
        securitycode.classList.add("is-valid");
    });
});
