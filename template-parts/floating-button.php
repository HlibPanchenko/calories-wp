<?php


use Kirki\Compatibility\Kirki;

if (Kirki::get_option('float_button_to_top_align') === "left") {
    $align_class_btn_to_top = 'float_button_left';
} else {
    $align_class_btn_to_top = 'float_button_right';
}

if (Kirki::get_option('float_button_to_top_enable')) {
?>

<div class="scroll-to-top <?php echo $align_class_btn_to_top ?> " id="scroll-to-top">
    <svg viewBox="0 0 24 24" width="56px" height="56px" fill="none"
         stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g>
        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
        <g id="SVGRepo_iconCarrier">
            <path d="M7 14.5L12 9.5L17 14.5" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            </path> </g></svg>
</div>
<?php } ?>
