<?php
// Получаем ID страницы "Main page" чтобы получить ее custom fields
$main_page_id = get_option('page_on_front');

// Получаем кастомные поля
$slider_elements = get_field('slider_elements', $main_page_id); // repeater

//$slider_image = $slider_elements["slider_img"]; // image
//$slider_title = $slider_elements["slider_title"]; // text
//$slider_content = $slider_elements["slider_content"]; // text area
?>

<!-- Slider main container -->
<section class="swiper-main">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">

        <?php foreach ($slider_elements as $slider_element) : ?>
            <?php
            // Получаем данные для каждого слайда
            $slider_image = $slider_element["slider_img"];
            $slider_title = $slider_element["slider_title"];
            $slider_content = $slider_element["slider_content"];
            ?>

            <!-- Slides -->
            <div class="swiper-slide slider-block">
                <img src="<?php echo esc_url($slider_image); ?>" alt="Изображение слайдера">
                <div class="slider-block_container">
                    <div class="slider-block_content card-in-slider">
                        <div class="card-in-slider_img">
                            <img src="<?php echo get_template_directory_uri() ?>/dist/images/SImply-Recipes-Fondant-Potatoes-METHOD-10-0f009ff3e0ce47a196cc97bff2c4fd80.webp" alt="dish photo">
                        </div>
                        <h3 class="card-in-slider_title">
                            <?php echo esc_html($slider_title); ?>
                        </h3>
                        <p class="card-in-slider_description">
                            <?php echo esc_html($slider_content); ?>
                        </p>
                        <div class="card-in-slider_info">
                            <div class="card-in-slider_rating">
                                <div class="card-in-slider_star"></div>
                                <div class="card-in-slider_star"></div>
                                <div class="card-in-slider_star"></div>
                                <div class="card-in-slider_star"></div>
                                <div class="card-in-slider_star"></div>
                            </div>
                            <div class="card-in-slider_credentials">
                                <div class="card-in-slider_date">08.12.2023</div>
                                <div class="card-in-slider_author">
                                    Vladilen Kuchka
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>

    </div>
    <!-- If we need pagination -->
    <div class="swiper-pagination"></div>

    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>

    <!-- If we need scrollbar -->
    <!--            <div class="swiper-scrollbar"></div>-->
</section>