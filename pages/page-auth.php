<?php
/**
 * Template Name: auth
 */

if ($_POST) {
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

    // Проверка, что все поля не пустые
    if (empty($user_login) || empty($user_password) || empty($user_email)) {
        return;
    }

    // Инициализация массива для сбора ошибок
    $form_errors = array();

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

    // Автоматический вход после регистрации
    $creds = array(
        'user_login' => $user_email,
        'user_password' => $user_password, // Используйте оригинальный пароль
        'remember' => true,
    );

    $user = wp_signon($creds, false);

    if (is_wp_error($user)) {
        // Обработка ошибок при входе пользователя
        echo $user->get_error_message();
        return;
    }

    $_SESSION['registration_success'] = 'Регистрация прошла успешно.';
    wp_redirect(home_url());
    exit;
};

get_header();


$current_user = wp_get_current_user();
if ($current_user instanceof WP_User) {
    echo '<div class="current-user-info">';
    echo 'Имя пользователя: ' . esc_html($current_user->user_login) . '<br>';
    echo 'E-mail: ' . esc_html($current_user->user_email) . '<br>';
    echo 'ID пользователя: ' . esc_html($current_user->ID) . '<br>';
    echo '</div>';
}
?>

<main id="primary" class="main-wrapper">

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
                                <input type="hidden" name="action" value="my_custom_registration">
                                <h3 class="auth-page_title">Авторизация</h3>

                                <!--                                <input type="text" name="user_login" id="user_login" class="auth-page_input"-->
                                <!--                                       placeholder="Name"-->
                                <!--                                       size="20" value="-->
                                <?php //echo $user_login_value; ?><!--">-->

                                <input type="email" name="user_email" id="user_email" class="auth-page_input"
                                       placeholder="Email"
                                       size="25" value="<?php echo $user_email_value; ?>">

                                <input type="password" name="user_password" id="user_password" class="auth-page_input"
                                       placeholder="Password"
                                       size="20">

                                <div class="auth-page_info auth-page_forget">
                                    <div> Забыл пароль?</div>
                                    <div class="auth-page_link" id="btn-to-renew">Восстановить</div>
                                </div>

                                <button type="submit" name="btnSubmit" id="btnSubmit" class="auth-page_btn">Войти
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
