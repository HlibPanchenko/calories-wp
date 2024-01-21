<?php
/**
 * Template Name: главная страница
 */
get_header();
?>

    <main id="primary" class="main-wrapper">
        <?php
        if (isset($_SESSION['login_success'])) {
            echo '<div class="success-message">' . esc_html($_SESSION['login_success']) . '</div>';
            // Очистка сообщения после отображения
            unset($_SESSION['login_success']);
        }

        if (isset($_SESSION['registration_confirm'])) {
            echo '<div class="success-message">' . esc_html($_SESSION['registration_confirm']) . '</div>';
            // Очистка сообщения после отображения
            unset($_SESSION['registration_confirm']);
        }
        ?>
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

<!--            --><?php //get_template_part('template-parts/blocks/accordion-block') ?>


        </article>

    </main>

<?php
//get_sidebar();
get_footer();
