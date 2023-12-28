jQuery(document).ready(function ($) {
    var scrollToTopButton = $('#scroll-to-top');

    $(window).scroll(function () {
        if ($(this).scrollTop() > 500) {
            scrollToTopButton.css({
                'opacity': 1,
                'visibility': 'visible'
            });
        } else {
            scrollToTopButton.css({
                'opacity': 0,
                'visibility': 'hidden'
            });
        }
    });

    scrollToTopButton.click(function () {
        $('html, body').animate({
            scrollTop: 0
        }, 'smooth');
    });
});
