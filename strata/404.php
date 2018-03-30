<?php 
	global $qode_options_theme13; 
?>

<?php get_header(); ?>

			<?php get_template_part( 'title' ); ?>
			<div class="container">
				<div class="container_inner">
					<div class="page_not_found">
						<h2><?php if($qode_options_theme13['404_text'] != ""): echo $qode_options_theme13['404_text']; else: ?> <?php _e('The page you requested does not exist', 'qode'); ?> <?php endif;?></h2>
						<p><a class="qbutton with-shadow" href="<?php echo home_url(); ?>/"><?php if($qode_options_theme13['404_backlabel'] != ""): echo $qode_options_theme13['404_backlabel']; else: ?> <?php _e('Back to homepage', 'qode'); ?> <?php endif;?></a></p>
						<div class="separator  transparent center  " style="margin-top:30px;"></div>
					</div>
				</div>
			</div>
			
<?php get_footer(); ?>	