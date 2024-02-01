<?php

namespace src;

class UserPostsHandler
{
    public static function init(): void
    {
        add_action('wp_ajax_hide_user_post', [__CLASS__, 'hide_user_post']);
        add_action('wp_ajax_activate_user_post', [__CLASS__, 'activate_user_post']);
        add_action('wp_ajax_delete_user_post', [__CLASS__, 'delete_user_post']);
//        add_action('wp_ajax_nopriv_hide_user_post', [__CLASS__, 'hide_user_post']);
    }

    public static function hide_user_post()
    {
        if( ! wp_verify_nonce( $_POST['nonce_code'], 'myajax-nonce' ) ) die( 'Stop!');

        $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;

        // Проверяем, существует ли пост
        if (get_post_status($post_id) === false) {
            self::add_session_message('error', 'Пост не найден');
            wp_send_json_error('Пост не найден');
            return;
        }

        // Проверяем тип поста
        $post_type = get_post_type($post_id);

        if ($post_type === 'post') {
            // Обновляем поле для типа 'post'
            update_field('post_is_active', false, $post_id);
        } elseif ($post_type === 'recipe') {
            // Обновляем поле для типа 'recipe'
            update_field('recipe_is_active', false, $post_id);
        } else {
            self::add_session_message('error', 'Неподдерживаемый тип поста');
            wp_send_json_error('Неподдерживаемый тип поста');
            return;
        }
        self::add_session_message('success', 'Пост успешно скрыт');

        wp_send_json_success(['message' => 'Пост успешно скрыт']);

        die;
    }

    public static function activate_user_post()
    {
        if( ! wp_verify_nonce( $_POST['nonce_code'], 'myajax-nonce' ) ) die( 'Stop!');

        $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;

        // Проверяем, существует ли пост
        if (get_post_status($post_id) === false) {
            self::add_session_message('error', 'Пост не найден');
            wp_send_json_error('Пост не найден');
            die;
        }

        // Проверяем тип поста
        $post_type = get_post_type($post_id);

        if ($post_type === 'post') {
            // Обновляем поле для типа 'post'
            update_field('post_is_active', true, $post_id);
        } elseif ($post_type === 'recipe') {
            // Обновляем поле для типа 'recipe'
            update_field('recipe_is_active', true, $post_id);
        } else {
            self::add_session_message('error', 'Неподдерживаемый тип поста');
            wp_send_json_error('Неподдерживаемый тип поста');
            return;
        }
        self::add_session_message('success', 'Теперь ваша публикация видна для других пользователей');

        wp_send_json_success(['message' => 'Пост успешно активирован']);

        die;
    }

    public static function delete_user_post()
    {
        if( ! wp_verify_nonce( $_POST['nonce_code'], 'myajax-nonce' ) ) die( 'Stop!');

        $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
        if (get_post_status($post_id) === false) {
            self::add_session_message('error', 'Пост не найден');
            wp_send_json_error('Пост не найден');
            return;
        }

        // Определение capability в зависимости от типа записи
        $post_type = get_post_type($post_id);
//        $capability = 'delete_post';
        $capability = ($post_type === 'recipe') ? 'delete_recipes' : 'delete_post';

        // Проверка, имеет ли текущий пользователь право удалять этот пост
        if (current_user_can($capability, $post_id)) {
            wp_delete_post($post_id, true); // Удаление поста навсегда
            self::add_session_message('success', 'Пост успешно удален');
            wp_send_json_success(['message' => 'Пост успешно удален']);
        } else {
            self::add_session_message('error', 'У вас нет прав на удаление этого поста');
            wp_send_json_error('У вас нет прав на удаление этого поста');
        }

        die;
    }

    public static function add_session_message($type, $message) {
        if (!isset($_SESSION['user-posts-manage'])) {
            $_SESSION['user-posts-manage'] = array();
        }
        $_SESSION['user-posts-manage'][] = array('type' => $type, 'message' => $message);
    }

}
