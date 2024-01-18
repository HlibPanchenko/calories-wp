<?php

if ( ! is_active_sidebar( 'sidebar-recipe-taxonomies' ) ) {
	return;
}
?>

<div class="sidebar">
    <?php dynamic_sidebar('sidebar-recipe-taxonomies'); ?>
</div>

