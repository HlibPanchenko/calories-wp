<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package calories_first
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found">
            <p> Упс, произошла ошибка. </p>

            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
			Вернуться на главную страницу.
            </a>
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
