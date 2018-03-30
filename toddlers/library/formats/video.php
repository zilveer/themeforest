<?php global $unf_options; ?>
<?php //Video Format?>
<div <?php post_class( 'clearfix blog-posts thepost' ); ?>>
	<?php if( $unf_options['unf_post_layout'] == '2') { echo '<div class="compact-post-layout">'; } else { echo '<div class="larger-post-layout">';};?>


<?php
echo theme_oembed_videos();
?>
	<div class="titlewrap clearfix">
		<h2 class="post-title entry-title">
			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
				<?php the_title(); ?>
			</a>
		</h2>
		<?php get_template_part('library/unf/postmeta');?>
	</div>
	<?php get_template_part( 'library/unf/viewcommentsshare');?>
	</div>
</div>