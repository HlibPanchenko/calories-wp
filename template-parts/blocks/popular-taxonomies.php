<?php
use src\UtilsClass;
// Получаем ID страницы "Main page" чтобы получить ее custom fields
//$main_page_id = get_option('page_on_front');

// Получаем кастомные поля
$popular_categories = get_field('popular_categories'); // group
//$popular_categories = get_field('popular_categories', $main_page_id); // group
$popular_categories_title = $popular_categories["popular_categories_title"]; // text
$popular_categories_taxonomies = $popular_categories["popular_categories_taxonomies"]; // checkbox
// Определение белого списка таксономий
$whitelist_taxonomies = array('dish', 'ingredients', 'cuisine', 'holiday', 'cooking-method', 'part_of_the_day');

?>

<section class="recipe-layout popular-taxonomies">
    <div class="recipe-layout_container">
        <header class="recipe-layout_header header-layout">
            <div class=" header-layout_wrapper">
                <a href="<?php echo esc_url(get_permalink(get_page_by_path('recipes'))); ?>" class=" header-layout_link shaked-el" >

                    <span class="header-layout_linktext _anim-items"><?php echo  $popular_categories_title?></span>
                    <span class="header-layout_svg-wrapper">
                        <svg width="36px" height="36px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M4 12H20M20 12L16 8M20 12L16 16" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
                    </span>
                </a>
            </div>
        </header>
        <div class="recipe-layout_content content-layout">
            <div class="content-layout_wrapper">
                <?php foreach ($popular_categories_taxonomies as $taxonomy) : ?>
                    <?php
                    // Проверяем наличие ключей
                    $taxonomy_value = isset($taxonomy['value']) ? $taxonomy['value'] : '';
                    $taxonomy_label = isset($taxonomy['label']) ? $taxonomy['label'] : '';

                    if ($taxonomy_value && $taxonomy_label) {
                        // Поиск соответствующей таксономии из $whitelist_taxonomies
                        foreach ($whitelist_taxonomies as $whitelist_taxonomy) {
                            // Получаем объект таксономии
                            $term = get_term_by('slug', $taxonomy_value, $whitelist_taxonomy);

                            // Если таксономия найдена, используем её
                            if ($term) {
                                $term_id = $term->term_id;
                                // Получаем картинку таксономии
//                                $taxonomy_image = get_field('taxonomy_image', $term_id);
                                $taxonomy_image = get_field('taxonomy_image', 'term_' . $term_id);

//                                var_dump($taxonomy_image);

                                // Вывод карточки
                                ?>
                                <div class="content-layout_card card-layout">
                                    <a href="<?php echo get_term_link($term_id); ?>" class="card-layout_link">
                                        <div class="card-layout_header">
                                            <?php if ($taxonomy_image) : ?>
                                                <img src="<?php echo esc_url($taxonomy_image); ?>" alt="Картинка для таксономии" class="card-layout_img">
                                            <?php else : ?>
                                                <img src="<?php echo get_template_directory_uri(); ?>/dist/images/default_taxonomy.png" alt="Default Image" class="card-layout_img">
                                            <?php endif; ?>
                                        </div>
                                        <div class="card-layout_info">
                                            <div class="card-layout_title"><?php echo esc_html($taxonomy_label); ?></div>
                                        </div>
                                    </a>
                                </div>
                                <?php
                                // Прерываем цикл, так как таксономия уже найдена
                                break;
                            }
                        }
                    }
                    ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
