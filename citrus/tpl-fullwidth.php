<?php /*Template Name: Full Width Template*/?>
<?php get_header();?>

<?php
global $post;
dttheme_slider_section( $post->ID, 'page' );
dttheme_top_space( $post->ID, 'page' );
?>

<!-- ** Primary Section ** -->
<div id="primary" class="content-full-width"><?php
    if( have_posts() ):
        while( have_posts() ):
            the_post();
            get_template_part( 'framework/loops/content-fullwidth', 'page' );
        endwhile;
    endif;?>
</div><!-- ** Primary Section End ** -->

<div class="dt-sc-margin70"></div>
    
<?php get_footer(); ?>