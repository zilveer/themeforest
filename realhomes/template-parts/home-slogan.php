<?php
/* Slogan Title and Text */
$slogan_title = get_option('theme_slogan_title');
$slogan_text = get_option('theme_slogan_text');

?>
<div class="narrative">
    <?php
    if(!empty($slogan_title)){
        ?><h2><?php echo stripslashes($slogan_title); ?></h2><?php
    }

    if(!empty($slogan_text)){
        ?><p><?php echo stripslashes($slogan_text); ?></p><?php
    }
    ?>
</div>