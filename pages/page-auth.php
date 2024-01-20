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
//    var_dump('user id: ', $user_id);

    if (is_wp_error($user_id)) {
        // Обработка ошибок при создании пользователя
        echo $user_id->get_error_message();
        return;
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
                    <?php
                    // Отображение ошибок валидации, если они есть в сессии
                    if (isset($_SESSION['form_errors'])) {
                        foreach ($_SESSION['form_errors'] as $error_key => $error_value) {
                            echo '<div class="error-message">' . esc_html($error_value) . '</div>';
                        }
                        // Очистка ошибок после отображения
                        unset($_SESSION['form_errors']);
                    }

                    ?>
                    <form id="registerform" method="post">
                        <?php wp_nonce_field('my_register_action'); ?>
                        <input type="hidden" name="action" value="my_custom_registration">

                        <?php
                        // Используйте данные из сессии, если они есть, в противном случае используйте пустую строку
                        $user_login_value = isset($_SESSION['form_data']['user_login']) ? esc_attr($_SESSION['form_data']['user_login']) : '';
                        $user_email_value = isset($_SESSION['form_data']['user_email']) ? esc_attr($_SESSION['form_data']['user_email']) : '';

                        // Удалите сохраненные данные формы после использования
                        unset($_SESSION['form_data']);
                        ?>
                        <p>
                            <label for="user_login">
                                Имя пользователя<br>
                                <input type="text" name="user_login" id="user_login" class="input" placeholder="Name"
                                       size="20" value="<?php echo $user_login_value; ?>">
                            </label>
                        </p>
                        <p>
                            <label for="user_password">
                                Пароль<br>
                                <input type="password" name="user_password" id="user_password" class="input"
                                       placeholder="Password"
                                       size="20">
                            </label>
                        </p>
                        <p>
                            <label for="user_email">
                                E-mail<br>
                                <input type="email" name="user_email" id="user_email" class="input" placeholder="Email"
                                       size="25" value="<?php echo $user_email_value; ?>">
                            </label>
                        </p>
                        <br class="clear">
                        <p>
                            <input type="submit" name="btnSubmit" id="btnSubmit" class="button" value="Регистрация">
                        </p>
                    </form>
                </div>
        </section>
    </article>

</main>

<?php
get_footer();
?>
