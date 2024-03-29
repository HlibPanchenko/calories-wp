<?php

use src\UtilsClass;

$uniqid = uniqid('post-block-');

$blok_postov = get_field('block_postov'); // group
$blok_postov_title = $blok_postov["block_postov_zagolovok"]; // title
$block_postov_checkbox = $blok_postov['block_postov_checkbox']; // post object (return id, multiple values)
$blok_postov_link = $blok_postov['block_postov_link'];
//var_dump($blok_postov_link);
?>
<style>
    <?php
    $block_postov_background = $blok_postov['block_postov_background'];
    $block_postov_color = $blok_postov['block_postov_color'];
    $block_postov_tax_color = $blok_postov['block_postov_tax_color'];

    echo <<<EOT
    #$uniqid {
         background: $block_postov_background;
         }
     #$uniqid .header-layout_linktext {
        color:$block_postov_color;
     }
     
    #$uniqid .header-layout_linktext:hover {
              border-bottom: 2px solid $block_postov_color;
     }
     
    #$uniqid .header-arrow path {
        stroke: $block_postov_color;
    }
     
     #$uniqid .featured-news_title h3 {
        color: $block_postov_color;
     }
     
      #$uniqid .featured-news_title h3:hover {
            border-bottom: 2px solid $block_postov_color; 
      }
     
     #$uniqid .featured-news_svg path {
        stroke: $block_postov_color;
    }
     
     #$uniqid .featured-news_description {
        color: $block_postov_color;    
     }
     
     #$uniqid .featured-news_taxonomy {
        color: $block_postov_tax_color;
     }
     
     #$uniqid .news-card_title {
        color: $block_postov_color;    
     }
     
     #$uniqid .news-card_taxonomy {
        color: $block_postov_tax_color;
     }
     
    EOT;
    ?>
</style>

<!--<section class="tranding">-->
<section class="tranding" id="<?php echo $uniqid; ?>">
    <div class="tranding_container">
        <header class="tranding_header header-layout">

            <div class=" header-layout_wrapper">
                <a href="<?php echo esc_url(home_url('/' . $blok_postov_link)); ?>"
                   class="header-layout_link shaked-el">
                    <span class="header-layout_linktext _anim-items"><?php echo esc_html($blok_postov_title); ?></span>

                    <span class="header-layout_svg-wrapper">
                        <svg class="header-arrow" width="36px" height="36px" viewBox="0 0 24 24" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
<path d="M4 12H20M20 12L16 8M20 12L16 16" stroke="#000000" stroke-width="2" stroke-linecap="round"
      stroke-linejoin="round"/>
</svg>
                    </span>
                </a>
            </div>
        </header>
        <div class="tranding_content content-box">
            <div class="content-box_wrapper">
                <div class="content-box_featured featured-news featured-news__health">
                    <?php
                    if (!empty($block_postov_checkbox)) {
                        $latest_post_id = end($block_postov_checkbox);

                        $args = array(
                            'post_type' => 'post',
                            'p' => $latest_post_id, // Указываем ID поста для запроса
                            'posts_per_page' => 1,
                        );

                        // Выполнение запроса
                        $latest_post_query = new WP_Query($args);

                        // Проверка наличия постов
                        if ($latest_post_query->have_posts()) {
                            while ($latest_post_query->have_posts()) {
                                $latest_post_query->the_post();
                                ?>
                                <!--сюда выводим информацию о посте-->
                                <a href="<?php the_permalink(); ?>" class="featured-news_wrapper">
                                    <header class="featured-news_header">
                                        <div class="featured-news_imgbox">
                                            <?php
                                            // Вывод featured image
                                            if (has_post_thumbnail()) {
                                                the_post_thumbnail('full', array('class' => 'featured-image'));
                                            } else {
                                                // Вывод заглушки, если у поста нет изображения
                                                echo '<img src="' . get_template_directory_uri() . '/dist/images/default-thumbnail.jpg" alt="Default Thumbnail">';
                                            }
                                            ?>
                                        </div>
                                    </header>
                                    <div class="featured-news_content">
                                        <div class="featured-news_title">
                                            <h3><?php the_title(); ?></h3>
                                            <svg class="featured-news_svg" height="30" width="30" viewBox="0 0 24 24"
                                                 fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                   stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path d="M14 12C14 14.7614 11.7614 17 9 17H7C4.23858 17 2 14.7614 2 12C2 9.23858 4.23858 7 7 7H7.5M10 12C10 9.23858 12.2386 7 15 7H17C19.7614 7 22 9.23858 22 12C22 14.7614 19.7614 17 17 17H16.5"
                                                          stroke="#000000" stroke-width="2"
                                                          stroke-linecap="round"></path>
                                                </g>
                                            </svg>
                                        </div>
                                        <div class="featured-news_description">
                                            <?php
                                            // Вывод краткого описания (excerpt)
                                            the_excerpt();
                                            ?>
                                        </div>
                                        <div class="featured-news_taxonomies">
                                            <?php
                                            // Вывод категорий поста
                                            $categories = get_the_category();
                                            foreach ($categories as $category) {
                                                echo '<div class="featured-news_taxonomy">#' . $category->name . '</div>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </a>
                                <?php
                            }
                            // Сброс данных поста
                            wp_reset_postdata();
                        } else {
                            // Если нет выбранных постов, выведите сообщение или выполните другие действия
                            echo '<p>Нет постов для отображения.</p>';
                        }
                    }
                    ?>
                </div>
                <div class="content-box_sidebar sidebar_news">
                    <div class="sidebar_news_wrapper">
                        <ul class="sidebar_news_list health_list">
                            <?php
                            // Исключаем последний ID, который уже был использован
                            if (!empty($block_postov_checkbox)) {
                                array_pop($block_postov_checkbox);

                                // Перебираем остальные ID постов
                                foreach ($block_postov_checkbox as $post_id) {
                                    // Аргументы запроса для получения поста
                                    $args = array(
                                        'post_type' => 'post',
                                        'p' => $post_id,
                                        'posts_per_page' => 1,
                                    );

                                    // Выполнение запроса
                                    $post_query = new WP_Query($args);

                                    // Проверка наличия постов
                                    if ($post_query->have_posts()) {
                                        while ($post_query->have_posts()) {
                                            $post_query->the_post();
                                            ?>
                                            <!--Сюда выводим информацию о каждом посте-->
                                            <a href="<?php the_permalink(); ?>"
                                               class="sidebar_news_item news-card health_card">
                                                <div class="news-card_box">
                                                    <div class="news-card_img">
                                                        <?php
                                                        // Вывод featured image
                                                        if (has_post_thumbnail()) {
                                                            the_post_thumbnail('full', array('class' => 'featured-image'));
                                                        } else {
                                                            // Вывод заглушки, если у поста нет изображения
                                                            echo '<img src="' . get_template_directory_uri() . '/dist/images/default-thumbnail.jpg" alt="Default Thumbnail">';
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="news-card_content">
                                                        <h4 class="news-card_title">
                                                            <?php echo UtilsClass::limit_title_to_one_line(get_the_title(), 50, '...'); ?>
                                                        </h4>
                                                        <div class="news-card_taxonomies">
                                                            <?php
                                                            // Вывод категорий поста (максимум 3)
                                                            $categories = get_the_category();
                                                            $count = 0; // Счетчик категорий
                                                            foreach ($categories as $category) {
                                                                if ($count < 3) {
                                                                    echo '<div class="news-card_taxonomy">#' . $category->name . '</div>';
                                                                    $count++;
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <?php
                                        }
                                        // Сброс данных поста
                                        wp_reset_postdata();
                                    } else {
                                        // Если нет выбранных постов, выведите сообщение или выполните другие действия
                                        echo '<p>Нет постов для отображения.</p>';
                                    }
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
