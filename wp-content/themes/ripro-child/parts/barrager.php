<?php
/**
 * @Author   源码园
 * @WebUrl   www.ymkuzhan.com 源码园
 */
?>
<script>
    var str = <?php get_paylogs_cache();?>;
    var paylogsData = JSON.parse(JSON.stringify(str));
    (function ($) {
        $.fn.barrager = function (barrage) {
            barrage = $.extend({
                close: true,
                bottom: 0,
                max: 10,
                speed: 8,
                color: "#fff",
                old_ie_color: "#000000"
            }, barrage || {});
            var time = new Date().getTime();
            var barrager_id = "barrage_" + time;
            var id = "#" + barrager_id;
            var div_barrager = $("<div class='barrage' id='" + barrager_id + "'></div>").appendTo($(this));
            var window_height = $(window).height() - 100;
            var this_height = (window_height > this.height()) ? this.height() : window_height;
            var window_width = $(window).width() + 500;
            var this_width = (window_width > this.width()) ? this.width() : window_width;
            var bottom = (barrage.bottom == 0) ? Math.floor(Math.random() * this_height + 40) : barrage.bottom;
            div_barrager.css("bottom", bottom + "px");
            div_barrager_box = $("<div class='barrage_box cl'></div>").appendTo(div_barrager);
            //用户头像
            if (barrage.img) {
                div_barrager_box.append("<a class='portrait z' href='javascript:;'></a>");
                var img = $("<img src='' >").appendTo(id + " .barrage_box .portrait");
                img.attr("src", barrage.img)
            }
            div_barrager_box.append(" <div class='z p'></div>");
            if (barrage.close) {
                div_barrager_box.append(" <div class='close z'></div>")
            }
            var content = $("<a title='' href='' target='_blank'></a>").appendTo(id + " .barrage_box .p");
            content.attr({"href": barrage.href, "id": barrage.id}).empty().append(barrage.info);
            if (navigator.userAgent.indexOf("MSIE 6.0") > 0 || navigator.userAgent.indexOf("MSIE 7.0") > 0 || navigator.userAgent.indexOf("MSIE 8.0") > 0) {
                content.css("color", barrage.old_ie_color)
            } else {
                content.css("color", barrage.color)
            }
            var i = 0;
            div_barrager.css("margin-right", 0);
            $(id).animate({right: this_width}, barrage.speed * 1000, function () {
                $(id).remove()
            });
            div_barrager_box.mouseover(function () {
                $(id).stop(true)
            });
            div_barrager_box.mouseout(function () {
                $(id).animate({right: this_width}, barrage.speed * 1000, function () {
                    $(id).remove()
                })
            });
            $(id + ".barrage .barrage_box .close").click(function () {
                $(id).remove()
            })
        };
        $.fn.barrager.removeAll = function () {
            $(".barrage").remove()
        }
    })(jQuery);

    //下载订单弹幕
    var looper_time = 5000;
    var items = paylogsData;
    var total = paylogsData.length;
    var run_once = true;
    var index = 0;
    if (paylogsData != '') {
        barrager();
    }
    function barrager() {
        if (run_once) {
            looper = setInterval(barrager, looper_time);
            run_once = false
        }
        $("body").barrager(items[index]);
        index++;
        if (index == total) {
            clearInterval(looper);
            return false
        }
    }
</script>
