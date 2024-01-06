<?php

$uniqid_arrow1 = uniqid('swiper-block-');
$uniqid_arrow2 = uniqid('swiper-block-');


$slider_elements = get_field('slider_elements'); // repeater
$slider_dots = get_field("slider_dots");
$slider_arrows = get_field("slider_arrows");

?>




<!-- Slider main container -->
<section class="swiper-main" >
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">

        <?php foreach ($slider_elements as $slider_element) : ?>
            <?php
            $uniqid = uniqid('swiper-block-');

            // Получаем данные для каждого слайда
            $slider_image = $slider_element["slider_img"];
            $slider_title = $slider_element["slider_title"];
            $slider_content = $slider_element["slider_content"];
            $slider_link = $slider_element["slider_link"];
            $slider_title_color = $slider_element["slider_title_color"];
            $slider_content_color = $slider_element["slider_content_color"];
            $slider_button_color = $slider_element["slider_button_color"];
            $slider_button_text_color = $slider_element["slider_button_text_color"];
            $slider_button_text = $slider_element["slider_button_text"];
            $slider_card_background = $slider_element["slider_card_background"];
            $slider_block_tinting = $slider_element["slider_block_tinting"];
            $slider_block_border = $slider_element["slider_block_border"];



            ?>

            <style>
                <?php
                echo <<<EOT
                #$uniqid .card-in-slider_title {
                     color: $slider_title_color;
                }
                #$uniqid .card-in-slider_text {
                    color: $slider_content_color
                }
                
                #$uniqid .card-in-slider_btn {
                    background-color:  $slider_button_color;
                    color:  $slider_button_text_color;
                }
                
                #$uniqid .card-in-slider {
                    background-color: $slider_card_background;
                }
                
                 #$uniqid .slider-block_tinting {
                    background-color: $slider_block_tinting;
                }
                
                #$uniqid .slider-block_content {
                    border: 1px solid $slider_block_border;

                }
                
               #$uniqid_arrow1 , #$uniqid_arrow2  {
                    border-color: $slider_arrows; 
                    color: $slider_arrows;
                }
               
               .swiper-pagination-bullet {
                    background: $slider_dots;
               }
             EOT;
                ?>
            </style>

            <!-- Slides -->
            <div class="swiper-slide slider-block" id="<?php echo $uniqid; ?>">
                <img src="<?php echo esc_url($slider_image); ?>" alt="Изображение слайдера">
                <div class="slider-block_tinting"></div>
                <div class="slider-block_container">

                    <div class="slider-block_content card-in-slider">
                        <div class="card-in-slider_box">
                            <div class="card-in-slider_title"><?php echo esc_html($slider_title) ?></div>
                            <div class="card-in-slider_text"><?php echo esc_html($slider_content) ?></div>
                            <a href="<?php echo esc_url(home_url('/' . $slider_link)); ?>" class="card-in-slider_btn">
                                <?php echo esc_html( $slider_button_text) ?>
                            </a>
                        </div>

                    </div>
                </div>
            </div>

        <?php endforeach; ?>

    </div>
    <!-- If we need pagination -->
    <div class="swiper-pagination"></div>

    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev" id="<?php echo $uniqid_arrow1; ?>"></div>
    <div class="swiper-button-next" id="<?php echo $uniqid_arrow2; ?>"></div>

    <!-- If we need scrollbar -->
    <!--            <div class="swiper-scrollbar"></div>-->
</section>