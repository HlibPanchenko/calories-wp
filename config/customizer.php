<?php
    
    new \Kirki\Panel(
        'theme_settings',
        [
        'priority'    => 10,
            'title'       => esc_html__( 'Настройки темы', 'calories_first' ),
            'description' => esc_html__( 'Описание панели настроек темы', 'calories_first' ),
        ]
    );

    new \Kirki\Section(
        'global_settings',
        [
        'title'       => esc_html__('Глобальные настройки', 'calories_first'),
        'description' => esc_html__('Описание глобальных настроек', 'calories_first'),
        'panel'       => 'theme_settings',
        'priority'    => 160,
        ]
    );
    /*в опциях указываем секцию*/
    new \Kirki\Field\Color(
        [
    // Уникальный идентификатор для этой опции
        'settings'    => 'theme_main_color',
        'label'       => __('Главный цвет сайта', 'calories_first'),
        'section'     => 'global_settings',
        'default'     => '#73ae37',
    // предоставления дополнительных настроек опции
        'choices'     => [
   // добавляет возможность выбора прозрачности цвета (добавится слайдер для управления прозрачностью)
            'alpha' => true,
            /*цвет по дефолту*/
            'colors' => ['#73ae37'],
        ],
  // куда должны выводиться значения выбранных опций
        'output'   => [
            [
                /*Определяет CSS-селектор, к которому будут применяться стили*/
                'element'  => ':root',
                // Определяет CSS-свойство, которое будет изменяться в зависимости от выбора пользователя
                'property' => '--theme-main-color',
            ],
        ]
        ]
    );

new \Kirki\Field\Typography(
    [
        'settings'    => 'theme_global_font',
        'label'       => esc_html__( 'Шрифт для всего сайта', 'kirki' ),
//        'description' => esc_html__( 'Описание настроек для заголовка слайдера', 'kirki' ),
        'section'     => 'global_settings',
        'priority'    => 10,
        'transport'   => 'auto',
        'default'     => [
            'font-family'     => 'Roboto',
        ],
        'choices' => [
            'fonts' => [
                'google' => [ 'Roboto', 'Open Sans', 'Lato', 'Noto Serif', 'Noto Sans' ],
            ],
        ],
        'output'      => [
            [
                'element' => 'body',
                'property' => 'font-family',
            ],
        ],
    ]
);


new \Kirki\Section(
    'swiper_settings',
    [
        'title'       => esc_html__('Swiper settings', 'calories_first'),
        'description' => esc_html__('Описание настроек для слайдера', 'calories_first'),
        'panel'       => 'theme_settings',
        'priority'    => 160,
    ]
);

new \Kirki\Field\Typography(
    [
        'settings'    => 'title_in_swiper',
        'label'       => esc_html__( 'Заголовок в слайдере', 'kirki' ),
        'description' => esc_html__( 'Описание настроек для заголовка слайдера', 'kirki' ),
        'section'     => 'swiper_settings',
        'priority'    => 10,
        'transport'   => 'auto',
        'default'     => [
            'font-family'     => 'Roboto',
            'variant'         => '700',
            'font-style'      => 'normal',
//            'color'           => '#333333',
            'font-size'       => '64px',
            'line-height'     => '1',
            'letter-spacing'  => '0',
            'text-transform'  => 'uppercase',
            'text-decoration' => 'none',
            'text-align'      => 'left',
        ],
        'choices' => [
            'fonts' => [
                'google' => [ 'Roboto', 'Open Sans', 'Lato', 'Noto Serif', 'Noto Sans' ],
            ],
        ],
        'output'      => [
            [
                'element' => '.card-in-slider_title',
            ],
        ],
    ]
);


    new \Kirki\Field\Textarea(
        [
        'settings' => 'theme_fonts_link',
        'label'    => esc_html__('Fonts Link', 'kirki'),
        'section'  => 'global_settings',
        'default'  => 'https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;700&display=swap',
        'priority' => 10,
        ]
    );

    new \Kirki\Field\Text(
        [
        'settings' => 'theme_fonts_heading',
        'label'    => esc_html__('Heading Font', 'kirki'),
        'section'  => 'global_settings',
        'default'  => esc_html__("Nunito", 'kirki'),
        'priority' => 10,
        'output'   => [
            [
                'element'  => ':root',
                'property' => '--font-heading-family',
            ],
        ],
        ]
    );

    new \Kirki\Field\Text(
        [
        'settings' => 'theme_fonts_content',
        'label'    => esc_html__('Content Font', 'kirki'),
        'section'  => 'global_settings',
        'default'  => esc_html__("Nunito", 'kirki'),
        'priority' => 10,
        'output'   => [
            [
                'element'  => ':root',
                'property' => '--font-content-family',
            ],
        ],
        ]
    );

    new \Kirki\Section(
        'header_settings',
        [
        'title'       => esc_html__('Header Settings', 'kirki'),
        'description' => esc_html__('My Section Description.', 'kirki'),
        'panel'       => 'theme_settings',
        'priority'    => 160,
        ]
    );

    new \Kirki\Field\Color(
        [
        'settings'    => 'header_background_color',
        'label'       => __('Background Color', 'kirki'),
        'section'     => 'header_settings',
        'default'     => '#171717',
        'output'   => [
            [
                'element'  => ':root',
                'property' => '--header-bg-color',
            ],
        ],
        ]
    );

    new \Kirki\Field\Color(
        [
        'settings'    => 'header_submenu_background_color',
        'label'       => __('Submenu Background Color', 'kirki'),
        'section'     => 'header_settings',
        'default'     => '#303030',
        'output'   => [
            [
                'element'  => ':root',
                'property' => '--header-submenu-bg-color',
            ],
        ],
        ]
    );

    new \Kirki\Field\Color(
        [
        'settings'    => 'header_link_color',
        'label'       => __('Link Color', 'kirki'),
        'section'     => 'header_settings',
        'default'     => '#ffffff',
        'output'   => [
            [
                'element'  => ':root',
                'property' => '--header-link-color',
            ],
        ],
        ]
    );

    new \Kirki\Field\Color(
        [
        'settings'    => 'header_link_active_color',
        'label'       => __('Link Active Color', 'kirki'),
        'section'     => 'header_settings',
        'default'     => '#E20F0F',
        'output'   => [
            [
                'element'  => ':root',
                'property' => '--header-link-active-color',
            ],
        ],
        ]
    );

    new \Kirki\Field\Checkbox_Toggle(
        [
        'settings'    => 'float_header_enable',
        'label'       => esc_html__('Enable Float Header', 'kirki'),
        'section'     => 'header_settings',
        'default'     => '0',
        'priority'    => 10,
        ]
    );

    new \Kirki\Section(
        'content_settings',
        [
        'title'       => esc_html__('Content Settings', 'kirki'),
        'description' => esc_html__('My Section Description.', 'kirki'),
        'panel'       => 'theme_settings',
        'priority'    => 160,
        ]
    );

    new \Kirki\Field\Color(
        [
        'settings'    => 'content_background_color',
        'label'       => __('Background Color', 'kirki'),
        'section'     => 'content_settings',
        'default'     => '#171717',
        'output'   => [
            [
                'element'  => ':root',
                'property' => '--content-bg-color',
            ],
        ],
        ]
    );

    new \Kirki\Field\Color(
        [
        'settings'    => 'content_heading_color',
        'label'       => __('Heading Color', 'kirki'),
        'section'     => 'content_settings',
        'default'     => '#ffffff',
        'output'   => [
            [
                'element'  => ':root',
                'property' => '--content-heading-color',
            ],
        ],
        ]
    );

    new \Kirki\Field\Color(
        [
        'settings'    => 'content_text_color',
        'label'       => __('Text Color', 'kirki'),
        'section'     => 'content_settings',
        'default'     => '#ffffff',
        'output'   => [
            [
                'element'  => ':root',
                'property' => '--content-text-color',
            ],
        ],
        ]
    );

    new \Kirki\Field\Color(
        [
        'settings'    => 'content_link_color',
        'label'       => __('Link Color', 'kirki'),
        'section'     => 'content_settings',
        'default'     => '#E20F0F',
        'output'   => [
            [
                'element'  => ':root',
                'property' => '--content-link-color',
            ],
        ],
        ]
    );

    new \Kirki\Section(
        'archive_settings',
        [
        'title'       => esc_html__('Archive Settings', 'kirki'),
        'description' => esc_html__('My Section Description.', 'kirki'),
        'panel'       => 'theme_settings',
        'priority'    => 160,
        ]
    );

    new \Kirki\Field\Image(
        [
        'settings'    => 'archive_background_image',
        'label'       => esc_html__('Background Image', 'kirki'),
        'section'     => 'archive_settings',
        'default'     => '',
        'choices'     => [
            'save_as' => 'id',
        ],
        ]
    );

    new \Kirki\Section(
        'footer_settings',
        [
        'title'       => esc_html__('Footer Settings', 'kirki'),
        'description' => esc_html__('My Section Description.', 'kirki'),
        'panel'       => 'theme_settings',
        'priority'    => 160,
        ]
    );

    new \Kirki\Field\Color(
        [
        'settings'    => 'footer_background_color',
        'label'       => __('Background Color', 'kirki'),
        'section'     => 'footer_settings',
        'default'     => '#141414',
        'output'   => [
            [
                'element'  => ':root',
                'property' => '--footer-bg-color',
            ],
        ],
        ]
    );

    new \Kirki\Field\Color(
        [
        'settings'    => 'footer_text_color',
        'label'       => __('Text Color', 'kirki'),
        'section'     => 'footer_settings',
        'default'     => '#ffffff',
        'output'   => [
            [
                'element'  => ':root',
                'property' => '--footer-text-color',
            ],
        ],
        ]
    );

    new \Kirki\Field\Color(
        [
        'settings'    => 'footer_link_color',
        'label'       => __('Link Color', 'kirki'),
        'section'     => 'footer_settings',
        'default'     => '#ffffff',
        'output'   => [
            [
                'element'  => ':root',
                'property' => '--footer-link-color',
            ],
        ],
        ]
    );

    new \Kirki\Field\Color(
        [
        'settings'    => 'footer_link_active_color',
        'label'       => __('Active Link Color', 'kirki'),
        'section'     => 'footer_settings',
        'default'     => '#E20F0F',
        'output'   => [
            [
                'element'  => ':root',
                'property' => '--footer-link-active-color',
            ],
        ],
        ]
    );

    new \Kirki\Section(
        'contacts_settings',
        [
        'title'       => esc_html__('Contacts Settings', 'kirki'),
        'description' => esc_html__('My Section Description.', 'kirki'),
        'panel'       => 'theme_settings',
        'priority'    => 160,
        ]
    );

    new \Kirki\Field\Checkbox_Toggle(
        [
        'settings'    => 'contacts_phone_enable',
        'label'       => esc_html__('Enable Phone Number', 'kirki'),
        'section'     => 'contacts_settings',
        'default'     => '0',
        'priority'    => 10,
        ]
    );

    new \Kirki\Field\Text(
        [
        'settings' => 'contacts_phone',
        'label'    => esc_html__('Phone Number', 'kirki'),
        'section'  => 'contacts_settings',
        'default'  => esc_html__('', 'kirki'),
        'priority' => 10,
        ]
    );

    new \Kirki\Field\Checkbox_Toggle(
        [
        'settings'    => 'contacts_telegram_enable',
        'label'       => esc_html__('Enable Telegram', 'kirki'),
        'section'     => 'contacts_settings',
        'default'     => '0',
        'priority'    => 10,
        ]
    );

    new \Kirki\Field\URL(
        [
        'settings' => 'contacts_telegram',
        'label'    => esc_html__('Telegram Link', 'kirki'),
        'section'  => 'contacts_settings',
        'default'  => 'https://t.me/',
        'priority' => 10,
        ]
    );

    new \Kirki\Field\Checkbox_Toggle(
        [
        'settings'    => 'contacts_whatsapp_enable',
        'label'       => esc_html__('Enable WhatsApp', 'kirki'),
        'section'     => 'contacts_settings',
        'default'     => '0',
        'priority'    => 10,
        ]
    );

    new \Kirki\Field\URL(
        [
        'settings' => 'contacts_whatsapp',
        'label'    => esc_html__('WhatsApp Link', 'kirki'),
        'section'  => 'contacts_settings',
        'default'  => 'https://wa.me/',
        'priority' => 10,
        ]
    );

    new \Kirki\Section(
        'posts_settings',
        [
        'title'       => esc_html__('Posts Settings', 'kirki'),
        'description' => esc_html__('My Section Description.', 'kirki'),
        'panel'       => 'theme_settings',
        'priority'    => 160,
        ]
    );

    new \Kirki\Field\Color(
        [
        'settings'    => 'posts_related_card_bg_color',
        'label'       => __('Related Card Background', 'kirki'),
        'section'     => 'posts_settings',
        'default'     => '#303030',
        'output'   => [
            [
                'element'  => ':root',
                'property' => '--posts-related-card-bg-color',
            ],
        ],
        ]
    );

    new \Kirki\Field\Color(
        [
        'settings'    => 'posts_related_card_link_color',
        'label'       => __('Related Card Link Color', 'kirki'),
        'section'     => 'posts_settings',
        'default'     => '#ffffff',
        'output'   => [
            [
                'element'  => ':root',
                'property' => '--posts-related-card-link-color',
            ],
        ],
        ]
    );

    new \Kirki\Field\Color(
        [
        'settings'    => 'verify_block_background_color',
        'label'       => __('Verify Block Background Color', 'kirki'),
        'section'     => 'posts_settings',
        'default'     => '#1fb425',
        'output'   => [
            [
                'element'  => ':root',
                'property' => '--verify-block-background-color',
            ],
        ],
        ]
    );

    new \Kirki\Field\Color(
        [
        'settings'    => 'video_block_background_color',
        'label'       => __('Video Block Background Color', 'kirki'),
        'section'     => 'posts_settings',
        'default'     => '#1472c9',
        'output'   => [
            [
                'element'  => ':root',
                'property' => '--video-block-background-color',
            ],
        ],
        ]
    );

    new \Kirki\Section(
        'models_settings',
        [
        'title'       => esc_html__('Models Settings', 'kirki'),
        'description' => esc_html__('My Section Description.', 'kirki'),
        'panel'       => 'theme_settings',
        'priority'    => 160,
        ]
    );

    new \Kirki\Field\Color(
        [
        'settings'    => 'model_page_block_bg_color',
        'label'       => __('Blocks Background', 'kirki'),
        'section'     => 'models_settings',
        'default'     => '#000000',
        'output'   => [
            [
                'element'  => ':root',
                'property' => '--model-page-block-bg-color',
            ],
        ],
        ]
    );

    new \Kirki\Field\Color(
        [
        'settings'    => 'model_page_text_color',
        'label'       => __('Text Color', 'kirki'),
        'section'     => 'models_settings',
        'default'     => '#ffffff',
        'output'   => [
            [
                'element'  => ':root',
                'property' => '--model-page-text-color',
            ],
        ],
        ]
    );

    new \Kirki\Field\Color(
        [
        'settings'    => 'model_page_link_color',
        'label'       => __('Link Color', 'kirki'),
        'section'     => 'models_settings',
        'default'     => '#ffffff',
        'output'   => [
            [
                'element'  => ':root',
                'property' => '--model-page-link-color',
            ],
        ],
        ]
    );

    new \Kirki\Field\Color(
        [
        'settings'    => 'model_page_link_active_color',
        'label'       => __('Link Active Color', 'kirki'),
        'section'     => 'models_settings',
        'default'     => '#e20f0f',
        'output'   => [
            [
                'element'  => ':root',
                'property' => '--model-page-link-active-color',
            ],
        ],
        ]
    );

    new \Kirki\Field\Textarea(
        [
        'settings' => 'models_alt_spin_text',
        'label'    => esc_html__('Photos Alt Spintax Text', 'kirki'),
        'section'  => 'models_settings',
        'default'  => esc_html__('', 'kirki'),
        'priority' => 10,
        ]
    );
    
    new \Kirki\Field\Sortable(
        [
            'settings' => 'single_model_setting',
            'label'    => __('Sort The Blocks', 'kirki'),
            'section'  => 'models_settings',
            'default'  => [ 'Name', 'Contacts', 'Location', 'Age', 'Bust', 'Price', 'About', 'Services', 'Tags' ],
            'priority' => 10,
            'choices'  => [
                'Name' => esc_html__('Name', 'kirki'),
                'Contacts' => esc_html__('Contacts', 'kirki'),
                'Location' => esc_html__('Location', 'kirki'),
                'Age' => esc_html__('Age-Height-Weight', 'kirki'),
                'Bust' => esc_html__('Hair-Bust', 'kirki'),
                'Price' => esc_html__('Price', 'kirki'),
                'About' => esc_html__('About', 'kirki'),
                'Services' => esc_html__('Services', 'kirki'),
                'Tags' => esc_html__('Tags', 'kirki'),
            ],
        ]
    );

    new \Kirki\Section(
        'popup_settings',
        [
        'title'       => esc_html__('Popup Settings', 'kirki'),
        'description' => esc_html__('My Section Description.', 'kirki'),
        'panel'       => 'theme_settings',
        'priority'    => 160,
        ]
    );

    new \Kirki\Field\Checkbox_Toggle(
        [
        'settings'    => 'popup_enable',
        'label'       => esc_html__('Enable Popup', 'kirki'),
        'section'     => 'popup_settings',
        'default'     => '0',
        'priority'    => 10,
        ]
    );

    new \Kirki\Field\Number(
        [
        'settings' => 'popup_delay',
        'label'    => esc_html__('Delay', 'kirki'),
        'section'  => 'popup_settings',
        'default'  => 10,
        'choices'  => [
            'min'  => 0,
            'max'  => 300,
            'step' => 1,
        ],
        'active_callback' => [
            [
                'setting'  => 'popup_enable',
                'operator' => '==',
                'value'    => true,
            ]
        ],
        ]
    );

    new \Kirki\Field\Text(
        [
        'settings' => 'popup_text',
        'label'    => esc_html__('Text', 'kirki'),
        'section'  => 'popup_settings',
        'default'  => esc_html__('', 'kirki'),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'popup_enable',
                'operator' => '==',
                'value'    => true,
            ]
        ],
        ]
    );

    new \Kirki\Field\Text(
        [
        'settings' => 'popup_button_text',
        'label'    => esc_html__('Button Text', 'kirki'),
        'section'  => 'popup_settings',
        'default'  => esc_html__('', 'kirki'),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'popup_enable',
                'operator' => '==',
                'value'    => true,
            ]
        ],
        ]
    );

    new \Kirki\Field\URL(
        [
        'settings' => 'popup_button_link',
        'label'    => esc_html__('Button Link', 'kirki'),
        'section'  => 'popup_settings',
        'default'  => 'https://',
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'popup_enable',
                'operator' => '==',
                'value'    => true,
            ]
        ],
        ]
    );

    new \Kirki\Field\Color(
        [
        'settings'    => 'popup_text_color',
        'label'       => __('Text Color', 'kirki'),
        'section'     => 'popup_settings',
        'default'     => '#FFFFFF',
        'active_callback' => [
            [
                'setting'  => 'popup_enable',
                'operator' => '==',
                'value'    => true,
            ]
        ],
        'output'   => [
            [
                'element'  => ':root',
                'property' => '--popup-text-color',
            ],
        ],
        ]
    );

    new \Kirki\Field\Color(
        [
        'settings'    => 'popup_background_color',
        'label'       => __('Background Color', 'kirki'),
        'section'     => 'popup_settings',
        'default'     => '#171717',
        'active_callback' => [
            [
                'setting'  => 'popup_enable',
                'operator' => '==',
                'value'    => true,
            ]
        ],
        'output'   => [
            [
                'element'  => ':root',
                'property' => '--popup-bg-color',
            ],
        ],
        ]
    );

    new \Kirki\Section(
        'float_button_settings',
        [
        'title'       => esc_html__('Float Button Settings', 'kirki'),
        'description' => esc_html__('My Section Description.', 'kirki'),
        'panel'       => 'theme_settings',
        'priority'    => 160,
        ]
    );

    new \Kirki\Field\Checkbox_Toggle(
        [
        'settings'    => 'float_button_enable',
        'label'       => esc_html__('Enable Float Button', 'kirki'),
        'section'     => 'float_button_settings',
        'default'     => '0',
        'priority'    => 10,
        ]
    );

    new \Kirki\Field\URL(
        [
        'settings' => 'float_button_link',
        'label'    => esc_html__('Button Link', 'kirki'),
        'section'  => 'float_button_settings',
        'default'  => 'https://wa.me/',
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'float_button_enable',
                'operator' => '==',
                'value'    => true,
            ]
        ],
        ]
    );

    new \Kirki\Field\Radio_Buttonset(
        [
        'settings'    => 'float_button_align',
        'label'       => esc_html__('Align Float Button', 'kirki'),
        'section'     => 'float_button_settings',
        'default'     => 'right',
        'priority'    => 10,
        'choices'     => [
            'left'   => esc_html__('Left', 'kirki'),
            'right' => esc_html__('Right', 'kirki'),
        ],
        ]
    );

    new \Kirki\Field\Checkbox_Toggle(
        [
        'settings'    => 'float_button_to_top_enable',
        'label'       => esc_html__('Enable Float Button Back Top', 'kirki'),
        'section'     => 'float_button_settings',
        'default'     => '1',
        'priority'    => 10,
        ]
    );

    new \Kirki\Field\Radio_Buttonset(
        [
        'settings'    => 'float_button_to_top_align',
        'label'       => esc_html__('Align Float Button To Top', 'kirki'),
        'section'     => 'float_button_settings',
        'default'     => 'left',
        'priority'    => 10,
        'choices'     => [
            'left'   => esc_html__('Left', 'kirki'),
            'right' => esc_html__('Right', 'kirki'),
        ],
        ]
    );
    
    
    new \Kirki\Section(
        'currency_settings',
        [
            'title'       => esc_html__('Currency Settings', 'kirki'),
            'description' => esc_html__('Currency Section Settings.', 'kirki'),
            'panel'       => 'theme_settings',
            'priority'    => 160,
        ]
    );
    
    new \Kirki\Field\Checkbox_Toggle(
        [
            'settings'    => 'currency_enable',
            'label'       => esc_html__('Enable Currency List', 'kirki'),
            'section'     => 'currency_settings',
            'default'     => '0',
            'priority'    => 10,
        ]
    );
