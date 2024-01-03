<?php
/**
 * Template Name: single page for posts
 */

get_header();

// Выводим данные текущего поста
while (have_posts()) :
    the_post();
    ?>

    <main id="primary" class="site-main single_wrapper">
        <div class="single-recipe_container">
            <div class="single-recipe_header">
                <div class="all-recepies_breadcrumbs single-recipe_breadcrumbs">
                    <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
                </div>
            </div>
            <div class="single-recipe_content">
                <div class="single-recipe_left left-recipe">
                    <div class="left-recipe_img">

                    <?php the_post_thumbnail('full'); ?>
                    </div>
                    <div class="left-recipe_title"><?php  the_title() ?></div>
                    <div class="left-recipe_description">
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

                </div>
                <div class="single-recipe_right right-recipe">
                     <div class="right-recipe_sidebar">
                        <?php get_sidebar(); ?>
                    </div>
                </div>
            </div>
            <?php

            ?>
        </div>
        <?php get_template_part('template-parts/floating-button') ?>

    </main>

<?php
endwhile;

$single_page = get_post(522);
$post = $single_page;
if ($single_page) :
    setup_postdata($single_page);
    ?>
    <div class="single-page">
<!--        <h2>--><?php //the_title(); ?><!--</h2>-->
        <?php the_content(); ?>
    </div>

    <?php
    wp_reset_postdata();
endif;

get_sidebar();
get_footer();
?>
