<?php
/**
 * Template Name: page-add-recipe2
 */

acf_form_head();
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
                    <div class="page-add-recipe_description">
                        <div class="page-add-recipe_description-item">
                            Добро пожаловать на <span> CALORIES.365! </span>
                        </div>
                        <br>
                        <div class="page-add-recipe_description-item">
                            Мы рады, что вы решили поделиться своим кулинарным творением
                            с нашим сообществом. Ваш уникальный рецепт может вдохновить многих и принести радость домашнего
                            приготовления во многие дома. Пожалуйста, <span> следуйте шагам ниже, чтобы добавить ваш рецепт. </span>
                        </div>
                        <br>
                        <div class="page-add-recipe_description-item">
                            Заполните необходимые поля, чтобы добавить свой рецепт на  <span> CALORIES.365. </span> Укажите название вашего рецепта,
                            опишите процесс приготовления и ингредиенты, а также добавьте качественные изображения. Не забудьте
                            поделиться секретами и особыми советами, которые сделают ваш рецепт по-настоящему особенным!

                        </div>
                        <br>
                        <div class="page-add-recipe_description-item">
                            Как только вы опубликуете рецепт, он <span> пройдет модерацию перед публикацией </span> в общем доступе.
                        </div>
                    </div>

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
                        <?php
                        // Подготовка аргументов для acf_form
                        $acf_form_args = array(
                            'field_groups' => array('group_657acfb249ef7'),
                            'post_id'       => 'new_post', // Это создаст новый пост
                            'post_title'    => true,
                            'post_content'  => true,
                            'new_post'      => array(
                                'post_type'   => 'recipe',
                                'post_status' => 'pending'
                            ),
//                            'uploader' => 'basic',
                            'submit_value'  => 'Опубликовать',
//                            'html_submit_spinner' => '<span class="acf-spinner"></span>',
                        );

                        // Вывод формы ACF на фронтенде
                        acf_form($acf_form_args);

                        ?>
                    </div>

                <?php endif; ?>
            </div>
        </section>
    </article>

</main>

<?php
get_footer()
?>
