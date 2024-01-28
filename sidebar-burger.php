<?php

if ( ! is_active_sidebar( 'sidebar-burger-menu')) {
    return;
}
?>

<div class="sidebar-burger" id="burger-sidebar">
    <?php dynamic_sidebar('sidebar-burger-menu'); ?>
</div>

