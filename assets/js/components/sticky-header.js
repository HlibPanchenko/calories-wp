jQuery(document).ready(function ($) {
    var headerBottom = $('.main-header_bottom');
    var mainWrapper = $('.main-wrapper');
    var fixedClass = 'fixed-header';
    var layoutFixedMarginClass = 'layout-fixed-margin';

    $(window).scroll(function () {
        var scrollY = window.scrollY || window.pageYOffset;
        var threshold = 55;

        if (scrollY > threshold) {
            headerBottom.addClass(fixedClass);
            mainWrapper.addClass(layoutFixedMarginClass);
        } else {
            headerBottom.removeClass(fixedClass);
            mainWrapper.removeClass(layoutFixedMarginClass);
        }
    });
});
