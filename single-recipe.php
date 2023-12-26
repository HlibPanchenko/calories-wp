<?php
get_header();

the_post();

// Получаем текущую таксономию dish
$dish_terms = get_the_terms(get_the_ID(), 'dish');
?>
    <main id="primary" class="main-wrapper single-recipe_wrapper">
        <div class="single-recipe_container">
            <div class="single-recipe_header">
                <div class="all-recepies_breadcrumbs single-recipe_breadcrumbs">
                    <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
                </div>
            </div>
            <div class="single-recipe_content">
                <div class="single-recipe_left left-recipe">
                    <?php
                    $images_of_recipe = get_field('images_of_recepie');

                    get_template_part('template-parts/swiper-recipe', null, array('images_of_recipe' => $images_of_recipe));
                    ?>

                    <div class="left-recipe_title"><?php  the_title() ?></div>
                    <div class="left-recipe_description">
<!--                        <div class="left-recipe_description-header">-->
<!--                            <img src="--><?php //echo get_template_directory_uri() ?><!--/dist/images/list.png" alt="list">-->
<!---->
<!--                            <span>Описание:</span> <br>-->
<!--                        </div>-->
                        <div class="left-recipe_text">
                            <?php  the_content(); ?>

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
                    <div class="left-recipe_steps step-section">
                        <div class="step-section_header">
                            Этапы приготовления
                            <span class="step-section_svg-wrapper">
                        <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M4 12H20M20 12L16 8M20 12L16 16" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
                    </span>
                        </div>
                        <ul class="step-section_list">
                            <?php
                            $recipe_steps = get_field('recipe_steps'); // Получаем данные из поля repeater
//                            var_dump($recipe_steps);
                            if ($recipe_steps) {
                                foreach ($recipe_steps as $step) {
                                    $step_num = $step['recipe_stepnum'];
                                    $step_text = $step['recipe_steptext'];
                                    $step_images = $step['recipe_stepimg'];
                                    ?>
                                    <li class="step-section_step">
                                        <div class="step-section_num">
                                            <span><?php echo '0' . esc_html($step_num); ?></span>
                                            <div class="step-section_text">
                                                <span>Ш</span>
                                                <span>А</span>
                                                <span>Г</span>
                                            </div>
                                        </div>
                                        <div class="step-section_content content-step">
                                            <div class="content-step_text">
                                                <?php echo esc_html($step_text); ?>
                                            </div>
                                            <div class="content-step_gallery">
                                                <?php
                                                foreach ($step_images as $image) {
                                                    ?>
                                                    <div class="content-step_imgwrapper">
                                                        <img src="<?php echo esc_url($image); ?>" alt="step image">
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </li>
                                    <?php
                                }
                            }
                            ?>


                        </ul>
                    </div>

                </div>
                <div class="single-recipe_right right-recipe">
                    <div class="right-recipe_info">
                        <ul class="right-recipe_list">
                            <li class="right-recipe_item">
                                <div class="right-recipe_column">
                                    <div class="right-recipe_top">243 <span> ккал </span></div>
                                    <div class="right-recipe_bottom"> на 100г</div>
                                </div>
                            </li>
                            <li class="right-recipe_item">
                                <div class="right-recipe_columns">
                                    <div class="right-recipe_column">
                                        <div class="right-recipe_top">4 <span> г </span></div>
                                        <div class="right-recipe_bottom"> Белки</div>
                                    </div>
                                    <div class="right-recipe_column">
                                        <div class="right-recipe_top">12 <span> г </span></div>
                                        <div class="right-recipe_bottom"> Жиры</div>
                                    </div>
                                    <div class="right-recipe_column">
                                        <div class="right-recipe_top">8 <span> г </span> </div>
                                        <div class="right-recipe_bottom"> Углеводы</div>
                                    </div>
                                </div>
                            </li>
                            <li class="right-recipe_item">
                                <div class="right-recipe_column">
                                    <div class="right-recipe_top">35 <span> минут </span> </div>
                                    <div class="right-recipe_bottom"> Время</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="right-recipe_ingredients ingredients-box">
                        <div class="ingredients-box_header">
                            Ингредиенты
                            <span class="step-section_svg-wrapper">
                        <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M4 12H20M20 12L16 8M20 12L16 16" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
                    </span>
                        </div>
                        <ul class="ingredients-box_list">
                            <li class="ingredients-box_item">
<!--                                <img src="--><?php //echo get_template_directory_uri() ?><!--/dist/images/cabbage.png" alt="ingredient">-->
                                <div class="ingredients-box_text">пол помидора</div>
                            </li>
                            <li class="ingredients-box_item">
<!--                                <img src="--><?php //echo get_template_directory_uri() ?><!--/dist/images/apple.png" alt="ingredient">-->
                                <div class="ingredients-box_text">2 яблока</div>
                            </li>
                            <li class="ingredients-box_item">
<!--                                <img src="--><?php //echo get_template_directory_uri() ?><!--/dist/images/chicken-leg.png" alt="ingredient">-->
                                <div class="ingredients-box_text">100г курицы</div>
                            </li>
                            <li class="ingredients-box_item">
<!--                                <img src="--><?php //echo get_template_directory_uri() ?><!--/dist/images/fish.png" alt="ingredient">-->
                                <div class="ingredients-box_text">250г форели</div>
                            </li>
                            <li class="ingredients-box_item">
<!--                                <img src="--><?php //echo get_template_directory_uri() ?><!--/dist/images/cheese.png" alt="ingredient">-->
                                <div class="ingredients-box_text">200г сыра</div>
                            </li>
                            <li class="ingredients-box_item">
<!--                                <img src="--><?php //echo get_template_directory_uri() ?><!--/dist/images/spices.png" alt="ingredient">-->
                                <div class="ingredients-box_text">соль, перец</div>
                            </li>
                        </ul>

                    </div>
                    <div class="right-recipe_sidebar">
                        <?php get_sidebar(); ?>
                    </div>
                </div>
            </div>
            <?php
            get_template_part('template-parts/recipes-layout-6-posts',  null, array('current_taxonomy' => $dish_terms))

            ?>
        </div>
   </main>
<?php
get_footer();
?>
