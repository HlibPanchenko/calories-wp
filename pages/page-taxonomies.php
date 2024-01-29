<?php
/**
 * Template Name: taxonomies
 */

use src\UtilsClass;

get_header();
?>

<main id="primary" class="main-wrapper">


    <article class="main-article page-taxonomies">
        <section class= layout-posts ">
            <div class=" layout-posts_container">
                <div class=" layout-posts_header">

                    <div class=" layout-posts_breadcrumbs page-taxonomies_breadcrumbs">
                        <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
                    </div>
                    <h1 class="layout-posts_title"><?php the_title(); ?></h1>


                </div>
                <div class=" layout-posts_catalog catalog-posts">
                    <div class="content-layout_wrapper page-taxonomies_list">
                        <?php
                        // Получаем все таксономии для кастомного типа записи "recipe"
                        $taxonomies = get_object_taxonomies('recipe');

                        // Инициализируем пустой массив для хранения всех терминов
                        $all_terms = array();

                        foreach ($taxonomies as $taxonomy) {
                            // Получаем все термины (категории) для текущей таксономии
                            $terms = get_terms(array(
                                'taxonomy' => $taxonomy,
                                'hide_empty' => false,
                            ));
                            // Объединяем текущие термины с массивом $all_terms
                            $all_terms = array_merge($all_terms, $terms);
                        }

                        // Получаем первые 10 элементов из массива $all_terms
                        $first_10_terms = array_slice($all_terms, 0, 9);

                        // Выводим карточки для каждого термина
                        foreach ($first_10_terms as $term) {
//                            foreach ($terms as $term) {
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
                                    <div class="card-layout_info page-taxonomies_info">
                                        <div class="card-layout_title"><?php echo $term->name; ?></div>
                                    </div>
                                </a>
                            </div>
                            <?php
                        }
                        ?>

                    </div>

                </div>
                <div class="layout-posts_more load-more">
                    <button class="load-more_btn" data-page="1"
                            data-max-pages="<?php echo esc_attr(ceil(count($all_terms) / 9)); ?>">
                        Показать еще
                    </button>
                </div>
            </div>
        </section>
    </article>

    <?php get_template_part('template-parts/floating-button') ?>

</main>

<?php
get_footer();
?>
