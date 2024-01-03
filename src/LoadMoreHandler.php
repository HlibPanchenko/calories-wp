<?php

namespace src;

class LoadMoreHandler
{
    public static function init(): void
    {
        add_action('wp_ajax_load_more_taxonomies', [__CLASS__, 'load_more_taxonomies']);
        add_action('wp_ajax_nopriv_load_more_taxonomies', [__CLASS__, 'load_more_taxonomies']);
    }

    public static function load_more_taxonomies()
    {
        if( ! wp_verify_nonce( $_POST['nonce_code'], 'myajax-nonce' ) ) die( 'Stop!');

        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $posts_per_page = 9;

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

        $html_content = '';

        /*если $page = 1, пропускам 10, если 2 - 20*/
        $start = ($page - 1) * $posts_per_page + 9;
        $end = $start + $posts_per_page;
        $sliced_terms = array_slice($all_terms, $start, $posts_per_page);

        foreach ($sliced_terms as $term) {
            $term_id = $term->term_id;
            $taxonomy_image = get_field('taxonomy_image', 'term_' . $term_id);

            ob_start();
            ?>
            <div class="content-layout_card card-layout">
                <a href="<?php echo esc_url(get_term_link($term)); ?>" class="card-layout_link">
                    <div class="card-layout_header">
                        <?php if ($taxonomy_image) : ?>
                            <img src="<?php echo esc_url($taxonomy_image); ?>"
                                 alt="Картинка для таксономии" class="card-layout_img">
                        <?php else : ?>
                            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/dist/images/default_taxonomy.png"
                                 alt="Default Image" class="card-layout_img">
                        <?php endif; ?>
                    </div>
                    <div class="card-layout_info">
                        <div class="card-layout_title"><?php echo esc_html($term->name); ?></div>
                    </div>
                </a>
            </div>
            <?php
            $html_content .= ob_get_clean();
        }

//         Возвращаем HTML с новыми таксономиями
        $response = array(
            'html_content' => $html_content,
            'status' => 'success', // You can add more status indicators if needed
        );

        echo json_encode($response);

        die();
    }
}
