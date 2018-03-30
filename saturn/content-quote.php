<article id="<?php the_ID();?>" <?php post_class();?>>
	<div class="post-content">
		<?php function_exists( 'saturn_post_format_content' ) ? saturn_post_format_content() : '';?>
	</div>
</article><!-- post quote -->