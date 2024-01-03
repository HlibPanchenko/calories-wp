<?php

namespace src;

class UtilsClass
{

    public static function minsToHours(int $minutes): array
    {
        // Рассчитываем количество часов и минут
        $hours = floor($minutes / 60);
        $remainingMinutes = $minutes % 60;

        // Возвращаем результат в виде массива
        return [$hours, $remainingMinutes];
    }

    public static function generateTimeMarkup($timeCookHours, $timeCookMins): string
    {
        // Build the HTML markup for time
        $time_markup = '';

        // Check if $timeCookHours is zero
        if ($timeCookHours == 0) {
            $time_markup .= $timeCookMins . ' мин';
        } else {
            $time_markup .= $timeCookHours . ' час ' . $timeCookMins . ' мин';
        }

        return $time_markup;
    }

    public static function get_taxonomy_terms($taxonomy_keys)
    {
        $result = array();

        foreach ($taxonomy_keys as $key) {
            $terms = get_terms(array(
                'taxonomy' => $key,
                'hide_empty' => false,
            ));

            $result[] = array(
                $key => $terms,
            );
        }

        return $result;
    }

    public static function custom_excerpt($text, $length = 20, $append = '...')
    {
        $excerpt = strip_tags($text);
        if (mb_strlen($excerpt, 'UTF-8') > $length) {
            $excerpt = mb_substr($excerpt, 0, $length, 'UTF-8');
            $excerpt .= $append;
        }
        return $excerpt;
    }

    public static function limit_title_to_one_line($title, $max_length = 50, $append = '...') {
        $title = strip_tags($title); // Удаляем HTML-теги
        if (mb_strlen($title, 'UTF-8') > $max_length) {
            $title = mb_substr($title, 0, $max_length, 'UTF-8');
            $title .= $append;
        }
        return $title;
    }

    public static function debug($data)
    {
        echo '<pre>' . print_r($data, 1) . '</pre>';
    }
}
