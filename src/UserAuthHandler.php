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
            // Отрезаем "user_" и оставляем только ID
            $user_id = (int) substr($post_id, strlen('user_'));

            $has_activated = get_field('has_activated', 'user_' . $user_id);
//            $_SESSION['changed_post_id'] =  $post_id;

            if ($has_activated == false) {
                // Если не админ, разлогиниваем
                /*Разлогинивает не пользователей у которых has activated false, а админа который внес изменения*/
//                if ($post_id !== 'user_1') {
//                    wp_logout($post_id);
                }

//                if ($user_id !== 1) {  // 1 - это ID админа
//                    wp_logout($user_id);
//                }
            }
        }
    }
