<?php
/**
 * Template Name: page-cabinet
 */

get_header();
?>

<main id="primary" class="main-wrapper">
    <article class="main-article auth-page">
        <section class="auth-page_section">
            <div class="auth-page_container">

                <?php
                $current_user = wp_get_current_user();
                if ($current_user instanceof WP_User) {
                    echo '<div class="current-user-info">';
                    echo 'Имя пользователя: ' . esc_html($current_user->user_login) . '<br>';
                    echo 'E-mail: ' . esc_html($current_user->user_email) . '<br>';
                    echo 'ID пользователя: ' . esc_html($current_user->ID) . '<br>';
                    echo '</div>';
                }
                ?>

                <?php if (is_user_logged_in()): ?>
                    <!-- Пользователь авторизован, показываем кнопку выхода -->
                    <a href="<?php echo esc_url(wp_logout_url(home_url())); ?>" class="main-header_signout">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#ffffff" width="20px" height="20px"
                             viewBox="0 0 24 24" stroke="#ffffff">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"></path>
                            </g>
                        </svg>
                        <div>Выход</div>
                    </a>
                <?php endif; ?>

            </div>
        </section>
    </article>

</main>


<?php
get_footer();
?>
