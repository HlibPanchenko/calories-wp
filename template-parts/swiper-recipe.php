<div class="swiper-recipe">
    <div class="swiper-recipe_block">
        <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper-top">
            <div class="swiper-wrapper">
                <?php
                $images_of_recipe = isset($args['images_of_recipe']) ? $args['images_of_recipe'] : array();

                if ($images_of_recipe) {
                    foreach ($images_of_recipe as $image_url) {
                        ?>
                        <div class="swiper-slide">
                            <img src="<?php echo esc_url($image_url); ?>" alt="Recipe Image">
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
            <?php
            if (count($images_of_recipe) > 1) {
            ?>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
                <?php
            }
            ?>
        </div>
        <?php
        if (count($images_of_recipe) > 1) {
        ?>
        <div thumbsSlider="" class="swiper-bottom">
            <div class="swiper-wrapper">
                <?php
                if ($images_of_recipe) {
                    foreach ($images_of_recipe as $image_url) {
                        ?>
                        <div class="swiper-slide">
                            <img src="<?php echo esc_url($image_url); ?>" alt="Recipe Image">
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</div>










<!--<div class="swiper-recipe">-->
<!--    <div class="swiper-wrapper">-->
<!--        --><?php
//        // Получение массива изображений из переданной переменной
//        $images_of_recipe = isset($args['images_of_recipe']) ? $args['images_of_recipe'] : array();
//        // Проверка наличия изображений
//        if ($images_of_recipe) {
//            foreach ($images_of_recipe as $image_url) {
//                ?>
<!--                <div class="swiper-slide">-->
<!--                    <img src="--><?php //echo esc_url($image_url); ?><!--" alt="Recipe Image">-->
<!--                </div>-->
<!--                --><?php
//            }
//        }
//        ?>
<!--    </div>-->
<!--    <div class="swiper-pagination swiper-pagination2"></div>-->
<!--    <div class="swiper-button-next swiper-button-next2"></div>-->
<!--    <div class="swiper-button-prev swiper-button-prev2"></div>-->
<!--    <div class="swiper-scrollbar swiper-scrollbar2"></div>-->
<!--</div>-->
