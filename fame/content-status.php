<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

    global $post;
    //uses post content as title, and title as author name
    echo '<h2 class="post-title">'.get_the_title().'</h2><i class="post-format-icon fa fa-mobile"></i>';
?>
<div class="real-content">

    <?php the_content(); ?>

    <div class="clear"></div>
</div>

<?php a13_post_meta(); ?>
