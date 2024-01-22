<?php

namespace src;

class InitTheme
{
    public static function initHooks(): void
    {
        add_action('after_setup_theme', [__CLASS__, 'registerThemeSupports']);

        add_action('wp_enqueue_scripts', [__CLASS__, 'enqueueScripts']);

        add_action('wp_enqueue_scripts', [__CLASS__, 'myajax_data'], 99);

        add_action('widgets_init', [__CLASS__, 'registerSidebars']);

        add_action('init', [__CLASS__, 'create_custom_role']);

//        AuthHandler::init();

        // Инициализация обработчика сортировки
        SortHandler::init();

        LoadMoreHandler::init();

        // Инициализация виджета
        CustomTaxonomyWidget::init();

        if (function_exists('acf_register_block_type')) {
            add_action('acf/init', [__CLASS__, 'registerAcfBlockTypes']);
        }
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
                'menu-navbar-main' => esc_html__('Menu in header', 'calories_first'),
                'menu-navbar-footer' => esc_html__('Menu in footer', 'calories_first'),
            )
        );

        add_theme_support(
            'custom-logo',
            [
                'height' => 250,
                'width' => 250,
                'flex-width' => true,
                'flex-height' => true,
            ]
        );
    }

    public static function enqueueScripts(): void
    {
        wp_enqueue_style(
            'calories_first-google-fonts',
            'https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap'
        );

        wp_enqueue_script('jquery', [
            'in_footer' => true,
        ]);

        wp_enqueue_style(
            'calories_first-maincss',
            get_template_directory_uri() . '/dist/css/bundle.css',
            array('swiper-styles'),
            _S_VERSION,
            'all'
        );

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
            ]
        );

    }

    public static function myajax_data()
    {

        // Первый параметр 'twentyfifteen-script' означает, что код будет прикреплен к скрипту с ID 'twentyfifteen-script'
        // 'twentyfifteen-script' должен быть добавлен в очередь на вывод, иначе WP не поймет куда вставлять код локализации
        // Заметка: обычно этот код нужно добавлять в functions.php в том месте где подключаются скрипты, после указанного скрипта
        wp_localize_script('calories_first-mainjs', 'myajax',
            array(
                'url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('myajax-nonce')
            )

        );

    }

    public static function registerSidebars(): void
    {

        register_sidebar(
            array(
                'name' => esc_html__('Сайдбар таксономий', 'calories_first'),
                'id' => 'sidebar-recipe-taxonomies',
                'description' => esc_html__('Добавьте сюда виджеты', 'calories_first'),
                'class' => 'first',
                'before_widget' => '<div class="widget-sb-1">',
                'after_widget' => '</div>',
                'before_title' => '<h2 class="widget-title">',
                'after_title' => '</h2>',
                'before_sidebar' => '<div class="sidebar-1">',
                'after_sidebar'  => '</div>'
            )
        );

        register_sidebar(
            array(
                'name' => esc_html__('Сайдбар 2', 'calories_first'),
                'id' => 'sidebar-recipe-second',
                'description' => esc_html__('Добавьте сюда виджеты', 'calories_first'),
                'class' => 'second',
                'before_widget' => '<div class="widget-sb-2">',
                'after_widget' => '</div>',
                'before_title' => '<h2 class="widget-title">',
                'after_title' => '</h2>',
                'before_sidebar' => '<div class="sidebar-2">',
                'after_sidebar'  => '</div>'
            )
        );
    }

    public static function registerAcfBlockTypes(): void
    {
        acf_register_block_type([
            'name' => 'taxonomies-block',
            'title' => 'Блок Таксономий',
            'description' => 'A block for displaying 6 taxonomies',
            'render_template' => get_template_directory() . '/template-parts/blocks/popular-taxonomies-block.php',
            'icon' => 'list-view',
            'keywords' => 'taxonomy'
        ]);

        acf_register_block_type([
            'name' => 'swiper-block',
            'title' => 'Блок Свайпер',
            'description' => 'A block for displaying main swiper',
            'render_template' => get_template_directory() . '/template-parts/blocks/swiper-main-block.php',
            'icon' => 'list-view',
            'keywords' => 'swiper'
        ]);

        acf_register_block_type([
            'name' => 'recipes-block',
            'title' => 'Блок рецептов',
            'description' => 'A block for displaying recipes',
            'render_template' => get_template_directory() . '/template-parts/blocks/recipes-block.php',
            'icon' => 'list-view',
            'keywords' => 'recipes'
        ]);

        acf_register_block_type([
            'name' => 'posts-block',
            'title' => 'Блок постов',
            'description' => 'A block for displaying posts',
            'render_template' => get_template_directory() . '/template-parts/blocks/posts-block.php',
            'icon' => 'list-view',
            'keywords' => 'recipes'
        ]);

        acf_register_block_type([
            'name' => 'accordion-block',
            'title' => 'Блок аккордион',
            'description' => 'A block for displaying accordion block',
            'render_template' => get_template_directory() . '/template-parts/blocks/accordion-block.php',
            'icon' => 'list-view',
            'keywords' => 'accordion, questions'
        ]);
    }

    public static function create_custom_role(): void {
        add_role('member_role', 'Member Custom  Role', array(
            'read' => true, // разрешение на чтение
            'edit_recipes' => true,
            'publish_recipes' => true,
            'delete_recipes' => true,
        ));
    }
}
