jQuery(document).ready(function ($) {
    // Добавьте обработчик изменения размера окна
    $(window).on("resize", function() {
        // /*удаляем стрелочки на больших экранах*/
        // /*если ширина окна больше чем 768*/
        // if ($(window).width() > 768) {
        if ($(window).width() > 1024) {
            $("#menu-main-menu-in-header li").find('.dropdown-arrow').remove();
        }
    });

    $(".main-header_burger").on("click", function (event) {
        /*при открытии бургера закрываем все открытые вложенные менюшки в хедере*/
        $(".dropdown-menu").remove();

        $(".main-nav, .main-header_burger").toggleClass("active");
        // Навешиваем класс "burger-item" на каждый li
        $(".main-nav .main-nav_list li").toggleClass("burger-item");

        $('body').toggleClass('lock'); // при открытом бургер меню не скроллится контент



        // Закрываем все вложенные менюшки при закрытии бургера
        if (!$(".main-header_burger").hasClass("active")) {
            $(".main-nav .main-nav_list li").find('.dropdown-menu-in-burger').remove();
            // // /*удаляем стрелочки на больших экранах*/
            // // /*если ширина окна больше чем 768*/
            // if ($(window).width() > 768) {
            //     $("#menu-main-menu-in-header li").find('.dropdown-arrow').remove();
            // }

        }
    });


})
