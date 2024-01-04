<?php
use src\UtilsClass;

get_header();
?>

<main id="primary" class="main-wrapper">

    <article class="main-article all-popular-article">
        <section class="all-recepies all-popular-recepies">
            <div class="all-recepies_container">
                <div class="all-recepies_header">

                    <div class="all-recepies_breadcrumbs">
                        <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
                    </div>

                    <h1 class="page-title">
                        <?php
                        /* translators: %s: search query. */
                        printf( esc_html__( 'Поиск по: %s', 'calories_first' ), '<span>' . get_search_query() . '</span>' );
                        ?>
                    </h1>

                </div>
                <div class="all-recepies_catalog catalog-posts">

                    <span class="loader"></span>

                    <div class="catalog-posts_list">
                        <?php
                        if (have_posts()) :
                            while (have_posts()) :
                                the_post();

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

                                // Render markup
                                $time_markup = UtilsClass::generateTimeMarkup($timeCookHours, $timeCookMins);

                                // Получаем все таксономии для текущего поста
                                $part_of_the_day_terms = get_the_terms(get_the_ID(), 'part_of_the_day');
                                ?>

                                <a href="<?php the_permalink(); ?>" class="catalog-posts_card card">
                                    <div class="card_box">
                                        <div class="card_header">
                                            <div class="card_img">
                                                <?php
                                                if (has_post_thumbnail()) {
                                                    the_post_thumbnail('full', array('class' => 'card-day_img'));
                                                } else {
                                                    if ($images && is_array($images) && !empty($images)) {
                                                        echo '<img src="' . esc_url($images[0]) . '" alt="Image in card" class="card-day_img">';
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="card_content">
                                            <div class="card_title"><?php echo UtilsClass::limit_title_to_one_line(get_the_title(), 50, '...'); ?></div>

                                            <div class="card_info">
                                                <?php echo UtilsClass::custom_excerpt(get_the_excerpt(), 100, '...'); ?>

                                            </div>
<!--                                            <div class="card_meta">-->
<!--                                                <div class="card_author">Marina Volkova</div>-->
<!--                                                <div class="card_date">--><?php //echo get_the_date('d.m.Y'); ?><!--</div>-->
<!--                                            </div>-->
                                        </div>
                                    </div>
                                </a>
                            <?php endwhile; ?>

                        <?php else : ?>
                            <p><?php _e('По вашему запросу нет постов.'); ?></p>
                        <?php endif; ?>
                    </div>
                    <?php
                    // Пагинация
                    the_posts_pagination(array(
                        'prev_text'          => '&laquo;',
                        'next_text'          => '&raquo;',
                        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'your-theme') . ' </span>',
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
