<?php
/*
Template Name: Homepage
*/
?>

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

<!-- Homepage content -->
<div class="container homepage-content">
    <div class="main-content-column-1 full-width">
        
        <?php    
            if ( have_posts() ) : 
                while ( have_posts() ) : the_post();
                    echo '<div class="post">';
                        the_content();
                    echo '</div>';
                endwhile;
            else :
                    echo _e('no posts found!', 'goliath');
            endif;
        ?>
    </div>
</div>

<?php get_footer(); ?>