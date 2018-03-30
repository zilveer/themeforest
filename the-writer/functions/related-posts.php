<!-- Further Reading Block -->
<?php if( get_option( "ocmx_meta_further_reading" ) == "true" ) {
	global $related_posts;
	if ( isset( $related_posts  ) && !empty( $related_posts ) ) { ?>
    	<div class="related-posts clearfix">
            <h4 class="related-posts-title"><?php _e( 'If you liked this story, you may also like:' , 'ocmx' ); ?></h4>
            <ul class="post-list opacity_zero" id="post-list">
                <?php while( $related_posts->have_posts() ) {
                    $related_posts->the_post(); ?>

                    <li class="post" id="post-<?php the_ID(); ?>" <?php post_class('post clearfix'); ?>>
                        <div class="book-cover <?php if( '' != get_post_meta( $post->ID , "header_image", true) ) echo 'has-cover-background'; ?> <?php if( 'yes' == get_post_meta( $post->ID , "post_text_shadow", true) ) echo 'has-text-shadow'; ?> " data-href="<?php echo the_permalink(); ?>">

                            <div class="content">
                                <h2 class="post-title typography-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            </div>
                        </div>
                    </li>

                <?php } // while related_posts ?>
            </ul>
        </div>
<?php }
} // Show further reading block if enabled in Theme Options ?>