<?php
get_header();
global $bd_data;

/* Sidebar */
$post_full = '';
$post_po = '';
if(get_post_meta($post->ID, 'bd_full_width', true)){
    $post_full      = ' post_full_width';
}
elseif(get_post_meta($post->ID, 'bd_sidebar_position', true) == 'left'){
    $post_po        = ' post_sidebar_left';
}
elseif(get_post_meta($post->ID, 'bd_sidebar_position', true) == 'right'){
    $post_po        = ' post_sidebar_right';
}

$bd_criteria_display = get_post_meta(get_the_ID(), 'bd_criteria_display', true);

?>

    <div class="bd-container <?php echo $post_po; echo $post_full; ?>">
        <div class="bd-main">

            <div class="blog-v1">
                <?php get_template_part( 'loop', 'standard' ); ?>
                <?php
					wp_reset_query();
					if( bdayh_get_option( 'comments_pages' ) == true ){
						comments_template();
					}
                ?>
            </div><!-- .blog-v1-->

        </div><!-- .bd-main-->

        <?php get_sidebar(); ?>
    </div><!-- .bd-container -->

<?php get_footer(); ?>