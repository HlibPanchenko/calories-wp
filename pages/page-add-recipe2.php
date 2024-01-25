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
                            'post_id'       => 'new_post', // Это создаст новый пост
                            'post_title'    => true,
                            'post_content'  => true,
                            'new_post'      => array(
                                'post_type'   => 'recipe',
                                'post_status' => 'publish'
                            ),
                            'submit_value'  => 'Добавить рецепт',
                            'html_submit_spinner' => '<span class="acf-spinner"></span>',
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
