<?php

namespace src;

class utilsClass
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

    public static function get_taxonomy_terms($taxonomy_keys) {
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

    public static function debug($data)
{
    echo '<pre>' . print_r($data, 1) . '</pre>';
}
}