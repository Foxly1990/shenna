$.fn.sendContent = function (content) {
    let self = $(this),
        cont = $(content),
        place = window.location;

    self.on("submit", function () {
        let body = $(".body-input"),
            content = $.trim(cont.html()),
            write = body.val(content),
            status = $("#status-changes"),
            // domain = place.protocol + "//" + place.hostname +"/",
            url = "controller/__writer.php",
            data = self.serialize(),
            response = $.parseJSON;

        $.ajax({
            url: url,
            type: "POST",
            data: data,
            beforeSend: function () {
                status.fadeIn("fast");
            },
            statusCode: {
                404: function () {
                    status.html("Страница не найдена. Код 404");
                },
                500: function () {
                    status.html("Ошибка сервера. Код 500");
                }
            },
            success: function (json) {
                console.log(json);
            }
        }).done(function (json) {
            status.html(response(json).success).fadeOut(3000);
        }).fail(function (json) {
            status.html(response(json).fail).fadeOut(3000);
        });

        return false;
    });
};

$.fn.elementCenter = function () {
    let elemWidth = $(this).outerWidth(true),
        elemHeight = $(this).outerHeight(true);

    $(this).css({
        "position": "fixed",
        "top": "50%",
        "left": "50%",
        "margin-top": -(elemHeight / 2) + "px",
        "margin-left": -(elemWidth / 2) + "px"
    });
};

$(document).on("ready", function () {
    $("#status-changes").elementCenter();
    $("#changes").sendContent("#editor");
});
