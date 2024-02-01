<?php
/**
 * Template Name: page-send-mail-again
 */
if ('POST' == $_SERVER['REQUEST_METHOD'] && !empty($_POST['action']) && $_POST['action'] == 'send-mail-again') {
    $retrieved_nonce = $_REQUEST['_wpnonce'];
    if (!wp_verify_nonce($retrieved_nonce, 'send-mail-again')) {
        die('Failed security check');
    }

    $user_email = sanitize_email($_POST['email_send']);
    $send_errors = array();

    // Проверка корректности электронной почты
    if (!is_email($user_email)) {
        $send_errors['email_send'] = 'Указан некорректный электронный адрес.';
    }

    // Попытка найти пользователя по email
    $user = get_user_by('email', $user_email);
    if (!$user) {
        $send_errors['email_send'] = 'Пользователь с таким электронным адресом не найден.';
    } else {
        $user_id = $user->ID;
        // Проверка, не активирован ли уже аккаунт
        $has_activated = get_user_meta($user_id, 'has_activated', true);
        if ($has_activated == 'true') {
            $send_errors['email_send'] = 'Аккаунт уже активирован.';
        }
    }

    if (empty($send_errors)) {
        // Генерируем новый ключ активации и отправляем письмо
        $activation_key = sha1(mt_rand(10000, 99999) . time() . $user_email);
        update_user_meta($user_id, 'activation_key', $activation_key);
        update_user_meta($user_id, 'has_activated', 'false');

        $activation_link = add_query_arg(array('key' => $activation_key, 'user' => $user_id), get_permalink('1105'));
        $message = 'Пожалуйста, активируйте вашу учетную запись, перейдя по следующей ссылке: ' . $activation_link;
        $headers = array(
            'From: Calories365 <c63039000@gmail.com>',
            'content-type: text/html',
        );

        wp_mail($user_email, 'Активация учетной записи', $message, $headers);

        $send_mail_again_url = home_url('/send-mail-again');

        $_SESSION['registration_confirm'] = '
                 На вашу почту отправлено письмо для подтверждения почты. <br>
                 Важно!! Письмо может попасть в спам. <br>
                 <a href="' . $send_mail_again_url . '">Получить письмо еще раз!</a>
            ';

        wp_redirect(home_url('/'));
        exit;
    } else {
        // Сохраняем ошибки в сессии для отображения
        $_SESSION['send_errors'] = $send_errors;
        wp_redirect(home_url('/send-mail-again'));
        exit;
    }
}

get_header();
?>

<main id="primary" class="page-auth-wrapper">
    <article class="main-article auth-page">
        <section class="auth-page_section">
            <div class="auth-page_container">
                <div class="auth-page_box">
                    <div class="auth-page_card">
                        <div class="auth-page_message error-auth-notify auth-notify">
                            <?php
                            // Отображение ошибок валидации, если они есть в сессии
                            if (isset($_SESSION['send_errors'])) {
                                foreach ($_SESSION['send_errors'] as $error_key => $error_value) {
                                    echo ' <div class="auth-notify_box">
                                <div class="auth-notify_color"></div>
                                <div class="auth-notify_message">' . esc_html($error_value) . '</div>
                                           </div>';
                                }
                                // Очистка ошибок после отображения
                                unset($_SESSION['send_errors']);
                            }
                            ?>
                        </div>
                        <div class="auth-page_content">
                            <form id="send-mail-again-form" class="auth-page_form" method="post">
                                <?php wp_nonce_field('send-mail-again'); ?>
                                <input type="hidden" name="action" value="send-mail-again">
                                <h3 class="auth-page_title">Получить письмо активации аккаунта</h3>
                                <input type="email" name="email_send" id="email_send" class="auth-page_input"
                                       placeholder="Email" size="25">
                                <button type="submit" name="btnSend" id="btnSend" class="auth-page_btn">Получить</button>
                            </form>
                        </div>
                    </div>
                </div>
        </section>
    </article>

</main>


<?php
     get_footer();
 ?>

