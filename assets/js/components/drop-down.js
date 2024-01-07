jQuery(document).ready(function($) {
    $(".main-header_burger").on("click", function (event) {
        /*показываем стреочки у li, у которых есть submenu. Только li которые в бургере*/
        /*делаем все только если бургер active*/
        $("#menu-main-menu-in-header li").each(function (index, element) {
            var $currentItem = $(element);
            var $subMenu = $currentItem.find(".sub-menu");

            // Удаляем все элементы с классом "dropdown-arrow"
            $currentItem.find(".dropdown-arrow").remove();


            if ($subMenu.length > 0) {
                $currentItem.addClass("has-submenu");
                // if ($(window).width() <= 768) {
                if ($(window).width() <= 1024) {
                    // Добавляем элемент с стрелочкой после текста ссылки
                    $currentItem.append('<span class="dropdown-arrow"></span>');
                }
            }
        });

        // Обработчик клика на стрелочке
        $("#menu-main-menu-in-header").on("click", ".has-submenu", function () {
        // $("#menu-main-menu-in-header").on("click", ".dropdown-arrow", function () {
        //     var listItem = $(this).closest("li");
            var listItem = $(this);
            console.log(listItem);

            // Закрыть все другие дропдауны
            $("#menu-main-menu-in-header li").not(listItem).removeClass("dropdown-open").find('.dropdown-menu-in-burger').remove();

            // все стрелочки у всех li кроме текущего возвращаем в исходное положение
            $("#menu-main-menu-in-header li").not(listItem).find('.dropdown-arrow').removeClass("dropdown-arrow_opened");
            // переворичиваем стрелочку
            // $(this).toggleClass("dropdown-arrow_opened");
            listItem.find('.dropdown-arrow').toggleClass("dropdown-arrow_opened");
            // Переключение класса и создание/удаление элемента .dropdown-menu
            listItem.toggleClass("dropdown-open");

            if (listItem.hasClass("dropdown-open")) {
                /*+ проверка есть ли у этого ли класс "burger-item"*/
                if (listItem.hasClass("burger-item")) {
                    var dropdownInBurger = $('<div class="dropdown-menu-in-burger"><ul class="dropdown-burger_list"></ul></div>');
                    var subMenuItems = listItem.find('.sub-menu').html();
                    dropdownInBurger.find('ul').html(subMenuItems);
                    listItem.append(dropdownInBurger);
                    // console.log('burger menu')
                }
            } else {
                listItem.find('.dropdown-menu-in-burger').remove();
                listItem.find('.dropdown-arrow').removeClass("dropdown-arrow_opened");
                // console.log('close')
            }

        });
    })

});



