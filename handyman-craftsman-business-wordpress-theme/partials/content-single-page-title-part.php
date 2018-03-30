<?php
use \Handyman\Front as F;
/**
 *  Used on single post/page template as article header
 */

global $post;

do_action('layers_before_single_post_title');
?>
<header class="section-title large">

    <?php
        /**
         * Display the Featured Thumbnail
         */
        echo F\tl_post_featured_media(array('size' => 'tl-blog-landscape',
                                     'wrap_class'=> 'thumbnail-media img-force-width push-bottom',
                                     'force_vid' => true));
    ?>

    <?php do_action('layers_before_single_title'); ?>
    <h1 class="heading"><?php the_title(); ?></h1>
    <?php do_action('layers_after_single_title'); ?>

</header>
<?php do_action('layers_after_single_post_title'); ?>