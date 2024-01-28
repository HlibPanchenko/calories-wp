jQuery(document).ready(function ($) {
    var headerBottom = $('.main-header_bottom');
    var mainWrapper = $('.main-wrapper');
    var fixedClass = 'fixed-header';
    var layoutFixedMarginClass = 'layout-fixed-margin';
    var threshold = 55;

    // Функция для обработки события прокрутки
    function handleScroll() {
        var scrollY = window.scrollY || window.pageYOffset;
        // console.log(scrollY);
        if (scrollY > threshold) {
            headerBottom.addClass(fixedClass);
            mainWrapper.addClass(layoutFixedMarginClass);
        } else {
            headerBottom.removeClass(fixedClass);
            mainWrapper.removeClass(layoutFixedMarginClass);
        }
    }

    // Проверка ширины экрана перед привязкой обработчика событий прокрутки
    if ($(window).width() > 1024) {
        $(window).scroll(handleScroll);

        // Выполнить обработку события при загрузке страницы (если необходимо)
        handleScroll();
    }
});
