<?php global $unf_options; ?>
<?php //Gallery Format?>
<div <?php post_class( 'clearfix blog-posts thepost' ); ?>>

	<div class="gallery-post-wrapper">
		<?php
		if ( gallery_shortcode($post->ID) ){
			$pattern = get_shortcode_regex();
			$matches = array();
			preg_match("/$pattern/s", get_the_content(), $matches); //just finds the first one
			echo do_shortcode($matches[0]);
		} ?>
		<div class="titlewrap clearfix">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="gallery-post-title">
					<?php the_title(); ?>
				</a></h2>
			<?php get_template_part('library/unf/postmeta');?>
		</div>
	</div>
</div>