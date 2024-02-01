<?php

namespace src;

class AcfFormCustom
{
    public static function init(): void
    {
        add_filter('acf/prepare_field', [__CLASS__, 'my_acf_prepare_field']);
        add_filter('acf/prepare_field', [__CLASS__, 'my_hide_acf_field_on_frontend']);
        add_filter('ajax_query_attachments_args', [__CLASS__, 'myprefix_show_current_user_attachments']);
        add_action('acf/save_post', [__CLASS__, 'my_acf_save_post'], 20);
        add_filter('acf/prepare_field/name=images_of_recepie', [__CLASS__, 'my_custom_acf_field_label_images_of_recepie']);
        add_filter('acf/prepare_field/name=_post_title', [__CLASS__, 'my_custom_acf_field_label_post_title']);
        add_filter('acf/prepare_field/name=_post_content', [__CLASS__, 'my_custom_acf_field_label_post_content']);

    }

    public static function my_acf_prepare_field($field)
    {
        if ($field['key'] == 'field_657acfce05a3a') {
            $field['acf-gallery-add'] = 'Добавить фото'; // Your custom text
        }
        return $field;
    }

    /*исключить определённые поля из вывода на фронтенде в форме - поле Является ли рецепт популярным*/
    public static function my_hide_acf_field_on_frontend($field)
    {
        // Проверяем, что форма выводится на фронтенде, а не в админ-панели
        if (!is_admin()) {
            // Проверяем, является ли это поле тем, которое мы хотим скрыть
            if ($field['_name'] == 'popular_boolean') {
                // Возвращаем false, чтобы поле не отображалось
                return false;
            }

            if ($field['_name'] == 'recipe_is_active') {
                // Возвращаем false, чтобы поле не отображалось
                return false;
            }
        }
        // Возвращаем оригинальный массив поля, если это не то поле, которое мы хотим скрыть
        return $field;
    }

    /*чтобы пользователь при загрузке картинок видел только свои картинки*/
    public static function myprefix_show_current_user_attachments($query)
    {
        $user_id = get_current_user_id();
        if ($user_id && !current_user_can('activate_plugins') && !current_user_can('edit_others_posts')) {
            $query['author'] = $user_id;
        }
        return $query;
    }

    /*после создания рецепта редирект + сообщение*/
    public static function my_acf_save_post($post_id)
    {
        // Убедитесь, что не обрабатываете автоматические ревизии и не сохраняете новый пост
        if (wp_is_post_revision($post_id) || get_post_type($post_id) != 'recipe') {
            return;
        }

        // Перенаправляем на страницу нового рецепта
        $_SESSION['recipe_added'] = 'Ваш рецепт будет опубликован после проверки!';
//        wp_redirect(get_permalink($post_id));
        wp_redirect(home_url(''));
        exit;
    }

    /*изменить метки (labels) полей в форме ACF на фронтенде, не затрагивая их в админ-панели*/
    public static function my_custom_acf_field_label_images_of_recepie($field) {
        if (!is_admin()) {
            $field['label'] = 'Изображения вашего рецепта';
        }
        return $field;
    }

    public static function my_custom_acf_field_label_post_title( $field ) {
        $field['label'] = 'Название вашего рецепта'; // Новая метка для поля
        $field['instructions'] = 'Оно будет показано в общей ленте'; // Новые инструкции для поля

        return $field;
    }

    public static function my_custom_acf_field_label_post_content( $field ) {
        $field['label'] = 'Описание вашего рецепта'; // Новая метка для поля
//        $field['instructions'] = 'Оно будет показано в общей ленте'; // Новые инструкции для поля

        return $field;
    }
}