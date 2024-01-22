<?php
/**
 * Template Name: page-cabinet
 */

get_header();

$current_user = wp_get_current_user();

?>

<main id="primary" class="main-wrapper">
    <article class="main-article page-cabinet">
        <section class=page-cabinet_section">
            <div class="page-cabinet_container">
                <div class="page-cabinet_header">

                    <div class="layout-posts_breadcrumbs page-cabinet_breadcrumbs">
                        <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
                    </div>

                    <h1 class="page-cabinet_title">
                        Личный кабинет
                    </h1>

                </div>
                <div class="page-cabinet_content">
                    <div class="page-cabinet_top top-info">
                        <div class="top-info_avatar">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/images/cat-puns-64ef515f6036a.jpg?>" alt="Avatar">

                        </div>
                        <div class="top-info_name">
                            <?php echo esc_html($current_user->user_login) ?>
<!--                            --><?php //echo 'Логин пользователя: ' . '<span>' . esc_html($current_user->user_login) . '</span>' ?>
                        </div>
                    </div>
                    <div class="page-cabinet_mid mid-info">
                        <div class="mid-info_login">
                            <div class="mid-info_text">Логин:</div>
                            <div class="mid-info_credentials"><?php echo esc_html($current_user->user_login) ?></div>
                        </div>
                        <div class="mid-info_email">
                            <div class="mid-info_text">Почта:</div>
                            <div class="mid-info_credentials"><?php echo esc_html($current_user->user_email) ?></div>
                        </div>

                    </div>
                    <div class="page-cabinet_bottom">
                    </div>
                </div>
                <div class="page-cabinet_btn">
                    <?php if (is_user_logged_in()): ?>
                        <!-- Пользователь авторизован, показываем кнопку выхода -->
                        <a href="<?php echo esc_url(wp_logout_url(home_url())); ?>" class="main-header_signout">
                            <div>Выйти</div>
                        </a>
                    <?php endif; ?>

                </div>
            </div>
        </section>
    </article>

</main>
<?php
get_footer();
?>
