<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly


global $apollo13;

echo '<h2 class="post-title"><a href="'. esc_url(get_permalink()) . '">' . get_the_title() . '</a></h2><i class="post-format-icon fa fa-comments-o"></i>';
?>

<div class="real-content">

    <?php echo a13_daoon_chat_post($post->post_content);?>

    <div class="clear"></div>
</div>

<?php a13_post_meta(); ?>