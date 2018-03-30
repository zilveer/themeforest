<?php
if ( yit_get_sidebar_layout() == 'sidebar-no' ) :
    $span = 5;
    $span_title = 2;
else:
    $span = 3;

    if( ( is_posts_page() || is_home() || is_single() ) && ( yit_get_option( 'blog-type' ) == 'big-ribbon' || yit_get_option( 'blog-type' ) == 'small-ribbon' ) ) {
        $span_title = 2;
    } else {
        $span_title = 3;
    }
endif;
$content = (isset($content) && $content != '') ? $content : '';
?>
<div class="row box-title">
    <div class="span<?php echo $span ?>">
        <?php echo do_shortcode('[border]') ?>
    </div>
    <h3 class="span<?php echo $span_title ?>">
        <?php echo $content ?>
    </h3>
    <div class="span<?php echo $span ?>">
        <?php echo do_shortcode('[border]') ?>
    </div>
</div>
