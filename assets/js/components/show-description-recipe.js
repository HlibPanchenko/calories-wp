jQuery(document).ready(function ($) {
    $('._show-all-description').on('click', function () {
        $('.left-recipe_text').toggleClass('expanded');

        var buttonText = $('._show-all-description_btn').text();

        if (buttonText.trim() === 'Читать полностью') {
            $('._show-all-description_btn').text('Скрыть');
            $('._show-all-description_arrow').addClass('_arrow opened');
        } else {
            $('._show-all-description_btn').text('Читать полностью');
            $('._show-all-description_arrow').removeClass('_arrow opened');
        }

        // Прокручиваем к блоку .left-recipe_title
        $('html, body').animate({
            scrollTop: $('.left-recipe_title').offset().top
        }, 500);
    });
});
