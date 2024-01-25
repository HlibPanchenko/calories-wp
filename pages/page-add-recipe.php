<?php
/**
 * Template Name: page-add-recipe
 */

// Проверяем, авторизован ли пользователь
if (is_user_logged_in()) {
// Если форма была отправлена, обрабатываем данные
    if ('POST' == $_SERVER['REQUEST_METHOD'] && !empty($_POST['action']) && $_POST['action'] == 'add_recipe') {

//        var_dump($_POST);
        var_dump('КАРТИНКИИИИИИИИИ: ', $_FILES);

        if ( !isset($_POST['add_recipe_nonce']) || !wp_verify_nonce($_POST['add_recipe_nonce'], 'add_recipe_action') ) {
            // Обработка случая, если проверка nonce не прошла
            die('Неверный или отсутствующий контрольный параметр nonce, действие остановлено.');
        }

        // Валидация и санитизация данных
        $title = sanitize_text_field($_POST['recipe_title']);
        $content = sanitize_textarea_field($_POST['recipe_content']);
        $calories = intval($_POST['k-vo_kalorij']);
        $cooking_time = intval($_POST['vremya_na_gotovku']);
        $protein = intval($_POST['bzhu_belki']);
        $fat = intval($_POST['bzhu_zhiri']);
        $carbohydrates = intval($_POST['bzhu_uglevody']);
        $steps = array_map('sanitize_textarea_field', $_POST['recipe_steps']);
        $ingredients = array_map(function ($ingredient) {
            return sanitize_text_field($ingredient['ingredient_recipe']);
        }, $_POST['ingredients_recipe']);

        // Создание нового поста
        $recipe_id = wp_insert_post([
            'post_title'    => $title,
            'post_content'  => $content,
            'post_status'   => 'publish', // Или 'publish', если нужно сразу публиковать. pending
            'post_type'     => 'recipe',
            'post_author'   => get_current_user_id(),
        ]);

        // Проверяем, успешно ли создан пост
        // После создания поста
        // После создания поста
        if (!is_wp_error($recipe_id)) {
            // Проверяем, установлен ли ACF и функция update_field
            if (function_exists('update_field')) {
                // Сохранение простых метаполей с помощью ACF
                update_field('k-vo_kalorij', $calories, $recipe_id);
                update_field('vremya_na_gotovku', $cooking_time, $recipe_id);
                // ... сохраните другие поля аналогичным образом ...

                // Сохранение шагов приготовления и загрузка изображений для них
                $steps_to_save = array();
                foreach ($_POST['recipe_steps'] as $index => $step) {
                    $step_images = array();
                    if (!empty($_FILES['recipe_steps']['name'][$index]['recipe_stepimg'])) {
                        // Обработка загрузки изображений для данного шага
                        foreach ($_FILES['recipe_steps']['name'][$index]['recipe_stepimg'] as $img_index => $file_name) {
                            if ($file_name) {
                                // Загрузка изображения и получение ID вложения
                                $file = array(
                                    'name'     => $_FILES['recipe_steps']['name'][$index]['recipe_stepimg'][$img_index],
                                    'type'     => $_FILES['recipe_steps']['type'][$index]['recipe_stepimg'][$img_index],
                                    'tmp_name' => $_FILES['recipe_steps']['tmp_name'][$index]['recipe_stepimg'][$img_index],
                                    'error'    => $_FILES['recipe_steps']['error'][$index]['recipe_stepimg'][$img_index],
                                    'size'     => $_FILES['recipe_steps']['size'][$index]['recipe_stepimg'][$img_index]
                                );
                                $_FILES['recipe_stepimg'] = $file;

                                // Обработка загрузки файла
                                $attach_id = media_handle_upload('recipe_stepimg', $recipe_id);
                                if (!is_wp_error($attach_id)) {
                                    // ID изображения успешно получен, добавляем в массив изображений шага
                                    $step_images[] = $attach_id;
                                } else {
                                    // Обработка ошибок
                                    echo "Ошибка загрузки изображения: " . $attach_id->get_error_message();
                                }
                            }
                        }
                    }

                    // Собираем данные шага, включая ID изображений
                    $step_data = array(
                        'recipe_stepnum' => $index + 1, // Здесь может быть ошибка, если 'recipe_stepnum' в $_POST не установлен
                        'recipe_steptext' => sanitize_text_field($step['recipe_steptext']),
                        'recipe_stepimg' => $step_images
                    );
                    $steps_to_save[] = $step_data;
                }

                // Сохраняем все шаги с помощью ACF
                update_field('recipe_steps', $steps_to_save, $recipe_id);
            }
        }
    }
}

get_header();


?>

<main id="primary" class="main-wrapper">
    <article class="main-article page-add-recipe">
        <section class=page-add-recipe_section">
            <div class="page-add-recipe_container">
                <div class="page-add-recipe_header">

                    <div class="layout-posts_breadcrumbs page-add-recipe_breadcrumbs">
                        <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
                    </div>

                    <h1 class="page-add-recipe_title">
                        Поделись своим рецептом!
                    </h1>

                </div>
                <?php
                /*только авторизованный пользователь может добавить свой рецепт*/
                if (!is_user_logged_in()) : ?>

                    <div class="page-add-recipe_content">
                        Для того чтобы добавить свой рецепт на наш сайт, Вам необходимо создать аккаунт. <br>
                        Регистрация займет всего один момент. <br>
                        <a href="<?php echo home_url('/auth'); ?>"> Перейти к регистрации </a>
                    </div>

                <?php else: ?>
                    <div class="page-add-recipe_content recipe-add">
                        <h2 class="recipe-add_title">
                            Создайте свой рецепт
                        </h2>
                        <form id="add-recipe-form" class="recipe-add_form" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="action" value="add_recipe">
                            <?php wp_nonce_field('add_recipe_action', 'add_recipe_nonce'); ?>

                            <input type="text" name="recipe_title" placeholder="Название рецепта" required>
                            <textarea name="recipe_content" placeholder="Описание рецепта" required></textarea>
                            <!-- Дополнительные поля ACF -->
                            <!-- Поле для загрузки изображений -->
                            <div class="page-add-recipe_subtitle">
                                Изображения рецепта
                            </div>
                            <div class="page-add-recipe_subdescription">
                                Загрузите изображения рецептов. Ограничение: 10 штук. Первое изображение будет главным.
                            </div>
                            <input class="page-add-recipe_hide-btn" type="file" name="images_of_recepie[]" multiple>
                            <div id="main-image-preview">
                                <button type="button" id="add-main-image-preview" class="page-add-recipe_add-img">+
                                </button>
                                <div class="main-image-container">
                                </div>
                            </div>

                            <div class="page-add-recipe_double-box">
                                <!-- Поле для количества калорий -->
                                <input type="number" name="k-vo_kalorij" placeholder="Количество калорий" min="1"
                                       max="5000">
                                <!-- Поле для времени приготовления -->
                                <input type="number" name="vremya_na_gotovku" placeholder="Время на готовку в минутах"
                                       min="1" max="1000">
                            </div>


                            <!-- Поле для шагов приготовления (репитер) -->
                            <!-- Контейнер для шагов -->
                            <div class="page-add-recipe_subtitle">
                                Шаги приготовления рецепта
                            </div>
                            <div class="page-add-recipe_subdescription">
                                По желанию загрузите изображения для этапа приготовления.
                            </div>
                            <div id="recipe-add_steps-container">
                                <div class="recipe-add_step-group">
                                    <!--                                    <input type="number" name="recipe_steps[0][recipe_stepnum]" placeholder="Номер шага">-->
                                    <textarea name="recipe_steps[0][recipe_steptext]"
                                              placeholder="Описание шага"></textarea>
                                    <input class="page-add-recipe_hide-step-btn" type="file"
                                           name="recipe_steps[0][recipe_stepimg]" multiple>
                                    <div class="step-image-preview">
                                        <button type="button"
                                                class="page-add-recipe_add-img page-add-recipe_add-step-img">+
                                        </button>
                                        <div class="step-image-container">
                                            <!-- Здесь будут отображаться загруженные изображения -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="add-step-btn-wrapper add-row-btn">
                                <button type="button" id="add-step" class="add-step-btn-wrapper_btn add-row-btn_btn">
                                    <div class="add-step-btn-wrapper_text add-row-btn_text">Добавить шаг</div>
                                    <div class="add-step-btn-wrapper_plus add-row-btn_plus">+</div>
                                </button>
                            </div>


                            <!-- Поля для группы bzhu_recipe -->
                            <div class="page-add-recipe_subtitle">
                                БЖУ (белки, жиры, углеводы)
                            </div>
                            <div class="page-add-recipe_triple-box">
                                <input type="number" name="bzhu_belki" placeholder="Белки" required>
                                <input type="number" name="bzhu_zhiri" placeholder="Жиры" required>
                                <input type="number" name="bzhu_uglevody" placeholder="Углеводы" required>
                            </div>


                            <!-- Поле для ингредиентов (репитер) -->
                            <!-- Контейнер для ингредиентов -->
                            <div class="page-add-recipe_subtitle">
                                Добавьте ингредиенты
                            </div>
                            <div class="page-add-recipe_subdescription">
                                Указывайте название и грамовку (например, 500г курицы, пол столовой ложки меда)
                            </div>
                            <div id="ingredients-container">
                                <div class="ingredient-group">
                                    <input type="text" name="ingredients_recipe[0][ingredient_recipe]"
                                           placeholder="Ингредиент">
                                </div>
                            </div>
                            <div class="add-step-btn-wrapper add-row-btn">
                                <button type="button" id="add-ingredient"
                                        class="add-step-btn-wrapper_btn add-row-btn_btn">
                                    <div class="add-step-btn-wrapper_text add-row-btn_text">Добавить ингредиент</div>
                                    <div class="add-step-btn-wrapper_plus add-row-btn_plus">+</div>
                                </button>
                            </div>
                            <!-- ... Добавьте другие поля по аналогии ... -->
                            <div class="recipe-add_main-btn_wrapper">

                                <button type="submit" class="recipe-add_main-btn"> Добавить рецепт</button>
                            </div>
                        </form>

                    </div>

                <?php endif; ?>
            </div>
        </section>
    </article>

</main>

<?php
get_footer()
?>
