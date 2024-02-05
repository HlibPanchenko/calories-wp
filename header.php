<?php

use Kirki\Compatibility\Kirki;

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <title>Калории 365</title>
    <link rel="icon" href="<?php echo get_template_directory_uri() ?>/dist/images/favicon.ico" type="image/png">
    <meta property="og:image" content="<?php echo get_template_directory_uri() ?>/dist/images/og_img_calories.png">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!--------------------------------------
Header
--------------------------------------->

<header class="main-header">
    <!--<header class="main-header fixed-header">-->
    <div class="main-header_top ">
        <?php get_template_part('template-parts/burger-menu'); ?>

        <div class="main-header_container">
            <div class="main-header_box">

                <div class="main-header_logo logo-in-header">
                    <?php
                    // получаем ссылку на логотип
                    $custom_logo__url = wp_get_attachment_image_src(get_theme_mod('custom_logo'), 'full');

                    if ($custom_logo__url) :
                        ?>


                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                            <img class="logo-in-header_whole"
                                 src="<?php echo $custom_logo__url[0] ?>"
                                 alt="logo">
                        </a>

                    <?php endif; ?>

                    <!--                    --><?php //the_custom_logo(); ?>

                    <!--                    <img class="logo-in-header_sign"-->
                    <!--                         src="-->
                    <?php //echo get_template_directory_uri() ?><!--/assets/images/logo-main-4-sign.png?>"-->
                    <!--                         alt="logo">-->
                    <!--                    <img class="logo-in-header_text"-->
                    <!--                         src="-->
                    <?php //echo get_template_directory_uri() ?><!--/assets/images/logo-main-4-text.png?>"-->
                    <!--                         alt="logo">-->

                </div>
                <div class="main-header_info">
                    <?php
                    // Получение значения опции is_search_block
                    $is_search_block = Kirki::get_option('', 'is_search_block', 'true');
                    //                    var_dump($is_search_block);
                    // Проверка условия и вывод блока
                    if ($is_search_block) :
//                    if ($is_search_block === 'true') :
                        ?>
                        <div class="main-header_search search-block">
                            <svg class="search-block_svg" width="25px" height="25px" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path d="M14.9536 14.9458L21 21M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                                          stroke="#000000" stroke-width="2" stroke-linecap="round"
                                          stroke-linejoin="round"></path>
                                </g>
                            </svg>
                            <?php get_template_part('search-form'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="main-header_auth">
                        <?php if (is_user_logged_in()): ?>
                            <!-- Пользователь авторизован, показываем кнопку выхода -->
                            <a href="<?php echo esc_url(home_url('/page-cabinet')); ?>"
                               class="main-header_signin">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="#ffffff" width="20px" height="20px"
                                     viewBox="0 0 24 24" stroke="#ffffff">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"></path>
                                    </g>
                                </svg>
                                <div>
                                    <?php
                                    $current_user = wp_get_current_user();

                                    if ($current_user instanceof WP_User) :
                                        $btnText = $current_user->user_login ? esc_html($current_user->user_login) : 'Личный кабинет';
                                    endif;
                                    ?>
                                    <div class="main-header_signin_text">
                                        <?php
                                        echo $btnText;
                                        ?>
                                    </div>
                                </div>
                            </a>
                        <?php endif; ?>
                        <?php if (!is_user_logged_in()): ?>
                            <!-- Пользователь не авторизован, показываем кнопку входа -->
                            <a href="<?php echo esc_url(home_url('/auth')); ?>" class="main-header_signin">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="#ffffff" width="20px" height="20px"
                                     viewBox="0 0 24 24" stroke="#ffffff">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"></path>
                                    </g>
                                </svg>
                                <div class="main-header_signin_text">Вход</div>
                            </a>
                        <?php endif; ?>
                    </div>
                    <!--burger-menu-->
                    <div id="burger" class="main-header_burger">
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--блок помогает избавиться от прыжка когда header bottom становится fixed-->
    <div id="_avoid_jump"></div>
    <div class="main-header_bottom ">
        <div class="main-header_container">
            <div class="main-header_box">
                <nav class="main-header_nav main-nav">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'menu-navbar-main',
                            'container' => false,
                            'menu_class' => 'main-nav_list',
                        )
                    );
                    ?>
                </nav>
            </div>
        </div>
    </div>
</header>

