<?php

/**
 * Template Name: activation-page
 */

if (isset($_GET['key']) && isset($_GET['user'])) {
    $user_id = intval($_GET['user']);
//    $key = get_user_meta($user_id, 'activation_key', true);
    $key = get_field('activation_key', 'user_' . $user_id);

    // Проверка ключа активации
    if ($key == $_GET['key']) {
        // Удаление ключа активации
        delete_user_meta($user_id, 'activation_key');
//        update_user_meta($user_id, 'has_activated', 'true'); // Устанавливаем статус активации как 'true'
        // Установка статуса активации через ACF
        update_field('has_activated', true, 'user_' . $user_id);
        // Здесь могут быть дополнительные действия, например, установка роли пользователя
        // ...
        $_SESSION['registration_success'] = 'Регистрация прошла успешно. Можете войти в свой аккаунт';
        // Переадресация на страницу входа с сообщением об успешной активации
        wp_redirect(home_url('/auth'));
        exit;
    }
}

?>