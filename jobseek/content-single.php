<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>><?php
	
	get_template_part( 'inc/thumbnail' );

	the_title( '<h2 class="post-title">', '</h2>' );

	get_template_part( 'inc/post-meta' );

	the_content();

?></article>

<?php
if ( function_exists( 'sharing_display' ) ) { ?>
	<div class="share">
    	<?php sharing_display( '', true ); ?>
    </div><?php
}

if ( get_the_author_meta( 'description' ) ) :
	get_template_part( 'author-bio' );

if( has_tag() ) {
	the_tags( '<ul class="tags"><li>', '</li><li>', '</li></ul>' );
}

endif;

if ( get_post_type() == 'post' ) {
?><ul class="paging"><li class="prev"><?php previous_post_link( '%link', __('Prev', 'jobseek') ); ?></li><li class="next"><?php next_post_link( '%link', __('Next', 'jobseek') ); ?></li></ul><?php
}

if ( is_single() && ( get_post_type() == 'post' ) ) {
	comments_template();
} ?>