<?php
/**
 * Template Name: taxonomies
 */

use src\UtilsClass;

get_header();
?>

<main id="primary" class="main-wrapper">


    <article class="main-article page-taxonomies">
        <section class="all-recepies all-popular-recepies">
            <div class="all-recepies_container">
                <div class="all-recepies_header">

                    <div class="all-recepies_breadcrumbs">
                        <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
                    </div>

                    <div class="all-recepies_description">
                        Описание страницы.
                    </div>

                </div>
                <div class="all-recepies_catalog catalog-posts">
                    <div class="content-layout_wrapper page-taxonomies_list">
                        <?php
                        // Получаем все таксономии для кастомного типа записи "recipe"
                        $taxonomies = get_object_taxonomies('recipe');

                        foreach ($taxonomies as $taxonomy) {
                            // Получаем все термины (категории) для текущей таксономии
                            $terms = get_terms(array(
                                'taxonomy' => $taxonomy,
                                'hide_empty' => false,
                            ));

                            // Выводим карточки для каждого термина
                            foreach ($terms as $term) {
                                $term_id = $term->term_id;
                                // Получаем картинку таксономии
                                $taxonomy_image = get_field('taxonomy_image', 'term_' . $term_id);
                                ?>
                                <div class="content-layout_card card-layout">
                                    <a href="<?php echo get_term_link($term); ?>" class="card-layout_link">
                                        <div class="card-layout_header">
                                            <?php if ($taxonomy_image) : ?>
                                                <img src="<?php echo esc_url($taxonomy_image); ?>"
                                                     alt="Картинка для таксономии" class="card-layout_img">
                                            <?php else : ?>
                                                <img src="<?php echo get_template_directory_uri(); ?>/dist/images/default_taxonomy.png"
                                                     alt="Default Image" class="card-layout_img">
                                            <?php endif; ?>
                                        </div>
                                        <div class="card-layout_info">
                                            <div class="card-layout_title"><?php echo $term->name; ?></div>
                                        </div>
                                    </a>
                                </div>
                                <?php
                            }
                        }
                        ?>

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
