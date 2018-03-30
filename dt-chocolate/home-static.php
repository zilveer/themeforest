<?php
/*Template Name: Homepage - Static*/
?>
<?php get_header(); ?>
<?php get_sidebar(); ?>

<?php if( have_posts() ): while(have_posts()): the_post();?>

<?php
global $post;
$box_name = 'homestatic';
$homepage_data = get_post_meta( $post->ID, 'dt_'. $box_name. '_options', true );
?>

<?php if ( !$homepage_data['dt_hide_desc'] ): ?>
	<div id="pg_desc2" class="pg_description">
	<?php if( !empty($post->post_content) ): ?>
		<div style="display:block;">
			<h2>
				<?php the_title(); ?>
			</h2>
			<p>
				<?php the_content(); ?>
			</p>
			<?php if( !empty($homepage_data['dt_link']) ): ?>
			<p>
				<a class="go_more" href="<?php echo esc_url($homepage_data['dt_link']); ?>">
					<span>
						<i></i>
						<?php _e('Details', LANGUAGE_ZONE); ?>
					</span>
				</a>
			</p>
			<?php endif ?>
		</div>
		<div class="desc-b"></div>
	<?php endif ?>
	</div>
<?php endif ?>
	
<?php if( !$homepage_data['dt_hide_over_mask'] ): ?>
	<div id="big-mask"></div>
<?php endif; ?>

<?php endwhile; ?>
<?php endif;?>

<?php get_footer(); ?>
