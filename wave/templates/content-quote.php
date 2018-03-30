<?php 
	
	global $dd_sn;
	global $dd_post_class;

	if ( ! isset( $dd_post_class ) )
		$dd_post_class = 'one-third column ';
	
?>

<div class="blog-post format-quote <?php echo $dd_post_class; ?>">

	<div class="blog-post-inner">

		<div class="blog-post-main">

			<span class="quote-sign"></span>

			<h2 class="blog-post-title"><?php the_content(); ?></h2>

			<span class="blog-post-author">- <?php the_title(); ?></span>

		</div><!-- .blog-post-main -->

	</div><!-- .blog-post-inner -->

</div><!-- .blog-post -->