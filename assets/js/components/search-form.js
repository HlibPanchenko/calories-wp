jQuery(document).ready(function ($) {
    // Назначаем обработчик события на клик по иконке поиска
    $(".search-block img").click(function() {
        $(".search-block_form").css("display", "block");
        $(".search-block img").css("display", "none");
        /*блок авторизации*/
        $(".main-header_auth").css("display", "none");
    });

    // Назначаем обработчик события на клик по кнопке "Close"
    $(".search-block_close").click(function () {
        // Возвращаем все к исходному состоянию
        $(".search-block_form").css("display", "none");
        $(".search-block img").css("display", "block");
        /*деалать только если размер экрана больше чем 768*/
        // $(".main-header_auth").css("display", "block");
        if (window.innerWidth > 768) {
            $(".main-header_auth").css("display", "block");
        }
    });

})