<?php global $qode_options_magnet; ?>	

<?php get_header(); ?>
			<div class="container">
				<div class="container_inner clearfix">
					<div class="title">
						<h1><?php if($qode_options_magnet['404_title'] != ""): echo $qode_options_magnet['404_title']; else: ?> <?php _e('404', 'qode'); ?> <?php endif;?></h1>
						<span><?php if($qode_options_magnet['404_subtitle'] != ""): echo $qode_options_magnet['404_subtitle']; else: ?> <?php _e('Something went wrong', 'qode'); ?> <?php endif; ?></span>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="container_inner clearfix">
					<div class="page_not_found">
						<h2><?php if($qode_options_magnet['404_text'] != ""): echo $qode_options_magnet['404_text']; else: ?> <?php _e('Page not found', 'qode'); ?> <?php endif;?></h2>
						<hr/>
						<p><a href="<?php echo home_url(); ?>/"><?php if($qode_options_magnet['404_backlabel'] != ""): echo $qode_options_magnet['404_backlabel']; else: ?> <?php _e('Back to homepage', 'qode'); ?> <?php endif;?></a></p>
					</div>
				</div>
			</div>
			
<?php get_footer(); ?>	