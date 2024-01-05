<?php

$uniqid = uniqid('accordion-block-');

$accordion_block = get_field('accordion_repeater'); //repeater

$accordion_header_text = get_field('accordion_header_text');

?>

<style>
    <?php
    $accordion_section_color = get_field('accordion_section_color');
    $accordion_background_title = get_field('accordion_background_title');
    $accordion_background_text = get_field('accordion_background_text');
    $accordion_color_title = get_field('accordion_color_title');
    $accordion_color_text = get_field('accordion_color_text');
    $accordion_background_arrow = get_field('accordion_background_arrow');
    $accordion_header_color = get_field('accordion_header_color');
    $accordion_borderbottom_title = get_field('accordion_borderbottom_title');

    echo <<<EOT
    #$uniqid  {
         background: $accordion_section_color;
    }
    
      #$uniqid .accordion_block_title {
          color: $accordion_header_color;
    }
         
     #$uniqid .accordion-1_btn {
         background:$accordion_background_title;
         color: $accordion_color_title;
         border-bottom: 1px solid  $accordion_borderbottom_title;
    }
         
     #$uniqid .accordion-1_dropdown {
         background:$accordion_background_text;
         color:  $accordion_color_text;
     }
     
      #$uniqid .accordion-1_arrow {
         border-left: 2px solid  $accordion_background_arrow;
         border-bottom: 2px solid  $accordion_background_arrow;
     }
     
    EOT;
    ?>
</style>


<section class="accordion_block" id="<?php echo $uniqid; ?>">
    <div class="accordion_block_container">
        <div class="accordion_block_block">
            <div class="accordion_block_content">
                <header class="accordion_block_header">
                    <h2 class="accordion_block_title"><?php echo $accordion_header_text ?></h2>

                </header>
                <div class="accordion_block_accordion accordion-1">
                    <?php foreach ($accordion_block as $item) : ?>
                        <?php
                        $accordion_block_title = $item["accordion_title"]; // title
                        $accordion_block_text = $item["accordion_text"]; // text
//                    var_dump($accordion_block_title);
//                    var_dump($accordion_block_text);
                        ?>

                        <div class="accordion-1_btn">
                            <div class="accordion-1_text"><?php echo esc_html($accordion_block_title) ?></div>
                            <span class="accordion-1_arrow"></span>
                        </div>
                        <div class="accordion-1_dropdown">
                            <p><?php echo nl2br($accordion_block_text) ?></p>
                        </div>


                    <?php endforeach; ?>
                </div>
            </div>


            <?php if (get_field('accordion_img')) : ?>
                <div class="accordion_block_img">
                    <img src="<?php echo esc_url(get_field('accordion_img')); ?>" alt="Изображение аккордиона">
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>
