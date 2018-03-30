<article id="<?php the_ID();?>" <?php post_class();?>>
	<?php function_exists( 'saturn_post_format_content' ) ? saturn_post_format_content() : '';?>
	<?php do_action( 'saturn_post_meta' );?>
	<div class="post-header">
		<h3 class="post-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
	</div><!-- end post header -->
	<div class="post-content">
		<?php the_content( __( 'Continue reading <span class="readmore">&rarr;</span>', 'saturn' ) );?>
	</div>
</article><!-- post standard -->