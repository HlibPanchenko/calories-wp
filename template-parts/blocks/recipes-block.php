<?php

use src\UtilsClass;

$uniqid = uniqid('recipes-block-');

$recipes_block = get_field('block_recipes'); // block
/*
 * array(4) { [“block_recipes_title”]=> string(17) “Рецепты :)” [“block_recipes_checkbox”]=> array(6) { [0]=> int(296) [1]=> int(95) [2]=> int(184) [3]=> int(233) [4]=> int(53) [5]=> int(86) } [“block_recipes_background”]=> string(15) “rgb(238,238,34)” [“block_recipes_color”]=> string(7) “#eaeaea” } string(7) “#eaeaea” string(15) “rgb(238,238,34)”
 * */
$recipes_block_title = $recipes_block['block_recipes_title'];
$recipes_block_ids = $recipes_block['block_recipes_checkbox'];
$recipes_block_link = $recipes_block['block_recipes_link'];

?>

<style>
    <?php
    $recipes_block_background = $recipes_block['block_recipes_background'];
    $recipes_block_color = $recipes_block['block_recipes_color'];

    echo <<<EOT
    #$uniqid {
         background: $recipes_block_background;
    }
         
    #$uniqid .header-layout_linktext {
        color:$recipes_block_color;
    }
     
    #$uniqid .header-layout_linktext:hover {
        border-bottom: 2px solid $recipes_block_color;
    }
     
    #$uniqid .header-arrow path {
        stroke: $recipes_block_color;
    }
     
     #$uniqid .card-layout_title {
        color:$recipes_block_color;
     }
     
     #$uniqid .card-layout_excerpt {
        color:$recipes_block_color;
     }
    EOT;
    ?>
</style>


<!--<section class="recipe-layout">-->
<section class="recipe-layout" id="<?php echo $uniqid; ?>">
    <div class="recipe-layout_container">
        <header class="recipe-layout_header header-layout">
            <div class=" header-layout_wrapper">
                <!--В админке сделать поле для ссылки-->
                <a href="<?php echo esc_url(home_url('/' . $recipes_block_link)); ?>"
                   class=" header-layout_link shaked-el">
                    <span class="header-layout_linktext _anim-items"><?php echo esc_html($recipes_block_title) ?></span>
                    <span class="header-layout_svg-wrapper">
                        <svg class="header-arrow" width="36px" height="36px" viewBox="0 0 24 24" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
<path d="M4 12H20M20 12L16 8M20 12L16 16" stroke="#000000" stroke-width="2" stroke-linecap="round"
      stroke-linejoin="round"/>
</svg>
                    </span>
                </a>
            </div>
        </header>
        <div class="recipe-layout_content content-layout">
            <div class="content-layout_wrapper">

                <!--сюда выводить-->

                <?php

                if (is_array($recipes_block_ids) && !empty($recipes_block_ids)) {
                    // Query arguments
                    $args = array(
                        'post_type' => 'recipe',
                        'posts_per_page' => 6,
                        'post__in' => $recipes_block_ids,
                        'orderby' => 'post__in',
                    );

                    $query = new WP_Query($args);

                    if ($query->have_posts()) :
                        while ($query->have_posts()) :
                            $query->the_post();

                            // Get ACF fields
                            $post_id = get_the_ID();
                            $images = get_field('images_of_recepie', $post_id);
                            $calories = get_field('k-vo_kalorij', $post_id);
                            $timeCook = get_field('vremya_na_gotovku', $post_id);


                            if (isset($timeCook) && is_numeric($timeCook)) {
                                [$timeCookHours, $timeCookMins] = UtilsClass::minsToHours($timeCook);
                            } else {
                                // Handle the case when $timeCook is not set or not a number
                                $timeCookHours = 0;
                                $timeCookMins = 0;
                            }
                            /*render markup*/
                            $time_markup = UtilsClass::generateTimeMarkup($timeCookHours, $timeCookMins);

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
                                        <!--                                <img src="-->
                                        <?php //echo get_template_directory_uri()
                                        ?><!--/dist/images/SImply-Recipes-Fondant-Potatoes-METHOD-10-0f009ff3e0ce47a196cc97bff2c4fd80.webp" alt="image in card" class="card-day_img">-->
                                    </div>
                                    <div class="card-layout_info">
                                        <!--                                <div class="card-layout_subtitle">-->
                                        <!--                                    <div class="card-layout_calories">-->
                                        <!--                                        <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff" stroke-width="0.9359999999999999">-->
                                        <!--                                            <path d="M14.5 10.0003C14.5 9.20875 15.5528 8.99895 15.8321 9.73957C16.5077 11.5311 17 13.1337 17 14.0002C17 16.7616 14.7614 19.0002 12 19.0002C9.23858 19.0002 7 16.7616 7 14.0002C7 13.0693 7.56822 11.2887 8.32156 9.33698C9.29743 6.80879 9.78536 5.54469 10.3877 5.4766C10.5804 5.45482 10.7907 5.49399 10.9626 5.58371C11.5 5.86413 11.5 7.24285 11.5 10.0003C11.5 10.8287 12.1716 11.5003 13 11.5003C13.8284 11.5003 14.5 10.8287 14.5 10.0003Z" stroke="#666666"></path>-->
                                        <!--                                            <path d="M11 19L10.7372 18.343C10.2816 17.204 10.4737 15.9079 11.24 14.95V14.95C11.6296 14.463 12.3704 14.463 12.76 14.95V14.95C13.5263 15.9079 13.7184 17.204 13.2628 18.343L13 19" stroke="#666666"></path>-->
                                        <!--                                        </svg>-->
                                        <!--                                        <span>120 ккал</span>-->
                                        <!--                                        <span>--><?php //echo $calories;
                                        ?><!-- ккал</span>-->
                                        <!--                                    </div>-->
                                        <!--                                    <div class="card-layout_time">-->
                                        <!--                                        <svg width="24px" height="24px" viewBox="-2.4 -2.4 28.80 28.80" fill="none" xmlns="http://www.w3.org/2000/svg" transform="matrix(-1, 0, 0, 1, 0, 0)rotate(0)" stroke="#ffffff" stroke-width="1.7280000000000002">-->
                                        <!--                                            <rect width="24" height="24" fill="white"></rect>-->
                                        <!--                                            <circle cx="12" cy="12" r="9" stroke="#666666" stroke-linecap="round" stroke-linejoin="round"></circle>-->
                                        <!--                                            <path d="M12 6V12L7.5 7.5" stroke="#666666" stroke-linecap="round" stroke-linejoin="round"></path>-->
                                        <!--                                        </svg>-->
                                        <!--                                        <span>--><?php //echo $time_markup
                                        ?><!--</span>-->
                                        <!--                                    </div>-->
                                        <!--                                </div>-->
                                        <div class="card-layout_title"><?php echo UtilsClass::limit_title_to_one_line(get_the_title(), 50, '...'); ?></div>
                                        <div class="card-layout_excerpt"> <?php echo UtilsClass::custom_excerpt(get_the_excerpt(), 100, '...'); ?></div>
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
