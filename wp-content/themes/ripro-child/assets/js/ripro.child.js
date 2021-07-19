//初始化
jQuery(function () {
    categoryBoxes();
    categoryBoxesSpecial();
    categoryBoxesTags();
})

//专题专题模块js
function categoryBoxesSpecial() {
    jQuery(".child-container-special .category-boxes").owlCarousel({
        dots: !1,
        margin: 15,
        nav: !0,
        autoplay: !0,
        loop: true,
        navSpeed: 500,
        navText: navText,
        responsive: {0: {items: 2}, 768: {items: 2}, 992: {items: 3}, 1230: {items: 5}, 1450: {items: 5}}
    })
}

//专题专题模块js
function categoryBoxesTags() {
    jQuery(".child-container-tags .category-boxes").owlCarousel({
        dots: !1,
        margin: 60,
        nav: !0,
        autoplay: !0,
        loop: false,
        navSpeed: 500,
        navText: navText,
        responsive: {0: {items: 3}, 768: {items: 4}, 992: {items: 6}, 1230: {items: 7}, 1450: {items: 8}}
    })
}

//推荐专题模块js
function categoryBoxes() {
    jQuery(".child-container .category-boxes").owlCarousel({
        dots: !1,
        margin: 15,
        nav: !0,
        autoplay: !0,
        loop: true,
        navSpeed: 500,
        navText: navText,
        responsive: {0: {items: 1}, 768: {items: 2}, 992: {items: 3}, 1230: {items: 4}, 1450: {items: 5}}
    })
}

/**
 * 首页搜索上面动态文案 create by yuanbt.com
 */
setInterval(function () {
    var dynamicTitle = $('.dynamic-title').data('init');
    var dynamicTitleTwo = $('.dynamic-title').data('two');
    if ($('.focusbox-title').text().length == dynamicTitle.length) {
        $('.focusbox-title').text(dynamicTitleTwo)
    } else {
        $('.focusbox-title').text(dynamicTitle)
    }
}, 2000);