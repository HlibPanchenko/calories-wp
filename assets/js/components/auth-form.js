jQuery(document).ready(function ($) {
    // Получаем элементы
    var registerBlock = $('#register-block');
    var loginBlock = $('#login-block');
    var btnToLogin = $('#btn-to-login');
    var btnToRegister = $('#btn-to-register');

    // Функция для показа формы регистрации и скрытия формы входа
    function showRegister() {
        registerBlock.show();
        loginBlock.hide();
    }

    // Функция для показа формы входа и скрытия формы регистрации
    function showLogin() {
        registerBlock.hide();
        loginBlock.show();
    }

    // Назначение обработчиков событий
    btnToLogin.on('click', showLogin);
    btnToRegister.on('click', showRegister);

    // Начальное состояние
    showRegister(); // Или showLogin(), если нужно показать форму входа
});
