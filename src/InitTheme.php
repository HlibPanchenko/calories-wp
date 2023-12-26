<?php

namespace src;

class InitTheme
{
    public static function initHooks(): void
    {
        add_action('after_setup_theme', [__CLASS__, 'registerThemeSupports']);

        add_action('wp_enqueue_scripts', [__CLASS__, 'enqueueScripts']);

        add_action('widgets_init', [__CLASS__, 'registerSidebars']);

        // Инициализация обработчика сортировки
        SortHandler::init();

        // Инициализация виджета
        CustomTaxonomyWidget::init();

    }

    public static function registerThemeSupports(): void
    {
        add_theme_support('post-thumbnails');
        add_theme_support('title-tag');
        add_theme_support('customize-selective-refresh-widgets');

        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            )
        );

        register_nav_menus(
            array(
                'menu-navbar-main' => esc_html__( 'Menu in header', 'calories_first' ),
            )
        );

        add_theme_support(
            'custom-logo',
            [
                'height'      => 250,
                'width'       => 250,
                'flex-width'  => true,
                'flex-height' => true,
            ]
        );
    }

    public static function enqueueScripts(): void
    {
        wp_enqueue_style(
            'calories_first-google-fonts',
            'https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap');

        wp_enqueue_script( 'jquery', [
            'in_footer' => true,
        ]  );

        wp_enqueue_style(
            'calories_first-maincss',
            get_template_directory_uri() . '/dist/css/bundle.css',
            array('swiper-styles'),
            _S_VERSION,
            'all' );

        wp_enqueue_script(
            'calories_first-mainjs',
            get_template_directory_uri() . '/dist/js/bundle.js',
            array('jquery', 'swiper-scripts'),
            _S_VERSION,
//            true
    ['in_footer' => true]
        );


        wp_enqueue_style(
            'swiper-styles',
            get_template_directory_uri() . '/dist/css/libs/swiper-bundle.min.css',
            '',
            ''
        );

        wp_enqueue_script(
            'swiper-scripts',
            get_template_directory_uri() . '/dist/js/libs/swiper-bundle.min.js',
            _S_VERSION,
            [
                'in_footer' => true,
            ] );

    }

    public static function registerSidebars(): void
    {

        register_sidebar(
            array(
                'name'          => esc_html__( 'Сайдбар таксономий', 'calories_first' ),
                'id'            => 'sidebar-recipe-taxonomies',
                'description'   => esc_html__( 'Добавьте сюда виджеты', 'calories_first' ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            )
        );


    }
}