$(function () {
    $(window).load(function () {
        $("*[data-mediabox]").each(function () {
            var g = parseInt($(this).data("padding-x"));
            var d = parseInt($(this).data("padding-y"));
            var b = parseInt($(this).data("mediabox"));
            if (isNaN(g)) {
                g = 0
            }
            if (isNaN(d)) {
                d = 0
            }
            var f = $(this).data("direction") ? $(this).data("direction") : "bottom";
            var c = $('<div class="box-media ' + f + '"><p>' + $(this).data("content") + '</p> <a class="box-media-close">X</a></div>');
            var a = $(this).offset();
            $("body").append(c);
            if (f == "bottom") {
                c.css({left: (a.left - (c.outerWidth(true) / 2) + $(this).outerWidth(true) / 2) + g, top: (a.top + $(this).outerHeight(true)) + d + 10})
            } else {
                if (f == "top") {
                    c.css({left: (a.left - (c.outerWidth(true) / 2) + $(this).outerWidth(true) / 2) + g, top: (a.top - c.outerHeight(true)) + d - 10})
                } else {
                    if (f == "left") {
                        c.css({left: (a.left - c.outerWidth(true) - 15) + g, top: (a.top - (c.outerHeight(true) / 2) + ($(this).outerHeight(true) / 2)) + d})
                    } else {
                        if (f == "right") {
                            c.css({left: (a.left + $(this).outerWidth(true)) + g, top: (a.top - (c.outerHeight(true) / 2) + ($(this).outerHeight(true) / 2)) + d})
                        }
                    }
                }
            }
            $(".box-media-close", c).click(function () {
                c.remove();
                $.post( baseUrl + "Mediabox/close/", {"id": b});
            });
            c.delay(500);
            c.animate({top: "-=10"}, 150);
            c.animate({top: "+=10"}, 150);
            c.delay(700);
            c.animate({top: "-=10"}, 150);
            c.animate({top: "+=10"}, 150);
            c.animate({opacity: "0.1"}, 5000);
            c.queue("fx");
            c.mouseenter(function () {
                c.stop().clearQueue().css("opacity", "1.0")
            }).mouseleave(function () {
                c.animate({opacity: "0.1"}, 1000)
            });
            var e = $.fn.hide;
            $.fn.hide = function (i, h) {
                return $(this).each(function () {
                    $(this).trigger("beforeHide");
                    e.apply($(this))
                })
            };
            $(this).bind("beforeHide", function () {
                c.remove()
            })
        })
    })
});