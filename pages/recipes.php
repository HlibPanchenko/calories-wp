<?php
/**
 * Template Name: recipes
 */
get_header();

use src\UtilsClass;
use Kirki\Compatibility\Kirki;

$dropdown_design = Kirki::get_option('recipes_page_choose_design_dropdown') === '1' ?
    'sort-dropdown-design_first' :
    'sort-dropdown-design_second';
?>


    <main id="primary" class="main-wrapper">

        <article class="main-article all-popular-article">
            <section class="all-recepies all-popular-recepies">
                <div class="all-recepies_container">
                    <div class="all-recepies_header">

                        <div class="all-recepies_breadcrumbs">
                            <?php if (function_exists('rank_math_the_breadcrumbs')) {
                                rank_math_the_breadcrumbs();
                            } ?>
                        </div>

                        <div class="all-recepies_description">
                            <h1> <?php echo html_entity_decode(Kirki::get_option('recipes_page_title')) ?></h1>
<!--                            <p>-->
<!--                                --><?php //echo html_entity_decode(Kirki::get_option('recipes_page_description')) ?>
<!--                            </p>-->
<!--                            <div class="all-recepies_guide guide-recipe">-->
<!--                                <div class="guide-recipe_img">-->
<!--                                    <svg width="91px" height="91px" viewBox="-1.26 -1.26 20.52 20.52" fill="#ffffff" stroke="#ffffff">-->
<!--                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>-->
<!--                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>-->
<!--                                        <g id="SVGRepo_iconCarrier">-->
<!--                                            <path fill="#ffffff" d="M9,14a1.5,1.5,0,1,1,1.5068-1.5A1.5035,1.5035,0,0,1,9,14Z"></path>-->
<!--                                            <path fill="#ffffff" d="M9,2A7,7,0,1,1,2,9,7.0079,7.0079,0,0,1,9,2M9,0a9,9,0,1,0,9,9A9,9,0,0,0,9,0Z"></path>-->
<!--                                            <path fill="#ffffff" d="M10,4H8a1,1,0,0,0-.97,1.2425l1,4a1,1,0,0,0,1.94,0l1-4A1,1,0,0,0,10,4Zm0,2h0Z"></path>-->
<!--                                        </g>-->
<!--                                    </svg>-->
<!--                                </div>-->
<!--                                <div class="guide-recipe_content">-->
<!--                                    <h2 class="guide-recipe_title">БЫстрый поиск</h2>-->
<!--                                    <ul class="guide-recipe_tips">-->
<!--                                        <li class="guide-recipe_tip">Нажмите на "Показать фильтры"</li>-->
<!--                                        <li class="guide-recipe_tip">Используйте блок поиска</li>-->
<!--                                        <li class="guide-recipe_tip">Настройте фильтры</li>-->
<!--                                    </ul>-->
<!--                                </div>-->
<!--                            </div>-->
                        </div>

                        <div class="all-recepies_show-filters">
                            <p id="show-filters"> Показать фильтры </p>
                            <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" >
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path d="M4 5L10 5M10 5C10 6.10457 10.8954 7 12 7C13.1046 7 14 6.10457 14 5M10 5C10 3.89543 10.8954 3 12 3C13.1046 3 14 3.89543 14 5M14 5L20 5M4 12L16 12M16 12C16 13.1046 16.8954 14 18 14C19.1046 14 20 13.1046 20 12C20 10.8954 19.1046 10 18 10C16.8954 10 16 10.8954 16 12ZM8 19L20 19M8 19C8 17.8954 7.10457 17 6 17C4.89543 17 4 17.8954 4 19C4 20.1046 4.89543 21 6 21C7.10457 21 8 20.1046 8 19Z" stroke="#000000" stroke-width="1.5" stroke-linecap="round">
                                    </path> </g></svg>

                        </div>

                        <?php if (true == get_theme_mod('recipes_page_s_show', true)) :
                            get_template_part('search-form-big');
                        endif;
                        ?>

                        <div class="all-recepies_sort sort-block">

                            <ul class="sort-block_list <?php echo $dropdown_design?>">
                                <?php
                                $taxonomy_keys = array('ingredients', 'cooking-method', 'dish');
                                $result = UtilsClass::get_taxonomy_terms($taxonomy_keys);

                                // Проход по всем данным из $result
                                foreach ($result as $taxonomy_data) {
                                    foreach ($taxonomy_data as $taxonomy => $terms) {
                                        ?>
                                        <li class="sort-block_item" id="taxonomy_<?php echo esc_attr($taxonomy); ?>">
                                            <div class="sort-block_wrapper">
                                                <div class="sort-block_header">
                                                    <div class="sort-block_text">
                                                        <?php
                                                        // Получите название таксономии
                                                        $taxonomy_labels = get_taxonomy_labels(get_taxonomy($taxonomy));
                                                        echo esc_html($taxonomy_labels->singular_name);
                                                        ?>
                                                    </div>
                                                    <div class="sort-block_btn">
                                                        <div class="sort-block_arrow"></div>
                                                    </div>

                                                </div>

                                                <?php
                                                // Проверка, есть ли термины
                                                if (!empty($terms)) {
                                                    ?>
                                                    <div class="sort-block_dropdown dropdown-sort">
                                                        <?php
                                                        // Проход по всем терминам
                                                        foreach ($terms as $term) {
                                                            ?>
                                                            <div class="dropdown-sort_checkbox">
                                                                <label>
                                                                    <input class="dropdown-sort_input" type="checkbox"
                                                                           data-filterText="<?php echo esc_html($term->name); ?>"
                                                                           id="<?php echo esc_attr($term->term_id); ?>">
                                                                    <?php echo esc_html($term->name); ?>
                                                                </label>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </li>
                                        <?php
                                    }
                                }
                                ?>
                                <li class="sort-block_item" id="taxonomy_<?php echo esc_attr($taxonomy); ?>" id="calories">
                                    <div class="sort-block_wrapper">
                                        <div class="sort-block_header">
                                            <div class="sort-block_text">
                                                Количество калорий
                                            </div>
                                            <div class="sort-block_btn">
                                                <div class="sort-block_arrow"></div>
                                            </div>
                                        </div>
                                        <div class="sort-block_dropdown dropdown-sort">
                                            <?php
                                            // Получите уникальные значения для поля k-vo_kalorij
                                            //                                            $calories = get_unique_recipe_field_values('k-vo_kalorij');

                                            // Определите диапазоны калорий
                                            $ranges = array(
                                                '0-100' => '0-100 калорий',
                                                '100-200' => '100-200 калорий',
                                                '200-300' => '200-300 калорий',
                                                '300-400' => '300-400 калорий',
                                                '400-1000' => '400+ калорий',
                                            );

                                            // Выведите чекбоксы для каждого диапазона
                                            foreach ($ranges as $key => $range) {
                                                ?>
                                                <div class="dropdown-sort_checkbox">
                                                    <label>
                                                        <input class="dropdown-sort_input" type="checkbox"
                                                               data-filterText="<?php echo $range; ?>"
                                                               id="<?php echo esc_attr($key); ?>">
                                                        <?php echo esc_html($range); ?>
                                                    </label>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </li>
                                <li class="sort-block_item" id="cook_time">
                                    <div class="sort-block_wrapper">
                                        <div class="sort-block_header">
                                            <div class="sort-block_text">
                                                Время на готовку
                                            </div>
                                            <div class="sort-block_btn">
                                                <div class="sort-block_arrow"></div>
                                            </div>
                                        </div>
                                        <div class="sort-block_dropdown dropdown-sort">
                                            <?php
                                            // Определите диапазоны времени на готовку
                                            $cook_times = array(
                                                '0-10' => 'до 10 минут',
                                                '10-20' => '10-20 минут',
                                                '20-30' => '20-30 минут',
                                                '30-40' => '30-40 минут',
                                                '40-60' => '40-1 час',
                                                '60-120' => 'больше часа',
                                                '120-180' => 'больше 2 часов',
                                            );

                                            // Выведите чекбоксы для каждого диапазона
                                            foreach ($cook_times as $range => $label) {
                                                ?>
                                                <div class="dropdown-sort_checkbox">
                                                    <label>
                                                        <input class="dropdown-sort_input" type="checkbox"
                                                               data-filterText="<?php echo $label; ?>"
                                                               id="<?php echo esc_attr($range); ?>">
                                                        <?php echo esc_html($label); ?>
                                                    </label>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                            <!--                            <div class="sort-block_side">-->
                            <!--                                sidebar-->
                            <!--                            </div>-->
                        </div>

                    </div>
                    <div class="all-recepies_catalog catalog-posts">
                        <div class="catalog-posts_choosenFilters choosenFilters">
                            <!--                                <div class="choosenFilters_title">Фильтры:</div>-->
                            <ul class="choosenFilters_list">
                                <!--                                    <li class="choosenFilters_item">-->
                                <!--                                        Мясо &#215;-->
                                <!--                                    </li>-->
                            </ul>
                        </div>


                        <!--                            <span class="loader"></span>-->

                        <div class="catalog-posts_list">
                            <span class="loader"></span>

                            <?php

                            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                            $args = array(
                                'post_type' => 'recipe',
                                'posts_per_page' => 12,
                                'order' => 'DESC',
                                'orderby' => 'date',
                                'paged' => $paged,
                                'meta_query' => array(
                                    array(
                                        'key' => 'recipe_is_active', // Название ACF поля
                                        'value' => '1', // ACF true возвращает строку '1'
                                        'compare' => '=' // Условие равенства
                                    )
                                )
                            );
                            $recipe_query = new WP_Query($args);

                            // Loop through the recipe posts
                            while ($recipe_query->have_posts()) :
                                $recipe_query->the_post();

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

                                <a href="<?php the_permalink(); ?>" class="catalog-posts_card card">
                                    <div class="card_box">
                                        <div class="card_header">
                                            <div class="card_img">
                                                <?php

                                                if ($images && is_array($images) && !empty($images)) {
                                                    echo '<img src="' . esc_url($images[0]) . '" alt="Image in card" class="card-day_img">';
                                                } else {
                                                    // Fallback image if no images are found
                                                    echo '<img src="' . get_template_directory_uri() . '/dist/images/default-image.jpg" alt="Default Image" class="card-day_img">';
                                                }
                                                ?>
                                                <!--                                            <img src="-->
                                                <?php //echo get_template_directory_uri()
                                                ?><!--/dist/images/Cheeseburger-Casserole-Lead-5-a7f9bee676c146e5b00820f30a211855.webp" alt="image in card">-->
                                            </div>
                                        </div>
                                        <div class="card_content">
                                            <div class="card_title"><?php echo UtilsClass::limit_title_to_one_line(get_the_title(), 50, '...'); ?></div>

                                            <!--                                        <div class="card_subtitle">SubTitle</div>-->
                                            <div class="card_info">
                                                <?php echo UtilsClass::custom_excerpt(get_the_excerpt(), 100, '...'); ?>
                                            </div>
                                            <!--                                            <div class="card_meta">-->
                                            <!--                                                <div class="card_author">Marina Volkova</div>-->
                                            <!--                                                <div class="card_date">-->
                                            <?php //echo get_the_date('d.m.Y');
                                            ?><!--</div>-->
                                            <!--                                            </div>-->
                                        </div>
                                    </div>
                                </a>
                            <?php endwhile; ?>

                            <?php wp_reset_postdata(); ?>

                        </div>


                        <div class="pagination">
                            <?php
                            // Пагинация
                            echo paginate_links(array(
                                'total' => $recipe_query->max_num_pages,
                                'current' => max(1, get_query_var('paged')),
                                'prev_text' => '<',
                                'next_text' => '>',
                            ));
                            ?>
                        </div>
                    </div>
            </section>
        </article>

        <?php get_template_part('template-parts/floating-button') ?>

        <?php echo the_content(); ?>

    </main>


<?php
get_footer();
