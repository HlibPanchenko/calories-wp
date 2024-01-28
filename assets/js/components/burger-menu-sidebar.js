jQuery(document).ready(function ($) {
    function lockScroll() {
        document.body.classList.toggle('lock-scroll');
    }

    function addArrows() {
        // Условие для ширины экрана, чтобы добавить стрелки только для мобильных устройств
        if ($(window).width() <= 1024) {
            $("#menu-burger-menu li").each(function (index, element) {
                var $currentItem = $(element);
                var $subMenu = $currentItem.find(".sub-menu");

                // Удаляем все существующие стрелки, чтобы избежать дублирования
                $currentItem.find(".dropdown-arrow").remove();

                // Если у элемента есть подменю, добавляем стрелку
                if ($subMenu.length > 0) {
                    $currentItem.addClass("has-submenu").append('<span class="dropdown-arrow"></span>');
                }
            });
        }
    }

    // Вызываем функцию addArrows при загрузке страницы
    addArrows();

    // Обработка клика по бургер-меню
    $(".main-header_burger").on("click", function (event) {
        lockScroll(); // Блокируем прокрутку

        // Переключаем классы для активации меню и бургера
        $(".main-nav, .main-header_burger").toggleClass("active");
        $('.burger-menu_wrapper').toggleClass('opened');
        $('.burger-submenu_wrapper').removeClass('opened');

    });

    // Добавляем обработчики событий на ссылки для раскрытия подменю
    $(document).on("click", ".has-submenu", function (event) {
    // $(document).on("click", ".dropdown-arrow", function (event) {
        event.stopPropagation(); // Предотвращаем всплытие события
        $('.burger-submenu_wrapper').addClass('opened');

        /*найди мне ближайший menu-item*/
        var $menuItem = $(this);
        // var $menuItem = $(this).closest('.menu-item');
        /*найди мне ближайший sub-menu*/
        /* используем метод .clone() для клонирования найденного подменю.
        Это позволяет нам сохранить оригинальное подменю в DOM и одновременно вставить его копию в другое место.*/
        var $subMenu = $menuItem.find('.sub-menu').clone();

        // Вставляем клонированное подменю в .burger-submenu_menu
        $('.burger-submenu_menu').html($subMenu);

    });

    $(document).on("click", ".burger-submenu_arrow", function (event) {
        /*стрелочка burger-submenu_arrow должна  $('.burger-submenu_wrapper').removeClass('opened');*/

        event.stopPropagation();
        var $submenuWrapper = $('.burger-submenu_wrapper');

        $submenuWrapper.removeClass('opened');

    });

});
