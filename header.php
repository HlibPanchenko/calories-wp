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
                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                    <?php the_custom_logo(); ?>
<!--                    <img class="logo-in-header_whole"-->
<!--                         src="--><?php //echo get_template_directory_uri() ?><!--/assets/images/CALORIES.365%20vector%20green.png?>"-->
<!--                         alt="logo">-->
<!--                    <img class="logo-in-header_sign"-->
<!--                         src="--><?php //echo get_template_directory_uri() ?><!--/assets/images/logo-main-4-sign.png?>"-->
<!--                         alt="logo">-->
<!--                    <img class="logo-in-header_text"-->
<!--                         src="--><?php //echo get_template_directory_uri() ?><!--/assets/images/logo-main-4-text.png?>"-->
<!--                         alt="logo">-->

                </a>
            </div>
            <div class="main-header_info">
                <div class="main-header_search search-block">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/images/search-alt-1-svgrepo-com.svg"
                         alt="search" width="25" height="25">
                    <?php get_template_part('search-form'); ?>
                </div>
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

