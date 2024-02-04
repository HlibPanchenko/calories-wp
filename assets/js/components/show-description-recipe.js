jQuery(document).ready(function ($) {
    $('._show-all-description_btn').on('click', function () {
        // Изменяем стили при каждом клике
        $('.left-recipe_text').toggleClass('expanded');

        // Получаем текущий текст кнопки
        var buttonText = $(this).text();

        // Изменяем текст кнопки в зависимости от текущего состояния
        if (buttonText.trim() === 'Читать полностью') {
            $(this).text('Скрыть');
        } else {
            $(this).text('Читать полностью');
        }

        // Прокручиваем к блоку .left-recipe_title
        $('html, body').animate({
            scrollTop: $('.left-recipe_title').offset().top
        }, 500);
    });
});
