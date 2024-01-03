<?php
/**
 * Template Name: главная страница
 */
get_header();
?>

    <main id="primary" class="main-wrapper">
        <article class="main-article">
            <!--        <div class="full-width-section"></div>-->
<!--            --><?php //get_template_part('template-parts/swiper-main') ?>

            <?php echo the_content(); ?>

            <!--        --><?php //get_template_part('template-parts/blocks/popular-taxonomies') ?>

<!--            --><?php //get_template_part('template-parts/recipies-day') ?>

<!--            --><?php //get_template_part('template-parts/health-section') ?>

<!--            --><?php //get_template_part('template-parts/recent-posts') ?>

<!--            --><?php //get_template_part('template-parts/trending-section') ?>

            <?php get_template_part('template-parts/floating-button') ?>


        </article>

    </main>

<?php
//get_sidebar();
get_footer();
