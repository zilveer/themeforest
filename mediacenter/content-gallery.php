<div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
	
	<?php media_center_post_header();?>
	
	<div class="post-entry">
		<div class="post-content">
			
			<?php media_center_gallery_slideshow( get_the_ID() ); ?>
			
			<h2 class="post-title">
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'mediacenter' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?> </a>
			</h2>
			
			<?php media_center_post_meta(); ?>

			<?php media_center_post_content();?>
			
		</div><!-- /.post-content --> 
	</div><!-- /.post-entry -->
	
</div><!-- /.post -->