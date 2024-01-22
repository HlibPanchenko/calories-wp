<?php
/**
 * Template Name: page-add-recipe
 */


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
                        <form id="add-recipe-form" class="recipe-add_form" method="post">
                            <input type="text" name="recipe_title" placeholder="Название рецепта" required>
                            <textarea name="recipe_content" placeholder="Описание рецепта" required></textarea>
                            <!-- Добавьте дополнительные поля по необходимости -->
                            <input type="submit" value="Добавить рецепт">
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
