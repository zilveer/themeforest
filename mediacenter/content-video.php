<?php
/* 
 * Template for displaying Video
 */
 ?>			
<div class="post format-video">
									
	<?php media_center_post_header();?>
	
	<div class="post-content">
		
		<?php media_center_video_player( get_the_ID() ); ?>

		<div class="post-entry">

			<h2 class="post-title">
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'mediacenter' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h2>

			<?php media_center_post_meta(); ?>

			<?php media_center_post_content();?>
			
		</div><!-- /.post-entry -->
		
	</div><!-- /.post-content --> 
	
</div><!-- /.post -->