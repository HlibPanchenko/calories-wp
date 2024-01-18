jQuery(document).ready(function ($) {
    // Назначаем обработчик события на клик по иконке поиска
    $(".search-block .search-block_svg").click(function () {
    // $(".search-block img").click(function () {
        $(".search-block_form").css("display", "block");
        $(".search-block .search-block_svg").css("display", "none");
        // $(".search-block img").css("display", "none");
        /*блок авторизации*/
        $(".main-header_auth").css("display", "none");
        /*лого*/
        if (window.innerWidth  <= 768) {
            $(".logo-in-header_whole").addClass("show");
            // $(".main-header_logo").addClass("show");
        }

        // Устанавливаем фокус на поле ввода
        $("#general-search__search-input").focus();

    });

    // Назначаем обработчик события на клик по кнопке "Close"
    $(".search-block_close").click(function () {
        // Возвращаем все к исходному состоянию
        $(".search-block_form").css("display", "none");
        $(".search-block .search-block_svg").css("display", "block");
        // $(".search-block img").css("display", "block");
        /*деалать только если размер экрана больше чем 768*/
        // $(".main-header_auth").css("display", "block");
        if (window.innerWidth > 768) {
            $(".main-header_auth").css("display", "block");
        }

        /*лого*/
        if (window.innerWidth  <= 768) {
            $(".logo-in-header_whole").removeClass("show");
            // $(".main-header_logo").removeClass("show");
        }
    });

})