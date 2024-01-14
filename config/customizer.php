<?php

new \Kirki\Panel(
    'theme_settings',
    [
        'priority' => 10,
        'title' => esc_html__('Настройки темы', 'calories_first'),
        'description' => esc_html__('Описание панели настроек темы', 'calories_first'),
    ]
);

/*Секция гдобальный настроек*/
new \Kirki\Section(
    'global_settings',
    [
        'title' => esc_html__('Глобальные настройки', 'calories_first'),
        'description' => esc_html__('Описание глобальных настроек', 'calories_first'),
        'panel' => 'theme_settings',
        'priority' => 160,
    ]
);
/*в опциях указываем секцию*/
new \Kirki\Field\Color(
    [
        // Уникальный идентификатор для этой опции
        'settings' => 'theme_main_color',
        'label' => __('Главный цвет сайта', 'calories_first'),
        'section' => 'global_settings',
        'default' => '#73ae37',
        // предоставления дополнительных настроек опции
        'choices' => [
            // добавляет возможность выбора прозрачности цвета (добавится слайдер для управления прозрачностью)
            'alpha' => true,
            /*цвет по дефолту*/
            'colors' => ['#73ae37'],
        ],
        // куда должны выводиться значения выбранных опций
        'output' => [
            [
                /*Определяет CSS-селектор, к которому будут применяться стили*/
                'element' => ':root',
                // Определяет CSS-свойство, которое будет изменяться в зависимости от выбора пользователя
                'property' => '--theme-main-color',
            ],
        ]
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'global_background_color',
        'label' => __('Background Color', 'calories_first'),
        'section' => 'global_settings',
        'default' => '#ffffff',
        'output' => [
            [
                'element' => ':root',
                'property' => '--global-bg-color',
            ],
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'global_font_color',
        'label' => __('Font Color', 'calories_first'),
        'section' => 'global_settings',
        'default' => '#000000',
        'output' => [
            [
                'element' => ':root',
                'property' => '--global-font-color',
            ],
        ],
    ]
);

new \Kirki\Field\Typography(
    [
        'settings' => 'theme_global_font',
        'label' => esc_html__('Шрифт для всего сайта', 'kirki'),
//        'description' => esc_html__( 'Описание настроек для заголовка слайдера', 'kirki' ),
        'section' => 'global_settings',
        'priority' => 10,
        'transport' => 'auto',
        'default' => [
            'font-family' => 'Roboto',
        ],
        'choices' => [
            'fonts' => [
                'google' => ['Roboto', 'Open Sans', 'Lato', 'Noto Serif', 'Noto Sans'],
            ],
        ],
        'output' => [
            [
                'element' => 'body',
                'property' => 'font-family',
            ],
        ],
    ]
);


/*Секция настроек header*/
new \Kirki\Section(
    'header_settings',
    [
        'title' => esc_html__('Header Settings', 'kirki'),
        'description' => esc_html__('My Section Description.', 'kirki'),
        'panel' => 'theme_settings',
        'priority' => 160,
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'header_background_color',
        'label' => __('Background Color in header', 'calories_first'),
        'section' => 'header_settings',
        'default' => '#ffffff',
        'output' => [
            [
                'element' => ':root',
                'property' => '--header-bg-color',
            ],
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'header_dropdown_background_color',
        'label' => __('Background Color in dropdown', 'calories_first'),
        'section' => 'header_settings',
        'default' => '#ffffff',
        'output' => [
            [
                'element' => ':root',
                'property' => '--header-dropdown-bg-color',
            ],
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'header_dropdown_hover_color',
        'label' => __('Hover Color in dropdown', 'calories_first'),
        'section' => 'header_settings',
        'default' => '#ececec',
        'output' => [
            [
                'element' => ':root',
                'property' => '--header-dropdown-hover-color',
            ],
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'header_color',
        'label' => __('Color in header', 'calories_first'),
        'section' => 'header_settings',
        'default' => '#000000',
        'output' => [
            [
                'element' => ':root',
                'property' => '--header-color',
            ],
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'header_buttons_bg_color',
        'label' => __('Background for buttons', 'calories_first'),
        'section' => 'header_settings',
        'default' => '#73ae37',
        'output' => [
            [
                'element' => ':root',
                'property' => '--header_buttons_bg_color',
            ],
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'header_buttons_text_color',
        'label' => __('Color for buttons', 'calories_first'),
        'section' => 'header_settings',
        'default' => '#ffffff',
        'output' => [
            [
                'element' => ':root',
                'property' => '--header_buttons_text_color',
            ],
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'header_buttons_hover_color',
        'label' => __('Hover color for buttons', 'calories_first'),
        'section' => 'header_settings',
        'default' => '#ff00a8',
        'output' => [
            [
                'element' => ':root',
                'property' => '--header_buttons_hover_color',
            ],
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'header_boxshadow_color',
        'label' => __('Box-shadow color', 'calories_first'),
        'section' => 'header_settings',
        'default' => '#000000',
        'output' => [
            [
                'element' => ':root',
                'property' => '--header_boxshadow_color',
            ],
        ],
    ]
);

new \Kirki\Field\Radio_Buttonset(
    [
        'settings' => 'is_search_block',
        'label' => esc_html__('Show search block', 'kirki'),
        'section' => 'header_settings',
        'default' => true,
        'priority' => 10,
        'choices' => [
            true => esc_html__('Show', 'kirki'),
            false => esc_html__('Hide', 'kirki'),
        ],
    ]
);

/*Секция настроек слайдера*/
new \Kirki\Section(
    'swiper_settings',
    [
        'title' => esc_html__('Swiper settings', 'calories_first'),
//        'description' => esc_html__('Описание настроек для слайдера', 'calories_first'),
        'panel' => 'theme_settings',
        'priority' => 160,
    ]
);

new \Kirki\Field\Typography(
    [
        'settings' => 'title_in_swiper',
        'label' => esc_html__('Заголовок в слайдере', 'calories_first'),
//        'description' => esc_html__( 'Описание настроек для заголовка слайдера', 'kirki' ),
        'section' => 'swiper_settings',
        'priority' => 10,
        'transport' => 'auto',
        'default' => [
            'font-family' => 'Roboto',
            'variant' => '700',
            'font-style' => 'normal',
//            'color'           => '#333333',
            'font-size' => '64px',
            'line-height' => '1',
            'letter-spacing' => '0',
            'text-transform' => 'uppercase',
            'text-decoration' => 'none',
            'text-align' => 'left',
        ],
        'choices' => [
            'fonts' => [
                'google' => ['Roboto', 'Open Sans', 'Lato', 'Noto Serif', 'Noto Sans'],
            ],
        ],
        'output' => [
            [
                'element' => '.card-in-slider_title',
            ],
        ],
    ]
);

new \Kirki\Field\Dimension(
    [
        'settings' => 'mr_btm_title_swiper',
        'label' => esc_html__('Margin for title', 'calories_first'),
        'section' => 'swiper_settings',
        'priority' => 10,
        'transport' => 'refresh',
        'default' => '18px',
        'choices' => [
            'accept_unitless' => false,
        ],
    ]
);

new \Kirki\Field\Typography(
    [
        'settings' => 'text_in_swiper',
        'label' => esc_html__('Текст в слайдере', 'calories_first'),
        'section' => 'swiper_settings',
        'priority' => 10,
        'transport' => 'auto',
        'default' => [
            'font-family' => 'Roboto',
            'variant' => '700',
            'font-style' => 'normal',
            'font-size' => '24px',
            'line-height' => '1',
            'letter-spacing' => '0',
            'text-transform' => 'uppercase',
            'text-decoration' => 'none',
            'text-align' => 'left',
        ],
        'choices' => [
            'fonts' => [
                'google' => ['Roboto', 'Open Sans', 'Lato', 'Noto Serif', 'Noto Sans'],
            ],
        ],
        'output' => [
            [
                'element' => '.card-in-slider_text',
            ],
        ],
    ]
);

new \Kirki\Field\Dimension(
    [
        'settings' => 'mr_btm_text_swiper',
        'label' => esc_html__('Margin for text', 'calories_first'),
        'section' => 'swiper_settings',
        'priority' => 10,
        'transport' => 'refresh',
        'default' => '36px',
        'choices' => [
            'accept_unitless' => false,
        ],

    ]
);

/*Секция для footer*/
new \Kirki\Section(
    'footer_settings',
    [
        'title' => esc_html__('Footer Settings', 'calories_first'),
//        'description' => esc_html__('My Section Description.', 'calories_first'),
        'panel' => 'theme_settings',
        'priority' => 160,
    ]
);

new \Kirki\Field\Image(
    [
        'settings' => 'footer_logo',
        'label' => esc_html__('Logo', 'calories_first'),
        'section' => 'footer_settings',
        'default' => '',
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'footer_background_color',
        'label' => __('Background Color', 'calories_first'),
        'section' => 'footer_settings',
        'default' => '#ffffff',
        'output' => [
            [
                'element' => ':root',
                'property' => '--footer-bg-color',
            ],
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'footer_title_color',
        'label' => __('Title Color', 'calories_first'),
        'section' => 'footer_settings',
        'default' => '#73ae37',
        'output' => [
            [
                'element' => ':root',
                'property' => '--footer-title-color',
            ],
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'footer_link_color',
        'label' => __('Link Color', 'calories_first'),
        'section' => 'footer_settings',
        'default' => '#000000',
        'output' => [
            [
                'element' => ':root',
                'property' => '--footer-link-color',
            ],
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'footer_accent_color',
        'label' => __('Accent Color', 'calories_first'),
        'section' => 'footer_settings',
        'default' => '#ff00a8',
        'output' => [
            [
                'element' => ':root',
                'property' => '--footer_accent_color',
            ],
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'footer_border_top_color',
        'label' => __('Border-top Color', 'calories_first'),
        'section' => 'footer_settings',
        'default' => '#e0e0e0',
        'output' => [
            [
                'element' => ':root',
                'property' => '--footer_border_top_color',
            ],
        ],
    ]
);


/*Секция кнопки вернуться вверх*/
new \Kirki\Section(
    'float_button_settings',
    [
        'title' => esc_html__('Float Button Settings', 'calories_first'),
        'panel' => 'theme_settings',
        'priority' => 160,
    ]
);

new \Kirki\Field\Checkbox_Toggle(
    [
        'settings' => 'float_button_to_top_enable',
        'label' => esc_html__('Enable Float Button Back Top', 'calories_first'),
        'section' => 'float_button_settings',
        'default' => '1',
        'priority' => 10,
    ]
);

new \Kirki\Field\Radio_Buttonset(
    [
        'settings' => 'float_button_to_top_align',
        'label' => esc_html__('Align Float Button To Top', 'calories_first'),
        'section' => 'float_button_settings',
        'default' => 'right',
        'priority' => 10,
        'choices' => [
            'left' => esc_html__('Left', 'calories_first'),
            'right' => esc_html__('Right', 'calories_first'),
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'float_button_to_top_background',
        'label' => __('Background color', 'calories_first'),
        'section' => 'float_button_settings',
        'default' => '#73ae37',
        'output' => [
            [
                'element' => ':root',
                'property' => '--float_button_to_top_background',
            ],
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'float_button_to_top_color',
        'label' => __('Arrow color', 'calories_first'),
        'section' => 'float_button_settings',
        'default' => '#ffffff',
        'output' => [
            [
                'element' => ':root',
                'property' => '--float_button_to_top_color',
            ],
        ],
    ]
);


/*настройки для single-recipe.php*/

new \Kirki\Section(
    'single_recipe_page_settings',
    [
        'title' => esc_html__('Single recipe page settings', 'calories_first'),
        'panel' => 'theme_settings',
        'priority' => 160,
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'single_recipe_background_color',
        'label' => __('Background Color', 'calories_first'),
        'description' => esc_html__('Если цвет не указан, будет применен глобальный цвет сайта', 'calories_first'),
        'section' => 'single_recipe_page_settings',
        'default' => 'rgba(255, 255, 255, 0)',
        'choices' => [
            // добавляет возможность выбора прозрачности цвета (добавится слайдер для управления прозрачностью)
            'alpha' => true,
            /*цвет по дефолту*/
            'colors' => ['rgba(255, 255, 255, 0)'],
        ],
        'output' => [
            [
                'element' => ':root',
                'property' => '--single-recipe-bg-color',
            ],
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'single_recipe_title_color',
        'label' => __('Title color', 'calories_first'),
        'description' => esc_html__('Если цвет не указан, будет применен глобальный цвет сайта', 'calories_first'),
        'section' => 'single_recipe_page_settings',
//        'default' => 'rgba(0, 0, 0, 0)',
        'choices' => [
            // добавляет возможность выбора прозрачности цвета (добавится слайдер для управления прозрачностью)
            'alpha' => true,
            /*цвет по дефолту*/
//            'colors' => ['#rgba(0, 0, 0, 0)'],
        ],
        'output' => [
            [
                'element' => ':root',
                'property' => '--single_recipe_title_color',
            ],
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'single_recipe_content_color',
        'label' => __('Content color', 'calories_first'),
        'description' => esc_html__('Если цвет не указан, будет применен глобальный цвет сайта', 'calories_first'),
        'section' => 'single_recipe_page_settings',
//        'default' => 'rgba(0, 0, 0, 0)',
        'choices' => [
            // добавляет возможность выбора прозрачности цвета (добавится слайдер для управления прозрачностью)
            'alpha' => true,
        ],
        'output' => [
            [
                'element' => ':root',
                'property' => '--single_recipe_content_color',
            ],
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'single_recipe_link_color',
        'label' => __('Link color', 'calories_first'),
        'section' => 'single_recipe_page_settings',
//        'default' => 'rgba(0, 0, 0, 0)',
        'choices' => [
            // добавляет возможность выбора прозрачности цвета (добавится слайдер для управления прозрачностью)
            'alpha' => true,
        ],
        'output' => [
            [
                'element' => ':root',
                'property' => '--single_recipe_link_color',
            ],
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'single_recipe_hover_link_color',
        'label' => __('Hover link color', 'calories_first'),
        'section' => 'single_recipe_page_settings',
//        'default' => 'rgba(0, 0, 0, 0)',
        'choices' => [
            // добавляет возможность выбора прозрачности цвета (добавится слайдер для управления прозрачностью)
            'alpha' => true,
        ],
        'output' => [
            [
                'element' => ':root',
                'property' => '--single_recipe_hover_link_color',
            ],
        ],
    ]
);

new \Kirki\Field\Radio_Buttonset(
    [
        'settings' => 'single_recipe_line_show',
        'label' => esc_html__('Show line', 'calories_first'),
        'description' => esc_html__('It will be shown after description', 'calories_first'),
        'section' => 'single_recipe_page_settings',
        'default' => 'yes',
        'priority' => 10,
        'choices' => [
            'none' => esc_html__('No', 'calories_first'),
            'block' => esc_html__('Yes', 'calories_first'),
        ],
        'output' => [
            [
                'element' => ':root',
                'property' => '--single_recipe_line_show',
            ],
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'single_recipe_line_color',
        'label' => __('Color for line', 'calories_first'),
        'section' => 'single_recipe_page_settings',
        'default' => '#ffffff',
        'choices' => [
            // добавляет возможность выбора прозрачности цвета (добавится слайдер для управления прозрачностью)
            'alpha' => true,
        ],
        'output' => [
            [
                'element' => ':root',
                'property' => '--single_recipe_line_color',
            ],
        ],
    ]
);

new \Kirki\Field\Checkbox_Toggle(
    [
        'settings' => 'single_recipe_show_sidebar',
        'label' => esc_html__('Enable sidebar', 'calories_first'),
        'section' => 'single_recipe_page_settings',
        'default' => '1',
        'priority' => 10,
    ]
);

new \Kirki\Field\Multicheck(
    [
        'settings' => 'single_recipe_multicheck_sidebar',
        'label' => esc_html__('Choose sidebar to show', 'calories_first'),
        'section' => 'single_recipe_page_settings',
        'default' => ['option-1', 'option-2'],
        'priority' => 10,
        'choices' => [
            'option-1' => esc_html__('Sidebar 1', 'calories_first'),
            'option-2' => esc_html__('Sidebar 2', 'calories_first'),
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'single_recipe_sidebar_background',
        'label' => __('Background Color', 'calories_first'),
        'description' => esc_html__('Можете переопределить цвета сайдбара, но основные настройки сайдбара находятся в секции "Sidebar settings"', 'calories_first'),
        'section' => 'single_recipe_page_settings',
//        'default' => 'rgba(255, 255, 255, 0)',
        'choices' => [
            // добавляет возможность выбора прозрачности цвета (добавится слайдер для управления прозрачностью)
            'alpha' => true,
            /*цвет по дефолту*/
//            'colors' => ['rgba(255, 255, 255, 0)'],
        ],
        'output' => [
            [
                'element' => ':root',
                'property' => '--single_recipe_sidebar_background',
            ],
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'single_recipe_sidebar_title',
        'label' => __('Title Color', 'calories_first'),
        'description' => esc_html__('Можете переопределить цвета сайдбара, но основные настройки сайдбара находятся в секции "Sidebar settings"', 'calories_first'),
        'section' => 'single_recipe_page_settings',
//        'default' => 'rgba(255, 255, 255, 0)',
        'choices' => [
            // добавляет возможность выбора прозрачности цвета (добавится слайдер для управления прозрачностью)
            'alpha' => true,
            /*цвет по дефолту*/
//            'colors' => ['rgba(255, 255, 255, 0)'],
        ],
        'output' => [
            [
                'element' => ':root',
                'property' => '--single_recipe_sidebar_title',
            ],
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'single_recipe_sidebar_color',
        'label' => __('Link Color', 'calories_first'),
        'description' => esc_html__('Можете переопределить цвета сайдбара, но основные настройки сайдбара находятся в секции "Sidebar settings"', 'calories_first'),
        'section' => 'single_recipe_page_settings',
//        'default' => 'rgba(255, 255, 255, 0)',
        'choices' => [
            // добавляет возможность выбора прозрачности цвета (добавится слайдер для управления прозрачностью)
            'alpha' => true,
            /*цвет по дефолту*/
//            'colors' => ['rgba(255, 255, 255, 0)'],
        ],
        'output' => [
            [
                'element' => ':root',
                'property' => '--single_recipe_sidebar_color',
            ],
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'single_recipe_sidebar_hover',
        'label' => __('Hover Link Color', 'calories_first'),
        'description' => esc_html__('Можете переопределить цвета сайдбара, но основные настройки сайдбара находятся в секции "Sidebar settings"', 'calories_first'),
        'section' => 'single_recipe_page_settings',
//        'default' => 'rgba(255, 255, 255, 0)',
        'choices' => [
            // добавляет возможность выбора прозрачности цвета (добавится слайдер для управления прозрачностью)
            'alpha' => true,
            /*цвет по дефолту*/
//            'colors' => ['rgba(255, 255, 255, 0)'],
        ],
        'output' => [
            [
                'element' => ':root',
                'property' => '--single_recipe_sidebar_hover',
            ],
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'single_recipe_info_bg',
        'label' => __('Background Color', 'calories_first'),
        'description' => esc_html__('Information block about calories, time etc.', 'calories_first'),
        'section' => 'single_recipe_page_settings',
        'default' => '#f7f7f7',
        'choices' => [
            // добавляет возможность выбора прозрачности цвета (добавится слайдер для управления прозрачностью)
            'alpha' => true,
            /*цвет по дефолту*/
            'colors' => ['#f7f7f7'],
        ],
        'output' => [
            [
                'element' => ':root',
                'property' => '--single_recipe_info_bg',
            ],
        ],
    ]
);

new \Kirki\Field\Radio_Buttonset(
    [
        'settings' => 'single_recipe_info_design',
        'label' => esc_html__('Choose design for info block', 'calories_first'),
        'section' => 'single_recipe_page_settings',
        'default' => 'separated-blocks',
        'priority' => 10,
        'choices' => [
            'one-block' => esc_html__('One-block', 'calories_first'),
            'separated-blocks' => esc_html__('Separated-blocks', 'calories_first'),
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'single_recipe_info_m_color',
        'label' => __('Main Font Color', 'calories_first'),
        'section' => 'single_recipe_page_settings',
        'default' => '#000000',
        'choices' => [
            // добавляет возможность выбора прозрачности цвета (добавится слайдер для управления прозрачностью)
            'alpha' => true,
            /*цвет по дефолту*/
            'colors' => ['#000000'],
        ],
        'output' => [
            [
                'element' => ':root',
                'property' => '--single_recipe_info_m_color',
            ],
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'single_recipe_info_sub_color',
        'label' => __('Sub Font Color', 'calories_first'),
        'section' => 'single_recipe_page_settings',
        'default' => '#c4c4c4',
        'choices' => [
            // добавляет возможность выбора прозрачности цвета (добавится слайдер для управления прозрачностью)
            'alpha' => true,
            /*цвет по дефолту*/
            'colors' => ['#c4c4c4'],
        ],
        'output' => [
            [
                'element' => ':root',
                'property' => '--single_recipe_info_sub_color',
            ],
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'single_recipe_ingredients_bg',
        'label' => __('Background Color', 'calories_first'),
        'description' => esc_html__('Ingredients block', 'calories_first'),
        'section' => 'single_recipe_page_settings',
        'default' => '#F7847C',
        'choices' => [
            // добавляет возможность выбора прозрачности цвета (добавится слайдер для управления прозрачностью)
            'alpha' => true,
            /*цвет по дефолту*/
            'colors' => ['#F7847C'],
        ],
        'output' => [
            [
                'element' => ':root',
                'property' => '--single_recipe_ingredients_bg',
            ],
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'single_recipe_ingredients_color',
        'label' => __('Text Color', 'calories_first'),
        'section' => 'single_recipe_page_settings',
        'default' => '#ffffff',
        'choices' => [
            // добавляет возможность выбора прозрачности цвета (добавится слайдер для управления прозрачностью)
            'alpha' => true,
            /*цвет по дефолту*/
            'colors' => ['#ffffff'],
        ],
        'output' => [
            [
                'element' => ':root',
                'property' => '--single_recipe_ingredients_color',
            ],
        ],
    ]
);

new \Kirki\Field\Radio_Buttonset(
    [
        'settings' => 'single_recipe_ingredients_title_align',
        'label' => esc_html__('Align title in ingredients block', 'calories_first'),
        'section' => 'single_recipe_page_settings',
        'default' => 'center',
        'priority' => 10,
        'choices' => [
            'left' => esc_html__('Left', 'calories_first'),
            'center' => esc_html__('Center', 'calories_first'),
        ],
        'output' => [
            [
                'element' => ':root',
                'property' => '--single_recipe_ingredients_title_align',
            ],
        ],
    ]
);

new \Kirki\Field\Text(
    [
        'settings' => 'single_recipe_ingredients_title_text',
        'label' => esc_html__('Text in title', 'calories_first'),
        'section' => 'single_recipe_page_settings',
        'default' => esc_html__('Steps of cooking', 'calories_first'),
        'priority' => 10,
    ]
);

new \Kirki\Field\Checkbox(
    [
        'settings' => 'single_recipe_ingredients_title_svg_show',
        'label' => esc_html__('Show svg in title', 'calories_first'),
        'section' => 'single_recipe_page_settings',
        'default' => true,
    ]
);


new \Kirki\Field\Color(
    [
        'settings' => 'single_recipe_steps_bg',
        'label' => __('Step block background color', 'calories_first'),
        'section' => 'single_recipe_page_settings',
        'default' => '#F7847C',
        'choices' => [
            // добавляет возможность выбора прозрачности цвета (добавится слайдер для управления прозрачностью)
            'alpha' => true,
            /*цвет по дефолту*/
            'colors' => ['#F7847C'],
        ],
        'output' => [
            [
                'element' => ':root',
                'property' => '--single_recipe_steps_bg',
            ],
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'single_recipe_steps_title',
        'label' => __('Title color', 'calories_first'),
        'section' => 'single_recipe_page_settings',
        'default' => '#ffffff',
        'choices' => [
            // добавляет возможность выбора прозрачности цвета (добавится слайдер для управления прозрачностью)
            'alpha' => true,
            /*цвет по дефолту*/
            'colors' => ['#ffffff'],
        ],
        'output' => [
            [
                'element' => ':root',
                'property' => '--single_recipe_steps_title',
            ],
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'single_recipe_steps_color',
        'label' => __('Text color', 'calories_first'),
        'section' => 'single_recipe_page_settings',
        'default' => '#ffffff',
        'choices' => [
            // добавляет возможность выбора прозрачности цвета (добавится слайдер для управления прозрачностью)
            'alpha' => true,
            /*цвет по дефолту*/
            'colors' => ['#ffffff'],
        ],
        'output' => [
            [
                'element' => ':root',
                'property' => '--single_recipe_steps_color',
            ],
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'single_recipe_steps_step_color',
        'label' => __('Color of step (01 step)', 'calories_first'),
        'section' => 'single_recipe_page_settings',
        'default' => '#ffffff',
        'choices' => [
            // добавляет возможность выбора прозрачности цвета (добавится слайдер для управления прозрачностью)
            'alpha' => true,
            /*цвет по дефолту*/
            'colors' => ['#ffffff'],
        ],
        'output' => [
            [
                'element' => ':root',
                'property' => '--single_recipe_steps_step_color',
            ],
        ],
    ]
);

new \Kirki\Field\Radio_Buttonset(
    [
        'settings' => 'single_recipe_steps_step_choose',
        'label' => esc_html__('Choose design for step title', 'calories_first'),
        'section' => 'single_recipe_page_settings',
        'default' => 'step-1',
        'priority' => 10,
        'choices' => [
            'step-1' => esc_html__('01step', 'calories_first'),
            'step-2' => esc_html__('Step1', 'calories_first'),
        ],

    ]
);

new \Kirki\Field\Radio_Buttonset(
    [
        'settings' => 'single_recipe_steps_title_align',
        'label' => esc_html__('Align title in step block', 'calories_first'),
        'section' => 'single_recipe_page_settings',
        'default' => 'left',
        'priority' => 10,
        'choices' => [
            'left' => esc_html__('Left', 'calories_first'),
            'center' => esc_html__('Center', 'calories_first'),
        ],
        'output' => [
            [
                'element' => ':root',
                'property' => '--single_recipe_steps_title_align',
            ],
        ],
    ]
);

new \Kirki\Field\Text(
    [
        'settings' => 'single_recipe_steps_title_text',
        'label' => esc_html__('Text in title', 'calories_first'),
        'section' => 'single_recipe_page_settings',
        'default' => esc_html__('Steps of cooking', 'calories_first'),
        'priority' => 10,
    ]
);

new \Kirki\Field\Checkbox(
    [
        'settings' => 'single_recipe_steps_title_svg_show',
        'label' => esc_html__('Show svg in title', 'calories_first'),
        'section' => 'single_recipe_page_settings',
        'default' => true,
    ]
);

new \Kirki\Field\Code(
    [
        'settings' => 'single_recipe_steps_title_svg',
        'label' => esc_html__('Svg in title', 'calories_first'),
        'description' => esc_html__('Put in here svg html tag', 'calories_first'),
        'section' => 'single_recipe_page_settings',
        'default' => '',
        'choices' => [
            'language' => 'html',
        ],
    ]
);

/*single.php*/
new \Kirki\Section(
    'single_page_settings',
    [
        'title' => esc_html__('Single page settings', 'calories_first'),
        'panel' => 'theme_settings',
        'priority' => 160,
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'single_background_color',
        'label' => __('Background Color', 'calories_first'),
        'description' => esc_html__('Если цвет не указан, будет применен глобальный цвет сайта', 'calories_first'),
        'section' => 'single_page_settings',
        'default' => 'rgba(255, 255, 255, 0)',
        'choices' => [
            // добавляет возможность выбора прозрачности цвета (добавится слайдер для управления прозрачностью)
            'alpha' => true,
            /*цвет по дефолту*/
            'colors' => ['rgba(255, 255, 255, 0)'],
        ],
        'output' => [
            [
                'element' => ':root',
                'property' => '--single-bg-color',
            ],
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'single_title_color',
        'label' => __('Title color', 'calories_first'),
        'description' => esc_html__('Если цвет не указан, будет применен глобальный цвет сайта', 'calories_first'),
        'section' => 'single_page_settings',
//        'default' => 'rgba(0, 0, 0, 0)',
        'choices' => [
            // добавляет возможность выбора прозрачности цвета (добавится слайдер для управления прозрачностью)
            'alpha' => true,
            /*цвет по дефолту*/
//            'colors' => ['#rgba(0, 0, 0, 0)'],
        ],
        'output' => [
            [
                'element' => ':root',
                'property' => '--single_title_color',
            ],
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'single_content_color',
        'label' => __('Content color', 'calories_first'),
        'description' => esc_html__('Если цвет не указан, будет применен глобальный цвет сайта', 'calories_first'),
        'section' => 'single_page_settings',
//        'default' => 'rgba(0, 0, 0, 0)',
        'choices' => [
            // добавляет возможность выбора прозрачности цвета (добавится слайдер для управления прозрачностью)
            'alpha' => true,
        ],
        'output' => [
            [
                'element' => ':root',
                'property' => '--single_content_color',
            ],
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'single_link_color',
        'label' => __('Link color', 'calories_first'),
        'section' => 'single_page_settings',
//        'default' => 'rgba(0, 0, 0, 0)',
        'choices' => [
            // добавляет возможность выбора прозрачности цвета (добавится слайдер для управления прозрачностью)
            'alpha' => true,
        ],
        'output' => [
            [
                'element' => ':root',
                'property' => '--single_link_color',
            ],
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'single_hover_link_color',
        'label' => __('Hover link color', 'calories_first'),
        'section' => 'single_page_settings',
//        'default' => 'rgba(0, 0, 0, 0)',
        'choices' => [
            // добавляет возможность выбора прозрачности цвета (добавится слайдер для управления прозрачностью)
            'alpha' => true,
        ],
        'output' => [
            [
                'element' => ':root',
                'property' => '--single_hover_link_color',
            ],
        ],
    ]
);

new \Kirki\Field\Radio_Buttonset(
    [
        'settings' => 'single_line_show',
        'label' => esc_html__('Show line', 'calories_first'),
        'description' => esc_html__('It will be shown after description', 'calories_first'),
        'section' => 'single_page_settings',
        'default' => 'yes',
        'priority' => 10,
        'choices' => [
            'none' => esc_html__('No', 'calories_first'),
            'block' => esc_html__('Yes', 'calories_first'),
        ],
        'output' => [
            [
                'element' => ':root',
                'property' => '--single_line_show',
            ],
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'single_line_color',
        'label' => __('Color for line', 'calories_first'),
        'section' => 'single_page_settings',
        'default' => '#ffffff',
        'choices' => [
            // добавляет возможность выбора прозрачности цвета (добавится слайдер для управления прозрачностью)
            'alpha' => true,
        ],
        'output' => [
            [
                'element' => ':root',
                'property' => '--single_line_color',
            ],
        ],
    ]
);

new \Kirki\Field\Checkbox_Toggle(
    [
        'settings' => 'single_show_sidebar',
        'label' => esc_html__('Enable sidebar', 'calories_first'),
        'section' => 'single_page_settings',
        'default' => '1',
        'priority' => 10,
    ]
);

new \Kirki\Field\Multicheck(
    [
        'settings' => 'single_multicheck_sidebar',
        'label' => esc_html__('Choose sidebar to show', 'calories_first'),
        'section' => 'single_page_settings',
        'default' => ['option-1', 'option-2'],
        'priority' => 10,
        'choices' => [
            'option-1' => esc_html__('Sidebar 1', 'calories_first'),
            'option-2' => esc_html__('Sidebar 2', 'calories_first'),
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'single_sidebar_background',
        'label' => __('Background Color', 'calories_first'),
        'description' => esc_html__('Можете переопределить цвета сайдбара, но основные настройки сайдбара находятся в секции "Sidebar settings"', 'calories_first'),
        'section' => 'single_page_settings',
//        'default' => 'rgba(255, 255, 255, 0)',
        'choices' => [
            // добавляет возможность выбора прозрачности цвета (добавится слайдер для управления прозрачностью)
            'alpha' => true,
            /*цвет по дефолту*/
//            'colors' => ['rgba(255, 255, 255, 0)'],
        ],
        'output' => [
            [
                'element' => ':root',
                'property' => '--single_sidebar_background',
            ],
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'single_sidebar_title',
        'label' => __('Title Color', 'calories_first'),
        'description' => esc_html__('Можете переопределить цвета сайдбара, но основные настройки сайдбара находятся в секции "Sidebar settings"', 'calories_first'),
        'section' => 'single_page_settings',
//        'default' => 'rgba(255, 255, 255, 0)',
        'choices' => [
            // добавляет возможность выбора прозрачности цвета (добавится слайдер для управления прозрачностью)
            'alpha' => true,
            /*цвет по дефолту*/
//            'colors' => ['rgba(255, 255, 255, 0)'],
        ],
        'output' => [
            [
                'element' => ':root',
                'property' => '--single_sidebar_title',
            ],
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'single_sidebar_color',
        'label' => __('Link Color', 'calories_first'),
        'description' => esc_html__('Можете переопределить цвета сайдбара, но основные настройки сайдбара находятся в секции "Sidebar settings"', 'calories_first'),
        'section' => 'single_page_settings',
//        'default' => 'rgba(255, 255, 255, 0)',
        'choices' => [
            // добавляет возможность выбора прозрачности цвета (добавится слайдер для управления прозрачностью)
            'alpha' => true,
            /*цвет по дефолту*/
//            'colors' => ['rgba(255, 255, 255, 0)'],
        ],
        'output' => [
            [
                'element' => ':root',
                'property' => '--single_sidebar_color',
            ],
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'single_sidebar_hover',
        'label' => __('Hover Link Color', 'calories_first'),
        'description' => esc_html__('Можете переопределить цвета сайдбара, но основные настройки сайдбара находятся в секции "Sidebar settings"', 'calories_first'),
        'section' => 'single_page_settings',
        'choices' => [
            // добавляет возможность выбора прозрачности цвета (добавится слайдер для управления прозрачностью)
            'alpha' => true,
        ],
        'output' => [
            [
                'element' => ':root',
                'property' => '--single_sidebar_hover',
            ],
        ],
    ]
);

/*sidebars*/

new \Kirki\Section(
    'sidebars_settings',
    [
        'title' => esc_html__('Sidebars Settings', 'calories_first'),
        'panel' => 'theme_settings',
        'priority' => 160,
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'sidebar_first_background',
        'label' => __('Background color for sidebar 1', 'calories_first'),
        'section' => 'sidebars_settings',
        'default' => '#f7f7f7',
        'output' => [
            [
                'element' => ':root',
                'property' => '--sidebar_first_background',
            ],
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'sidebar_first_title_color',
        'label' => __('Title color for sidebar 1', 'calories_first'),
        'section' => 'sidebars_settings',
        'default' => '#ffffff',
        'output' => [
            [
                'element' => ':root',
                'property' => '--sidebar_first_title_color',
            ],
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'sidebar_first_link_color',
        'label' => __('Link color for sidebar 1', 'calories_first'),
        'section' => 'sidebars_settings',
        'default' => '#000000',
        'output' => [
            [
                'element' => ':root',
                'property' => '--sidebar_first_link_color',
            ],
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'sidebar_first_hover_link_color',
        'label' => __('Hover link color for sidebar 1', 'calories_first'),
        'section' => 'sidebars_settings',
        'default' => '#ff00a8',
        'output' => [
            [
                'element' => ':root',
                'property' => '--sidebar_first_hover_link_color',
            ],
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'sidebar_first_border_bottom_color',
        'label' => __('Border bottom color for sidebar 1', 'calories_first'),
        'section' => 'sidebars_settings',
        'default' => '#e0e0e0',
        'output' => [
            [
                'element' => ':root',
                'property' => '--sidebar_first_border_bottom_hover_link_color',
            ],
        ],
    ]
);


new \Kirki\Field\Color(
    [
        'settings' => 'sidebar_second_background',
        'label' => __('Background color for sidebar 2', 'calories_first'),
        'section' => 'sidebars_settings',
        'default' => '#f7f7f7',
        'output' => [
            [
                'element' => ':root',
                'property' => '--sidebar_second_background',
            ],
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'sidebar_second_title_color',
        'label' => __('Title color for sidebar 2', 'calories_first'),
        'section' => 'sidebars_settings',
        'default' => '#ffffff',
        'output' => [
            [
                'element' => ':root',
                'property' => '--sidebar_second_title_color',
            ],
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'sidebar_second_link_color',
        'label' => __('Link color for sidebar 2', 'calories_first'),
        'section' => 'sidebars_settings',
        'default' => '#000000',
        'output' => [
            [
                'element' => ':root',
                'property' => '--sidebar_second_link_color',
            ],
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'sidebar_second_hover_link_color',
        'label' => __('Hover link color for sidebar 2', 'calories_first'),
        'section' => 'sidebars_settings',
        'default' => '#ff00a8',
        'output' => [
            [
                'element' => ':root',
                'property' => '--sidebar_second_hover_link_color',
            ],
        ],
    ]
);

new \Kirki\Field\Color(
    [
        'settings' => 'sidebar_second_dots_color',
        'label' => __('Dots color for sidebar 2', 'calories_first'),
        'section' => 'sidebars_settings',
        'default' => '#000000',
        'output' => [
            [
                'element' => ':root',
                'property' => '--sidebar_second_dots_color',
            ],
        ],
    ]
);

new \Kirki\Field\Radio_Buttonset(
    [
        'settings' => 'sidebar_second_title_align',
        'label' => esc_html__('Align title of sidebar 2', 'calories_first'),
        'section' => 'sidebars_settings',
        'default' => 'left',
        'priority' => 10,
        'choices' => [
            'left' => esc_html__('Left', 'calories_first'),
            'center' => esc_html__('Center', 'calories_first'),
            'right' => esc_html__('Right', 'calories_first'),
        ],
        'output' => [
            [
                'element' => ':root',
                'property' => '--sidebar_second_title_align',
            ],
        ],
    ]
);