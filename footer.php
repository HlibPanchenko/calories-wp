<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package calories_first
 */

?>

<footer class="main-footer">
    <div class="main-footer_box">
        <div class="main-footer_top">
            <div class="main-footer_container">
                <div class="main-footer_content">
                    <div class="main-footer_left">
                        <div class="main-footer_logo">
                            <a href="<?php echo esc_url(home_url('/')); ?>">
                                <?php
                                $image = get_theme_mod('footer_logo', '');
//                                var_dump($image);
                                ?>
                                <?php if ($image) : ?>

                                    <img class="logo-in-footer_whole"
                                         src="<?php echo $image ?>" alt="logo">
                                <?php else: ?>
                                    <img class="logo-in-footer_whole"
                                         src="<?php echo get_template_directory_uri() ?>/assets/images/CALORIES.365%20vector%20green.png?>"
                                         alt="logo">
                                <?php endif; ?>
                            </a>

                        </div>
                        <div class="main-footer_info">
                            <ul class="main-footer_list">
                                <li class="main-footer_link">
                                    <a href="<?php echo esc_url(home_url('/about')); ?>"> О нас</a>
                                   </li>
                                <li class="main-footer_link">
                                    <a href="<?php echo esc_url(home_url('/about')); ?>"> Контакты </a>
                                </li>
                                <li class="main-footer_link">Про проект</li>
                            </ul>
                        </div>
                    </div>
                    <div class="main-footer_right">
                        <div class="main-footer_menu">
                            <?php
                            wp_nav_menu(
                                array(
                                    'theme_location' => 'menu-navbar-footer',
                                    'container' => false,
                                    'menu_class' => 'menu-footer',
                                )
                            );
                            ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="main-footer_bottom">
            <div class="main-footer_container">
                © 2023 - 2024 Калории 365 | Все права защищены.
            </div>
        </div>
    </div>


</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
