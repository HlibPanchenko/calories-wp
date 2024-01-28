<?php

if ( ! is_active_sidebar( 'sidebar-recipe-second' ) ) {
    return;
}
?>

<div class="sidebar">
    <?php dynamic_sidebar('sidebar-recipe-second'); ?>
</div>

