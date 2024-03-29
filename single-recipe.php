<?php

/**
 * Template Name: single page for recipes
 */

get_header();

use Kirki\Compatibility\Kirki;

the_post();

// Получаем текущую таксономию dish
$dish_terms = get_the_terms(get_the_ID(), 'dish');

// определяем дизайн для info блока
$info_design = Kirki::get_option('single_recipe_info_design');

// определяем дизайн для title шага
$step_design = Kirki::get_option('single_recipe_steps_step_choose');

// переопределение цвета сайдбара
$sr_sidebar_bg_class = Kirki::get_option('single_recipe_sidebar_background') ?
    Kirki::get_option('single_recipe_sidebar_background') : null;

$sr_sidebar_title_class = Kirki::get_option('single_recipe_sidebar_title') ?
    Kirki::get_option('single_recipe_sidebar_title') : null;

$sr_sidebar_color_class = Kirki::get_option('single_recipe_sidebar_color') ?
    Kirki::get_option('single_recipe_sidebar_color') : null;

$sr_sidebar_hover_class = Kirki::get_option('single_recipe_sidebar_hover') ?
    Kirki::get_option('single_recipe_sidebar_hover') : null;
?>

<style>
    <?php

    echo <<<EOT
    .right-recipe_sidebar .sidebar-1, .right-recipe_sidebar .sidebar-2  {
        background-color: $sr_sidebar_bg_class;
    }
    
     .right-recipe_sidebar .sidebar-1 h2, .right-recipe_sidebar .sidebar-2 h2 {
        color: $sr_sidebar_title_class;
     }
     
     
     
      .right-recipe_sidebar ul li a {
        color: $sr_sidebar_color_class !important;
     }
     
     .right-recipe_sidebar ul li a:hover {
        color: $sr_sidebar_hover_class !important;
     }
     
      .right-recipe_sidebar ul li:before {
        background-color: $sr_sidebar_title_class !important;
      }
     
     
    EOT;
    ?>
</style>


<main id="primary" class="main-wrapper single-recipe_wrapper">

    <div class="single-recipe_container">
        <div class="single-recipe_header">
            <div class="all-recepies_breadcrumbs single-recipe_breadcrumbs">
                <?php if (function_exists('rank_math_the_breadcrumbs')) {
                    rank_math_the_breadcrumbs();
                } ?>
            </div>
        </div>
        <div class="single-recipe_content">
            <div class="single-recipe_left left-recipe">
                <?php
                $images_of_recipe = get_field('images_of_recepie');

                $bzhu_recipe = get_field('bzhu_recipe');
                $bzhu_belki = isset(get_field('bzhu_recipe')['bzhu_belki']) ? get_field('bzhu_recipe')['bzhu_belki'] : 0;
                $bzhu_zhiri = isset(get_field('bzhu_recipe')['bzhu_zhiri']) ? get_field('bzhu_recipe')['bzhu_zhiri'] : 0;
                $bzhu_uglevody = isset(get_field('bzhu_recipe')['bzhu_uglevody']) ? get_field('bzhu_recipe')['bzhu_uglevody'] : 0;

                $ingredients_recipe = get_field('ingredients_recipe');
                $ingredient_recipe = get_field('ingredient_recipe');
                $time_cooking = get_field('vremya_na_gotovku');
                $quantity_calories = get_field('k-vo_kalorij');

                get_template_part('template-parts/swiper-recipe', null, array('images_of_recipe' => $images_of_recipe));
                ?>

                <h1 class="left-recipe_title"><?php the_title() ?></h1>
                <div class="left-recipe_description">
                                            <div class="left-recipe_description-header">
<!--                                                <svg fill="#000000" width="34px" height="34px" viewBox="0 0 24 24">-->
<!--                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>-->
<!--                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>-->
<!--                                                    <g id="SVGRepo_iconCarrier">-->
<!--                                                        <path d="M21,2H3A1,1,0,0,0,2,3V21a1,1,0,0,0,1,1H21a1,1,0,0,0,1-1V3A1,1,0,0,0,21,2ZM4,4H20V6H4ZM20,20H4V8H20ZM6,12a1,1,0,0,1,1-1H17a1,1,0,0,1,0,2H7A1,1,0,0,1,6,12Zm0,4a1,1,0,0,1,1-1h5a1,1,0,0,1,0,2H7A1,1,0,0,1,6,16Z">-->
<!--                                                        </path></g></svg>-->

                                                <h2>Описание:</h2> <br>
                                            </div>
                    <div class="left-recipe_text _hide-on-phones">
                        <?php the_content(); ?>
                    </div>
                    <div class="_show-all-description">
                        <div class="_show-all-description_btn">
                            Читать полностью
                        </div>
                        <div class="_show-all-description_arrow">

                        </div>
                    </div>
                    <div class="left-recipe_taxonomies">
                        <?php
                        $post_taxonomies = get_post_taxonomies(get_the_ID());

                        foreach ($post_taxonomies as $taxonomy) {
                            $terms = get_the_terms(get_the_ID(), $taxonomy);

                            if ($terms && !is_wp_error($terms)) {
                                echo '<div class="taxonomy">';
                                echo '<span class="taxonomy-label">' . esc_html(get_taxonomy($taxonomy)->labels->singular_name) . ':</span> ';

                                $term_links = array();
                                foreach ($terms as $term) {
                                    $term_links[] = '<a href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a>';
                                }

                                echo implode(', ', $term_links);
                                echo '</div>';
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="left-recipe_meta"></div>
                <?php
                $recipe_steps = get_field('recipe_steps'); // Получаем данные из поля repeater
                if ($recipe_steps && !empty($recipe_steps)) :
                    ?>
                    <div class="left-recipe_steps step-section">
                        <div class="step-section_header">
                            <?php
                            if (get_theme_mod('single_recipe_steps_title_text', '')) :
                                echo get_theme_mod('single_recipe_steps_title_text', '');
                            else :
                                echo 'Этапы приготовления';
                            endif;
                            ?>
                            <?php
                            if (get_theme_mod('single_recipe_steps_title_svg_show')) :
                                ?>
                                <span class="step-section_svg-wrapper">
                                <?php
                                $svg_code = get_theme_mod('single_recipe_steps_title_svg');
                                if ($svg_code && preg_match('/^<svg[^>]*>.*<\/svg>$/', $svg_code)) :
                                    echo $svg_code;
                                else :
                                    echo '<svg width="30px" height="30px" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                         <path d="M4 12H20M20 12L16 8M20 12L16 16" stroke="#FFFFFF" 
                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        </path>
                                    </svg>';
                                endif;
                                ?>
    </span>
                            <?php endif;
                            ?>

                        </div>
                        <ul class="step-section_list">
                            <?php foreach ($recipe_steps as $index => $step) : ?>
                                <li class="step-section_step">
                                    <div class="step-section_num">
                                        <?php if ($step_design == 'step-1') : ?>
                                            <span><?php echo esc_html($index + 1); ?></span>
                                            <div class="step-section_text">
                                                <span>Ш</span>
                                                <span>А</span>
                                                <span>Г</span>
                                            </div>

                                        <?php else : ?>
                                            <!--                                            <div class="step-section_text">-->
                                            <!--                                                <span>Ш</span>-->
                                            <!--                                                <span>А</span>-->
                                            <!--                                                <span>Г</span>-->
                                            <!--                                            </div>-->
                                            <span><?php echo esc_html($index + 1); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="step-section_content content-step">
                                        <div class="content-step_text">
                                            <!--                                            --><?php //echo esc_html($step['recipe_steptext']); ?>
                                            <?php echo nl2br($step['recipe_steptext']); ?>


                                        </div>
                                        <?php if (!empty($step['recipe_stepimg'])) : ?>
                                            <div class="content-step_gallery">
                                                <?php foreach ($step['recipe_stepimg'] as $image) : ?>
                                                    <?php if ($image) : ?>
                                                        <div class="content-step_imgwrapper">
                                                            <img src="<?php echo esc_url($image); ?>" alt="step image">
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>


            </div>
            <div class="single-recipe_right right-recipe">
                <?php if ($info_design == 'one-block') : ?>
                    <div class="right-recipe_info one-block_info">
                        <ul class="right-recipe_list">
                            <li class="right-recipe_item">
                                <div class="right-recipe_column">
                                    <div class="right-recipe_top"><?php echo esc_html($quantity_calories); ?>
                                        <span> ккал </span></div>
                                    <div class="right-recipe_bottom"> на 100г</div>
                                </div>
                            </li>
                            <li class="right-recipe_item">
                                <div class="right-recipe_columns">
                                    <div class="right-recipe_column">
                                        <div class="right-recipe_top"><?php echo $bzhu_belki ? esc_html($bzhu_belki) . '<span> г </span>' : 'Н/Д'; ?></div>
                                        <div class="right-recipe_bottom"> Белки</div>
                                    </div>
                                    <div class="right-recipe_column">
                                        <div class="right-recipe_top"><?php echo $bzhu_zhiri ? esc_html($bzhu_zhiri) . '<span> г </span>' : 'Н/Д'; ?></div>
                                        <div class="right-recipe_bottom"> Жиры</div>
                                    </div>
                                    <div class="right-recipe_column">
                                        <div class="right-recipe_top"><?php echo $bzhu_uglevody ? esc_html($bzhu_uglevody) . '<span> г </span>' : 'Н/Д'; ?></div>
                                        <div class="right-recipe_bottom"> Углеводы</div>
                                    </div>
                                </div>
                            </li>
                            <li class="right-recipe_item">
                                <div class="right-recipe_column">
                                    <div class="right-recipe_top"><?php echo esc_html($time_cooking); ?>
                                        <span> минут </span></div>
                                    <div class="right-recipe_bottom"> Время</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                <?php else : ?>
                <div class="right-recipe_info separated-blocks_info">
                    <div class="separated-blocks_info_box">
                        <div class="separated-blocks_info_item separated-blocks_info_item-one">
                            <div class="item-one_num"><?php echo esc_html($quantity_calories); ?></div>
                            <div class="item-one_text">калорий</div>

                        </div>
                        <div class="separated-blocks_info_item separated-blocks_info_item-three">
                            <div class="separated-blocks_info_subitem">
                                <div class="info_subitem_top"> <?php echo $bzhu_belki ? esc_html($bzhu_belki) . '<span> г </span>' : 'Н/Д'; ?></div>
                                <div class="info_subitem_bottom">белок</div>
                            </div>
                            <div class="separated-blocks_info_subitem">
                                <div class="info_subitem_top"> <?php echo $bzhu_zhiri ? esc_html($bzhu_zhiri) . '<span> г </span>' : 'Н/Д'; ?></div>
                                <div class="info_subitem_bottom">жиры</div>
                            </div>
                            <div class="separated-blocks_info_subitem">
                                <div class="info_subitem_top"> <?php echo $bzhu_uglevody ? esc_html($bzhu_uglevody) . '<span> г </span>' : 'Н/Д'; ?></div>
                                <div class="info_subitem_bottom">углеводы</div>
                            </div>
                        </div>
                        <div class="separated-blocks_info_item separated-blocks_info_item-one">
                            <div class="item-one_num"><?php echo esc_html($time_cooking); ?> <span>минут</span></div>
                            <div class="item-one_text">Время</div>
                        </div>
                    </div>
                </div>

                    <?php endif; ?>

                    <?php if ($ingredients_recipe && !empty($ingredients_recipe)) : ?>
                        <div class="right-recipe_ingredients ingredients-box">
                            <div class="ingredients-box_header">
                                <?php
                                if (get_theme_mod('single_recipe_ingredients_title_text', '')) :
                                    echo get_theme_mod('single_recipe_ingredients_title_text', '');
                                else :
                                    echo 'Ингредиенты';
                                endif;
                                ?>
                                <?php if (get_theme_mod('single_recipe_ingredients_title_svg_show')) : ?>
                                    <span class="step-section_svg-wrapper ingredients-section_svg-wrapper">
                <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 12H20M20 12L16 8M20 12L16 16" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round"></path>
                </svg>
            </span>
                                <?php endif; ?>
                            </div>
                            <ul class="ingredients-box_list">
                                <?php foreach ($ingredients_recipe as $ingredient_group) : ?>
                                    <li class="ingredients-box_item">
                                        <div class="ingredients-box_text"><?php echo esc_html($ingredient_group['ingredient_recipe']); ?></div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <?php if (Kirki::get_option('single_recipe_show_sidebar')) : ?>
                        <?php $sidebars = get_theme_mod('single_recipe_multicheck_sidebar', array('option-1', 'option-3')); ?>

                        <?php if (!empty($sidebars)) : ?>
                            <h3 class="right-recipe_sidebar-title">Вас также может заинтересовать</h3>
                            <div class="right-recipe_sidebar">
                                <?php foreach ($sidebars as $sidebar) :
                                    if ($sidebar == 'option-1') :
                                        get_sidebar();
                                    else :
                                        get_sidebar('2');
                                    endif;
                                endforeach; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <?php

                ?>
            </div>
        </div>

        <?php get_template_part('template-parts/floating-button') ?>

</main>
<?php

//            get_template_part('template-parts/recipes-layout-6-posts',  null, array('current_taxonomy' => $dish_terms))
$single_page = get_post(760);
$post = $single_page;
if ($single_page) :
    setup_postdata($single_page);
    ?>
    <div class="single-page">
        <?php the_content(); ?>
    </div>

    <?php
    wp_reset_postdata();
endif;

?>
</div>
<?php
get_footer();
?>
