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
        <div class="main-header_container">
            <div class="main-header_box">

                <div class="main-header_logo logo-in-header">
<!--                    <a href="--><?php //echo esc_url(home_url('/')); ?><!--" rel="home">-->
                        <?php the_custom_logo(); ?>
                        <!--                    <img class="logo-in-header_whole"-->
                        <!--                         src="-->
                        <?php //echo get_template_directory_uri() ?><!--/assets/images/CALORIES.365%20vector%20green.png?>"-->
                        <!--                         alt="logo">-->
                        <!--                    <img class="logo-in-header_sign"-->
                        <!--                         src="-->
                        <?php //echo get_template_directory_uri() ?><!--/assets/images/logo-main-4-sign.png?>"-->
                        <!--                         alt="logo">-->
                        <!--                    <img class="logo-in-header_text"-->
                        <!--                         src="-->
                        <?php //echo get_template_directory_uri() ?><!--/assets/images/logo-main-4-text.png?>"-->
                        <!--                         alt="logo">-->

<!--                    </a>-->
                </div>
                <div class="main-header_info">
                    <?php
                    // Получение значения опции is_search_block
                    $is_search_block = Kirki::get_option('','is_search_block', 'true');
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
                        <a href="" class="main-header_login">Log in</a>
                        <a href="" class="main-header_signin">Sign in</a>
                    </div>
                    <!--burger-menu-->
                    <div id="burger" class="main-header_burger">
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

