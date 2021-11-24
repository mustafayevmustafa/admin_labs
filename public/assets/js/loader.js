var loader = `<div class="dimmer active">
											<div class="spinner2">
											  <div class="cube1"></div>
											  <div class="cube2"></div>
											</div>
										</div>`;

function loading(val, div) {
    var block_ele = div;
    if (val === 1) {
        $(block_ele).block({
            message: loader,
            overlayCSS: {
                backgroundColor: "rgba(255,255,255,0.9)",
                opacity: 1,
                cursor: "wait",
            },
            css: {
                border: 0,
                padding: 0,
                color: "#fff",
                backgroundColor: "transparent",
            },
        });
    } else if (val == 0) {
        $(".blockUI").hide();
    }
}
