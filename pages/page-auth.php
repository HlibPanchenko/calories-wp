<?php
/**
 * Template Name: auth
 */
/*только неавторизованный пользователь может попасть на эту страницу*/
if (is_user_logged_in()) {
    wp_redirect(home_url());
    exit;
}


if (isset($_POST['action']) && $_POST['action'] == 'my_custom_registration') {
    $retrieved_nonce = $_REQUEST['_wpnonce'];
    if (!wp_verify_nonce($retrieved_nonce, 'my_register_action')) {
        die('Failed security check');
    }

    // Обработка данных формы
    $user_login = sanitize_user($_POST['user_login']);
    $user_password = sanitize_text_field($_POST['user_password']);
    $user_email = sanitize_email($_POST['user_email']);

    $error_log_message = "User Login: $user_login, User Password: $user_password, User Email: $user_email";
//    var_dump($error_log_message);

    // Вывести сообщение в error log
    error_log($error_log_message);

    $form_errors = array();

    // Проверка, что все поля не пустые
    if (empty($user_login) || empty($user_password) || empty($user_email)) {
//        return;
        $form_errors['user_login'] = 'Поля формы пустые';
    }

    // Инициализация массива для сбора ошибок

    // Проверяем, есть ли в логине русские буквы
    if (preg_match('/[\p{Cyrillic}]/u', $user_login)) {
        $form_errors['user_login'] = 'Имя пользователя должно содержать только латинские буквы, цифры и подчеркивания.';
    }

    // Проверка длины пароля пользователя
    if (strlen($user_password) < 4 || strlen($user_password) > 16) {
        $form_errors['user_password'] = 'Пароль должен быть от 4 до 16 символов';
    }

    // Проверка корректности формата электронной почты
    if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
        $form_errors['user_email'] = 'Некорректный формат электронной почты';
    }

// Проверка уникальности логина и электронной почты
//    if (username_exists($user_login)) {
//        $form_errors['user_login'] = 'Этот логин уже занят';
//    }
    if (email_exists($user_email)) {
        $form_errors['user_email'] = 'Уже существует пользователь с таким электронным адресом';
    }

// Если есть ошибки, сохраняем их в сессию
    if (!empty($form_errors)) {
        $_SESSION['form_errors'] = $form_errors;
        $_SESSION['form_data'] = $_POST; // Сохраняем отправленные данные в форме в сессии

        // Переадресация обратно на страницу формы
        wp_redirect(home_url('/auth'));
        exit;
    }

    // Создание нового пользователя
    $user_id = wp_create_user($user_login, $user_password, $user_email);

    if (is_wp_error($user_id)) {
        /*Стандратное поведение WordPress таково, что нельзя создавать пользователей с одинаковым логином (именем)*/
        /*мы тут отлавливаем эту ошибку*/
        // Обработка ошибок при создании пользователя
        $_SESSION['form_errors']['user_login'] = $user_id->get_error_message();
        $_SESSION['form_data'] = $_POST; // Сохраняем отправленные данные в форме в сессии

        wp_redirect(home_url('/auth'));
        exit;
    }

    // После вызова wp_create_user(), но до автоматического входа
    if (!is_wp_error($user_id)) {
        // Установка кастомной роли для нового пользователя
        $user = new WP_User($user_id);
        $user->set_role('member_role');
        // Генерация уникального ключа для подтверждения
        $activation_key = sha1(mt_rand(10000, 99999) . time() . $user_email);
        update_user_meta($user_id, 'activation_key', $activation_key);
        update_user_meta($user_id, 'has_activated', 'false'); // Изначально пользователь не активирован

        // Создание URL для активации
        $activation_link = add_query_arg(array('key' => $activation_key, 'user' => $user_id), get_permalink('1105'));

        // Текст письма
        $message = 'Пожалуйста, активируйте вашу учетную запись, перейдя по следующей ссылке: ' . $activation_link;

        $headers = array(
            'From: Calories365 <c63039000@gmail.com>',
            'content-type: text/html',
        );

        // Отправка письма
        wp_mail($user_email, 'Активация учетной записи', $message, $headers);

        $_SESSION['registration_confirm'] = 'На вашу почту отправлено письмо. Подтвердите ее.';

        // Переадресация на страницу благодарности
        wp_redirect(home_url('/'));
        exit;
    }

    // Автоматический вход после регистрации
//    $creds = array(
//        'user_login' => $user_email,
//        'user_password' => $user_password, // Используйте оригинальный пароль
//        'remember' => true,
//    );
//
//    $user = wp_signon($creds, false);
//
//    if (is_wp_error($user)) {
//        // Обработка ошибок при входе пользователя
//        echo $user->get_error_message();
//        return;
//    }
//
//    $_SESSION['registration_success'] = 'Регистрация прошла успешно.';
//    wp_redirect(home_url());
//    exit;
};

if (isset($_POST['login_action']) && $_POST['login_action'] == 'my_custom_login') {
    $retrieved_nonce = $_REQUEST['_wpnonce'];
    if (!wp_verify_nonce($retrieved_nonce, 'my_login_action')) {
        die('Failed security check');
    }

//    $user_login = sanitize_user($_POST['user_login']);
    $user_email = sanitize_user($_POST['user_email_login']);
    $user_password = sanitize_text_field($_POST['user_password_login']);
    /*
     * Теперь, когда пользователь установит флажок "Запомнить меня" и войдет в систему,
     * WordPress установит куки входа на более длительный срок (обычно на 14 дней),
     * вместо стандартного срока, который длится до закрытия браузера.
     * */
    $remember = isset($_POST['rememberme']) && $_POST['rememberme'] == 'forever';

    // Сохраняем введенный email в сессии
    $_SESSION['login_email'] = $user_email;

    $creds = array(
        'user_login' => $user_email,
        'user_password' => $user_password,
        'remember' => $remember
    );
    /*возможно из-за этого не смогу залогиниться на локалке, так как локалка http, а не https*/
//    $user = wp_signon($creds, true);
    $user = wp_signon($creds, false);
//    $user = wp_signon($creds, is_ssl());

    if (is_wp_error($user)) {
        // Сохранить ошибку для отображения
//        $_SESSION['login_errors'] = $user->get_error_message();
        /*В это случае ВП возвращает свою ошибку, мне не нравится что там ссылка
        на встроенный action WP, переопределим текст ошибки*/
        // Получаем сообщение об ошибке
        $error_message = $user->get_error_message();

        // Убираем ссылку на стандартное восстановление пароля
        $error_message = strip_tags($error_message, '<strong>'); // Удаляем все теги кроме <strong>

        // Можно также заменить текст в сообщении, если это необходимо
        $error_message = str_replace('Lost your password?', '', $error_message);

        // Сохраняем обновленное сообщение об ошибке
        $_SESSION['login_errors'] = $error_message;

        wp_redirect(home_url('/auth'));
        exit;
    } else {
        // Проверка, активирован ли аккаунт
        $has_activated = get_user_meta($user->ID, 'has_activated', true);

        if ($has_activated !== 'true') {
            $_SESSION['login_errors'] = 'Ваш аккаунт еще не активирован.';
            wp_logout(); // Выйти, так как аккаунт не активирован
            wp_redirect(home_url('/auth'));
            exit;
        }

        $_SESSION['login_success'] = 'Вы успешно вошли в ваш аккаунт!';
        unset($_SESSION['login_email']);

        // Перенаправить на страницу профиля или другую целевую страницу
        wp_redirect(home_url('/'));
        exit;
    }
}

if ('POST' == $_SERVER['REQUEST_METHOD'] && !empty($_POST['reset-action']) && $_POST['reset-action'] == 'my_custom_reset') {
    $retrieved_nonce = $_REQUEST['_wpnonce'];
    if (!wp_verify_nonce($retrieved_nonce, 'my_reset_action')) {
        die('Failed security check');
    }

    $user_email = sanitize_email($_POST['user_email_reset']);
    $user = get_user_by('email', $user_email);

    if (!$user) {
        // Пользователь с таким email не найден
        $_SESSION['reset_password_errors'] = 'Пользователь с таким email не найден.';
        wp_redirect(home_url('/auth'));
        exit;
    } else {
        // Сброс пароля и установка нового пароля
        $new_password = wp_generate_password();
        wp_set_password($new_password, $user->ID);

        // Отправка email с новым паролем
        $subject = 'Ваш новый пароль на сайте ' . get_bloginfo('name');
        $message = "Ваш новый пароль: $new_password";

        $headers = array(
            'From: Calories365 <c63039000@gmail.com>',
            'content-type: text/html',
        );

        // Отправка письма
        if (wp_mail($user_email, $subject, $message, $headers)) {
            // Сообщение об успехе
            $_SESSION['reset_password_success'] = 'На ваш email отправлен новый пароль.';
            wp_redirect(home_url('/auth'));
            exit;
        } else {
            // Не удалось отправить email
            $_SESSION['reset_password_errors'] = 'Ошибка при отправке email.';
            wp_redirect(home_url('/auth'));
            exit;
        }
    }
}
get_header();


$current_user = wp_get_current_user();
?>

<main id="primary" class="page-auth-wrapper">
    <!--<main id="primary" class="main-wrapper">-->
    <?php
    if (isset($_SESSION['registration_success'])) {
        echo '<div class="success-message">
            <div class="success-message_wrapper">
                <div class="success-message_color"></div>
                <div class="success-message_content">
                    <span class="success-message_close">&times;</span>
                    <div class="success-message_text">'
            . esc_html($_SESSION['registration_success']) .
            '</div>
                </div>
            </div>
          </div>';
        // Очистка сообщения после отображения
        unset($_SESSION['registration_success']);
    }

    if (isset($_SESSION['reset_password_success'])) {
        echo '<div class="success-message">
            <div class="success-message_wrapper">
                <div class="success-message_color"></div>
                <div class="success-message_content">
                    <span class="success-message_close">&times;</span>
                    <div class="success-message_text">'
            . esc_html($_SESSION['reset_password_success']) .
            '</div>
                </div>
            </div>
          </div>';
        // Очистка сообщения после отображения
        unset($_SESSION['reset_password_success']);
    }
    ?>
    <div id="reset-modal" class="modal-reset">

        <!-- Modal content -->
        <div class="modal-reset_content">

            <span class="modal-reset_close">&times;</span>
            <div class="modal-reset_title">Восстановление пароля</div>
            <form id="reset-password-form" class="modal-reset_form" method="post">
                <?php wp_nonce_field('my_reset_action'); ?>
                <input type="hidden" name="reset-action" value="my_custom_reset">
                <input type="email" name="user_email_reset" id="user_email_reset" class="auth-page_input"
                       placeholder="Email"
                       size="25" value="">

                <button type="submit" name="btnSubmit_reset" id="btnSubmit_reset" class="auth-page_btn">
                    Восстановить
                </button>
            </form>
        </div>

    </div>

    <article class="main-article auth-page">
        <section class="auth-page_section">
            <div class="auth-page_container">
                <div class="auth-page_box">
                    <div class="auth-page_card">
                        <div class="auth-page_message error-auth-notify auth-notify">
                            <?php
                            // Отображение ошибок валидации, если они есть в сессии
                            if (isset($_SESSION['form_errors'])) {
                                foreach ($_SESSION['form_errors'] as $error_key => $error_value) {
                                    echo ' <div class="auth-notify_box">
                                <div class="auth-notify_color"></div>
                                <div class="auth-notify_message">' . esc_html($error_value) . '</div>
                                           </div>';
                                }
                                // Очистка ошибок после отображения
                                unset($_SESSION['form_errors']);
                            }

                            if (isset($_SESSION['login_errors'])) {
                                echo '<div class="auth-notify_box">';
                                echo '<div class="auth-notify_color"></div>';
                                echo '<div class="auth-notify_message">' . $_SESSION['login_errors'] . '</div>';
                                echo '</div>';
                                // Очистка сообщения об ошибке после отображения
                                unset($_SESSION['login_errors']);
                            }

                            if (isset($_SESSION['reset_password_errors'])) {
                                foreach ($_SESSION['reset_password_errors'] as $error_key => $error_value) {
                                    echo ' <div class="auth-notify_box">
                                <div class="auth-notify_color"></div>
                                <div class="auth-notify_message">' . esc_html($error_value) . '</div>
                                           </div>';
                                }
                                // Очистка ошибок после отображения
                                unset($_SESSION['reset_password_errors']);
                            }

                            ?>
                        </div>

                        <div class="auth-page_content" id="register-block">
                            <form id="registerform" class="auth-page_form" method="post">
                                <?php wp_nonce_field('my_register_action'); ?>
                                <input type="hidden" name="action" value="my_custom_registration">
                                <h3 class="auth-page_title">Регистрация</h3>
                                <?php
                                // Используйте данные из сессии, если они есть, в противном случае используйте пустую строку
                                $user_login_value = isset($_SESSION['form_data']['user_login']) ? esc_attr($_SESSION['form_data']['user_login']) : '';
                                $user_email_value = isset($_SESSION['form_data']['user_email']) ? esc_attr($_SESSION['form_data']['user_email']) : '';

                                // Удалите сохраненные данные формы после использования
                                unset($_SESSION['form_data']);
                                ?>

                                <input type="text" name="user_login" id="user_login" class="auth-page_input"
                                       placeholder="Name"
                                       size="20" value="<?php echo $user_login_value; ?>">

                                <input type="password" name="user_password" id="user_password" class="auth-page_input"
                                       placeholder="Password"
                                       size="20">

                                <input type="email" name="user_email" id="user_email" class="auth-page_input"
                                       placeholder="Email"
                                       size="25" value="<?php echo $user_email_value; ?>">

                                <button type="submit" name="btnSubmit" id="btnSubmit" class="auth-page_btn">Создать
                                    аккаунт
                                </button>

                            </form>
                            <div class="auth-page_info">
                                <div> Уже есть аккаунт?</div>
                                <div class="auth-page_link" id="btn-to-login">Заходи!</div>
                            </div>
                        </div>
                        <div class="auth-page_content" id="login-block">
                            <form id="loginform" class="auth-page_form" method="post">
                                <?php wp_nonce_field('my_login_action'); ?>
                                <input type="hidden" name="login_action" value="my_custom_login">
                                <h3 class="auth-page_title">Авторизация</h3>
                                <?php $login_email = $_SESSION['login_email'] ?? ''; ?>
                                <input type="email" name="user_email_login" id="user_email_login"
                                       class="auth-page_input"
                                       placeholder="Email"
                                       size="25" value="<?php echo esc_attr($login_email); ?>">

                                <input type="password" name="user_password_login" id="user_password_login"
                                       class="auth-page_input"
                                       placeholder="Password"
                                       size="20">

                                <div class="auth-page_checkbox">
                                    <input type="checkbox" name="rememberme" id="rememberme" value="forever">
                                    <label for="rememberme">Запомнить меня</label>
                                </div>

                                <div class="auth-page_info auth-page_forget">
                                    <div> Забыл пароль?</div>
                                    <div class="auth-page_link" id="btn-to-renew">Восстановить</div>
                                </div>


                                <button type="submit" name="btnSubmit_login" id="btnSubmit_login" class="auth-page_btn">
                                    Войти
                                </button>

                            </form>
                            <div class="auth-page_info">
                                <div> Нет аккаунта?</div>
                                <div class="auth-page_link" id="btn-to-register">Создать аккаунт!</div>
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
