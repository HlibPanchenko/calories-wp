<div class="burger-menu_wrapper">
    <div class="burger-menu_container">
        <?php
        get_sidebar('burger');
        ?>
        <div class="burger-menu_user">
            <?php if (is_user_logged_in()): ?>
                <a href="<?php echo esc_url(home_url('/page-cabinet')); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#ffffff" width="25px" height="25px"
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
                        <div>
                            <?php
                            echo $btnText;
                            ?>
                        </div>
                    </div>
                </a>
                <a href="<?php echo esc_url(wp_logout_url(home_url())); ?>">
                    <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none"
                         xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0">

                        </g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier"> <g id="Interface / Log_Out">
                                <path id="Vector"
                                      d="M12 15L15 12M15 12L12 9M15 12H4M9 7.24859V7.2002C9 6.08009 9 5.51962 9.21799 5.0918C9.40973 4.71547 9.71547 4.40973 10.0918 4.21799C10.5196 4 11.0801 4 12.2002 4H16.8002C17.9203 4 18.4796 4 18.9074 4.21799C19.2837 4.40973 19.5905 4.71547 19.7822 5.0918C20 5.5192 20 6.07899 20 7.19691V16.8036C20 17.9215 20 18.4805 19.7822 18.9079C19.5905 19.2842 19.2837 19.5905 18.9074 19.7822C18.48 20 17.921 20 16.8031 20H12.1969C11.079 20 10.5192 20 10.0918 19.7822C9.71547 19.5905 9.40973 19.2839 9.21799 18.9076C9 18.4798 9 17.9201 9 16.8V16.75" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                            </g> </g>
                    </svg>
                    <div>
                        <div>
                            Выйти с аккаунта
                        </div>
                    </div>
                </a>

            <?php endif; ?>
            <?php if (!is_user_logged_in()): ?>
                <a href="<?php echo esc_url(home_url('/auth')); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#ffffff" width="25px" height="25px"
                         viewBox="0 0 24 24" stroke="#ffffff">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"></path>
                        </g>
                    </svg>
                    <div>Войти в аккаунт</div>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="burger-submenu_wrapper">
    <div class="burger-submenu_container">
        <div class="burger-submenu_header">
            <div class="burger-submenu_arrow">
            </div>
        </div>
        <div class="burger-submenu_menu">

        </div>
    </div>
</div>



