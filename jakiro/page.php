<?php 
$main_class = dh_get_main_class();
$no_padding = dh_get_post_meta('no_padding');
?>
<?php get_header() ?>
	<div class="content-container<?php echo (!empty($no_padding) ? ' no-padding':'') ?>">
		<div class="<?php dh_container_class() ?>">
			<div class="row">
				<?php do_action('dh_left_sidebar')?>
			    <?php do_action('dh_left_sidebar_extra')?>
				<div class="<?php echo esc_attr($main_class) ?>" role="main">
					<div class="main-content">
						<?php if ( have_posts() ) : ?>
							<?php 
							 while (have_posts()): the_post();
								the_content();
							 endwhile;
							 ?>
							 <?php 
							if(dh_get_theme_option('comment-page',0) && comments_open(get_the_ID()))
								comments_template( '', true ); 
							?>
						<?php endif;?>
					</div>
				</div>
				<?php do_action('dh_right_sidebar_extra')?>
			    <?php do_action('dh_right_sidebar')?>
			</div>
		</div>
	</div>
<?php get_footer() ?>