<?php

use src\UtilsClass;
/*
 * передавать сюда текущую таксономию блюда чтобы формировать в header-day_wrapper ссылку на страницу этой таксономии
 * */
// Получаем переданную таксономию
$current_taxonomy = isset($args['current_taxonomy']) ? $args['current_taxonomy'] : array();
//var_dump($current_taxonomy);
if (!empty($current_taxonomy)) {
    $dish_link = get_term_link($current_taxonomy[0]);
}

?>

<section class="recipe-layout">

    <div class="recipe-layout_container">
        <header class="recipe-layout_header header-layout">
            <div class=" header-layout_wrapper">
                <a href="<?php echo esc_url($dish_link); ?>" class=" header-layout_link shaked-el" >
                    <span class="header-layout_linktext _anim-items">Рецепты из этой категории</span>
                    <span class="header-layout_svg-wrapper">
                        <svg width="36px" height="36px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M4 12H20M20 12L16 8M20 12L16 16" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
                    </span>
                </a>
            </div>
        </header>
        <div class="recipe-layout_content content-layout">
            <div class="content-layout_wrapper">
                <!--сюда выводить-->

                <?php

                if (!empty($current_taxonomy) && is_array($current_taxonomy) && isset($current_taxonomy[0]) && is_a($current_taxonomy[0], 'WP_Term')) {
                $dish_term_id = $current_taxonomy[0]->term_id;

                // Создаем новый запрос для получения 6 постов из текущей таксономии
                $args = array(
                    'post_type'      => 'recipe',  // Укажите тип поста, который вы используете
                    'posts_per_page' => 6,
                    'tax_query'      => array(
                        array(
                            'taxonomy' => 'dish',  // Укажите название вашей таксономии
                            'field'    => 'id',
                            'terms'    => $current_taxonomy[0]->term_id,
                        ),
                    ),
                );

                $query = new WP_Query($args);

                if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();

                    // Get ACF fields
                    $images = get_field('images_of_recepie');
                    $calories = get_field('k-vo_kalorij');
                    $timeCook = get_field('vremya_na_gotovku');


                    if (isset($timeCook) && is_numeric($timeCook)) {
                        [$timeCookHours, $timeCookMins] = UtilsClass::minsToHours($timeCook);
                    } else {
                        // Handle the case when $timeCook is not set or not a number
                        $timeCookHours = 0;
                        $timeCookMins = 0;
                    }
                    /*render markup*/
                    $time_markup = UtilsClass::generateTimeMarkup($timeCookHours, $timeCookMins);

                    // Получаем все таксономии для текущего поста
                    $part_of_the_day_terms = get_the_terms(get_the_ID(), 'part_of_the_day');
//                    var_dump(  $part_of_the_day_terms);
                    ?>

                    <!-- Display recipe information -->
                    <div class="content-layout_card card-layout">
                        <a href="<?php the_permalink(); ?>" class="card-layout_link">
                            <div class="card-layout_header">
                                <?php
                                if ($images && is_array($images) && !empty($images)) {

                                    echo '<img src="' . esc_url($images[0]) . '" alt="Image in card" class="card-layout_img">';

                                } else {
                                    // Fallback image if no images are found
                                    echo '<img src="' . get_template_directory_uri() . '/dist/images/default-image.jpg" alt="Default Image" class="card-layout_img">';
                                }
                                ?>
                                <!--                                <img src="--><?php //echo get_template_directory_uri() ?><!--/dist/images/SImply-Recipes-Fondant-Potatoes-METHOD-10-0f009ff3e0ce47a196cc97bff2c4fd80.webp" alt="image in card" class="card-day_img">-->
                            </div>
                            <div class="card-layout_info">
<!--                                <div class="card-layout_subtitle">-->
<!--                                    <div class="card-layout_calories">-->
<!--                                        <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff" stroke-width="0.9359999999999999">-->
<!--                                            <path d="M14.5 10.0003C14.5 9.20875 15.5528 8.99895 15.8321 9.73957C16.5077 11.5311 17 13.1337 17 14.0002C17 16.7616 14.7614 19.0002 12 19.0002C9.23858 19.0002 7 16.7616 7 14.0002C7 13.0693 7.56822 11.2887 8.32156 9.33698C9.29743 6.80879 9.78536 5.54469 10.3877 5.4766C10.5804 5.45482 10.7907 5.49399 10.9626 5.58371C11.5 5.86413 11.5 7.24285 11.5 10.0003C11.5 10.8287 12.1716 11.5003 13 11.5003C13.8284 11.5003 14.5 10.8287 14.5 10.0003Z" stroke="#666666"></path>-->
<!--                                            <path d="M11 19L10.7372 18.343C10.2816 17.204 10.4737 15.9079 11.24 14.95V14.95C11.6296 14.463 12.3704 14.463 12.76 14.95V14.95C13.5263 15.9079 13.7184 17.204 13.2628 18.343L13 19" stroke="#666666"></path>-->
<!--                                        </svg>-->
                                        <!--                                        <span>120 ккал</span>-->
<!--                                        <span>--><?php //echo $calories; ?><!-- ккал</span>-->
<!--                                    </div>-->
<!--                                    <div class="card-layout_time">-->
<!--                                        <svg width="24px" height="24px" viewBox="-2.4 -2.4 28.80 28.80" fill="none" xmlns="http://www.w3.org/2000/svg" transform="matrix(-1, 0, 0, 1, 0, 0)rotate(0)" stroke="#ffffff" stroke-width="1.7280000000000002">-->
<!--                                            <rect width="24" height="24" fill="white"></rect>-->
<!--                                            <circle cx="12" cy="12" r="9" stroke="#666666" stroke-linecap="round" stroke-linejoin="round"></circle>-->
<!--                                            <path d="M12 6V12L7.5 7.5" stroke="#666666" stroke-linecap="round" stroke-linejoin="round"></path>-->
<!--                                        </svg>-->
<!--                                        <span>--><?php //echo $time_markup ?><!--</span>-->
<!--                                    </div>-->
<!--                                </div>-->
                                <div class="card-layout_title"><?php the_title(); ?></div>
                                <div class="card-layout_excerpt"><?php echo get_the_excerpt() ?></div>
                            </div>
                        </a>

                    </div>

                <?php endwhile; ?>

                <?php wp_reset_postdata();
                else :
                    echo 'Нет постов для отображения.';
                endif;
                } ?>

            </div>
        </div>
    </div>
</section>
