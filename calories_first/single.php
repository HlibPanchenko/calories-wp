<?php
/**
 * Template Name: single page for posts
 */

get_header();

use Kirki\Compatibility\Kirki;

// переопределение цвета сайдбара
$s_sidebar_bg_class = Kirki::get_option('single_sidebar_background') ?
    Kirki::get_option('single_sidebar_background') : null;

$s_sidebar_title_class = Kirki::get_option('single_sidebar_title') ?
    Kirki::get_option('single_sidebar_title') : null;

$s_sidebar_color_class = Kirki::get_option('single_sidebar_color') ?
    Kirki::get_option('single_sidebar_color') : null;

$s_sidebar_hover_class = Kirki::get_option('single_sidebar_hover') ?
    Kirki::get_option('single_sidebar_hover') : null;
?>

<style>
    <?php

    echo <<<EOT
    .right-recipe_sidebar .sidebar-1, .right-recipe_sidebar .sidebar-2  {
        background-color: $s_sidebar_bg_class;
    }
    
     .right-recipe_sidebar .sidebar-1 h2, .right-recipe_sidebar .sidebar-2 h2 {
        color: $s_sidebar_title_class;
     }
     
     
     
      .right-recipe_sidebar ul li a {
        color: $s_sidebar_color_class !important;
     }
     
     .right-recipe_sidebar ul li a:hover {
        color: $s_sidebar_hover_class !important;
     }
     
      .right-recipe_sidebar ul li:before {
        background-color: $s_sidebar_title_class !important;
      }
     
     
    EOT;
    ?>
</style>


<?php
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
            <?php if (Kirki::get_option('single_show_sidebar')) : ?>

            <div class="single-recipe_content">

                <?php else: ?>

                <div class="single-recipe_content _one-column">

                    <?php endif; ?>
                    <div class="single-recipe_left left-recipe">
                        <div class="left-recipe_img">

                            <?php the_post_thumbnail('full'); ?>
                        </div>
                        <div class="left-recipe_title"><?php the_title() ?></div>
                        <div class="left-recipe_description">
                            <div class="left-recipe_text">
                                <?php the_content(); ?>
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
                    <?php if (Kirki::get_option('single_show_sidebar')) : ?>
                        <?php $sidebars = get_theme_mod('single_multicheck_sidebar', array('option-1', 'option-3')); ?>

                        <?php if (!empty($sidebars)) : ?>
                            <div class="single-recipe_right right-recipe">
                                <div class="right-recipe_sidebar">
                                    <?php foreach ($sidebars as $sidebar) :
                                        if ($sidebar == 'option-1') :
                                            get_sidebar();
                                        else :
                                            get_sidebar('2');
                                        endif;
                                    endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
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
        <!--        <h2>--><?php //the_title();
        ?><!--</h2>-->
        <?php the_content(); ?>
    </div>

    <?php
    wp_reset_postdata();
endif;

get_footer();
?>

