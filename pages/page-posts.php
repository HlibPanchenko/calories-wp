<?php
/**
 * Template Name: posts
 */

use src\UtilsClass;

get_header();


?>

<main id="primary" class="main-wrapper">

    <article class="main-article posts-page">
        <section class="all-recepies ">
            <div class="all-recepies_container">
                <div class="all-recepies_header">

                    <div class="all-recepies_breadcrumbs posts-page_breadcrumbs">
                        <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
                    </div>

<!--                    <div class="all-recepies_description">-->
<!--                        Описание страницы.-->
<!--                    </div>-->

                </div>
                <div class="all-recepies_catalog catalog-posts">

                    <div class="catalog-posts_list">
                        <?php
                        // Опции запроса для получения всех постов
                        $args = array(
                            'post_type' => 'post',  // Тип поста
                            'posts_per_page' => 5,      // Количество постов на странице
                            'paged' => get_query_var('paged') ? get_query_var('paged') : 1,  // Номер текущей страницы
                        );

                        // Создаем новый запрос
                        $custom_query = new WP_Query($args);

                        // Цикл по результатам запроса
                        while ($custom_query->have_posts()) : $custom_query->the_post();
                            ?>
                            <!-- Ваш код для отображения поста -->
                            <a href="<?php the_permalink(); ?>" class="catalog-posts_card card">
                                <div class="card_box">
                                    <div class="card_header">
                                        <div class="card_img">
                                            <?php the_post_thumbnail(); ?>
                                        </div>
                                    </div>
                                    <div class="card_content posts-page_content">
                                        <div class="card_title">
                                            <?php echo UtilsClass::limit_title_to_one_line(get_the_title(), 50, '...'); ?>
                                        </div>
                                        <div class="card_info">
                                            <?php echo UtilsClass::custom_excerpt(get_the_excerpt(), 100, '...'); ?>

                                        </div>
                                    </div>
                                </div>
                            </a>
                        <?php
                        endwhile;
                        ?>




                       <?php wp_reset_postdata(); ?>


                    </div>
                    <div class="pagination">
                        <?php
                        // Пагинация
                        echo paginate_links(array(
                            'total' => $custom_query->max_num_pages,
                            'current'   => max(1, get_query_var('paged')),
                            'prev_text' => '&laquo;',
                            'next_text' => '&raquo;',
                        ));
                        ?>
                    </div>
                </div>
        </section>
    </article>

    <?php get_template_part('template-parts/floating-button') ?>

</main>

<?php
get_footer();
?>
