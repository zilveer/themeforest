<?php get_header(); ?>
<?php
if(function_exists('putRevSlider'))
{
    global $post;
    $meta = get_post_meta($post->ID, 'page_rev_slider');
    if(!empty($meta) && strlen($meta[0]) > 0)
    {
        
        $slider = do_shortcode($meta[0]);
        if(!empty($slider) && strlen($slider) > 0)
        {
            echo '<div class="slider-full-width position-menu">';
            echo $slider;
            echo '</div>';      
        }
    }
}
?> 
<?php get_template_part('theme/templates/page-full-width'); ?>

<?php get_footer(); ?>