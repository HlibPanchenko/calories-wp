<?php
/**
 * Template Name: page-about
 */

get_header();

?>

<main id="primary" class="main-wrapper">


    <article class="main-article page-about">
        <section class=layout-posts
        ">
        <div class=" layout-posts_container">
            <div class=" layout-posts_header">
                <div class=" layout-posts_breadcrumbs page-taxonomies_breadcrumbs">
                    <?php if (function_exists('rank_math_the_breadcrumbs')) {
                        rank_math_the_breadcrumbs();
                    } ?>
                </div>
                <h1 class="layout-posts_title"><?php the_title(); ?></h1>
            </div>
            <div class="page-about_content">
                <div class="page-about_text">
                    <?php the_content(); ?>
                </div>
                <div class="page-about_img">
                    <?php $page_about_img = get_post_meta(get_the_ID(), 'page-about_img', true); ?>

                    <?php if ($page_about_img) : ?>
                        <img src="<?php echo esc_url(get_field('page-about_img'));?>"
                             alt="Изображение О нас">
                    <?php endif; ?>
                </div>
            </div>
        </div>
        </section>
    </article>

    <?php get_template_part('template-parts/floating-button') ?>

</main>


<?php
get_footer();
?>
