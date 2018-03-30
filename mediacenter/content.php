<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 */
?>
<?php if (! is_single() ) : ?>
<div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>

	<?php media_center_post_header();?>

	<div class="post-entry">
		<div class="post-content">
			
			<?php media_center_post_thumbnail();?>

			<h2 class="post-title">
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'mediacenter' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h2>

			<?php media_center_post_meta(); ?>

			<?php media_center_post_content(); ?>

			<?php mc_init_structured_data(); ?>

		</div><!-- /.post-content --> 	
	</div><!-- /.post-entry -->

</div><!-- /.post -->

<?php else : ?>
	
	<?php get_template_part( 'content' , 'single' );?>

<?php endif;