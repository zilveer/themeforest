<?php 
	
	global $dd_sn;
	global $dd_post_class;	

	if ( ! isset( $dd_post_class ) )
		$dd_post_class = 'one-third column ';

?>

<div class="blog-post format-link <?php echo $dd_post_class; ?>">

	<div class="blog-post-inner">

		<div class="blog-post-main">

			<h2 class="blog-post-title"><a href="<?php echo get_post_meta( get_the_ID(), $dd_sn . 'post_format_link_url', true ); ?>"><span class="icon-link"></span><?php the_title(); ?></a></h2>

			<div class="blog-post-excerpt">

				<?php the_content(); ?>

			</div><!-- .blog-post-excerpt -->

		</div><!-- .blog-post-main -->

	</div><!-- .blog-post-inner -->

</div><!-- .blog-post -->