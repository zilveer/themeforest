<?php get_header(); ?>
<div class="ads-preview-wrap">
<?php
    global $post;
    echo do_shortcode('[ad id="'.$post->ID.'"]');
    echo do_shortcode('[gap height="10"]');
?>
</div>
<?php get_footer(); ?>