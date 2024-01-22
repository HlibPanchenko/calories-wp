jQuery(document).ready(function ($) {
    // При нажатии на крестик
    $('.success-message_close').click(function () {
        // Скрываем родительский элемент .success-message
        $(this).closest('.success-message').hide();
    });
});