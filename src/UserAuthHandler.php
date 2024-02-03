<?php

namespace src;

class UserAuthHandler
{
    public static function init(): void
    {
        add_action('acf/save_post', [__CLASS__, 'check_has_activated_change'], 20);
    }

    public static function check_has_activated_change($post_id) {
        // Проверяем, что сохраняемый пост является пользовательским профилем
        if (strpos($post_id, 'user_') === 0) {
            // Приходит например 'user_123'. Отрезаем "user_" и оставляем только ID
//            $post_id = (int) substr($post_id, strlen('user_'));

            $has_activated = get_field('has_activated', $post_id);
//            $_SESSION['changed_post_id'] = 'Прошлое значение: ' . $has_activated;

            if ($has_activated !== 1) {
                // Получаем ID пользователя
                $user_id = (int)str_replace('user_', '', $post_id);
                // Деавторизация пользователя
                wp_logout($user_id);
            }
        }
    }
}