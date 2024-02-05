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

    public static function human_readable_time_diff($date_from) {
        $timestamp = strtotime($date_from);
        $difference = time() - $timestamp;

        // Секунды в разных временных промежутках
        $minute = 60;
        $hour = $minute * 60;
        $day = $hour * 24;
        $month = $day * 30;
        $year = $day * 365;

        // Расчет разницы
        if ($difference < $minute) {
            return $difference . " секунд назад";
        } elseif ($difference < $hour) {
            $minutes = floor($difference / $minute);
            return self::getTimeAgoString($minutes, 'минут', 'минуту', 'минуты');
        } elseif ($difference < $day) {
            $hours = floor($difference / $hour);
            return self::getTimeAgoString($hours, 'часов', 'час', 'часа');
        } elseif ($difference < $month) {
            $days = floor($difference / $day);
            return self::getTimeAgoString($days, 'дней', 'день', 'дня');
        } elseif ($difference < $year) {
            $months = floor($difference / $month);
            return self::getTimeAgoString($months, 'месяцев', 'месяц', 'месяца');
        } else {
            $years = floor($difference / $year);
            return self::getTimeAgoString($years, 'лет', 'год', 'года');
        }
    }

    private static function getTimeAgoString($value, $plural, $singular, $few) {
        $absValue = abs($value);
        $lastDigit = $absValue % 10;
        $lastTwoDigits = $absValue % 100;

        if ($lastTwoDigits >= 11 && $lastTwoDigits <= 19) {
            return $value . ' ' . $plural . ' назад';
        }

        if ($lastDigit == 1) {
            return $value . ' ' . $singular . ' назад';
        }

        if ($lastDigit >= 2 && $lastDigit <= 4) {
            return $value . ' ' . $few . ' назад';
        }

        return $value . ' ' . $plural . ' назад';
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
