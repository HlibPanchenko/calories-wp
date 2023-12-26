<?php

namespace src;

class SortHandler
{
    public static function init()
    {
        // Хук для обработки AJAX-запросов
        add_action('wp_ajax_handle_custom_request', [__CLASS__, 'handle_custom_request']);
        add_action('wp_ajax_nopriv_handle_custom_request', [__CLASS__, 'handle_custom_request']);
    }

    public static function handle_custom_request()
    {
        $selectedData = isset($_POST['selectedData']) ? $_POST['selectedData'] : array();
        $page = isset($_POST['page']) ? absint($_POST['page']) : 1;

//        $posts_per_page = get_option('posts_per_page');
        $posts_per_page = 8;
        $offset = ($page - 1) * $posts_per_page;

        error_log(print_r($selectedData, true));

        // Обработайте данные и подготовьте аргументы для WP_Query
        $query_args = array(
            'post_type' => 'recipe',
            'posts_per_page' => $posts_per_page,
            'offset' => $offset,
        );

        // Добавьте аргументы на основе данных, пришедших из AJAX
        if (!empty($selectedData['calories'])) {
            $calories_args = array('relation' => 'OR');
            foreach ($selectedData['calories'] as $calories_range) {
                list($min, $max) = explode('-', $calories_range);
                $calories_args[] = array(
                    'key' => 'k-vo_kalorij',
                    'value' => array($min, $max),
                    'type' => 'NUMERIC',
                    'compare' => 'BETWEEN',
                );
            }
            $query_args['meta_query'][] = $calories_args;
        }

        if (!empty($selectedData['cook_time'])) {
            $cooktime_args = array('relation' => 'OR');
            foreach ($selectedData['cook_time'] as $cooktime_range) {
                list($min, $max) = explode('-', $cooktime_range);
                $cooktime_args[] = array(
                    'key' => 'vremya_na_gotovku',
                    'value' => array($min, $max),
                    'type' => 'NUMERIC',
                    'compare' => 'BETWEEN',
                );
            }
            $query_args['meta_query'][] = $cooktime_args;
        }


        // Для 'ingredients'
        if (!empty($selectedData['ingredients'])) {
            $query_args['tax_query'][] = array(
                'taxonomy' => 'ingredients',
                'field' => 'id',
                'terms' => $selectedData['ingredients'],
                'operator' => 'IN',
            );
        }

        // Для 'cooking-method'
        if (!empty($selectedData['cooking-method'])) {
            $query_args['tax_query'][] = array(
                'taxonomy' => 'cooking-method',
                'field' => 'id',
                'terms' => $selectedData['cooking-method'],
                'operator' => 'IN',
            );
        }

        // Для 'dish'
        if (!empty($selectedData['dish'])) {
            $query_args['tax_query'][] = array(
                'taxonomy' => 'dish',
                'field' => 'id',
                'terms' => $selectedData['dish'],
                'operator' => 'IN',
            );
        }

        // Создайте объект WP_Query
        $recipes_query = new \WP_Query($query_args);

        // Отправляем информацию о пагинации обратно на фронт
        $pagination_data = array(
            'max_num_pages' => $recipes_query->max_num_pages,
            'current_page' => $page,
        );

        // Обработайте результаты запроса
        $posts_data = array(); // Массив для хранения данных постов

        if ($recipes_query->have_posts()) {
            while ($recipes_query->have_posts()) {
                $recipes_query->the_post();
                $images = get_field('images_of_recepie');
                $calories = get_field('k-vo_kalorij');
                $timeCook = get_field('vremya_na_gotovku');

                $post_data = array(
                    'title' => get_the_title(),
                    'content' => get_the_content(),
                    'permalink' => get_permalink(),
                    'excerpt' => get_the_excerpt(),
                    'images' => $images, // Добавляем изображения
                    'calories' => $calories, // Добавляем калории
                    'timeCook' => $timeCook, // Добавляем время готовки
                    // Добавьте другие данные, которые вам нужны
                );
                $posts_data[] = $post_data; // Добавляем данные поста в массив
            }
            wp_reset_postdata();
        } else {
            // Нет рецептов, удовлетворяющих запросу
            error_log('No posts found');
        }

        // Отправьте ответ обратно на фронт
        $data_to_send = array(
            'status' => 'success',
            'message' => 'Запрос успешно обработан.',
            'posts' => $posts_data,
            'pagination' => $pagination_data,
            'filters' =>  $selectedData,
        );

        wp_send_json($data_to_send);
    }
}