<?php
/**
 * Template Name: page-cabinet
 */

get_header();

$current_user = wp_get_current_user();
$user_id = $current_user->ID;

// WP_Query аргументы
$args = array(
    'author' => $user_id,
    'orderby' => 'post_date',
    'order' => 'DESC',
    'posts_per_page' => -1,
    'post_type' => array('post', 'recipe'),
);

// Запрос на получение постов
$the_query = new WP_Query($args);
?>

<main id="primary" class="main-wrapper">

    <?php

    if (isset($_SESSION['user-posts-manage'])) {
        foreach ($_SESSION['user-posts-manage'] as $message_data) {
            $message_class = $message_data['type'] === 'error' ? 'error-message' : 'success-message';
            echo '<div class="success-message manage-users-message">
                <div class="success-message_wrapper">
                    <div class="success-message_color"></div>
                    <div class="success-message_content">
                        <div class="success-message_close">&times;</div>
                        <div class="success-message_text">'
                . esc_html($message_data['message']) .
                '</div>
                    </div>
                </div>
              </div>';
        }
        // Очистка сообщений после отображения
        unset($_SESSION['user-posts-manage']);
    }
    ?>

    <article class="main-article page-cabinet">
        <div class="page-cabinet_loader">
            <span class="loader-cabinet"></span>
        </div>
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
                            <img src="<?php echo get_template_directory_uri() ?>/assets/images/cat-puns-64ef515f6036a.jpg?>"
                                 alt="Avatar">

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
                <div class="page-cabinet_posts manage-posts">
                    <h2 class="manage-posts_title">Управление вашими публикациями</h2>
                    <div class="manage-posts_active user-posts">
                        <h3 class="user-posts_title">Активные публикации</h3>
                        <div class="user-posts_content">
                            <!--сюда выводить посты, которые имеют acf поле posts_is_active true-->
                            <?php

                            if ($the_query->have_posts()) :

                                $has_active_posts = false; // Флаг для отслеживания активных постов

                                while ($the_query->have_posts()) : $the_query->the_post();

                                    $is_active = get_post_type() == 'post' ? get_field('post_is_active') : get_field('recipe_is_active');

                                    if ($is_active) :
                                        $has_active_posts = true;
                                        ?>
                                        <div class="user-posts_card post-of-user">
                                            <a href="<?php the_permalink(); ?>" class="post-of-user_link">
                                                <div class="post-of-user_content">
                                                    <div class="post-of-user_img">
                                                        <?php
                                                        if (get_post_type() == 'post' && has_post_thumbnail()) : ?>
                                                            <img src="<?php the_post_thumbnail_url(); ?>"
                                                                 alt="<?php the_title(); ?>">
                                                        <?php elseif (get_post_type() == 'recipe') :
                                                            $images = get_field('images_of_recepie');
//                                                    var_dump($images);

                                                            if ($images) : ?>
                                                                <img src="<?php echo esc_url($images[0]); ?>"
                                                                     alt="Изображение рецепта">
                                                            <?php else : ?>
                                                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/default_taxonomy.png"
                                                                     alt="Изображение поста пользователя">
                                                            <?php endif;
                                                        endif; ?>
                                                    </div>
                                                    <div class="post-of-user_text">
                                                        <div class="post-of-user_name"><?php the_title(); ?></div>
                                                        <div class="post-of-user_date"><?php echo get_the_date('j F Y'); ?></div>
                                                    </div>
                                                </div>
                                            </a>

                                            <div class="post-of-user_btns">
                                                <div class="post-of-user_btn hide-post"
                                                     data-postid="<?php the_ID(); ?>">
                                                    <svg fill="#000000" width="24px" height="24px"
                                                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                           stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <path d="M12 19c.946 0 1.81-.103 2.598-.281l-1.757-1.757c-.273.021-.55.038-.841.038-5.351 0-7.424-3.846-7.926-5a8.642 8.642 0 0 1 1.508-2.297L4.184 8.305c-1.538 1.667-2.121 3.346-2.132 3.379a.994.994 0 0 0 0 .633C2.073 12.383 4.367 19 12 19zm0-14c-1.837 0-3.346.396-4.604.981L3.707 2.293 2.293 3.707l18 18 1.414-1.414-3.319-3.319c2.614-1.951 3.547-4.615 3.561-4.657a.994.994 0 0 0 0-.633C21.927 11.617 19.633 5 12 5zm4.972 10.558-2.28-2.28c.19-.39.308-.819.308-1.278 0-1.641-1.359-3-3-3-.459 0-.888.118-1.277.309L8.915 7.501A9.26 9.26 0 0 1 12 7c5.351 0 7.424 3.846 7.926 5-.302.692-1.166 2.342-2.954 3.558z"></path>
                                                        </g>
                                                    </svg>
                                                </div>
                                                <div class="post-of-user_btn delete-post"
                                                     data-postid="<?php the_ID(); ?>">
                                                    <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <g id="SVGRepo_bgCarrier"
                                                           stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                           stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <path d="M10 11V17" stroke="#000000" stroke-width="2"
                                                                  stroke-linecap="round"
                                                                  stroke-linejoin="round"></path>
                                                            <path d="M14 11V17" stroke="#000000"
                                                                  stroke-width="2" stroke-linecap="round"
                                                                  stroke-linejoin="round">
                                                            </path>
                                                            <path d="M4 7H20" stroke="#000000" stroke-width="2"
                                                                  stroke-linecap="round" stroke-linejoin="round">
                                                            </path>
                                                            <path d="M6 7H12H18V18C18 19.6569 16.6569 21 15 21H9C7.34315 21 6 19.6569 6 18V7Z"
                                                                  stroke="#000000" stroke-width="2"
                                                                  stroke-linecap="round"
                                                                  stroke-linejoin="round"></path>
                                                            <path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z"
                                                                  stroke="#000000" stroke-width="2"
                                                                  stroke-linecap="round"
                                                                  stroke-linejoin="round"></path>
                                                        </g>
                                                    </svg>
                                                </div>
                                            </div>

                                        </div>
                                    <?php
                                    endif;
                                endwhile;

                                if (!$has_active_posts) : // Проверяем флаг после цикла
                                    echo '
                                    <div class="post-of-user_error">
                        <div>
                            <svg width="131px" height="131px" viewBox="0 0 1024 1024" class="icon" xmlns="http://www.w3.org/2000/svg" fill="#c7c7c7"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M660 103.2l-149.6 76 2.4 1.6-2.4-1.6-157.6-80.8L32 289.6l148.8 85.6v354.4l329.6-175.2 324.8 175.2V375.2L992 284.8z" fill="#ffffffFFFFFF"></path><path d="M180.8 737.6c-1.6 0-3.2 0-4-0.8-2.4-1.6-4-4-4-7.2V379.2L28 296c-2.4-0.8-4-4-4-6.4s1.6-5.6 4-7.2l320.8-191.2c2.4-1.6 5.6-1.6 8 0l154.4 79.2L656 96c2.4-1.6 4.8-0.8 7.2 0l332 181.6c2.4 1.6 4 4 4 7.2s-1.6 5.6-4 7.2l-152.8 88v350.4c0 3.2-1.6 5.6-4 7.2-2.4 1.6-5.6 1.6-8 0l-320-174.4-325.6 173.6c-1.6 0.8-2.4 0.8-4 0.8zM48 289.6L184.8 368c2.4 1.6 4 4 4 7.2v341.6l317.6-169.6c2.4-1.6 5.6-1.6 7.2 0l312.8 169.6V375.2c0-3.2 1.6-5.6 4-7.2L976 284.8 659.2 112.8 520 183.2c0 0.8-0.8 0.8-0.8 1.6-2.4 4-7.2 4.8-11.2 2.4l-1.6-1.6h-0.8l-152.8-78.4L48 289.6z" fill="#ffffff"></path><path d="M510.4 179.2l324.8 196v354.4L510.4 554.4z" fill="#ffffff121519"></path><path d="M510.4 179.2L180.8 375.2v354.4l329.6-175.2z" fill="#ffffff121519"></path><path d="M835.2 737.6c-1.6 0-2.4 0-4-0.8l-324.8-176c-2.4-1.6-4-4-4-7.2V179.2c0-3.2 1.6-5.6 4-7.2 2.4-1.6 5.6-1.6 8 0L839.2 368c2.4 1.6 4 4 4 7.2v355.2c0 3.2-1.6 5.6-4 7.2h-4zM518.4 549.6l308.8 167.2V379.2L518.4 193.6v356z" fill="#ffffff"></path><path d="M180.8 737.6c-1.6 0-3.2 0-4-0.8-2.4-1.6-4-4-4-7.2V375.2c0-3.2 1.6-5.6 4-7.2l329.6-196c2.4-1.6 5.6-1.6 8 0 2.4 1.6 4 4 4 7.2v375.2c0 3.2-1.6 5.6-4 7.2l-329.6 176h-4z m8-358.4v337.6l313.6-167.2V193.6L188.8 379.2z" fill="#ffffff"></path><path d="M510.4 550.4L372 496 180.8 374.4v355.2l329.6 196 324.8-196V374.4L688.8 483.2z" fill="#ffffffD6AB7F"></path><path d="M510.4 933.6c-1.6 0-3.2 0-4-0.8L176.8 736.8c-2.4-1.6-4-4-4-7.2V374.4c0-3.2 1.6-5.6 4-7.2 2.4-1.6 5.6-1.6 8 0L376 488.8l135.2 53.6 174.4-66.4L830.4 368c2.4-1.6 5.6-2.4 8-0.8 2.4 1.6 4 4 4 7.2v355.2c0 3.2-1.6 5.6-4 7.2l-324.8 196s-1.6 0.8-3.2 0.8z m-321.6-208l321.6 191.2 316.8-191.2V390.4L693.6 489.6c-0.8 0.8-1.6 0.8-1.6 0.8l-178.4 68c-1.6 0.8-4 0.8-5.6 0L369.6 504c-0.8 0-0.8-0.8-1.6-0.8L188.8 389.6v336z" fill="#ffffff"></path><path d="M510.4 925.6l324.8-196V374.4L665.6 495.2l-155.2 55.2z" fill="#ffffff121519"></path><path d="M510.4 933.6c-1.6 0-2.4 0-4-0.8-2.4-1.6-4-4-4-7.2V550.4c0-3.2 2.4-6.4 5.6-7.2L662.4 488l168-120c2.4-1.6 5.6-1.6 8-0.8 2.4 1.6 4 4 4 7.2v355.2c0 3.2-1.6 5.6-4 7.2l-324.8 196s-1.6 0.8-3.2 0.8z m8-377.6v355.2l308.8-185.6V390.4L670.4 501.6c-0.8 0.8-1.6 0.8-1.6 0.8l-150.4 53.6z" fill="#ffffff"></path><path d="M252.8 604l257.6 145.6V550.4l-147.2-49.6-182.4-126.4z" fill="#ffffff121519"></path><path d="M32 460l148.8-85.6 329.6 176L352 640.8z" fill="#ffffffFFFFFF"></path><path d="M659.2 693.6l176-90.4V375.2L692 480.8l-179.2 68-2.4 1.6z" fill="#ffffff121519"></path><path d="M510.4 550.4l148.8 85.6L992 464.8l-156.8-89.6z" fill="#ffffffFFFFFF"></path><path d="M352 648.8c-1.6 0-2.4 0-4-0.8l-320-180.8c-2.4-1.6-4-4-4-7.2s1.6-5.6 4-7.2L176.8 368c2.4-1.6 5.6-1.6 8 0l329.6 176c2.4 1.6 4 4 4 7.2s-1.6 5.6-4 7.2L356 648c-0.8 0.8-2.4 0.8-4 0.8zM48 460L352 632l141.6-80.8L180.8 384 48 460z" fill="#ffffff"></path><path d="M659.2 644c-1.6 0-2.4 0-4-0.8L506.4 557.6c-2.4-1.6-4-4-4-7.2s1.6-5.6 4-7.2l324.8-176c2.4-1.6 5.6-1.6 8 0l156.8 90.4c2.4 1.6 4 4 4 7.2s-1.6 5.6-4 7.2L663.2 643.2c-1.6 0.8-2.4 0.8-4 0.8zM527.2 550.4l132.8 76L976 464l-141.6-80-307.2 166.4z" fill="#ffffff"></path></g></svg>
                        </div>
                        <div>
                            Нет активных публикаций.
                        </div>
                    </div>
                                    ';
                                endif;
                            else :
                                echo 'У пользователя нет постов.';
                            endif;
                            wp_reset_postdata();
                            ?>

                        </div>
                    </div>


                    <div class="manage-posts_hidden user-posts">
                        <h3 class="user-posts_title">Скрытые публикации</h3>
                        <div class="user-posts_content">
                            <!--сюда выводить посты, которые имеют acf поле posts_is_active true-->
                            <?php
                            $has_inactive_posts = false; // Флаг для отслеживания неактивных постов

                            if ($the_query->have_posts()) :
                                while ($the_query->have_posts()) : $the_query->the_post();

                                    $is_active = get_post_type() == 'post' ? get_field('post_is_active') : get_field('recipe_is_active');

                                    if (!$is_active) :
                                        $has_inactive_posts = true;
                                        ?>
                                        <div class="user-posts_card post-of-user" id="post-<?php the_ID(); ?>">
                                            <div class="post-of-user_content">
                                                <div class="post-of-user_img">
                                                    <?php
                                                    if (get_post_type() == 'post' && has_post_thumbnail()) : ?>
                                                        <img src="<?php the_post_thumbnail_url(); ?>"
                                                             alt="<?php the_title(); ?>">
                                                    <?php elseif (get_post_type() == 'recipe') :
                                                        $images = get_field('images_of_recepie');
//                                                    var_dump($images);

                                                        if ($images) : ?>
                                                            <img src="<?php echo esc_url($images[0]); ?>"
                                                                 alt="Изображение рецепта">
                                                        <?php else : ?>
                                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/default_taxonomy.png"
                                                                 alt="Изображение поста пользователя">
                                                        <?php endif;
                                                    endif; ?>
                                                </div>
                                                <div class="post-of-user_text">
                                                    <div class="post-of-user_name"><?php the_title(); ?></div>
                                                    <div class="post-of-user_date"><?php echo get_the_date('j F Y'); ?></div>
                                                </div>
                                            </div>
                                            <div class="post-of-user_btns">
                                                <div class="post-of-user_btn activate_post"
                                                     data-postid="<?php the_ID(); ?>">
                                                    <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                                                         stroke="#000000" stroke-width="2.016" stroke-linecap="round"
                                                         stroke-linejoin="miter">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                           stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <path d="M2,12S5,4,12,4s10,8,10,8-2,8-10,8S2,12,2,12Z"></path>
                                                            <circle cx="12" cy="12" r="4"></circle>
                                                        </g>
                                                    </svg>
                                                </div>
                                                <div class="post-of-user_btn delete-post"
                                                     data-postid="<?php the_ID(); ?>">
                                                    <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <g id="SVGRepo_bgCarrier"
                                                           stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                           stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <path d="M10 11V17" stroke="#000000" stroke-width="2"
                                                                  stroke-linecap="round"
                                                                  stroke-linejoin="round"></path>
                                                            <path d="M14 11V17" stroke="#000000"
                                                                  stroke-width="2" stroke-linecap="round"
                                                                  stroke-linejoin="round">
                                                            </path>
                                                            <path d="M4 7H20" stroke="#000000" stroke-width="2"
                                                                  stroke-linecap="round" stroke-linejoin="round">
                                                            </path>
                                                            <path d="M6 7H12H18V18C18 19.6569 16.6569 21 15 21H9C7.34315 21 6 19.6569 6 18V7Z"
                                                                  stroke="#000000" stroke-width="2"
                                                                  stroke-linecap="round"
                                                                  stroke-linejoin="round"></path>
                                                            <path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z"
                                                                  stroke="#000000" stroke-width="2"
                                                                  stroke-linecap="round"
                                                                  stroke-linejoin="round"></path>
                                                        </g>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    endif;
                                endwhile;
                                if (!$has_inactive_posts) : // Проверяем флаг после цикла
                                    echo '
                                    <div class="post-of-user_error">
                        <div>
                            <svg width="131px" height="131px" viewBox="0 0 1024 1024" class="icon" xmlns="http://www.w3.org/2000/svg" fill="#c7c7c7"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M660 103.2l-149.6 76 2.4 1.6-2.4-1.6-157.6-80.8L32 289.6l148.8 85.6v354.4l329.6-175.2 324.8 175.2V375.2L992 284.8z" fill="#ffffffFFFFFF"></path><path d="M180.8 737.6c-1.6 0-3.2 0-4-0.8-2.4-1.6-4-4-4-7.2V379.2L28 296c-2.4-0.8-4-4-4-6.4s1.6-5.6 4-7.2l320.8-191.2c2.4-1.6 5.6-1.6 8 0l154.4 79.2L656 96c2.4-1.6 4.8-0.8 7.2 0l332 181.6c2.4 1.6 4 4 4 7.2s-1.6 5.6-4 7.2l-152.8 88v350.4c0 3.2-1.6 5.6-4 7.2-2.4 1.6-5.6 1.6-8 0l-320-174.4-325.6 173.6c-1.6 0.8-2.4 0.8-4 0.8zM48 289.6L184.8 368c2.4 1.6 4 4 4 7.2v341.6l317.6-169.6c2.4-1.6 5.6-1.6 7.2 0l312.8 169.6V375.2c0-3.2 1.6-5.6 4-7.2L976 284.8 659.2 112.8 520 183.2c0 0.8-0.8 0.8-0.8 1.6-2.4 4-7.2 4.8-11.2 2.4l-1.6-1.6h-0.8l-152.8-78.4L48 289.6z" fill="#ffffff"></path><path d="M510.4 179.2l324.8 196v354.4L510.4 554.4z" fill="#ffffff121519"></path><path d="M510.4 179.2L180.8 375.2v354.4l329.6-175.2z" fill="#ffffff121519"></path><path d="M835.2 737.6c-1.6 0-2.4 0-4-0.8l-324.8-176c-2.4-1.6-4-4-4-7.2V179.2c0-3.2 1.6-5.6 4-7.2 2.4-1.6 5.6-1.6 8 0L839.2 368c2.4 1.6 4 4 4 7.2v355.2c0 3.2-1.6 5.6-4 7.2h-4zM518.4 549.6l308.8 167.2V379.2L518.4 193.6v356z" fill="#ffffff"></path><path d="M180.8 737.6c-1.6 0-3.2 0-4-0.8-2.4-1.6-4-4-4-7.2V375.2c0-3.2 1.6-5.6 4-7.2l329.6-196c2.4-1.6 5.6-1.6 8 0 2.4 1.6 4 4 4 7.2v375.2c0 3.2-1.6 5.6-4 7.2l-329.6 176h-4z m8-358.4v337.6l313.6-167.2V193.6L188.8 379.2z" fill="#ffffff"></path><path d="M510.4 550.4L372 496 180.8 374.4v355.2l329.6 196 324.8-196V374.4L688.8 483.2z" fill="#ffffffD6AB7F"></path><path d="M510.4 933.6c-1.6 0-3.2 0-4-0.8L176.8 736.8c-2.4-1.6-4-4-4-7.2V374.4c0-3.2 1.6-5.6 4-7.2 2.4-1.6 5.6-1.6 8 0L376 488.8l135.2 53.6 174.4-66.4L830.4 368c2.4-1.6 5.6-2.4 8-0.8 2.4 1.6 4 4 4 7.2v355.2c0 3.2-1.6 5.6-4 7.2l-324.8 196s-1.6 0.8-3.2 0.8z m-321.6-208l321.6 191.2 316.8-191.2V390.4L693.6 489.6c-0.8 0.8-1.6 0.8-1.6 0.8l-178.4 68c-1.6 0.8-4 0.8-5.6 0L369.6 504c-0.8 0-0.8-0.8-1.6-0.8L188.8 389.6v336z" fill="#ffffff"></path><path d="M510.4 925.6l324.8-196V374.4L665.6 495.2l-155.2 55.2z" fill="#ffffff121519"></path><path d="M510.4 933.6c-1.6 0-2.4 0-4-0.8-2.4-1.6-4-4-4-7.2V550.4c0-3.2 2.4-6.4 5.6-7.2L662.4 488l168-120c2.4-1.6 5.6-1.6 8-0.8 2.4 1.6 4 4 4 7.2v355.2c0 3.2-1.6 5.6-4 7.2l-324.8 196s-1.6 0.8-3.2 0.8z m8-377.6v355.2l308.8-185.6V390.4L670.4 501.6c-0.8 0.8-1.6 0.8-1.6 0.8l-150.4 53.6z" fill="#ffffff"></path><path d="M252.8 604l257.6 145.6V550.4l-147.2-49.6-182.4-126.4z" fill="#ffffff121519"></path><path d="M32 460l148.8-85.6 329.6 176L352 640.8z" fill="#ffffffFFFFFF"></path><path d="M659.2 693.6l176-90.4V375.2L692 480.8l-179.2 68-2.4 1.6z" fill="#ffffff121519"></path><path d="M510.4 550.4l148.8 85.6L992 464.8l-156.8-89.6z" fill="#ffffffFFFFFF"></path><path d="M352 648.8c-1.6 0-2.4 0-4-0.8l-320-180.8c-2.4-1.6-4-4-4-7.2s1.6-5.6 4-7.2L176.8 368c2.4-1.6 5.6-1.6 8 0l329.6 176c2.4 1.6 4 4 4 7.2s-1.6 5.6-4 7.2L356 648c-0.8 0.8-2.4 0.8-4 0.8zM48 460L352 632l141.6-80.8L180.8 384 48 460z" fill="#ffffff"></path><path d="M659.2 644c-1.6 0-2.4 0-4-0.8L506.4 557.6c-2.4-1.6-4-4-4-7.2s1.6-5.6 4-7.2l324.8-176c2.4-1.6 5.6-1.6 8 0l156.8 90.4c2.4 1.6 4 4 4 7.2s-1.6 5.6-4 7.2L663.2 643.2c-1.6 0.8-2.4 0.8-4 0.8zM527.2 550.4l132.8 76L976 464l-141.6-80-307.2 166.4z" fill="#ffffff"></path></g></svg>
                        </div>
                        <div>
                            Нет скрытых публикаций.
                        </div>
                    </div>
                                    ';
                                endif;
                            else :
                                echo 'У пользователя нет постов.';
                            endif;
                            wp_reset_postdata();
                            ?>

                        </div>


                    </div>

                </div>
            </div>
        </section>
    </article>

</main>
<?php
get_footer();
?>
