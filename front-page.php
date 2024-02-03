<?php
/**
 * Template Name: главная страница
 */
get_header();
?>

    <main id="primary" class="main-wrapper">
<!--        --><?php
//        if (isset($_SESSION['changed_post_id'])) {
//            echo '<div class="success-message">
//        <div class="success-message_wrapper">
//            <div class="success-message_svg">
//                <svg width="34px" height="34px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" fill="#ffffff" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path fill="#ffffff" d="M512 64a448 448 0 1 1 0 896 448 448 0 0 1 0-896zm-55.808 536.384-99.52-99.584a38.4 38.4 0 1 0-54.336 54.336l126.72 126.72a38.272 38.272 0 0 0 54.336 0l262.4-262.464a38.4 38.4 0 1 0-54.272-54.336L456.192 600.384z"></path></g></svg>
//
//            </div>
//            <div class="success-message_content">
//                <div class="success-message_text">' . esc_html($_SESSION['changed_post_id']) . '</div>
//            </div>
//            <div class="success-message_close">&times;</div>
//        </div>
//    </div>';
//            // Очистка сообщения после отображения
//            unset($_SESSION['changed_post_id']);
//        }
//
//        ?>
        <?php
        if (isset($_SESSION['recipe_added'])) {
            echo '<div class="success-message">
            <div class="success-message_wrapper">
                <div class="success-message_svg">
            <svg width="34px" height="34px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" fill="#ffffff" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path fill="#ffffff" d="M512 64a448 448 0 1 1 0 896 448 448 0 0 1 0-896zm-55.808 536.384-99.52-99.584a38.4 38.4 0 1 0-54.336 54.336l126.72 126.72a38.272 38.272 0 0 0 54.336 0l262.4-262.464a38.4 38.4 0 1 0-54.272-54.336L456.192 600.384z"></path></g></svg>
                
                </div>
                <div class="success-message_content">
                    <div class="success-message_text">' . esc_html($_SESSION['recipe_added']) . '</div>
                </div>
                <div class="success-message_close">&times;</div>
            </div>
        </div>';
            unset($_SESSION['recipe_added']);
        }
        ?>

        <?php
        if (isset($_SESSION['login_success'])) {
            echo '<div class="success-message">
            <div class="success-message_wrapper">
                <div class="success-message_svg">
            <svg width="34px" height="34px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" fill="#ffffff" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path fill="#ffffff" d="M512 64a448 448 0 1 1 0 896 448 448 0 0 1 0-896zm-55.808 536.384-99.52-99.584a38.4 38.4 0 1 0-54.336 54.336l126.72 126.72a38.272 38.272 0 0 0 54.336 0l262.4-262.464a38.4 38.4 0 1 0-54.272-54.336L456.192 600.384z"></path></g></svg>
                
                </div>
                <div class="success-message_content">
                    <div class="success-message_text">' . esc_html($_SESSION['login_success']) . '</div>
                </div>
                <div class="success-message_close">&times;</div>
            </div>
        </div>';
            unset($_SESSION['login_success']);
        }

        if (isset($_SESSION['registration_confirm'])) {
            echo '<div class="success-message">
            <div class="success-message_wrapper">
                <div class="success-message_svg">
            <svg width="34px" height="34px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" fill="#ffffff" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path fill="#ffffff" d="M512 64a448 448 0 1 1 0 896 448 448 0 0 1 0-896zm-55.808 536.384-99.52-99.584a38.4 38.4 0 1 0-54.336 54.336l126.72 126.72a38.272 38.272 0 0 0 54.336 0l262.4-262.464a38.4 38.4 0 1 0-54.272-54.336L456.192 600.384z"></path></g></svg>
                
                </div>
                <div class="success-message_content">
                    <div class="success-message_text">' . $_SESSION['registration_confirm'] . '</div>
                </div>
                <div class="success-message_close">&times;</div>
            </div>
        </div>';
            unset($_SESSION['registration_confirm']);
        }
        ?>
        <article class="main-article">
            <!--        <div class="full-width-section"></div>-->
<!--            --><?php //get_template_part('template-parts/swiper-main') ?>

            <?php echo the_content(); ?>

            <!--        --><?php //get_template_part('template-parts/blocks/popular-taxonomies') ?>

<!--            --><?php //get_template_part('template-parts/recipies-day') ?>

<!--            --><?php //get_template_part('template-parts/health-section') ?>

<!--            --><?php //get_template_part('template-parts/recent-posts') ?>

<!--            --><?php //get_template_part('template-parts/trending-section') ?>

            <?php get_template_part('template-parts/floating-button') ?>

<!--            --><?php //get_template_part('template-parts/blocks/accordion-block') ?>


        </article>

    </main>

<?php
//get_sidebar();
get_footer();
