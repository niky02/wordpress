function wC(C, D) {
    exp = new Date();
    exp.setTime(exp.getTime() + (86400 * 1000 * 30));
    document.cookie = C + "=" + escape(D) + "; expires=" + exp.toGMTString() + "; path=/"
}

function rC(C) {
    var D;
    D = C + "=";
    offset = document.cookie.indexOf(D);
    if (offset != -1) {
        offset += D.length;
        end = document.cookie.indexOf(";", offset);
        if (end == -1) {
            end = document.cookie.length
        }
        return unescape(document.cookie.substring(offset, end))
    } else {
        return ""
    }
}

function qh(dq) {
    $(".list a").removeClass("on");
    var dqdiv = $(".list a").eq(dq);
    dqdiv.addClass("on");
    var dimg = dqdiv.attr("dimg");
    var type = dqdiv.attr("data-type");
    $(".xgt").html("<img class='load-img' src='./wp-content/themes/ripro-child/assets/images/load110.gif' alt='loading..'/>");
    var img = new Image;
    img.src = dimg;
    var imgClass = '';
    if(type==1){
        imgClass = 'img_nav';
    }
    img.onload = function () {
        $(".xgt").html('<img class="'+imgClass+'" src="' + dimg + '" title="' + dqdiv.html() + '" alt="' + dqdiv.html() + '" />')
    }
}

$(document).ready(function () {
    var index = 0;
    var btn = $(".list").find("a");
    var len = btn.length;
    $(".list a").click(function () {
        qh($(this).index())
    });
    if (rC("demotip") != "n") {
        $(".list").append('<div class="tip">键盘← →可快速翻页!<span>不再提醒</span></div>')
    }
    $(".list .tip span").click(function () {
        $(".list .tip").hide();
        wC("demotip", "n")
    });
    $(document).keyup(function (e) {
        var e = e || window.event;
        if (e.which == 39) {
            var dq = $(".list a.on").index() + 1;
            if (dq < len) {
                qh(dq)
            }
        } else {
            if (e.which == 37) {
                var dq = $(".list a.on").index() - 1;
                if (dq > -1) {
                    qh(dq)
                }
            }
        }
    })
});