<?php

/**
 * Template Name: Full Width Not Header
 */

get_header();


$sub = get_post_meta(get_the_ID(),'_cmb_page_sub', true);

$des = get_post_meta(get_the_ID(),'_cmb_page_des', true);
if(!$sub){
    $sub = learn_theme_option( "sub_head" );
}
if(!$des){
    $des = learn_theme_option( "des_head" );
}
?>

<?php
    $bg = '';
    if ( ! function_exists('rwmb_meta') ) { 
        $bg = '';
    }else{
        $images = rwmb_meta('_cmb_bg_header', "type=image" ); 
        if(!$images){
             $bg = '';
        } else {
             foreach ( $images as $image ) { 
                $bg = $image['full_url']; 
                break;
            }
        }
    }
   
?>
               
<?php while (have_posts()) : the_post()?>

    <?php the_content(); ?>
    
<?php endwhile; ?>

<!-- content close -->
<?php get_footer(); ?>